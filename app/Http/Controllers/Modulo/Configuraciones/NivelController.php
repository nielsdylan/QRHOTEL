<?php

namespace App\Http\Controllers\Modulo\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NivelController extends Controller
{
    //
    public function lista(){
        return view('modulos.configuraciones.niveles.lista', get_defined_vars());
    }
    public function listar(){
        $data     = Nivel::where('hotel_id', Auth::user()->hotel_sesion)->get();
        //$tipo_cambio = TipoCambio::orderBy('name', 'desc')->first();
        return DataTables::of($data)
        ->addColumn('estado_color', function ($data) {
            $color = ($data->estado == 1 ? 'success' : 'danger');
            $texto = ($data->estado == 1 ? 'Activo' : 'Inactivo');
            return
            '<span class="badge bg-'.$color.' badge-sm  me-1 mb-1 mt-1">'.$texto.'

            </span>';
        })
        ->addColumn('accion', function ($data) {
                return
                '<div class="flex align-items-center list-user-action" >
                    <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '"><i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '"><i class="fa fa-trash"></i>
                    </a>

                </div>';
        })->rawColumns(['accion','estado_color'])->make(true);
    }
    public function guardar(Request $request){
        $data = Nivel::firstOrNew(
            ['id' => $request->id],
        );
        $data->nombre = $request->nombre;
        $data->hotel_id = Auth::user()->hotel_sesion;
        $data->save();
        return response()->json([
            "status"=>true,
            "data"=> $request->all(),
            "titulo"=> "Éxito",
            "texto"=> "Se registro con éxito",
            "titpo"=> "success",
        ],200);
    }
    public function editar($id) {
        $data = Nivel::find($id);
        return response()->json([
            "status"=>"success",
            "data"=> $data
        ],200);
    }
    public function eliminar($id) {
        $data = Nivel::find($id);
        $data->estado = 0;
        $data->delete();
        $data->save();
        return response()->json([
            "title"=>"Éxito",
            "text"=>"Se elimino con éxito",
            "icon"=>"success"
        ],200);
    }
}
