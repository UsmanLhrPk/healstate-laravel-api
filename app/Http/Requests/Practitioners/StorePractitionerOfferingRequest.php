<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerOfferingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $profile = $this->route('profile');
        return $profile && $profile->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'subcategory_id' => 'required|exists:service_subcategories,id',
            'title'          => 'required|string|max:255',
            'brief'          => 'required|string|max:255',
            'description'    => 'required|string|max:10000',
            'duration'       => 'required|integer|min:1',
            'price'          => 'required|numeric|min:0',
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
            'images.*.max'          => 'Each image must be less than 5MB',
        ];
    }
}
