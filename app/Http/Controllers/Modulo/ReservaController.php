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
}
