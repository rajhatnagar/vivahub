<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'type', // User, Partner, Offline
        'validity',
        'features',
        'description',
        'is_active',
        'is_popular',
        'css_class',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Robust accessor to ensure features is always an array
    public function getFeaturesAttribute($value)
    {
        if (is_null($value)) {
            return [];
        }
        // If it's already an array (due to cast), return it
        if (is_array($value)) {
            return $value;
        }
        // If it's a JSON string, decode it
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }
}
