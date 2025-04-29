class ReservaView {

    constructor(model) {
        this.model = model;
        this.calendario
    }
    calendario = () => {
        let model = this.model;
        var calendarEl = document.getElementById('calendar2');

        // this.calendario = new FullCalendar.Calendar(calendarEl, {
        let Fullcalendario = new FullCalendar.Calendar(calendarEl, {

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
            editable: true,
            droppable: true, // this allows things to be dropped onto the calen


            select: function({allDay, end, endStr, jsEvent, start, startStr, view}) {

                $('#modal-registro').modal('show');
                $('#form-registro')[0].reset();
                $("#modal-registro").find('h6.modal-title').text('Nueva Reserva');
                $('[name="recepcion_id"]').val(0);
                $('[name="cliente_id"]').val(0);
                $('[name="persona_id"]').val(0);
                $('[name="habitacion_id"]').val(0);

                $('[name="precio"]').val(0);
                $('[name="total"]').val(0);

                $('#form-registro').find('[name="fecha_entrada"]').val(startStr);
                $('#form-registro').find('[name="fecha_salida"]').val(endStr);

                $('#form-registro').find('[name="medio_pago_id"]').val('').trigger('change.select2');
                $('#form-registro').find('[name="estado_habitacion_id"]').val('').trigger('change.select2');
                $('#form-registro').find('[name="habitacion_id"]').val('').trigger('change.select2');

                $('#form-registro').find('[name="habitacion_id"]').select2('destroy');
                actualizarHabitaciones();
            },
            eventClick: function({el, event, jsEvent, view}) {
                $('#modal-registro').modal('show');
                $('#form-registro')[0].reset();
                $("#modal-registro").find('h6.modal-title').text('Editar Reserva');
                // $('[name="id"]').val(event.id);
                actualizarHabitaciones();
                model.obtenerReserva(event.id).then((respuesta) => {
                    $('#form-registro').find('[name="dni"]').val(respuesta.persona.dni);
                    $('#form-registro').find('[name="apellidos"]').val(respuesta.persona.apellidos);
                    $('#form-registro').find('[name="nombres"]').val(respuesta.persona.nombres);
                    $('#form-registro').find('[name="telefono"]').val(respuesta.persona.telefono);

                    $('#form-registro').find('[name="fecha_entrada"]').val(respuesta.data.fecha_entrada);
                    $('#form-registro').find('[name="hora_entrada"]').val(respuesta.data.hora_entrada);
                    $('#form-registro').find('[name="fecha_salida"]').val(respuesta.data.fecha_salida);
                    $('#form-registro').find('[name="hora_salida"]').val(respuesta.data.hora_salida);
                    $('#form-registro').find('[name="total_mostrar"]').val(respuesta.data.total);

                    $('#form-registro').find('[name="total"]').val(respuesta.data.total);
                    $('#form-registro').find('[name="precio"]').val(respuesta.habitacion.precio);


                    $('#form-registro').find('[name="adelanto"]').val(respuesta.data.adelanto);
                    $('#form-registro').find('[name="descuento"]').val(respuesta.data.descuento);
                    $('#form-registro').find('[name="cobrar_extra"]').val(respuesta.data.cobrar_extra);
                    // $('#form-registro').find('[name="medio_pago_id"]').val(respuesta.data.medio_pago_id);

                    $('#form-registro').find('[name="medio_pago_id"]').val('').trigger('change.select2');
                    $('#form-registro').find('[name="medio_pago_id"]').val(respuesta.data.medio_pago_id).trigger('change.select2');
                    $('#form-registro').find('[name="estado_habitacion_id"]').val('').trigger('change.select2');
                    $('#form-registro').find('[name="estado_habitacion_id"]').val(respuesta.data.estado_habitacion_id).trigger('change.select2');

                    $('#form-registro').find('[name="habitacion_id"]').val('').trigger('change.select2');
                    $('#form-registro').find('[name="habitacion_id"]').val(respuesta.habitacion.id).trigger('change.select2');

                    $('#form-registro').find('[name="detalle"]').val(respuesta.data.detalle);
                    $('#form-registro').find('[name="recepcion_id"]').val(respuesta.data.id);
                    $('#form-registro').find('[name="cliente_id"]').val(respuesta.data.cliente_id);
                    $('#form-registro').find('[name="persona_id"]').val(respuesta.data.cliente.persona_id);
                    // $('#form-registro').find('[name="habitacion_id"]').val(respuesta.habitacion.id);
                    // Fullcalendario.refetchEvents();

                }).always(() => {
                }).fail(() => {
                    console.log('error-calendario');

                });
            },
            eventDrop: function(info) {
                let recepcion_id = info.event.id;
                let fecha_inicio = info.event.startStr;
                fecha_inicio = fecha_inicio.split('T')[0];
                let fecha_fin = info.event.endStr;
                fecha_fin = fecha_fin.split('T')[0];

                model.actualizarFechas(recepcion_id, fecha_inicio, fecha_fin).then((respuesta) => {

                }).always(() => {
                }).fail(() => {
                    console.log('error-calendario');

                });
              },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: route('reserva.lista-reservas'),
        });
        Fullcalendario.render();
        this.calendario = Fullcalendario;

        /*
        * * Actualiza el selector de habitaciones
        */
        function actualizarHabitaciones() {
            let opcion = '';
            model.habitacionEstados().then((respuesta) => {
                if (respuesta.status == true) {
                    opcion += '<option value="">Seleccione</option>';
                    $.each(respuesta.data, function (index, value) {
                        opcion += '<option value="' + value.id + '">' + value.nombre + ' - '+ value.estadoHabitacion.nombre+ '</option>';
                    });
                    $('#form-registro').find('[name="habitacion_id"]').html(opcion);
                    $('#form-registro').find('[name="habitacion_id"]').select2({
                        minimumResultsForSearch: Infinity,
                        width: '100%'
                    });

                }
            }).always(() => {
            }).fail(() => {
                console.log('error-calendario');

            });
        }
    }

    eventos = () => {
        /*
        * * Se guarda el registro de la reserva
        */
        $('#form-registro').submit((e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let button = $(e.currentTarget).find('button[type="submit"]')
            let tabla = this.tabla;
            let Fullcalendario = this.calendario;
            button.attr('disabled','true');
            button.find('i').removeClass('fa-save')
            button.find('i').addClass('fa-spinner fa-spin');

            this.model.guardar(data).then((respuesta) => {

                if (respuesta.status == true) {
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
                Fullcalendario.refetchEvents();
            }).always(() => {
            }).fail(() => {
                tabla.ajax.reload(null, false);
                $('#modal-registro').modal('hide');
                button.removeAttr('disabled')
                button.find('i').removeClass('fa-spinner fa-spin')
                button.find('i').addClass('fa-save');
            });

        });

        /*
        * * calcular el total de la reserva y verifica que no coloque letras
        * * en los campos de adelanto, descuento y cobrar extra
        * * y el total de la reserva
        */
        $('[data-section="calcular"]').change((e) => {
            e.preventDefault();
            console.log(esNumerico($('[name="adelanto"]').val()));
            let adelanto = esNumerico($('[name="adelanto"]').val());
            let descuento = esNumerico($('[name="descuento"]').val());
            let cobrar_extra = esNumerico($('[name="cobrar_extra"]').val());
            let total = esNumerico($('[name="precio"]').val());
            let total_final = ((total + cobrar_extra) - descuento)  - adelanto;

            $('[name="total_mostrar"]').val(total_final);
            $('[name="total"]').val(total_final);

            $('[name="adelanto"]').val(adelanto);
            $('[name="descuento"]').val(descuento);
            $('[name="cobrar_extra"]').val(cobrar_extra);
        });


        function esNumerico(valor) {
            // Verifica que no sea null, undefined o vacío
            if (valor === null || valor === undefined || valor === '') {
               return 0; // No es válido
            }

            // Convierte a número y verifica si es realmente un número
            let numero = Number(valor);
            if(!isNaN(numero) === true){
                return numero;
            }else{
                return 0;
            }
        }

        $('[data-action="obtener-habitacion"]').change((e) => {
            e.preventDefault();
            let id = $(e.currentTarget).val();
            console.log(id);

            this.model.obtenerHabitacion(id).then((respuesta) => {
                $('#form-registro').find('[name="precio"]').val(respuesta.data.precio);
                $('#form-registro').find('[name="total"]').val(respuesta.data.precio);
                $('#form-registro').find('[name="total_mostrar"]').val(respuesta.data.precio);


            }).always(() => {

            }).fail(() => {

            });
        });
    }
}
