<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'coupon_id',
        'user_id',
        'order_id',
        'original_amount',
        'discount_amount',
        'final_amount',
        'status'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
