<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoHabitacion extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'estados_habitaciones';
    protected $fillable = ['nombre','descripcion','icon','color','color_exadecimal','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
