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
        'footer_branding',
        'footer_text',
        'social_facebook',
        'social_instagram',
        'social_whatsapp',
        'social_website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'partner_id', 'user_id');
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
