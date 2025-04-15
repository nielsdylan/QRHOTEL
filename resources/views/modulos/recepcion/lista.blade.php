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
</style>
@endsection

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Gestion de Recepción</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Modulos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Recepción</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <!-- Row -->
            <div class="row ">
                @foreach ($data as $key=>$value)

                    <div class="col-md-3">
                        <div class="card">

                            <div class="card-body text-center">
                                <div class="d-flex">
                                    <div class="media mt-0">

                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown show">
                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('recepcion.registrar', ['id'=>$value->id]) }}">Registrar habitacion</a>

                                                {{-- <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="mb-2 mt-0">{{ $value->nombre }}</h2>
                                <i class="fa {{ $value->estadoHabitacion($value->id)->icon }} {{ $value->estadoHabitacion($value->id)->color }} fa-3x"></i>
                                <h6 class="mt-4 mb-2">{{ $value->estadoHabitacion($value->id)->nombre }}</h6>
                                {{-- <h2 class="mb-2  number-font">$34,516</h2>
                                <p class="text-muted">Sed ut perspiciatis unde omnis accusantium doloremque</p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- /Row -->
        </div>
        <!-- CONTAINER CLOSED -->
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

{{-- <script src="{{ asset('modulo/js/clientes/cliente-model.js') }}"></script> --}}
{{-- <script src="{{ asset('modulo/js/clientes/cliente-view.js') }}"></script> --}}

<script>
    //const view = new ClienteView(new ClienteModel(token));
    //view.listar();
    //view.eventos();
</script>
@endsection
