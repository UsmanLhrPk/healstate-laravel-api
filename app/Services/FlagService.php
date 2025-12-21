<?php

namespace App\Services;

use App\Models\Flag;

class FlagService
{
    /**
     * Flag content
     * Throws exception if already flagged
     */
    public function flagContent(string $flaggableType, int $flaggableId, int $userId): void
    {
        // Check if already flagged by this user
        $existingFlag = Flag::where('user_id', $userId)
            ->where('flaggable_type', $flaggableType)
            ->where('flaggable_id', $flaggableId)
            ->first();

        if ($existingFlag) {
            throw new \Exception('You have already flagged this content');
        }

        // Create flag
        Flag::create([
            'user_id' => $userId,
            'flaggable_type' => $flaggableType,
            'flaggable_id' => $flaggableId,
        ]);
    }

    /**
     * Get flag count for a flaggable entity
     */
    public function getFlagCount(string $flaggableType, int $flaggableId): int
    {
        return Flag::where('flaggable_type', $flaggableType)
            ->where('flaggable_id', $flaggableId)
            ->count();
    }

    /**
     * Check if user has flagged an entity
     */
    public function hasUserFlagged(string $flaggableType, int $flaggableId, int $userId): bool
    {
        return Flag::where('user_id', $userId)
            ->where('flaggable_type', $flaggableType)
            ->where('flaggable_id', $flaggableId)
            ->exists();
    }

    /**
     * Get all flags for an entity
     */
    public function getFlagsForEntity(string $flaggableType, int $flaggableId)
    {
        return Flag::where('flaggable_type', $flaggableType)
            ->where('flaggable_id', $flaggableId)
            ->with('user:id,name,email')
            ->get();
    }

    /**
     * Get all flags by a user
     */
    public function getUserFlags(int $userId, ?string $flaggableType = null)
    {
        $query = Flag::where('user_id', $userId);

        if ($flaggableType) {
            $query->where('flaggable_type', $flaggableType);
        }

        return $query->get();
    }

    /**
     * Remove flag (admin/moderation feature)
     */
    public function removeFlag(int $flagId): bool
    {
        return Flag::where('id', $flagId)->delete() > 0;
    }

    /**
     * Remove all flags for an entity (admin/moderation feature)
     */
    public function removeAllFlagsForEntity(string $flaggableType, int $flaggableId): int
    {
        return Flag::where('flaggable_type', $flaggableType)
            ->where('flaggable_id', $flaggableId)
            ->delete();
    }
}