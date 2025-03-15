<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'clientes';
    protected $fillable = ['estado','persona_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
