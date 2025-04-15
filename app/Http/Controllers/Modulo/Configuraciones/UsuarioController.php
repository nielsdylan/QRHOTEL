<?php

namespace App\Http\Controllers\Modulo\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\RecursoHumano;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UsuarioController extends Controller
{
    //
    public function lista(){
        return view('modulos.configuraciones.usuarios.lista', get_defined_vars());
    }
    public function listar(){
        $data     = RecursoHumano::where('hotel_id', Auth::user()->hotel_sesion)->get();
        //$tipo_cambio = TipoCambio::orderBy('name', 'desc')->first();
        return DataTables::of($data)
            ->addColumn('nombres_apellidos', function ($data) {
                $respuesta = User::find($data->usuario_id);
                return $respuesta->name;
            })
            ->addColumn('email', function ($data) {
                $respuesta = User::find($data->usuario_id);
                return $respuesta->email;
            })->addColumn('estado_color', function ($data) {
                $respuesta = User::find($data->usuario_id);
                $color = ($respuesta->estado == 1 ? 'success' : 'danger');
                $texto = ($respuesta->estado == 1 ? 'Activo' : 'Inactivo');
                return
                '<span class="badge bg-'.$color.' badge-sm  me-1 mb-1 mt-1">'.$texto.'

                </span>';
            })->addColumn('accion', function ($data) {
            return
            '<div class="flex align-items-center list-user-action" >
                <a href="#" class="btn btn-icon btn-sm ver text-dark"  data-id="' . $data->usuario_id . '" ><i class="fa fa-eye"></i></a>
                <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->usuario_id . '" ><i class="fa fa-pencil"></i>
                </a>
                <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->usuario_id . '" ><i class="fa fa-trash"></i>
                </a>

            </div>';
        })->rawColumns(['accion','estado_color'])->make(true);
    }
    public function guardar(Request $request){

        // $persona = new Persona();
        if(($request->password) && ($request->password !== $request->confirmar_password)){
            return response()->json([
                "status"=>true,
                "titulo"=>"Error",
                "mensaje"=>"Las contraseñas son diferentes",
                "icon"=>"error",
            ],200);
        }

        $user = User::find($request->id);

        $persona_id = ($user ? $user->persona_id : 0);
        $usuario_id = ($user ? $user->id : 0);
        $persona = Persona::firstOrNew(
            ['id' => $persona_id],
        );
        $persona->nombres   = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->dni       = $request->dni;
        $persona->telefono  = $request->telefono;
        $persona->save();

        $user = User::firstOrNew(
            ['id' => $usuario_id],
        );
        $user->name = $request->apellidos.' '.$request->nombres;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->persona_id = $persona->id;
        $user->estado = 1;
        $user->save();

        if((int)$usuario_id == 0){// entrara si es nuevo el usuario
            $recursos_humanos = new RecursoHumano();
            $recursos_humanos->hotel_id = Auth::user()->hotel_sesion;
            $recursos_humanos->usuario_id = $user->id;
            $recursos_humanos->save();
        }
        return response()->json([
            "status"=>true,
            "title"=>"Éxito",
            "text"=>"Se registor con éxito",
            "icon"=>"success",
        ],200);
    }
    public function editar($id) {
        $usuario = User::find($id);
        $persona = Persona::find($usuario->persona_id);
        return response()->json([
            "persona"=>$persona,
            "usuario"=>$usuario,
            "status"=>"success",
        ],200);
    }
    public function eliminar($id) {
        $user = User::find($id);
        $user->estado = 0;
        $user->delete();
        $user->save();
        $rrhh = RecursoHumano::where('usuario_id',$id)->where('hotel_id',Auth::user()->hotel_sesion)->first();
        $rrhh->estado = 0;
        $rrhh->delete();
        $rrhh->save();
        return response()->json([
            "usuario"=>$id,
            "status"=>true,
            "title"=>"Éxito",
            "text"=>"Se elimino con éxito",
            "icon"=>"success",
        ],200);
    }
}
