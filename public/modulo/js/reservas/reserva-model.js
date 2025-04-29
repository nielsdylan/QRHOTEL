class ReservaModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) =>{
        return $.ajax({
            url: route('reserva.guardar'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data
        });
    }
    obtenerHabitacion = (id) =>{
        return $.ajax({
            url: route('configuraciones.habitacion.editar',{id:id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
    habitacionEstados = () =>{
        return $.ajax({
            url: route('configuraciones.habitacion.estados'),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }

    obtenerReserva = (id) =>{
        return $.ajax({
            url: route('reserva.obtener-reserva',{id:id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
    actualizarFechas = (recepcion_id, fecha_inicio, fecha_fin) =>{
        return $.ajax({
            url: route('reserva.actualizar-fechas'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token, recepcion_id:recepcion_id, fecha_inicio:fecha_inicio, fecha_fin:fecha_fin }
        });
    }
}
