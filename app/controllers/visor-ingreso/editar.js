
export const EditarPlaca = (_buscador) => {

    const formulario = document.getElementById('form_editar_placa');
    const idIngreso = document.getElementById('editar-id-ingreso');
    const idVehiculo = document.getElementById('editar-id-vehiculo');
    const placaOriginal = document.getElementById('placa-original');
    // const placaNueva = document.getElementById('placa-nueva');


    const validacion = validateFormRulesEngine(
        {
            form: formulario,
            rules: {
                placa_original: {
                    required: true,
                    minlength: 5,
                    maxlength: 6,
                    noSpace: true,
                    placaValidator: true
                },
                placa_nueva: {
                    required: true,
                    minlength: 5,
                    maxlength: 6,
                    noSpace: true,
                    placaValidator: true
                },
                razon: {
                    required: true,
                    minlength: 3,
                    maxlength: 200
                },
                acepto_responsabilidad: {
                    required: true
                }
            },
            messages: {
                acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
            }
        }
    );

    let statusEditar = false;


    const myModal = new MyModal({
        container: 'editar-placa-ingreso-modal',
        title: 'Editar placa',
        icon: 'fa fa-warning',
        columnClass: 'sm',
        closeIcon: true,
        event: {
          onOpen: () => { 
            statusEditar = false;
          },
          onClose: () => {
            if (statusEditar) {            
              _buscador.formularioSubmit(true);
            }
          },
        },
      });

    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        if ($(formulario).valid()) {
            formularioSubmit();
        }
        else {
            validateFormError(validacion);
        }
    })


    const setDefaultFormulario = () => {
        formulario.reset();
    }


    const formularioSubmit = () => {
        statusEditar = false;
        let self = $.confirm({
            content: function () {
                return $.ajax(
                    getRequestConfig({
                        processData: false,
                        url: getMyAppModel('visor-ingreso/VisorIngreso', 'PlacaUpdate'),
                        formData: new FormData(formulario),
                        datatype: 'json'
                    })
                ).done(function (response) {
                    if (response.statusText === 'bien') {
                        self.setTitle(response.statusText);
                        self.setContent(response.message);                       
                        statusEditar = true;
                    } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                        self.close();
                        call_recuperar_session(function (k) {
                            formularioSubmit()
                        });
                    } else {
                        self.setTitle(response.statusText);
                        self.setContent(response.message);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    self.setTitle('Error fatal');
                    self.setContent(JSON.stringify(errorThrown));
                    console.log(errorThrown);
                });
            },
            buttons: {
                aceptar: function () {      
                    if(statusEditar){
                        console.log("closeee");
                        myModal.close();
                    }               
                },
            },
        });
    }




    const pruebaEditar = (data) => {
        setDefaultFormulario();
        placaOriginal.value = data.message.placa;
        idIngreso.value = data.message.id;
        idVehiculo.value = data.message.id_vehiculo;
        myModal.open();
    }

    return {
        pruebaEditar
    }

}