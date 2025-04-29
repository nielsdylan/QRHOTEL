<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recepcion extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'recepcion';
    protected $fillable = ['fecha_entrada','fecha_salida','hora_entrada','hora_salida','adelanto','total','descuento','cobrar_extra','detalle','email','enviar_correo','habitacion_id','usuario_id','cliente_id','medio_pago_id','estado_habitacion_id','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function habitacion(): HasOne
    {
        return $this->hasOne(Habitacion::class,'id','habitacion_id');
    }
    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class,'id','cliente_id');
    }
    public function estadoHabitacion(): HasOne
    {
        return $this->hasOne(EstadoHabitacion::class,'id','estado_habitacion_id');
    }

}
