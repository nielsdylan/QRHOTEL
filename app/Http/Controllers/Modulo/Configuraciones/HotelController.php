<?php

namespace App\Http\Controllers\Modulo\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\RecursoHumano;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    //
    public function autoSeleccionar(){
        $recursos_humanos = RecursoHumano::where('usuario_id',Auth::user()->id)->get();

        // primero consultamos si ya se le asigno un hotel
        if(Auth::user()->hotel_sesion!==0){
            return response()->json([
                "estado"=>true,
                "mensaje"=>"Hotel asignado."
            ],200);
        }
        // realizamos el proceso de ver cuantos hoteles tiene para que pueda seleccionar uno de ellos
        if(sizeof($recursos_humanos)==1){
            $user = User::find(Auth::user()->id); // Obtén el usuario autenticado
            $user->hotel_sesion = $recursos_humanos[0]->hotel_id; // Asigna el nuevo valor al campo
            $user->save();
            Auth::user()->hotel_sesion = $recursos_humanos[0]->hotel_id;
            return response()->json([
                "estado"=>true,
                "mensaje"=>"Hotel asignado"
            ],200);
        }
        foreach ($recursos_humanos as $key => $value) {
            $value->hotel = $value->hotel;
        }
        return response()->json([
            "estado"=>false,
            "hoteles"=>$recursos_humanos,
            "mensaje"=>"Seleccione un hotel"
        ],200);
    }
    public function seleccionarHotel(Request $request) {

        $user = User::find(Auth::user()->id); // Obtén el usuario autenticado
        $user->hotel_sesion = (int)$request->id; // Asigna el nuevo valor al campo
        $user->save();
        Auth::user()->hotel_sesion = (int)$request->id;

        return response()->json([
            "estado"=>true,
        ],200);
    }
}
