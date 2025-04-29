<?php

namespace App\Http\Controllers\Modulo;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\EstadoHabitacion;
use App\Models\Habitacion;
use App\Models\MedioPago;
use App\Models\Persona;
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
        $habitaciones = Habitacion::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();
            // foreach ($habitaciones as $key => $value) {
            //     $value->estadoHabitacion = $value->estadoHabitacion($value->id);
            // }
            // return $habitaciones;
        return view('modulos.reserva.calendario', get_defined_vars());
    }
    public function listaReservas(){
        $data = Recepcion::where('hotel_id', Auth::user()->hotel_sesion)
            ->where('estado', 1)
            ->get();

        // return response()->json([
        //     'data' => $data,
        // ], 200);
        $reservas = [];
        foreach ($data as $key => $value) {

            array_push($reservas, [
                'id' => $value->id,
                'start' => $value->fecha_entrada . 'T' . $value->hora_entrada,
                'end' => $value->fecha_salida . 'T' . $value->hora_salida,
                'title' => $value->habitacion->nombre,
                'rendering'=> 'background',
                // 'color'=> 'rgba(0,0,0,0.1)'
                'color' => $value->estadoHabitacion->color_exadecimal,
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
                "habitacion" => $reserva->habitacion,
                "persona" => $reserva->cliente->persona,
                "estado" => true,
            ], 200);
        }
        return response()->json([
            "data" => $reserva,
            "estado" => false,
        ], 200);
    }
    public function guardar(Request $request) {
        $cliente_id = $request->cliente_id;
        if((int) $request->cliente_id == 0){

            $persona = Persona::where('dni',$request->dni)->where('hotel_id',Auth::user()->hotel_sesion)->first();
            if(!$persona){
                $persona = new Persona();
            }
            $persona->nombres = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->dni = $request->dni;
            $persona->telefono = $request->telefono;
            // $persona->email = $request->email;
            $persona->hotel_id = Auth::user()->hotel_sesion;
            $persona->save();

            $cliente = Cliente::where('persona_id',$persona->id)->where('hotel_id',Auth::user()->hotel_sesion)->first();
            if(!$cliente){
                $cliente = new Cliente();
            }
            $cliente->persona_id = $persona->id;
            $cliente->hotel_id = Auth::user()->hotel_sesion;
            $cliente->estado = 1;
            $cliente->save();
            $cliente_id = $cliente->id;
        }

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
        $recepcion->habitacion_id           = $request->habitacion_id;
        $recepcion->usuario_id              = Auth::user()->id;
        $recepcion->cliente_id              = $cliente_id;
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
    public function actualizarFechas(Request $request) {
        $recepcion = Recepcion::find($request->recepcion_id);
        if ($recepcion) {
            $recepcion->fecha_entrada   = $request->fecha_inicio;
            $recepcion->fecha_salida    = $request->fecha_fin;
            $recepcion->save();
            return response()->json([
                'title' => "Éxito",
                'text' => 'Se actualizó correctamente',
                'icon' => 'success',
            ]);
        }
        return response()->json([
            'title' => "Error",
            'text' => 'No se encontró la reserva',
            'icon' => 'error',
        ]);
    }
}
