<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->name,
            'order_by' => $this->product->user->name,
            'product_name' => $this->product->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
