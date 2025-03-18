class NivelModel {

    constructor(token) {
        this.token = token;
    }

    autoSeleccionar = () =>{
        return $.ajax({
            url: route('auto-seleccionar'),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token: this.token}
        });
    }
    seleccionarHotel = (id) =>{
        return $.ajax({
            url: route('seleccionar-hotel'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token: this.token, id:id}
        });
    }
    editar = (user_id) =>{
        return $.ajax({
            url: route('administrador.configuraciones.clientes.editar',{id:user_id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token: this.token}
        });
    }
    eliminar = (id) =>{
        return $.ajax({
            url: route('administrador.configuraciones.clientes.eliminar',{id:id}),
            type: 'PUT',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
}
