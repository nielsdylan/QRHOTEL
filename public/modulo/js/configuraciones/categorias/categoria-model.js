class CategoriaModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) =>{
        return $.ajax({
            url: route('configuraciones.categorias.guardar'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data
        });
    }
    editar = (id) =>{
        return $.ajax({
            url: route('configuraciones.categorias.editar',{id:id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
    eliminar = (id) =>{
        return $.ajax({
            url: route('configuraciones.categorias.eliminar',{id:id}),
            type: 'PUT',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
}
