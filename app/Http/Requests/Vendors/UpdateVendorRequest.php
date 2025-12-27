<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('vendor')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'business_name' => 'sometimes|required|string|max:255',
            'brief' => 'sometimes|required|string',
            'category' => 'sometimes|required|array',
            'category.*' => 'required|string',
            'website' => 'nullable|url|max:255',
            'street_address' => 'nullable|string|max:255',
            'city' => 'required_with:street_address|string|max:255',
            'state_province' => 'required_with:street_address|string|max:255',
            'postal_code' => 'nullable|string|max:255',
        ];
    }
}