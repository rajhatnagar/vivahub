<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'invoice_number',
        'amount',
        'description',
        'status',
        'date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public function partner()
    {
        return $this->belongsTo(PartnerDetail::class, 'partner_id');
    }
}
