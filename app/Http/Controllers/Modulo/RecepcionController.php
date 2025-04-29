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
            ->where('hotel_id', Auth::user()->hotel_sesion)
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
        try {
            $recepcion = Recepcion::firstOrNew(
                ['id' => $request->id],
            );
            $recepcion->fecha_entrada   = $request->fecha_entrada;
            $recepcion->fecha_salida    = $request->fecha_salida;
            $recepcion->hora_entrada    = $request->hora_entrada;
            $recepcion->hora_salida     = $request->hora_salida;
            $recepcion->adelanto        = $request->adelanto;
            $recepcion->total           = $request->total;
            $recepcion->descuento       = $request->descuento;
            $recepcion->cobrar_extra    = $request->cobrar_extra;
            $recepcion->detalle         = $request->detalle;
            // $recepcion->email           = $request->email;
            // $recepcion->enviar_correo   = $request->enviar_correo;

            $recepcion->habitacion_id           = $request->habitacion_id;
            $recepcion->usuario_id              = Auth::user()->id;
            $recepcion->cliente_id              = $request->cliente_id;
            $recepcion->medio_pago_id           = $request->medio_pago_id;
            $recepcion->estado_habitacion_id    = 3;
            $recepcion->hotel_id = Auth::user()->hotel_sesion;
            $recepcion->save();

            return response()->json([
                'title' => "Éxito",
                'text' => 'Se guardó correctamente',
                'icon' => 'success',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => "Error",
                'text' => 'Se genero un error comunicar el departamento de sistemas',
                'icon' => 'error',
            ]);
        }

    }
}
