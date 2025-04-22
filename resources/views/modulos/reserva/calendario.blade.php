@extends('modulos.layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Gestion de Reservas</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Modulos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reservas</li>
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
                            <h3 class="card-title">Lista de Reservas</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id='calendar2'></div>
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



@endsection

@section('script')
<!-- INTERNAL SELECT2 JS -->
<script src="{{ asset('template/plugins/select2/select2.full.min.js') }}"></script>

<!-- FULL CALENDAR JS -->
<script src="{{ asset('template/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ asset('template/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
{{-- <script src="{{ asset('template/js/fullcalendar.js') }}"></script> --}}

<script src="{{ asset('modulo/js/reservas/reserva-model.js') }}"></script>
<script src="{{ asset('modulo/js/reservas/reserva-view.js') }}"></script>

<script>

    const view = new ReservaView(new ReservaModel(token));
    view.calendario();
    // view.eventos();
</script>
@endsection
