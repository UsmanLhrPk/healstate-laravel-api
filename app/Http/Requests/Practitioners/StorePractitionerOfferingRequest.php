<?php

namespace App\Http\Requests\Practitioners;

use App\Services\HtmlSanitizerService;
use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerOfferingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $profile = $this->route('profile');
        return $profile && $profile->user_id === auth()->id();
    }

    /**
     * Sanitize before validation so the validated() output is already clean.
     *
     * - title / brief  → plain text, zero HTML allowed
     * - description    → rich HTML from the editor, run through HTMLPurifier
     */
    protected function prepareForValidation(): void
    {
        $sanitizer = app(HtmlSanitizerService::class);

        $merge = [];

        if ($this->has('title')) {
            $merge['title'] = $sanitizer->sanitizePlainText($this->input('title'));
        }

        if ($this->has('brief')) {
            $merge['brief'] = $sanitizer->sanitizePlainText($this->input('brief'));
        }

        if ($this->has('description')) {
            $merge['description'] = $sanitizer->sanitize($this->input('description'));
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }

    public function rules(): array
    {
        return [
            'subcategory_id' => ['required', 'exists:service_subcategories,id'],
            'title'          => ['required', 'string', 'max:255'],
            'brief'          => ['required', 'string', 'max:255'],
            'description'    => ['required', 'string', 'max:10000'],
            'duration'       => ['required', 'integer', 'min:1', 'max:1440'],
            'price'          => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'active'         => ['sometimes', 'boolean'],
            'images'         => ['sometimes', 'array', 'max:5'],
            'images.*'       => ['image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'subcategory_id.exists' => 'The selected service subcategory does not exist.',
            'duration.max'          => 'Duration cannot exceed 1440 minutes (24 hours).',
            'price.max'             => 'Price cannot exceed 99,999.99.',
            'images.max'            => 'You can upload a maximum of 5 images.',
            'images.*.image'        => 'Each file must be a valid image.',
            'images.*.mimes'        => 'Images must be JPEG, PNG, GIF, or WebP.',
            'images.*.max'          => 'Each image must be less than 5 MB.',
        ];
    }
}