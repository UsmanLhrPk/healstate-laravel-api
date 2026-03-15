<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePractitionerOfferingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $offering = $this->route('offering');
        return $offering
            && $offering->practitionerProfile
            && $offering->practitionerProfile->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'subcategory_id' => 'sometimes|exists:service_subcategories,id',
            'title'          => 'sometimes|string|max:255',
            'brief'          => 'sometimes|string|max:255',
            'description'    => 'sometimes|string|max:10000',
            'duration'       => 'sometimes|integer|min:1',
            'price'          => 'sometimes|numeric|min:0',
            'active'         => 'sometimes|boolean',
            'images'         => 'sometimes|array|max:5',
            'images.*'       => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'subcategory_id.exists' => 'The selected service subcategory does not exist',
            'images.max'            => 'You can upload a maximum of 5 images',
            'images.*.image'        => 'Each file must be a valid image',
            'images.*.mimes'        => 'Images must be JPEG, PNG, GIF, or WebP',
            'images.*.max'          => 'Each image must be less than 5 MB',
        ];
    }
}