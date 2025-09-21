<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
        'is_active',
        'show_in_menu',
        'image',
    ];

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
