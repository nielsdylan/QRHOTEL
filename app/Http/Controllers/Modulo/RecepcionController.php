<?php

namespace App\Http\Controllers\Modulo;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\EstadoHabitacion;
use App\Models\Habitacion;
use App\Models\MedioPago;
use App\Models\Recepcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecepcionController extends Controller
{
    //
    public function lista()
    {

        $data = Habitacion::where('habitaciones.hotel_id', Auth::user()->hotel_sesion)
            ->orderBy('habitaciones.nivel_id')
            ->get();
        return view('modulos.recepcion.lista', get_defined_vars());
    }
    public function registrar($id)
    {
        $habitacion = Habitacion::find($id);
        $recepcion = Recepcion::where('habitacion_id', $id)
            ->where('estado', 1)
            ->first();
        $medio_pago = MedioPago::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();
        $estado_habitacion = EstadoHabitacion::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();

        $clientes = Cliente::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();
        return view('modulos.recepcion.registrar', get_defined_vars());
    }
    public function guardar(Request $request)
    {
        $recepcion = Recepcion::firstOrNew(
            ['id' => $request->id],
        );
        $recepcion->fecha_entrada   = date('Y-m-d H:i:s');
        $recepcion->fecha_salida    = date('Y-m-d H:i:s');
        $recepcion->hora_entrada    = date('Y-m-d H:i:s');
        $recepcion->hora_salida     = date('Y-m-d H:i:s');
        $recepcion->adelanto        = date('Y-m-d H:i:s');
        $recepcion->total           = date('Y-m-d H:i:s');
        $recepcion->descuento       = date('Y-m-d H:i:s');
        $recepcion->cobrar_extra    = date('Y-m-d H:i:s');
        $recepcion->detalle         = date('Y-m-d H:i:s');
        $recepcion->email           = date('Y-m-d H:i:s');
        $recepcion->enviar_correo   = date('Y-m-d H:i:s');

        $recepcion->habitacion_id = date('Y-m-d H:i:s');
        $recepcion->usuario_id = date('Y-m-d H:i:s');
        $recepcion->cliente_id = date('Y-m-d H:i:s');
        $recepcion->medio_pago_id = date('Y-m-d H:i:s');
        $recepcion->estado_habitacion_id = date('Y-m-d H:i:s');
        $recepcion->hotel_id = Auth::user()->hotel_sesion;
        $recepcion->save();

        return response()->json([
            'status' => true,
            'message' => 'Recepcion guardada correctamente',
            'data' => $request->all(),
        ]);
    }
}
