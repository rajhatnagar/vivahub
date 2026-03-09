<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invitation_id',
        'product_type',
        'product_details',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_pincode',
        'quantity',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'product_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
