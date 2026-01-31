<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'groom_name',
        'bride_name',
        'email',
        'wedding_date',
        'city',
        'status',
        'invitation_id'
    ];

    public function partner()
    {
        return $this->belongsTo(PartnerDetail::class, 'partner_id');
    }
}
