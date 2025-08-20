<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_price',
        'status',
        'shipping_address',
        'shipping_city',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Order statuses
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    // Payment statuses
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_FAILED = 'failed';

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    // Helper methods
    public function calculateTotal()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isPaid()
    {
        return $this->payment_status === self::PAYMENT_PAID;
    }

    // Helper methods for customer info
    public function getCustomerNameAttribute()
    {
        return $this->customer ? $this->customer->full_name : 'Guest Customer';
    }

    public function getCustomerPhoneAttribute()
    {
        return $this->customer ? $this->customer->phone : 'N/A';
    }

    public function getCustomerCityAttribute()
    {
        return $this->customer ? $this->customer->city : 'N/A';
    }
}
