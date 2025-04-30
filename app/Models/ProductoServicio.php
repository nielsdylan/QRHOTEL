<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoServicio extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'productos_servicios';
    protected $fillable = ['codigo','nombre','descripcion','precio','cantidad','producto','servicio','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
