<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // status constants
    const STATUS_PENDING = 0;
    const STATUS_PROCESSING= 1;
    const STATUS_SHIPPED= 2;
    const STATUS_DELIVERED = 3;
    const STATUS_CANCELED = 4;
    const STATUS_RETURNED = 5;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    // Accessor for human-readable status
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case self::STATUS_CANCELED:
                return 'Canceled';
            case self::STATUS_PROCESSING:
                return 'Processing';
            case self::STATUS_SHIPPED:
                return 'Shipped';
            case self::STATUS_DELIVERED:
                return 'Delivered';
            case self::STATUS_RETURNED:
                return 'Returned';
            default:
                return 'Pending';
        }
    }


}
