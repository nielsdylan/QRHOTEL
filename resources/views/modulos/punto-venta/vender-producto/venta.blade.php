@extends('modulos.layouts.app')

@section('style')
<style>
    .dt-buttons.btn-group.btn-foto-posicion {
        position: relative;
        inset-block-start: auto;
        inset-inline-start: auto;
        float: left;
    }
    .dt-buttons.btn-group {
        position: relative !important;
        inset-block-start: auto !important;
        inset-inline-start: auto !important;
        float: left;
    }
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }
    span.select2-container.select2-container--default.select2-container--open {
        z-index: 9999 !important;
    }
</style>
@endsection

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Gestion de Venta</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Modulos</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Punto de venta</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Vender producto</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Venta</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <!-- Row -->
            <div class="row ">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Productos / Servicio</h3>
                        </div>
                        <form action="">
                            <div class="card-body">
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cliente">Cliente</label>
                                            <select class="form-control select2" id="cliente" name="cliente">
                                                <option value="">Seleccione un cliente</option>
                                            </select>
                                    </div>
                                </div> --}}
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table border text-nowrap text-md-nowrap table-bordered mb-0 table-hover " id="tabla-venta">
                                                <thead>
                                                    <tr>
                                                        {{-- <th >#</th> --}}
                                                        <th class="text-center">Producto / Servicio</th>
                                                        <th class="text-center">Precio</th>
                                                        <th class="text-center" style="width: 10%;">Cantidad</th>
                                                        <th class="text-center">Sub Total</th>
                                                        <th class="text-center" >Pagado</th>
                                                        <th class="text-center">Acción <button type="button" class="btn btn-info btn-sm agregar-producto"><i class="fa fa-plus"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- <tr>
                                                        <td>
                                                            <select class="form-control select2" id="producto" name="producto">
                                                                <option value="">Seleccione un producto</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" class="form-control" id="precio" name="precio" readonly></td>
                                                        <td><input type="number" class="form-control" id="cantidad" name="cantidad"></td>
                                                        <td><input type="text" class="form-control" id="sub_total" name="sub_total" readonly></td>
                                                        <td><input type="text" class="form-control" id="pagado" name="pagado"></td>
                                                        <td><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resumen de Venta</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table border text-nowrap text-md-nowrap table-bordered mb-0 table-hover ">
                                            <tbody>
                                                <tr>
                                                    <td>Total</td>
                                                    <td><input type="text" class="form-control" id="total" name="total" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Descuento</td>
                                                    <td><input type="text" class="form-control" id="descuento" name="descuento"></td>
                                                </tr>
                                                <tr>
                                                    <td>Total a Pagar</td>
                                                    <td><input type="text" class="form-control" id="total_pagar" name="total_pagar" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('punto-venta.vender-producto.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Volver</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Guardar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /Row -->
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!-- MODAL EFFECTS -->
<div class="modal fade" id="modal-producto-servicio">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Lista de </h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-producto-servicio">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">Código</th>
                                        <th class="wd-15p border-bottom-0">Nombres</th>
                                        <th class="wd-20p border-bottom-0">Precio</th>
                                        <th class="wd-10p border-bottom-0">Tipo</th>
                                        {{-- <th class="wd-10p border-bottom-0">Estado</th> --}}

                                        <th class="wd-25p border-bottom-0">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<!-- INTERNAL SELECT2 JS -->
<script src="{{ asset('template/plugins/select2/select2.full.min.js') }}"></script>

<!-- DATA TABLE JS-->
<script src="{{ asset('template/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
{{-- <script src="{{ asset('template/plugins/datatable/js/jszip.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/buttons.colVis.min.js') }}"></script> --}}
<script src="{{ asset('template/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('template/js/table-data.js') }}"></script>

<script src="{{ asset('modulo/js/punto-venta/vender-producto/venta-model.js') }}"></script>
<script src="{{ asset('modulo/js/punto-venta/vender-producto/venta-view.js') }}"></script>

<script>
    const view = new VentaView(new VentaModel(token));
    // view.listar();
    view.eventosVenta();
</script>
@endsection
