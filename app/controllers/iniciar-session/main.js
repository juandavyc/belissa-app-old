const formulario = document.getElementById('formulario-iniciar-session');
const recuperar = document.getElementById('recuperar-contrasenia');

const validacion = validateFormRulesEngine(
    {
        form: formulario,
        rules: {
            usuario: {
                required: true,
                minlength: 4,
                maxlength: 25,
            },
            contrasenia: {
                required: true,
                minlength: 4,
                maxlength: 40,
            },
        },
        messages: {}
    }
);

formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    if ($(formulario).valid()) {
        let self = $.confirm({
            content: function () {
                return $.ajax(
                    getRequestConfig({
                        processData: false,
                        url: getMyAppModel('iniciar-session/Iniciar'),
                        formData: new FormData(formulario),
                        datatype: 'json'
                    })
                ).done(function (response) {
                    if (response.status === true) {
                        self.setTitle('Inicio de sesión correcto');
                        self.setContent('Redireccionando, espere...');
                        setTimeout(function () {
                            window.location.href = PROTOCOL_HOST + response.message;
                            //self.close();
                        }, 1000);
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
    else {
        validateFormError(validacion);
    }
})


recuperar.addEventListener('click', (e)=>{
    $.alert("Desactivado, contacte al administrador");
})

