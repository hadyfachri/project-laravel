<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory, HasUuids;

    public $fillable = [
        'supplier_id',
        'product_id',
        'quantity',
        'cost_price',
        'recieved_date',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
