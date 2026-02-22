<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePractitionerOfferingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $offering = $this->route('offering');
        return $offering && $offering->practitionerProfile->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'subcategory_id' => 'sometimes|exists:service_subcategories,id',
            'title'          => 'sometimes|required|string|max:255',
            'brief'          => 'sometimes|required|string|max:255',
            'description'    => 'sometimes|required|string|max:10000',
            'duration'       => 'sometimes|required|integer|min:1',
            'price'          => 'sometimes|required|numeric|min:0',
            'active'         => 'sometimes|boolean',
            'images'         => 'sometimes|array|max:5',
            'images.*'       => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
        ];
    }
}
