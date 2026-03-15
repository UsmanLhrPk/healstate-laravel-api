<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailNotification extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = 'sent_at';

    protected $fillable = [
        'user_id',
        'email_to',
        'email_subject',
        'email_type',
        'related_application_id',
        'delivery_status',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Get the user that received the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related application.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(PractitionerApplication::class, 'related_application_id');
    }

    /**
     * Scope for sent emails.
     */
    public function scopeSent($query)
    {
        return $query->where('delivery_status', 'sent');
    }

    /**
     * Scope for failed emails.
     */
    public function scopeFailed($query)
    {
        return $query->where('delivery_status', 'failed');
    }

    /**
     * Scope for a specific email type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('email_type', $type);
    }
}