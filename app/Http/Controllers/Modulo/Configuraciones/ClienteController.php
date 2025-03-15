<?php

namespace App\Http\Controllers\Modulo\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    //
    public function lista(){
        return view('modulos.clientes.lista', get_defined_vars());
    }
    public function listar(){
        $data     = Cliente::where('hotel_id', Auth::user()->hotel_sesion)->get();
        //$tipo_cambio = TipoCambio::orderBy('name', 'desc')->first();
        return DataTables::of($data)
            ->addColumn('telefono', function ($data) {
                $persona = Persona::find($data->persona_id);
                return $persona->telefono;
            })
            ->addColumn('dni', function ($data) {
                $persona = Persona::find($data->persona_id);
                return $persona->dni;
            })->addColumn('apellidos', function ($data) {
                $persona = Persona::find($data->persona_id);
                return $persona->apellidos;
            })->addColumn('nombres', function ($data) {
                $persona = Persona::find($data->persona_id);
                return $persona->nombres;
            })->addColumn('estado', function ($data) {

                $color = ($data->estado == 1 ? 'success' : 'danger');
                $texto = ($data->estado == 1 ? 'Activo' : 'Inactivo');
                return
                '<span class="badge bg-'.$color.' badge-sm  me-1 mb-1 mt-1">'.$texto.'

                </span>';
            })->addColumn('accion', function ($data) {
                return
                '<div class="flex align-items-center list-user-action" >
                    <a href="#" class="btn btn-icon btn-sm ver text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '" ><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '"><i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '"><i class="fa fa-trash"></i>
                    </a>

                </div>';
        })->rawColumns(['accion','estado'])->make(true);
    }
    public function guardar(Request $request){

        // $persona = new Persona();
        $persona = Persona::firstOrNew(
            ['id' => $request->persona_id],
        );
        $persona->nombres   = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->dni       = $request->dni;
        $persona->telefono  = $request->telefono;
        $persona->save();

        $cliente = new Cliente();
        $cliente = Cliente::firstOrNew(
            ['persona_id' => $persona->id],
            ['hotel_id' => Auth::user()->hotel_sesion],
        );
        $cliente->persona_id = $persona->id;
        $cliente->hotel_id   = Auth::user()->hotel_sesion;
        $cliente->save();
        return response()->json([
            "status"=>true,
            "titulo"=>"Éxito",
            "mensaje"=>"Se registor con éxito",
            "icon"=>"success",
        ],200);
    }
    public function editar($id) {
        $persona = Persona::find($id);
        return response()->json([
            "persona"=>$persona,
            "status"=>"success",
        ],200);
    }
    public function eliminar($id) {
        // $user = User::find($id);
        // $user->estado = 2;
        // $user->save();

        $cliente = Cliente::find($id);
        $cliente->estado = 2;
        $cliente->save();
        return response()->json([
            "usuario"=>$id,
            "status"=>true,
        ],200);
    }
}
