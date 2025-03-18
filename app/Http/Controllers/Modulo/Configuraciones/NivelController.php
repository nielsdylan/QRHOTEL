<?php

namespace App\Http\Controllers\Modulo\Configuraciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    //
    public function lista(){
        return view('modulos.configuraciones.niveles.lista', get_defined_vars());
    }
}
