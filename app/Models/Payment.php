<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory,HasUuids;

    public $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'status',
        'transaction_date'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
