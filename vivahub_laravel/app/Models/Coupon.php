<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'code',
        'discount_type',
        'discount_value',
        'max_uses',
        'status',
        'client_email',
        'used_by',
        'used_at',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }
}
