class NivelView {

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
                        // vistaCrear();
                        $('#modal-registro').modal('show');
                        $("#form-registro")[0].reset();
                        $('#modal-registro').find('.modal-header').find('h6.modal-title').text('Nuevo Nivel');
                        // $(selector).attr(attributeName);
                        $('[name="id"]').val(0);

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
                url: route('configuraciones.niveles.listar'),
                method: 'POST',
                // headers: {'X-CSRF-TOKEN': token},
                dataType: "JSON",
                // data: buscar,
                data: {_token : token},
            },
            columns: [
                {data: 'id', className: 'text-center'},
                {data: 'nombre', className: 'text-center'},
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
                        type: respuesta.titpo
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
                if(respuesta.status=="success"){


                    $("#form-registro")[0].reset();
                    $("#modal-registro").find('h5.modal-title').text('Editar Nivel');

                    $('[name="id"]').val(respuesta.data.id);
                    $('#form-registro').find('[name="nombre"]').val(respuesta.data.nombre)

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
}
