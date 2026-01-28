<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $fillable = [
        'name',
        'category', // invitation, board, nfc
        'design_type_id',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function designType()
    {
        return $this->belongsTo(DesignType::class);
    }
}
