<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use App\Models\ApplicationDocument;

class ApplicationDocument extends Model
{
    const UPDATED_AT = null;

    const CREATED_AT = 'uploaded_at';

    protected $fillable = [
        'application_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'document_type',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'uploaded_at' => 'datetime',
    ];

    /**
     * Get the application that owns the document.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(PractitionerApplication::class, 'application_id');
    }

    /**
     * Get the full URL to the document.
     */
    public function getUrlAttribute(): string
    {
        return '/api/admin/practitioners/documents/'.$this->id.'/download';
    }

    /**
     * Get the file size in MB.
     */
    public function getFileSizeMbAttribute(): float
    {
        return round($this->file_size / 1048576, 2);
    }

    /**
     * Delete the file from storage when the model is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($document) {
            if (Storage::exists($document->file_path)) {
                Storage::delete($document->file_path);
            }
        });
    }
}
