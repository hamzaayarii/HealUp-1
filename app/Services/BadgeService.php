<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;

class BadgeService
{
    public static function checkForNewBadges(User $user)
    {
        $user->checkAndAwardBadges();
    }

    public static function getBadgeProgress(User $user, Badge $badge)
    {
        $criteria = $badge->criteria;
        $userStats = $user->getChallengeStats();
        
        $progress = [];
        foreach ($criteria as $key => $target) {
            $current = $userStats[$key] ?? 0;
            $progress[$key] = [
                'current' => $current,
                'target' => $target,
                'percentage' => $target > 0 ? min(100, ($current / $target) * 100) : 0
            ];
        }
        
        return $progress;
    }

    public static function getUserBadgesWithProgress($user)
    {
        $badges = Badge::active()->get();
        $earnedBadges = $user->earnedBadges;
        
        $result = [];
        foreach ($badges as $badge) {
            $isEarned = $earnedBadges->contains('id', $badge->id);
            $progress = $isEarned ? null : self::getBadgeProgress($user, $badge);
            
            $result[] = [
                'badge' => $badge,
                'is_earned' => $isEarned,
                'progress' => $progress
            ];
        }
        
        return $result;
    }
}