<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'style',
        'color',
        'img',
        'description',
        'version',
        'is_active',
        'is_custom',
        'zip_path',
        'assets_path'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_custom' => 'boolean',
    ];
}
