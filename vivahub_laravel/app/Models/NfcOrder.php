<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NfcOrder extends Model
{
    protected $fillable = [
        'user_id',
        'invitation_id',
        'name',
        'phone',
        'address',
        'city',
        'pincode',
        'quantity',
        'status',
        'tracking_number'
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
