<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarifa extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'tarifas';
    protected $fillable = ['nombre','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
