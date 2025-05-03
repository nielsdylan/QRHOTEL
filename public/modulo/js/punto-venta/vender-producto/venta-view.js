class VentaView {

    constructor(model) {
        this.model = model;
        this.tabla
    }

    listar = () => {

        const $tabla = $('#tabla-data').DataTable({
            destroy: true,
            dom: 'Bftip',
            autoWidth: false,
            responsive: true,
            pageLength: 50,
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json"
            },
            serverSide: true,
            processing: true,
            buttons: [
                {
                    text: '<i class="fa fa-plus"></i> Nuevo',
                    attr: {
                        id: 'btn-cliente',
                    },
                    action: () => {
                        location.href = route('punto-venta.vender-producto.venta');
                    },
                    init: function(api, node, config) {

                        $(node).removeClass('btn-primary')
                    },
                    className: 'btn-light btn-sm btn-info'
                }
            ],
            // pagingType: 'full_numbers',
            // scrollCollapse: true,
            // scrollY: '60vh',
            // scrollX: '100vh',
            initComplete: function (settings, json) {
                const $filter = $('#tabla-data_filter');
                const $input = $filter.find('input');
                $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm" type="button" style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;"><i class="fa fa-search"></i></button>');
                $input.addClass('form-control-sm');
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 3px;');

                $('#tabla-data_wrapper .dt-buttons.btn-group.flex-wrap').addClass('btn-foto-posicion');
                $input.off();
                $input.on('keyup', (e) => {
                    if (e.key == 'Enter') {
                        $('#btnBuscar').trigger('click');
                    }
                });
                $('#btnBuscar').on('click', (e) => {
                    $tabla.search($input.val()).draw();
                });
                // $('#tabla-data_length label').addClass('select2-sm');
                // //______Select2
                // $('[name="tabla-data_length"]').select2({
                //     minimumResultsForSearch: Infinity
                // });
                // const $paginate = $('#tabla-data_paginate');
                // $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            drawCallback: function (settings) {
                $('#tabla-data_filter input').prop('disabled', false);
                $('#btnBuscar').html('<i class="fa fa-search"></i>').prop('disabled', false);
                $('#tabla-data_filter input').trigger('focus');
                const $paginate = $('#tabla-data_paginate');
                $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            order: [[0, 'desc']],
            ajax: {
                url: route('punto-venta.vender-producto.listar'),
                method: 'POST',
                // headers: {'X-CSRF-TOKEN': token},
                dataType: "JSON",
                // data: buscar,
                data: {_token : token},
            },
            columns: [
                {data: 'id', className: 'text-center'},
                {data: 'codigo', className: 'text-center'},
                {data: 'recepcion_id', className: 'text-center'},
                {data: 'total', className: 'text-center'},
                {data: 'pagado', className: 'text-center'},
                {data: 'estado_color', className: 'text-center'},
                {data: 'accion', className: 'text-center'},
            ]
        });
        $tabla.on('search.dt', function() {
            $('#tabla-data_filter input').attr('disabled', true);
            $('#btnBuscar').html('<i class="fa fa-clock-o" aria-hidden="true"></i>').prop('disabled', true);
        });
        $tabla.on('init.dt', function(e, settings, processing) {
            // $('#tabla-data_length label').addClass('select2-sm');
            // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
        });
        $tabla.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            } else {
                // $(e.currentTarget).LoadingOverlay("hide", true);
            }
        });
        this.tabla = $tabla;
        // $tabla.buttons().container().appendTo('#tabla-data_wrapper .col-md-6:eq(0)');
    }

    eventos = () => {
        $('#form-registro').submit((e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let button = $(e.currentTarget).find('button[type="submit"]')
            let tabla = this.tabla;
            button.attr('disabled','true');
            button.find('i').removeClass('fa-save')
            button.find('i').addClass('fa-spinner fa-spin');

            this.model.guardar(data).then((respuesta) => {

                if (respuesta.status == true) {
                    console.log(respuesta);
                    tabla.ajax.reload(null, false);
                    swal({
                        title: respuesta.titulo,
                        text:respuesta.texto,
                        type: respuesta.icon
                    });
                    // this.listar.$tabla
                    $('#tabla-data').DataTable().ajax.reload(null, false);
                }
                button.removeAttr('disabled')
                button.find('i').removeClass('fa-spinner fa-spin')
                button.find('i').addClass('fa-save');
                $('#modal-registro').modal('hide');
            }).always(() => {
            }).fail(() => {
                tabla.ajax.reload(null, false);
                $('#modal-registro').modal('hide');
                button.removeAttr('disabled')
                button.find('i').removeClass('fa-spinner fa-spin')
                button.find('i').addClass('fa-save');
            });

        });
        $('#tabla-data').on('click', 'a.editar',(e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            $('#modal-registro').modal('show');
            this.model.editar(id).then((respuesta) => {
                if(respuesta.success==true){


                    $("#form-registro")[0].reset();
                    $("#modal-registro").find('h5.modal-title').text('Editar Habitación');

                    $('[name="id"]').val(respuesta.data.id);
                    $('#form-registro').find('[name="nombre"]').val(respuesta.data.nombre)
                    $('#form-registro').find('[name="descripcion"]').val(respuesta.data.descripcion)
                    $('#form-registro').find('[name="precio"]').val(respuesta.data.precio)
                    $('#form-registro').find('[name="cantidad"]').val(respuesta.data.cantidad)
                    $('#form-registro').find('[name="tipo"]').removeAttr('checked');
                    if(respuesta.data.producto == 1){
                        $('#form-registro').find('[name="tipo"][value="producto"]').attr('checked',true);

                    }else{
                        $('#form-registro').find('[name="tipo"][value="servicio"]').attr('checked',true);
                    }


                }

            }).always(() => {

            }).fail(() => {

            });
        });
        $('#tabla-data').on('click', 'a.eliminar',(e) => {
            e.preventDefault();
            $('#alert-eliminar').modal('show');
            let id = $(e.currentTarget).attr('data-id');
            let model = this.model;
            // console.log(id);
            swal({
                title: "Eliminar",
                text: "Esta seguro de eliminar el registro.",
                type: "info",
                showLoaderOnConfirm: true,
                confirmButtonText: "Si, aceptar",
                cancelButtonText: "No, cancelar",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonClass: "btn-danger",
            }, function () {
                model.eliminar(id).then((respuesta) => {
                    swal(respuesta.title, respuesta.text, respuesta.icon)
                    $('#tabla-data').DataTable().ajax.reload(null, false);
                }).always(() => {

                }).fail(() => {

                });

            });
        });
    }

    eventosVenta = () => {
        /*
        * Funcion invocar el modal para agregar un producto
        */
        $('.agregar-producto').click((e) => {
            e.preventDefault();
            $('#modal-producto-servicio').modal('show');
            this.listarProductoServicio();
        });
        /*
        * Funcion agregar un producto a la tabla venta
        * Se obtiene el id del producto y se hace una peticion ajax para obtener los datos
        * y se agrega a la tabla venta
        */
        $('#tabla-producto-servicio').on('click', 'a.seleccionar',(e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            let html = '';
            this.model.obtener(id).then((respuesta) => {
                // console.log(respuesta);
                html = `
                    <tr key="`+respuesta.data.id+`">
                        <td>
                            <p class="font-w600 mb-1">`+respuesta.data.codigo+`</p>
                            <div class="text-muted">
                                <div class="text-muted">`+respuesta.data.descripcion+`</div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span >`+respuesta.data.precio+` </span>
                            <span class="d-none" id="venta-precio">`+respuesta.data.precio+`</span>
                        </td>
                        <td class="text-center">
                            <input type="number" data-input="venta" name="venta_cantidad[`+respuesta.data.id+`][]" class="form-control form-control-sm text-center" placeholder="" value="1.00" step="0.01" data-id="`+respuesta.data.id+`" />
                        </td>
                        <td class="text-center">
                            <span id="venta-sub-total">`+respuesta.data.precio+`</span>
                        </td>
                        <td class="text-center">
                            <div class="form-group">
                                <label class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" class="custom-control-input" name="pago[`+respuesta.data.id+`][]" value="true">
                                    <span class="custom-control-label">Pagado</span>
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm eliminar" data-id="`+respuesta.data.id+`"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                $('#tabla-venta').find('tbody').append(html);
                $('#modal-producto-servicio').modal('hide');

            }).always(() => {

            }).fail(() => {

            });
        });
        /*
        * Funcion para eliminar un producto de la tabla venta
        */
        $('#tabla-venta').on('click', 'button.eliminar',(e) => {
            let id = $(e.currentTarget).attr('data-id');
            $('#tabla-venta').find('tbody').find('tr[key="'+id+'"]').remove();
        });
        /*
        * Funcion para eliminar un producto de la tabla venta
        */
        $('#tabla-venta').on('change', 'input[data-input="venta"]',(e) => {
            let valor = $(e.currentTarget).val();
            let id = $(e.currentTarget).attr('data-id');
            let precio = $('#tabla-venta').find('tbody').find('tr[key="'+id+'"]').find('span#venta-precio').text();
            let sub_total = 0;
            if(valor<=0){
                $(e.currentTarget).val(1);
                valor = 1;

            }
            sub_total = valor*precio;

            $('#tabla-venta').find('tbody').find('tr[key="'+id+'"]').find('span#venta-sub-total').text(sub_total.toFixed(2));
            console.log($(e.currentTarget).val());

        });

    }
    listarProductoServicio = () => {
        const productoServicioTB = $('#tabla-producto-servicio').DataTable({
            destroy: true,
            // dom: 'Bftip',
            autoWidth: false,
            responsive: true,
            pageLength: 20,
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json"
            },
            serverSide: true,
            processing: true,
            buttons: [

            ],
            initComplete: function (settings, json) {
                const $filter = $('#tabla-producto-servicio_filter');
                const $input = $filter.find('input');
                $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm" type="button" style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;"><i class="fa fa-search"></i></button>');
                $input.addClass('form-control-sm');
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 3px;');

                $('#tabla-producto-servicio_wrapper .dt-buttons.btn-group.flex-wrap').addClass('btn-foto-posicion');
                $input.off();
                $input.on('keyup', (e) => {
                    if (e.key == 'Enter') {
                        $('#btnBuscar').trigger('click');
                    }
                });
                $('#btnBuscar').on('click', (e) => {
                    productoServicioTB.search($input.val()).draw();
                });
                // $('#tabla-data_length label').addClass('select2-sm');
                // //______Select2
                // $('[name="tabla-data_length"]').select2({
                //     minimumResultsForSearch: Infinity
                // });
                // const $paginate = $('#tabla-data_paginate');
                // $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            drawCallback: function (settings) {
                $('#tabla-producto-servicio_filter input').prop('disabled', false);
                $('#btnBuscar').html('<i class="fa fa-search"></i>').prop('disabled', false);
                $('#tabla-producto-servicio_filter input').trigger('focus');
                const $paginate = $('#tabla-producto-servicio_paginate');
                $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            order: [[0, 'desc']],
            ajax: {
                url: route('punto-venta.productos-servicios.listar-producto-servicio'),
                method: 'POST',
                // headers: {'X-CSRF-TOKEN': token},
                dataType: "JSON",
                // data: buscar,
                data: {_token : token},
            },
            columns: [
                {data: 'id', className: 'text-center'},
                {data: 'codigo', className: 'text-center'},
                {data: 'nombre', className: 'text-center'},
                {data: 'precio', className: 'text-center'},
                {data: 'tipo', className: 'text-center'},
                // {data: 'estado_color', className: 'text-center'},
                {data: 'accion', className: 'text-center'},
            ]
        });
        productoServicioTB.on('search.dt', function() {
            $('#tabla-producto-servicio_filter input').attr('disabled', true);
            $('#btnBuscar').html('<i class="fa fa-clock-o" aria-hidden="true"></i>').prop('disabled', true);
        });
        productoServicioTB.on('init.dt', function(e, settings, processing) {
            // $('#tabla-data_length label').addClass('select2-sm');
            // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
        });
        productoServicioTB.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            } else {
                // $(e.currentTarget).LoadingOverlay("hide", true);
            }
        });
        // productoServicioTB.buttons().container().appendTo('#tabla-data_wrapper .col-md-6:eq(0)');
    }
}
