<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recepcion extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'recepcion';
    protected $fillable = ['fecha_entrada','fecha_salida','hora_entrada','hora_salida','adelanto','total','descuento','cobrar_extra','detalle','email','enviar_correo','habitacion_id','usuario_id','cliente_id','medio_pago_id','estado_habitacion_id','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
