<?php

namespace App\Services;

use App\Models\User;
use App\Models\Challenge;
use App\Models\Participation;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public static function getRecommendedChallenges(User $user, $limit = 6)
    {
        try {
            $recommendations = [];

            // 1. Récupérer les préférences de l'utilisateur basées sur l'historique
            $userPreferences = self::getUserPreferences($user);
            
            // 2. Recommandation basée sur les défis similaires aux défis complétés
            $similarToCompleted = self::getChallengesSimilarToCompleted($user, $userPreferences, $limit);
            
            // 3. Recommandation basée sur la durée préférée
            $durationBased = self::getChallengesByPreferredDuration($user, $userPreferences, $limit);
            
            // 4. Recommandation basée sur la difficulté (points)
            $difficultyBased = self::getChallengesByPreferredDifficulty($user, $userPreferences, $limit);
            
            // 5. Défis populaires (fallback)
            $popularChallenges = self::getPopularChallenges($user, $limit);
            
            // Fusionner toutes les recommandations en évitant les doublons
            $allRecommendations = collect()
                ->merge($similarToCompleted)
                ->merge($durationBased)
                ->merge($difficultyBased)
                ->merge($popularChallenges)
                ->unique('id')
                ->shuffle()
                ->take($limit);
            
            return $allRecommendations;
        } catch (\Exception $e) {
            // En cas d'erreur, retourner les défis populaires
            \Log::error('Recommendation error: ' . $e->getMessage());
            return self::getPopularChallenges($user, $limit);
        }
    }
    
    private static function getUserPreferences(User $user)
    {
        $preferences = [
            'preferred_duration' => 7, // Valeur par défaut
            'preferred_difficulty' => 'medium',
            'completed_categories' => [],
            'avg_completion_time' => 0
        ];
        
        try {
            // Récupérer les défis complétés
            $completedChallenges = Participation::with('challenge')
                ->where('user_id', $user->id)
                ->where('completed', true)
                ->get();
                
            if ($completedChallenges->count() > 0) {
              
                $avgDuration = $completedChallenges->avg('challenge.duration');
                $preferences['preferred_duration'] = $avgDuration ? max(1, round((float)$avgDuration)) : 7;
                
              
                $avgReward = $completedChallenges->avg('challenge.reward');
                
                // Convertir en float et gérer les cas null/string
                $avgRewardValue = $avgReward ? (float)$avgReward : 0;
                
                if ($avgRewardValue < 50) {
                    $preferences['preferred_difficulty'] = 'easy';
                } elseif ($avgRewardValue < 100) {
                    $preferences['preferred_difficulty'] = 'medium';
                } else {
                    $preferences['preferred_difficulty'] = 'hard';
                }
                
              
                $totalCompletionTime = 0;
                $count = 0;
                foreach ($completedChallenges as $participation) {
                    if ($participation->completed_at && $participation->joined_at) {
                        $completionDays = $participation->joined_at->diffInDays($participation->completed_at);
                        $totalCompletionTime += $completionDays;
                        $count++;
                    }
                }
                $preferences['avg_completion_time'] = $count > 0 ? $totalCompletionTime / $count : 0;
            }
        } catch (\Exception $e) {
            \Log::error('User preferences error: ' . $e->getMessage());
           
        }
        
        return $preferences;
    }
    
    private static function getChallengesSimilarToCompleted(User $user, $preferences, $limit)
    {
        try {
           
            $completedChallengeIds = Participation::where('user_id', $user->id)
                ->where('completed', true)
                ->pluck('challenge_id');
                
            if ($completedChallengeIds->count() === 0) {
                return collect();
            }
            
            // Trouver des défis similaires (même créateur ou durée similaire)
            return Challenge::where('status', 'approved')
                ->where('end_date', '>=', now())
                ->whereNotIn('id', $completedChallengeIds)
                ->whereDoesntHave('participations', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where(function($query) use ($completedChallengeIds, $preferences) {
                    // Similaire en durée (± 3 jours)
                    $query->whereBetween('duration', [
                        max(1, $preferences['preferred_duration'] - 3),
                        $preferences['preferred_duration'] + 3
                    ]);
                    
                    // Ou même créateur que les défis complétés
                    $completedCreators = Challenge::whereIn('id', $completedChallengeIds)
                        ->pluck('creator_id');
                    if ($completedCreators->count() > 0) {
                        $query->orWhereIn('creator_id', $completedCreators);
                    }
                })
                ->with(['creator', 'participations'])
                ->withCount(['participations as current_participants_count'])
                ->orderBy('current_participants_count', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Exception $e) {
            \Log::error('Similar challenges error: ' . $e->getMessage());
            return collect();
        }
    }
    
    private static function getChallengesByPreferredDuration(User $user, $preferences, $limit)
    {
        try {
            return Challenge::where('status', 'approved')
                ->where('end_date', '>=', now())
                ->whereDoesntHave('participations', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->whereBetween('duration', [
                    max(1, $preferences['preferred_duration'] - 2),
                    $preferences['preferred_duration'] + 2
                ])
                ->with(['creator', 'participations'])
                ->withCount(['participations as current_participants_count'])
                ->orderBy('current_participants_count', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Exception $e) {
            \Log::error('Duration based challenges error: ' . $e->getMessage());
            return collect();
        }
    }
    
    private static function getChallengesByPreferredDifficulty(User $user, $preferences, $limit)
    {
        try {
            $rewardRange = [
                'easy' => [10, 50],
                'medium' => [51, 100],
                'hard' => [101, 500]
            ];
            
            $range = $rewardRange[$preferences['preferred_difficulty']] ?? $rewardRange['medium'];
            
            return Challenge::where('status', 'approved')
                ->where('end_date', '>=', now())
                ->whereDoesntHave('participations', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->whereBetween('reward', $range)
                ->with(['creator', 'participations'])
                ->withCount(['participations as current_participants_count'])
                ->orderBy('current_participants_count', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Exception $e) {
            \Log::error('Difficulty based challenges error: ' . $e->getMessage());
            return collect();
        }
    }
    
    private static function getPopularChallenges(User $user, $limit)
    {
        try {
            return Challenge::where('status', 'approved')
                ->where('end_date', '>=', now())
                ->whereDoesntHave('participations', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with(['creator', 'participations'])
                ->withCount(['participations as current_participants_count'])
                ->orderBy('current_participants_count', 'desc')
                ->orderBy('reward', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Exception $e) {
            \Log::error('Popular challenges error: ' . $e->getMessage());
            return collect();
        }
    }
    
   
    public static function getRecommendationExplanation(User $user)
    {
        try {
            $preferences = self::getUserPreferences($user);
            $completedCount = Participation::where('user_id', $user->id)
                ->where('completed', true)
                ->count();
                
            if ($completedCount === 0) {
                return "Découvrez nos défis les plus populaires pour commencer votre parcours bien-être !";
            }
            
            $explanations = [
                "Basé sur vos défis précédents (durée moyenne: {$preferences['preferred_duration']} jours)",
                "Adapté à votre niveau de difficulté préféré",
                "Défis similaires à ceux que vous avez complétés avec succès",
                "Recommandations personnalisées selon votre historique"
            ];
            
            return $explanations[array_rand($explanations)];
        } catch (\Exception $e) {
            \Log::error('Recommendation explanation error: ' . $e->getMessage());
            return "Découvrez des défis spécialement sélectionnés pour vous !";
        }
    }
}