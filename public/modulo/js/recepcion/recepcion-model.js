class RecepcionModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) =>{
        return $.ajax({
            url: route('recepcion.guardar'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data
        });
    }
    editar = (id) =>{
        return $.ajax({
            url: route('recepcion.editar',{id:id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
    eliminar = (id) =>{
        return $.ajax({
            url: route('recepcion.eliminar',{id:id}),
            type: 'PUT',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
}
