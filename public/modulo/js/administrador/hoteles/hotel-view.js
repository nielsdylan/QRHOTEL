class HotelView {

    constructor(model) {
        this.model = model;
    }

    iniciar = () => {
        let html = '';
        this.model.autoSeleccionar().then((respuesta) => {
            // $('#alert-eliminar').modal('hide');

            if (respuesta.estado === false) {
                $('#modal-asignar-hotel').modal('show');
                $.each(respuesta.hoteles, function (index, element) {
                    html += `<a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start" data-id="${element.hotel.id}" data-action="click">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${element.hotel.razon_social}</h5>
                        </div>
                        <p class="mb-1">${element.hotel.direccion}</p>
                        <small class="text-muted">Donec id elit non mi porta.</small>
                    </a>`
                });
                $('#modal-asignar-hotel').find('#seleccionar-lista-hoteles').html(html)
            }
        }).always(() => {
        }).fail(() => {
        });

        $('#seleccionar-lista-hoteles').on('click', 'a[data-action="click"]',(e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');

            this.model.seleccionarHotel(id).then((respuesta) => {
                // $('#modal-asignar-hotel').modal('hide');
                console.log(respuesta);
                location.reload();
            }).always(() => {
            }).fail(() => {
            });
        });
    }
}
