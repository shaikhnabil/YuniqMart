<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}