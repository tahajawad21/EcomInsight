<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
      protected $fillable = ['order_id', 'method', 'amount', 'status'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
