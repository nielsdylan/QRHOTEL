class VentaModel {

    constructor(token) {
        this.token = token;
    }

    obtener = (id) =>{
        return $.ajax({
            url: route('punto-venta.productos-servicios.obtener',{id:id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }

}
