<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        $slot = $this->route('slot');
        return $slot && $slot->product->vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'duration' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ];
    }
}