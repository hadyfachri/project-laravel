<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => $this->category->name,
            'name' => $this->name,
            'description' => $this->description,
            'price' => 'Rp.'.$this->price,
            'stock' => $this->stock,
            'image' => $this->image
        ];
    }
}
