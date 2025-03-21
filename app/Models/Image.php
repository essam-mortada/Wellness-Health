<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['product_id', 'image_path'];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
