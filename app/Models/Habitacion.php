<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitacion extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'habitaciones';
    protected $fillable = ['nombre','precio','nivel_id','tarifa_id','categoria_id','hotel_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // relacion de uno a uno
    public function nivel(): HasOne
    {
        return $this->hasOne(Nivel::class,'id','nivel_id');
    }
    public function categoria(): HasOne
    {
        return $this->hasOne(Categoria::class,'id','categoria_id');
    }
}
