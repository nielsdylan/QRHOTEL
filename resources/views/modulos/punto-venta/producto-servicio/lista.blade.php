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
                <h1 class="page-title">Gestion de Productos / Servicios</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Modulos</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Punto de venta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Producto servicio</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <!-- Row -->
            <div class="row ">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Productos / Servicios</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="tabla-data">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">Código</th>
                                            <th class="wd-15p border-bottom-0">Nombres</th>
                                            <th class="wd-20p border-bottom-0">Precio</th>
                                            <th class="wd-10p border-bottom-0">Tipo</th>
                                            <th class="wd-10p border-bottom-0">Estado</th>

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
            </div>

            <!-- /Row -->
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>


<!-- MODAL EFFECTS -->
<div class="modal fade" id="modal-registro">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Message Preview</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="form-registro">
                @csrf
                <input type="hidden" name="id" value="0">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control form-control-sm" placeholder="" aria-describedby="helpId" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Precio</label>
                                    <input type="number" name="precio" class="form-control form-control-sm" placeholder="" step="0.01" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control form-control-sm" placeholder="" step="0.01" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">Tipo</div>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="tipo" value="producto" checked>
                                        <span class="custom-control-label">Producto</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="tipo" value="servicio">
                                        <span class="custom-control-label">Servicio</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Descripcion</label>
                                {{-- <input type="text" name="descripcion" class="form-control form-control-sm" placeholder="" required /> --}}
                                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="3" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
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

<script src="{{ asset('modulo/js/punto-venta/producto-servicio/producto-servicio-model.js') }}"></script>
<script src="{{ asset('modulo/js/punto-venta/producto-servicio/producto-servicio-view.js') }}"></script>

<script>
    const view = new ProductoServicioView(new ProductoServicioModel(token));
    view.listar();
    view.eventos();
</script>
@endsection
