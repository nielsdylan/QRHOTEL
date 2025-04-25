class ReservaView {

    constructor(model) {
        this.model = model;
        this.calendario
    }
    calendario = () => {
        let model = this.model;
        var calendarEl = document.getElementById('calendar2');

        this.calendario = new FullCalendar.Calendar(calendarEl, {

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'es',
            // defaultView: 'month',
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            selectable: true,
            selectMirror: true,
            droppable: true, // this allows things to be dropped onto the calen


            select: function({allDay, end, endStr, jsEvent, start, startStr, view}) {
                $('#modal-registro').modal('show');
                $('#form-registro')[0].reset();
                $("#modal-registro").find('h6.modal-title').text('Nueva Reserva');
                $('[name="id"]').val(0);
            },
            eventClick: function({el, event, jsEvent, view}) {
                $('#modal-registro').modal('show');
                $('#form-registro')[0].reset();
                $("#modal-registro").find('h6.modal-title').text('Editar Reserva');
                $('[name="id"]').val(event.id);

                model.obtenerReserva(event.id).then((respuesta) => {
                    console.log(respuesta);
                    $('#form-registro').find('[name="dni"]').val(respuesta.cliente.dni);
                    $('#form-registro').find('[name="apellidos"]').val(respuesta.cliente.apellidos);
                    $('#form-registro').find('[name="nombres"]').val(respuesta.cliente.nombres);
                    $('#form-registro').find('[name="telefono"]').val(respuesta.cliente.telefono);

                    $('#form-registro').find('[name="fecha_entrada"]').val(respuesta.data.fecha_entrada);
                    $('#form-registro').find('[name="hora_entrada"]').val(respuesta.data.hora_entrada);
                    $('#form-registro').find('[name="fecha_salida"]').val(respuesta.data.fecha_salida);
                    $('#form-registro').find('[name="hora_salida"]').val(respuesta.data.hora_salida);
                    $('#form-registro').find('[name="total_mostrar"]').val(respuesta.data.total);
                    $('#form-registro').find('[name="adelanto"]').val(respuesta.data.adelanto);
                    $('#form-registro').find('[name="descuento"]').val(respuesta.data.descuento);
                    $('#form-registro').find('[name="cobrar_extra"]').val(respuesta.data.cobrar_extra);
                    // $('#form-registro').find('[name="medio_pago_id"]').val(respuesta.data.medio_pago_id);

                    $('#form-registro').find('[name="medio_pago_id"]').val('').trigger('change.select2');
                    $('#form-registro').find('[name="medio_pago_id"]').val(respuesta.data.medio_pago_id).trigger('change.select2');

                    $('#form-registro').find('[name="detalle"]').val(respuesta.data.detalle);

                }).always(() => {
                }).fail(() => {
                    console.log('error-calendario');

                });
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: route('reserva.lista-reservas'),
        });

        this.calendario.render();
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
                    $("#modal-registro").find('h5.modal-title').text('Editar Habitación');

                    $('[name="id"]').val(respuesta.data.id);
                    $('#form-registro').find('[name="nombre"]').val(respuesta.data.nombre)
                    $('#form-registro').find('[name="descripcion"]').val(respuesta.data.descripcion)
                    $('#form-registro').find('[name="precio"]').val(respuesta.data.precio)

                    $('#form-registro').find('[name="nivel_id"]').val(respuesta.data.nivel_id).trigger('change.select2');
                    $('#form-registro').find('[name="tarifa_id"]').val(respuesta.data.tarifa_id).trigger('change.select2');
                    $('#form-registro').find('[name="categoria_id"]').val(respuesta.data.categoria_id).trigger('change.select2');

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
