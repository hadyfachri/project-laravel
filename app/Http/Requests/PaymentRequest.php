<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaymentRequest extends FormRequest
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
            'amount'            => 'required|integer|max:10',   
            'payment_method'    => 'required|string|in:credit_card,bank_transfer,cash,ewallet',
            'status'            => 'required|string|in:pending, completed, failed',
            'transaction_date'  => 'date'
        ];
    }
}
