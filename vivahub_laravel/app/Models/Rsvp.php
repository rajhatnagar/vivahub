<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invitation_id',
        'guest_name',
        'guests_count',
        'phone',
        'attending_events'
    ];

    protected $casts = [
        'attending_events' => 'array',
    ];
}
