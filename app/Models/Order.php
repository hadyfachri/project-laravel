<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,HasUuids;

    public $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
