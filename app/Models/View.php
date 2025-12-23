<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class View extends Model
{
    public $timestamps = false; // We only need created_at
    
    protected $fillable = [
        'user_id',
        'viewable_type',
        'viewable_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the parent viewable model (Forum, Comment, etc.)
     */
    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who viewed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}