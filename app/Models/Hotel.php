<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'hoteles';
    protected $fillable = ['razon_social','ruc','direccion','telefono','whatsapp','logo','instagram','facebook','propietario_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function recursosHumanos(): HasMany
    {
        return $this->hasMany(Hotel::class, 'hotel_id');
    }
}
