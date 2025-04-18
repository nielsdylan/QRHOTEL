@extends('modulos.layouts.app')


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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Recepción</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <!-- Row -->
            <div class="row ">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Datos de habitacion</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">nombre</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="" disabled value="{{ $habitacion->nombre }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Precio</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="" disabled value="{{ $habitacion->precio }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nivel</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="" disabled value="{{ $habitacion->nivel->nombre }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Categoria</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="" disabled value="{{ $habitacion->categoria->nombre }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Registro de recepción</h3>
                        </div>
                        <form action="" id="form-registro" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $recepcion ? $recepcion->id : 0 }}">
                            <input type="hidden" name="habitacion_id" value="{{ $habitacion->id }}">
                            <div class="card-body">
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha entrada</label>
                                            <input type="date" name="fecha_entrada" class="form-control form-control-sm" placeholder="" value="{{ $recepcion ? $recepcion->fecha_entrada : '' }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Hora entrada</label>
                                            <input type="time" name="hora_entrada" class="form-control form-control-sm" placeholder="" value="{{ $recepcion ? $recepcion->hora_entrada : '' }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha salida</label>
                                            <input type="date" name="fecha_salida" class="form-control form-control-sm" value="{{ $recepcion ? $recepcion->fecha_salida : '' }}" placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Hora salida</label>
                                            <input type="time" name="hora_salida" class="form-control form-control-sm" value="{{ $recepcion ? $recepcion->hora_salida : '' }}" placeholder="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" name="precio" value="{{ $habitacion->precio }}">
                                        <input type="hidden" name="total" value="{{ $recepcion ? $recepcion->total :$habitacion->precio }}">
                                        <label for="" class="form-label">Total</label>
                                        <div class="form-group">
                                            <div class="input-group mb-3 input-group-sm">
                                                <span class="input-group-text">S/.</span>
                                                <input type="text" name="total_mostrar" class="form-control form-control-sm" value="{{ $recepcion ? $recepcion->total :$habitacion->precio }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Adelanto</label>
                                            <input type="text" name="adelanto" class="form-control form-control-sm" data-section="calcular" placeholder=""  value="{{ $recepcion ? $recepcion->adelanto : 0 }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descuento</label>
                                            <input type="text" name="descuento" class="form-control form-control-sm" data-section="calcular" placeholder=""  value="{{ $recepcion ? $recepcion->descuento : 0 }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cobro extra</label>
                                            <input type="text" name="cobrar_extra" class="form-control form-control-sm" data-section="calcular" placeholder="" value="{{ $recepcion ? $recepcion->cobrar_extra : 0 }}" required />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group select2-sm">
                                            <label for="" class="form-label">Estado de habitacion</label>
                                            <select class="form-select form-select-sm select2 select2-dropdown" name="estado_habitacion_id" required>
                                                <option value="">Select...</option>
                                                @foreach ($estado_habitacion as $value)
                                                <option value="{{$value->id}}" {{ $recepcion && $recepcion->estado_habitacion_id == $value->id ? 'selected' : '' }}>{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group select2-sm">
                                            <label for="" class="form-label">Clientes</label>
                                            <select class="form-select form-select-sm select2 " name="cliente_id" required>
                                                <option value="">Select...</option>
                                                @foreach ($clientes as $value)
                                                <option
                                                    value="{{$value->id}}"
                                                    {{ $recepcion && $recepcion->cliente_id == $value->id ? 'selected' : '' }}
                                                >
                                                    {{$value->persona->nombres . ' ' .$value->persona->apellidos .' ('. $value->persona->dni .')'}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group select2-sm">
                                            <label for="" class="form-label">Medio de pago</label>
                                            <select class="form-select form-select-sm select2 select2-dropdown" name="medio_pago_id" required>
                                                <option value="">Select...</option>
                                                @foreach ($medio_pago as $value)
                                                <option value="{{$value->id}}" {{ $recepcion && $recepcion->medio_pago_id == $value->id ? 'selected' : '' }}>{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Detalle</label>
                                            <textarea class="form-control form-control-sm" name="detalle" id="" cols="3" rows="3">{{ $recepcion ? $recepcion->detalle : '' }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('recepcion.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Volver</a>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Guardar</button>

                                    </div>
                                </div>
                            </div>

                        </form>
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


<script src="{{ asset('modulo/js/recepcion/recepcion-model.js') }}"></script>
<script src="{{ asset('modulo/js/recepcion/recepcion-view.js') }}"></script>

<script>
    const view = new RecepcionView(new RecepcionModel(token));
    view.eventos();
</script>
@endsection
