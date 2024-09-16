<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'supplier_name' => $this->supplier->name,
            'product_name'=> $this->product->name,
            'quantity'=> $this->quantity,
            'cost_price'=> $this->cost_price,
            'recieved_date'=> $this->recieved_date,
        ];
    }
}
