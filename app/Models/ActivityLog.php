<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'action_type',
        'entity_type',
        'entity_id',
        'ip_address',
        'user_agent',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for a specific action type.
     */
    public function scopeOfAction($query, string $action)
    {
        return $query->where('action_type', $action);
    }

    /**
     * Scope for a specific entity.
     */
    public function scopeForEntity($query, string $entityType, int $entityId)
    {
        return $query->where('entity_type', $entityType)
                     ->where('entity_id', $entityId);
    }

    /**
     * Static method to log an activity.
     */
    public static function log(
        ?int $userId,
        string $actionType,
        ?string $entityType = null,
        ?int $entityId = null,
        ?array $details = null
    ): self {
        return self::create([
            'user_id' => $userId,
            'action_type' => $actionType,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'details' => $details,
        ]);
    }
}