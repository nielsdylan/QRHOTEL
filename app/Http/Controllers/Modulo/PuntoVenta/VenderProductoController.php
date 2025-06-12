<?php

namespace App\Http\Controllers\Modulo\PuntoVenta;

use App\Http\Controllers\Controller;
use App\Models\Habitacion;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VenderProductoController extends Controller
{
    //
    public function lista()
    {
        return view('modulos.punto-venta.vender-producto.lista', get_defined_vars());
    }
    public function listar(Request $request)
    {
        $data = Venta::where('hotel_id', Auth::user()->hotel_sesion)->where('estado',1)->get();
        return DataTables::of($data)
            ->addColumn('estado_color', function ($data) {
                $color = ($data->estado == 1 ? 'success' : 'danger');
                $texto = ($data->estado == 1 ? 'Activo' : 'Inactivo');
                return
                    '<span class="badge bg-' . $color . ' badge-sm  me-1 mb-1 mt-1">' . $texto . '
                    </span>';
            })
            ->addColumn('accion', function ($data) {
                return
                    '<div class="flex align-items-center list-user-action" >
                        <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->id . '" ><i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->id . '"><i class="fa fa-trash"></i>
                        </a>
                    </div>';
            })->rawColumns(['accion', 'estado_color'])->make(true);
    }
    public function venta()
    {
        $habitacion = Habitacion::where('hotel_id', Auth::user()->hotel_sesion)->get();
        // foreach ($habitacion as $key => $value) {
        //     $value->estadoHabitacion = $value->estadoHabitacion($value->id);
        // }
        // return $habitacion;
        return view('modulos.punto-venta.vender-producto.venta', get_defined_vars());
    }
}
