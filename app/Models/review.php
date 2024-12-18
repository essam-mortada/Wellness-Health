<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(product::class,  'product_id');
    }

}
