<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
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
            'order_by' => $this->order->user->name,
            'address'=> $this->address,
            'shipping_method'=> $this->shipping_method,
            'shipping_cost'=> $this->shipping_cost,
            'status'=> $this->status,
        ];
    }
}
