<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecursoHumano extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'recursos_humanos';
    protected $fillable = ['hotel_id','usuario_id','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function hotel(): HasOne
    {
        return $this->hasOne(Hotel::class,'id');
    }
}
