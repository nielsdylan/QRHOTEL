<?php

namespace App\Http\Controllers\Modulo;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientesController extends Controller
{
    //
    public function lista(){
        return view('modulos.configuraciones.clientes.lista', get_defined_vars());
    }
    public function listar(){
        $data     = Cliente::get();
        //$tipo_cambio = TipoCambio::orderBy('name', 'desc')->first();
        return DataTables::of($data)
            ->addColumn('habilitado', function ($data) {

                $color = ($data->estado == 1 ? 'success' : 'danger');
                $texto = ($data->estado == 1 ? 'Activo' : 'Inactivo');
                return
                '<span class="badge bg-'.$color.' badge-sm  me-1 mb-1 mt-1">'.$texto.'

                </span>';
            })->addColumn('accion', function ($data) {
                return
                '<div class="flex align-items-center list-user-action" >
                    <a href="#" class="btn btn-icon btn-sm ver text-dark"  data-id="' . $data->user_id . '" ><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->user_id . '" ><i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->user_id . '" ><i class="fa fa-trash"></i>
                    </a>

                </div>';
        })->rawColumns(['accion','habilitado'])->make(true);
    }
}
