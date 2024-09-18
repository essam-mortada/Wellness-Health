<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category',
        'quantity',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function reviews()
    {
        return $this->hasMany(review::class);
    }
}
