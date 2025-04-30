<?php

namespace App\Http\Controllers\Modulo\PuntoVenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VenderProductoController extends Controller
{
    //
    public function lista()
    {
        return view('modulo.punto-venta.vender-producto.lista', get_defined_vars());
    }
}
