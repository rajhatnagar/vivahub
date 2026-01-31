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
        'status',
        'client_email',
    ];

    public function partner()
    {
        return $this->belongsTo(PartnerDetail::class, 'partner_id');
    }
}
