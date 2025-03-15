<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'personas';
    protected $fillable = ['apellidos','nombres','dni','telefono','estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
