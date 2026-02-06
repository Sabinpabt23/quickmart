<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_method'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // ADD THIS RELATIONSHIP:
    // Relationship with OrderItems
    public function orderItems()  // Note: plural 'orderItems' 
    {
        return $this->hasMany(OrderItem::class);
    }
}