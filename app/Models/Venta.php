<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'ventas';
    protected $fillable = ['codigo', 'recepcion_id', 'pagado', 'sub_total', 'total','hotel_id','usuario_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
