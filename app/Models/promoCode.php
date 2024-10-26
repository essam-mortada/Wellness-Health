<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'usage_limit', 'times_used', 'expires_at'];

    // Check if promo code is valid
    public function isValid()
    {
        return $this->expires_at === null || Carbon::now()->lessThanOrEqualTo($this->expires_at);
    }

    // Check if promo code has remaining usage
    public function hasRemainingUsage()
    {
        return $this->usage_limit === null || $this->times_used < $this->usage_limit;
    }

    // Increment the usage count
    public function incrementUsage()
    {
        $this->times_used += 1;
        $this->save();
    }
}
