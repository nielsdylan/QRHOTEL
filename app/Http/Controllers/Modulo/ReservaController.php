<?php

namespace App\Http\Controllers\Modulo;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\EstadoHabitacion;
use App\Models\MedioPago;
use App\Models\Recepcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    //
    public function calendario(){
        $medio_pago = MedioPago::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();
        $estado_habitacion = EstadoHabitacion::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();

        $clientes = Cliente::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();
        return view('modulos.reserva.calendario', get_defined_vars());
    }
    public function listaReservas(){
        $data = Recepcion::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();


        $reservas = [];
        foreach ($data as $key => $value) {
            array_push($reservas, [
                'id' => $value->id,
                'start' => $value->fecha_entrada . 'T' . $value->hora_entrada,
                'end' => $value->fecha_salida . 'T' . $value->hora_salida,
                'title' => $value->habitacion->nombre,
                'rendering'=> 'background',
                'color'=> 'rgba(0,0,0,0.1)'
                // 'color' => '#3788d8',
                // 'textColor' => '#fff',
                // 'url' => route('recepcion.registrar', ['id' => $value->id]),
            ]);
        }
        // {
        //     start: '2025-04-06',
        //     end: '2025-04-11',
        //     title: 'Conference',
        //     // overlap: false,
        //     rendering: 'background',
        //     color: 'rgba(0,0,0,0.1)'
        // }
        return response()->json($reservas,200);
    }
    public function obtenerReserva($id) {
        $reserva = Recepcion::find($id);
        if ($reserva) {
            return response()->json([
                "data" => $reserva,
                "cliente" => $reserva->cliente->persona,
                "estado" => true,
            ], 200);
        }
        return response()->json([
            "data" => $reserva,
            "estado" => false,
        ], 200);
    }
    public function guardar(Request $request) {
        // $cliente = Cliente::where('dni',)->firs();
        $recepcion = Recepcion::firstOrNew(
            ['id' => $request->recepcion_id],
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
        $recepcion->estado_habitacion_id    = $request->estado_habitacion_id;
        $recepcion->hotel_id = Auth::user()->hotel_sesion;
        $recepcion->save();

        return response()->json([
            'title' => "Éxito",
            'text' => 'Se guardó correctamente',
            'icon' => 'success',
        ]);
    }
}
