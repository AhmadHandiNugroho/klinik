<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function daftar(): HasMany
    {
        return $this->hasMany(Daftar::class);
    }
}