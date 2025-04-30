class ProductoServicioModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) =>{
        return $.ajax({
            url: route('punto-venta.productos-servicios.guardar'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data
        });
    }
    editar = (id) =>{
        return $.ajax({
            url: route('punto-venta.productos-servicios.editar',{id:id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
    eliminar = (id) =>{
        return $.ajax({
            url: route('punto-venta.productos-servicios.eliminar',{id:id}),
            type: 'PUT',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
}
