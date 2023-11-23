const myModalRecuperarSession = new MyModal({
    container: 'recuperar-session-modal',
    title: 'Recuperar sesión',
    icon: 'fa fa-sign-in-alt',
    columnClass: 'xs',
    //closeIcon: true,
    event: {
        onOpen: () => { },
        onClose: () => {

        },
    },
});
const myModalRecuperarSessionFormulario = document.getElementById('form-recuperar-session');
const myModalRecuperarSessionbtnCancel = document.getElementById('btn-recuperar-session-cancel');

let myModalRecuperarSessionCallback = null;

const myModalRecuperarSessionvalidacion = $(myModalRecuperarSessionFormulario).validate({
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
});

myModalRecuperarSessionbtnCancel.addEventListener('click', (e) => {
    e.preventDefault();
    window.location = '/web/cerrar/';
});
myModalRecuperarSessionFormulario.addEventListener('submit', (e) => {
    e.preventDefault();
    if (myModalRecuperarSessionvalidacion.valid() === true) {
        let self = $.confirm({
            content: function () {
                return $.ajax({
                    url: getMyAppModel('iniciar-session/Recuperar'),
                    type: 'POST',
                    data: new FormData(myModalRecuperarSessionFormulario),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    timeout: 35000,
                })
                    .done(function (response) {
                        if (response.statusText === 'bien') {
                            $("meta[name='csrf-token']").attr('content', response.token);
                            self.close(true);
                        } else {
                            self.setTitle(response.statusText);
                            self.setContent(response.message);
                        }
                    })
                    .fail(function (response) {
                        self.setTitle('Error fatal');
                        self.setContent(
                            response.statusText + ' // ' + response.responseText
                        );
                        console.log('fail');
                        console.log(response);
                    });
            },
            onClose: function (_task = false) {
                if (_task) {
                    myModalRecuperarSession.close();
                    myModalRecuperarSessionCallback();
                }
            },
            buttons: {
                aceptar: function () {

                },
            },
        });
    }

});
const call_recuperar_session = (_callback) => {
    myModalRecuperarSession.open();
    myModalRecuperarSessionCallback = _callback;
}
