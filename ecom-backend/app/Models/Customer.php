<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'city',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Helper methods
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    // Find or create customer by phone number
    public static function findOrCreateByPhone($phone, $firstname, $lastname, $city)
    {
        return static::firstOrCreate(
            ['phone' => $phone],
            [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'city' => $city,
            ]
        );
    }
}
