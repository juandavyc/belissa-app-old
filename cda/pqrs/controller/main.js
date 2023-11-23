const formulario = document.getElementById('formulario-pqrs');
const asunto = formulario.querySelector('#asunto');
const descripcionAsunto = formulario.querySelector('#descripcion-asunto');
const btnSubmit = formulario.querySelector('#btn-submit');

const asuntoContenido = [
    {
        title: "",
        description: ""
    },
    {
        title: "QUEJA",
        description: "Es la expresión o manifestación que le hace el usuario a la empresa por la inconformidad que le generó la prestación de nuestros servicios."
    },
    {
        title: "PETICIÓN",
        description: "Es una actuación por medio de la cual el usuario, de manera respetuosa, solicita a la empresa cualquier información relacionada con la prestación del servicio."
    },
    {
        title: "SUGERENCIA",
        description: "Es una propuesta presentada por un usuario para incidir en el mejoramiento de un proceso de la empresa cuyo objeto está relacionado con la prestación del servicio."
    },
    {
        title: "RECLAMO",
        description: "Es la oposición o contrariedad presentada por el usuario, con el objeto de que la empresa revise y evalúe una actuación relacionada con la prestación del servicio en términos económicos."
    }
];

const validacion = validateFormRulesEngine(
    {
        form: formulario,
        rules: {
            fecha: {
                required: true,
                noSpace: true,
                maxDate: true,
            },
            asunto: {
                required: true,
                valueNotEquals: '0',
            },
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
            descripcion: {
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
            asunto: "Seleccione un asunto",
            notificacion: "Seleccione un medio de Notificación de respuesta",
            terminos: 'Debe aceptar los términos, condiciones y políticas de privacidad',
        }
    }
);

asunto.addEventListener("change", (e) => {
    descripcionAsunto.innerText = asuntoContenido[e.target.value].description;
    btnSubmit.innerText = `ENVIAR ${asuntoContenido[e.target.value].title}`;
});

formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    if ($(formulario).valid() === true) {
        let self = $.confirm({
            content: function () {
                return $.ajax(
                    getRequestConfig({
                        processData: false,
                        url: getMyAppModel('pqrs/Create'),
                        formData: new FormData(formulario),
                        datatype: 'json'
                    })
                ).done(function (response) {
                    if (response.statusText === 'bien') {
                        self.setTitle('Enviado');
                        self.setContent(response.message);                       
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


