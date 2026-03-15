<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'application_id' => $this->application_id,
            'file_name' => $this->file_name,
            'file_type' => $this->file_type,
            'file_size' => $this->file_size,
            'file_size_mb' => $this->file_size_mb,
            'document_type' => $this->document_type,
            'url' => $this->url,
            'uploaded_at' => $this->uploaded_at?->toIso8601String(),
        ];
    }
}