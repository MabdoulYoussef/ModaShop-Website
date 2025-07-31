<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Helper methods
    public function getTotal()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function getItemCount()
    {
        return $this->cartItems->sum('quantity');
    }

    public function isEmpty()
    {
        return $this->cartItems->count() === 0;
    }
}
