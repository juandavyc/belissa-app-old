const formulario = document.getElementById('formulario-contactenos');

const validacion = validateFormRulesEngine(
    {
        form: formulario,
        rules: {           
            nombre: {
                required: true,
                minlength: 2,
                maxlength: 100,
                alphanumeric: true,
            },
            correo: {
                required: true,
                minlength: 1,
                maxlength: 40,
                noSpace: true,
                myEmail: true,
            },
            telefono: {
                required: true,
                minlength: 1,
                maxlength: 20,
            },
            placa: {
                required: true,
                minlength: 5,
                maxlength: 6,
                noSpace: true,
                placaValidator: true,
            },
            mensaje: {
                required: true,
                minlength: 2,
                maxlength: 1000,              
            },
            notificacion: {
                required: true,
                valueNotEquals: '0',
            },
            terminos: {
                required: true,
            },
        },
        messages: {         
            notificacion: "Seleccione un medio de Notificación de respuesta",
            terminos: 'Debe aceptar los términos, condiciones y políticas de privacidad',
        }
    }
);


formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    if ($(formulario).valid() === true) {
        let self = $.confirm({
            content: function () {
                return $.ajax(
                    getRequestConfig({
                        processData: false,
                        url: getMyAppModel('contactenos/Contactenos', 'Create'),
                        formData: new FormData(formulario),
                        datatype: 'json'
                    })
                ).done(function (response) {
                    if (response.statusText === 'bien') {
                        self.setTitle('Enviado');
                        self.setContent(response.message);
                        formulario.reset();
                        
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
                aceptar: function () { },
            },
        });
    }
});

