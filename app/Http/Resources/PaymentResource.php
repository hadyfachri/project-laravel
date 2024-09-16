<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_by'=> $this->order->user->name,
            'amount'=> $this->amount,
            'payment_method'=> $this->payment_method,
            'status'=> $this->status,
            'transaction_date' => $this->transaction_date
        ];
    }
}
