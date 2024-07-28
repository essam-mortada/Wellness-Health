<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItems extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function order(){
        return $this->belongsTo(order::class);
    }
}
