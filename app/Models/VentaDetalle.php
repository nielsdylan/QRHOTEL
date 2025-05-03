<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VentaDetalle extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'ventas_detalles';
    protected $fillable = ['producto_servicio_id','precio','cantidad','total', 'pagado','hotel_id','venta_id','usuario_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
