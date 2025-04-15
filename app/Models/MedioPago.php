<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedioPago extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'medios_pagos';
    protected $fillable = ['nombre','descripcion','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
