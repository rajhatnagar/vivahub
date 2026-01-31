<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'amount',
        'description',
        'type',
        'reference_id'
    ];

    public function partner()
    {
        return $this->belongsTo(PartnerDetail::class, 'partner_id');
    }
}
