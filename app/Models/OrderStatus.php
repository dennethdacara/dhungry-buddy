<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    const _PENDING = 1;
    const _ORDER_ACCEPTED = 2;
    const _PREPARING = 3;
    const _FOR_DELIVERY = 4;
    const _DELIVERED = 5;
    const _CANCELLED = 6;
}
