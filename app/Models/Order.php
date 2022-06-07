<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (is_null($model->order_no)) {
                $model->order_no = IdGenerator::generate([
                    'table'  => 'orders',
                    'field'  => 'order_no',
                    'length' => 10,
                    'prefix' => 'OR-',
                ]);
            }
        });
    }

}
