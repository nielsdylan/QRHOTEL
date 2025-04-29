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

<!-- MODAL EFFECTS -->
<div class="modal fade" id="modal-registro">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Message Preview</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="form-registro">
                @csrf
                <input type="hidden" name="recepcion_id" value="0">
                <input type="hidden" name="cliente_id" value="0">
                <input type="hidden" name="persona_id" value="0">
                {{-- <input type="hidden" name="habitacion_id" value="0"> --}}
                <div class="modal-body">
                    <section data-action="cliente">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group select2-sm">
                                    <label for="" class="form-label">Habitaciones</label>
                                    <select class="form-select form-select-sm select2 select2-dropdown" name="habitacion_id" data-action="obtener-habitacion" required>
                                        <option value="">Select...</option>
                                        {{-- @foreach ($habitaciones as $value)
                                        <option value="{{$value->id}}" {{ ($value->estadoHabitacion($value->id)->id == 8 ? 'disabled' : '') }}>{{$value->nombre .' - '. $value->estadoHabitacion($value->id)->nombre}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control form-control-sm" placeholder="" aria-describedby="helpId" required />
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control form-control-sm" placeholder="" aria-describedby="helpId" required />
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nombres</label>
                                    <input type="text" name="nombres" class="form-control form-control-sm" placeholder="" aria-describedby="helpId" required />
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Telefono</label>
                                    <input type="text" name="telefono" class="form-control form-control-sm" placeholder="" aria-describedby="helpId" required />
                                </div>

                            </div>
                        </div>
                    </section>
                    <section data-action="habitacion">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Fecha entrada</label>
                                    <input type="date" name="fecha_entrada" class="form-control form-control-sm" placeholder="" value="" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Hora entrada</label>
                                    <input type="time" name="hora_entrada" class="form-control form-control-sm" placeholder="" value="" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Fecha salida</label>
                                    <input type="date" name="fecha_salida" class="form-control form-control-sm" value="" placeholder="" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Hora salida</label>
                                    <input type="time" name="hora_salida" class="form-control form-control-sm" value="" placeholder="" required />
                                </div>
                            </div>
                        </div>
                    </section>
                    <section data-action="costo">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="hidden" name="precio" value="">
                                <input type="hidden" name="total" value="">
                                <label for="" class="form-label">Total</label>
                                <div class="form-group">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">S/.</span>
                                        <input type="text" name="total_mostrar" class="form-control form-control-sm" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Adelanto</label>
                                    <input type="text" name="adelanto" class="form-control form-control-sm" data-section="calcular" placeholder=""  value="0" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Descuento</label>
                                    <input type="text" name="descuento" class="form-control form-control-sm" data-section="calcular" placeholder=""  value="0" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Cobro extra</label>
                                    <input type="text" name="cobrar_extra" class="form-control form-control-sm" data-section="calcular" placeholder="" value="0" required />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group select2-sm">
                                    <label for="" class="form-label">Medio de pago</label>
                                    <select class="form-select form-select-sm select2 select2-dropdown" name="medio_pago_id" required>
                                        <option value="">Select...</option>
                                        @foreach ($medio_pago as $value)
                                        <option value="{{$value->id}}" >{{$value->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group select2-sm">
                                    <label for="" class="form-label">Estado de habitacion</label>
                                    <select class="form-select form-select-sm select2 select2-dropdown" name="estado_habitacion_id" required>
                                        <option value="">Select...</option>
                                        @foreach ($estado_habitacion as $value)
                                        <option value="{{$value->id}}">{{$value->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Detalle</label>
                                    <textarea class="form-control form-control-sm" name="detalle" id="" cols="3" rows="3"></textarea>
                                </div>

                            </div>
                        </div>
                    </section>

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

<!-- FULL CALENDAR JS -->
<script src="{{ asset('template/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ asset('template/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
{{-- <script src="{{ asset('template/js/fullcalendar.js') }}"></script> --}}

<script src="{{ asset('modulo/js/reservas/reserva-model.js') }}"></script>
<script src="{{ asset('modulo/js/reservas/reserva-view.js') }}"></script>

<script>

    const view = new ReservaView(new ReservaModel(token));
    view.calendario();
    view.eventos();
</script>
@endsection
