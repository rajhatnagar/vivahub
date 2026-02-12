<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agency_name',
        'credits',
        'logo_url',
        'phone',
        'primary_color',
        'gst_number',
        'currency',
        'billing_address',
        'footer_branding' // Also saw this in controller update logic
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'partner_id');
    }

    public function clients()
    {
        return $this->hasMany(PartnerClient::class, 'partner_id');
    }

    public function creditLogs()
    {
        return $this->hasMany(CreditLog::class, 'partner_id');
    }

    public function invoices()
    {
        return $this->hasMany(PartnerInvoice::class, 'partner_id');
    }
}
