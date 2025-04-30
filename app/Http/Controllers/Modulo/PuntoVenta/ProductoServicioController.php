<?php

namespace App\Http\Controllers\Modulo\PuntoVenta;

use App\Http\Controllers\Controller;
use App\Models\ProductoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductoServicioController extends Controller
{
    //
    public function lista()
    {

        return view('modulos.punto-venta.producto-servicio.lista', get_defined_vars());

    }
    public  function listar()
    {
        $data = ProductoServicio::where('hotel_id', Auth::user()->hotel_sesion)->get();
        return DataTables::of($data)
            ->addColumn('producto_servicio', function ($data) {
                $string = ($data->producto == 't'? 'Producto': 'Servicio');
                return $string;
            })
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
                        <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '"><i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->id . '" data-persona="' . $data->persona_id . '"><i class="fa fa-trash"></i>
                        </a>
                    </div>';
            })->rawColumns(['accion', 'estado_color'])->make(true);

    }
}
