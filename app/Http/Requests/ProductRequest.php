<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'category_id'   => 'required|uuid',
            'name'          => 'required|string|max:128|unique',
            'description'   => 'sometimes|string|nullable',
            'price'         => 'required|decimal:10,2',
            'stock'         => 'required|integer|max:10',
            'image'         => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
