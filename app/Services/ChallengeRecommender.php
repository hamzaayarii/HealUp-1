<?php

namespace App\Services;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Support\Collection;

class ChallengeRecommender
{
    /**
     * Return a collection of recommended challenges for the given user.
     *
     * Strategy (heuristic):
     * - Prefer challenges in categories the user already participated in.
     * - Prioritize high reward and recent/active challenges.
     * - Exclude challenges the user already completed or is currently participating in.
     *
     * @param User $user
     * @param int $limit
     * @return Collection|\Illuminate\Database\Eloquent\Collection
     */
    public function recommendFor(User $user, int $limit = 6)
    {
        // Get category ids the user has taken part in via participations -> challenge -> category
        $categoryIds = $user->participations()
            ->join('challenges', 'participations.challenge_id', '=', 'challenges.id')
            ->whereNotNull('challenges.category_id')
            ->pluck('challenges.category_id')
            ->unique()
            ->values()
            ->all();

        // Get challenge ids the user is already participating or completed in
        $excludedChallengeIds = $user->participations()->pluck('challenge_id')->unique()->values();

        $query = Challenge::where('status', 'approved')
            ->whereNotIn('id', $excludedChallengeIds)
            ->where(function ($q) {
                // Prefer challenges that are active now or without end_date
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->withCount('participations');

        // If we have category signals, boost those first
        if (!empty($categoryIds)) {
            $preferred = (clone $query)->whereIn('category_id', $categoryIds)
                ->orderByDesc('reward')
                ->orderByDesc('participations_count')
                ->latest()
                ->limit($limit)
                ->get();

            // If we found enough preferred, return them
            if ($preferred->count() >= $limit) {
                return $preferred->take($limit);
            }

            // Otherwise, fill the rest from the general pool
            $remaining = $limit - $preferred->count();
            $others = (clone $query)
                ->whereNotIn('category_id', $categoryIds)
                ->orderByDesc('reward')
                ->orderByDesc('participations_count')
                ->latest()
                ->limit($remaining)
                ->get();

            return $preferred->concat($others)->slice(0, $limit);
        }

        // No category signal: pick by reward + popularity
        return $query->orderByDesc('reward')
            ->orderByDesc('participations_count')
            ->latest()
            ->limit($limit)
            ->get();
    }
}
