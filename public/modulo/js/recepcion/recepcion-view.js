class RecepcionView {

    constructor(model) {
        this.model = model;
        this.tabla
    }

    eventos = () => {
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
        $('#form-registro').submit((e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let button = $(e.currentTarget).find('button[type="submit"]')
            button.attr('disabled','true');
            button.find('i').removeClass('fa-save')
            button.find('i').addClass('fa-spinner fa-spin');

            this.model.guardar(data).then((respuesta) => {
                // swal({
                //     title:  respuesta.title,
                //     text:   respuesta.text,
                //     type:   respuesta.icon
                // });
                swal({
                    title:  respuesta.title,
                    text:   respuesta.text,
                    type:   respuesta.icon,
                    closeOnConfirm: false,
                  },
                    function(){
                        location.href =route('recepcion.lista');
                });

                // location.href =route('recepcion.lista');
                button.removeAttr('disabled')
                button.find('i').removeClass('fa-spinner fa-spin')
                button.find('i').addClass('fa-save');
            }).always(() => {
            }).fail(() => {
                $('#modal-registro').modal('hide');
                button.removeAttr('disabled')
                button.find('i').removeClass('fa-spinner fa-spin')
                button.find('i').addClass('fa-save');
            });

        });
        // $('#tabla-data').on('click', 'a.editar',(e) => {
        //     e.preventDefault();
        //     let id = $(e.currentTarget).attr('data-id');
        //     $('#modal-registro').modal('show');
        //     this.model.editar(id).then((respuesta) => {
        //         if(respuesta.status=="success"){


        //             $("#form-registro")[0].reset();
        //             $("#modal-registro").find('h5.modal-title').text('Editar Habitación');

        //             $('[name="id"]').val(respuesta.data.id);
        //             $('#form-registro').find('[name="nombre"]').val(respuesta.data.nombre)
        //             $('#form-registro').find('[name="descripcion"]').val(respuesta.data.descripcion)
        //             $('#form-registro').find('[name="precio"]').val(respuesta.data.precio)

        //             $('#form-registro').find('[name="nivel_id"]').val(respuesta.data.nivel_id).trigger('change.select2');
        //             $('#form-registro').find('[name="tarifa_id"]').val(respuesta.data.tarifa_id).trigger('change.select2');
        //             $('#form-registro').find('[name="categoria_id"]').val(respuesta.data.categoria_id).trigger('change.select2');

        //         }

        //     }).always(() => {

        //     }).fail(() => {

        //     });
        // });
        // $('#tabla-data').on('click', 'a.eliminar',(e) => {
        //     e.preventDefault();
        //     $('#alert-eliminar').modal('show');
        //     let id = $(e.currentTarget).attr('data-id');
        //     let model = this.model;
        //     // console.log(id);
        //     swal({
        //         title: "Eliminar",
        //         text: "Esta seguro de eliminar el registro.",
        //         type: "info",
        //         showLoaderOnConfirm: true,
        //         confirmButtonText: "Si, aceptar",
        //         cancelButtonText: "No, cancelar",
        //         showCancelButton: true,
        //         closeOnConfirm: false,
        //         confirmButtonClass: "btn-danger",
        //     }, function () {
        //         model.eliminar(id).then((respuesta) => {
        //             swal(respuesta.title, respuesta.text, respuesta.icon)
        //             $('#tabla-data').DataTable().ajax.reload(null, false);
        //         }).always(() => {

        //         }).fail(() => {

        //         });

        //     });
        // });
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
    }
}
