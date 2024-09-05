<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id'          => 'required|uuid',
            'address'           => 'required|string|max:512',  
            'shipping_method'   => 'required|string|in:standard,express,pickup',
            'shipping_cost'     => 'required|decimal:10,2',
            'status'            => 'sometimes|string|in:pending, shipped, delivery, returned, picked',
        ];
    }
}
