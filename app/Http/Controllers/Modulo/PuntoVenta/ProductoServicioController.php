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
            ->addColumn('tipo', function ($data) {
                $string = ($data->producto == 1? 'Producto': 'Servicio');
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
                        <a href="#" class="btn btn-icon btn-sm editar text-dark"  data-id="' . $data->id . '" ><i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm eliminar text-dark"  data-id="' . $data->id . '"><i class="fa fa-trash"></i>
                        </a>
                    </div>';
            })->rawColumns(['accion', 'estado_color'])->make(true);

    }
    public function guardar(Request $request)
    {
        $total_registro = ProductoServicio::where('hotel_id', Auth::user()->hotel_sesion)->withTrashed()->count();
        $codigo = $this->generarCodigo($total_registro + 1);
        // return $codigo;
        $data = ProductoServicio::firstOrNew(
            ['id' => $request->id],
        );
        if((int)$request->id==0){
            $data->codigo = $codigo;
        }

        $data->nombre = $request->nombre;
        $data->descripcion = $request->descripcion;
        $data->precio = $request->precio;
        $data->cantidad = $request->cantidad;
        if($request->tipo == 'producto'){
            $data->producto = 1;
            $data->servicio = 0;
        }else{
            $data->servicio = 1;
            $data->producto = 0;
        }


        $data->hotel_id = Auth::user()->hotel_sesion;
        $data->save();
        return response()->json([
            "status"=>true,
            "titulo"=> "Éxito",
            "texto"=> "Se registro con éxito",
            "icon"=> "success",
        ],200);
        return response()->json(['success' => true, 'message' => 'Guardado correctamente']);
    }
    public function editar($id)
    {
        $data = ProductoServicio::find($id);
        return response()->json(['success' => true, 'data' => $data]);
    }
    public function eliminar($id)
    {
        $data = ProductoServicio::find($id);
        $data->delete();
        return response()->json([
            "status"=>true,
            "title"=> "Éxito",
            "text"=> "Se elimino con éxito",
            "icon"=> "success",
        ]);
    }
    public function generarCodigo($numero)
    {
        $numero_formateado = str_pad($numero, 4, "0", STR_PAD_LEFT);
        return $numero_formateado;
    }
    public  function listarProductoServicio()
    {
        $data = ProductoServicio::where('hotel_id', Auth::user()->hotel_sesion)->get();
        return DataTables::of($data)
            ->addColumn('tipo', function ($data) {
                $string = ($data->producto == 1? 'Producto': 'Servicio');
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
                        <a href="#" class="btn btn-success btn-sm seleccionar"  data-id="' . $data->id . '" >Seleccionar
                        </a>
                    </div>';
            })->rawColumns(['accion', 'estado_color'])->make(true);

    }
    public function obtener($id)
    {
        $data = ProductoServicio::find($id);
        return response()->json(['success' => true, 'data' => $data]);
    }
}
