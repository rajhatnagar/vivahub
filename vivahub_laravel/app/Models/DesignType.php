<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignType extends Model
{
    protected $fillable = ['name'];

    public function designs()
    {
        return $this->hasMany(Design::class);
    }
}
