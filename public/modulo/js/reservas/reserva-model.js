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
    eliminar = (id) =>{
        return $.ajax({
            url: route('reserva.eliminar',{id:id}),
            type: 'PUT',
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
}
