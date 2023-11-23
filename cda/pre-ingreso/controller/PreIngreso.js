export const PreIngreso = () => {

    const formulario = document.getElementById('formulario-datos-ingreso');

    const selectPropietario = document.getElementById('ingreso-propietario-tipo-documento');
    const selectConductor = document.getElementById('ingreso-conductor-tipo-documento');
    const selectFacturar = document.getElementById('ingreso-factura-tipo-documento');

    const radioSoyPropietario = document.querySelectorAll('input[name="soy_el_propietario"]');
    const radioFacturar = document.querySelectorAll('input[name="a_quien_facturar"]');


    const containerRadioConductor = document.getElementById('radio-container-conductor');

    const containerPropietario = document.getElementById('propietario-container');
    const containerPropietarioElementos = containerPropietario.querySelectorAll('input, select');

    const containerConductor = document.getElementById('conductor-container');
    const containerConductorElementos = containerConductor.querySelectorAll('input, select');

    const containerFacturar = document.getElementById('facturar-container');
    const containerFacturarElementos = containerFacturar.querySelectorAll('input, select');

    const containerFacturarRut = document.getElementById('factura-rut');

    const validationRules = {
        tipoDocumento: {
            required: true,
            valueNotEquals: 'default',
        },
        documento: {
            required: true,
            minlength: 2,
            maxlength: 50,
            noSecuencia: true
        },
        nombreApellido: {
            required: true,
            minlength: 2,
            maxlength: 50,
            alphanumeric: true,
        },
        telefono: {
            required: true,
            minlength: 5,
            maxlength: 50,
            noSecuencia: true
        },
        correo: {
            required: true,
            minlength: 5,
            maxlength: 50,
            noSpace: true
        },
        direccion: {
            required: true,
            minlength: 5,
            maxlength: 50,
            noSecuencia: true
        }
    }

    const validacion = validateFormRulesEngine(
        {
            form: formulario,
            rules: {
                placa: {
                    required: true,
                    minlength: 5,
                    maxlength: 6,
                    noSpace: true,
                    placaValidator: true
                },
                tipo_vehiculo: validationRules.tipoDocumento,
                propietario_documento: validationRules.documento,
                propietario_tipo_documento: validationRules.tipoDocumento,
                propietario_nombres: validationRules.nombreApellido,
                propietario_apellidos: validationRules.nombreApellido,
                propietario_telefono: validationRules.telefono,
                propietario_correo: validationRules.correo,
                propietario_direccion: validationRules.direccion,
                soy_el_propietario: {
                    required: true,
                },
                conductor_documento: validationRules.documento,
                conductor_tipo_documento: validationRules.tipoDocumento,
                conductor_nombres: validationRules.nombreApellido,
                conductor_apellidos: validationRules.nombreApellido,
                conductor_telefono: validationRules.telefono,
                conductor_correo: validationRules.correo,
                conductor_direccion: validationRules.direccion,
                conductor_rut: {
                    required: true,
                },
                a_quien_facturar: {
                    required: true,
                },
                factura_documento: validationRules.documento,
                factura_tipo_documento: validationRules.tipoDocumento,
                factura_nombres: validationRules.nombreApellido,
                factura_apellidos: validationRules.nombreApellido,
                factura_telefono: validationRules.telefono,
                factura_correo: validationRules.correo,
                factura_direccion: validationRules.direccion,
                factura_rut: {
                    required: true,
                },
                terminos_condiciones: {
                    required: true,
                },
                ofertas_comerciales: {
                    required: true,
                }
            },
            messages: {
                terminos_condiciones: 'Debe aceptar los términos y condiciones.'
            }
        }
    );
    // reglas
    const templateDatosVacio = {
        documento: '',
        tipo: 'default',
        nombre: '',
        apellido: '',
        whatsapp: '',
        correo: '',
        direccion: ''
    };

    const templateDatos = {
        documento: 11111,
        tipo: 2,
        nombre: 'no-nombre',
        apellido: 'no-apellido',
        whatsapp: 300000000,
        correo: 'correo@correo.com',
        direccion: 'direccion'
    };

    const tipoDocumento = {
        1: "NIT",
        2: "CEDULA",
        3: "CEDULA DE EXTRANGERIA",
        4: "TARJETA IDENTIDAD",
        5: "PASAPORTE",
        6: "REGISTRO CIVIL",
        8: "CARNET DIPLOMATICO"
    };

    // TipoDocumento
    containerFacturarRut.style.display = 'block';

    formulario.addEventListener('submit', (e) => {
        e.preventDefault()

        // for (const [clave, valor] of new FormData(formulario).entries()) {
        //     console.log(`Clave: ${clave}, Valor: ${valor}`);
        // }
        let status = false;
        if ($(formulario).valid()) {

            let self = $.confirm({
                title: false,
                content: 'Cargando, espere...',
                typeAnimated: true,
                scrollToPreviousElement: false,
                scrollToPreviousElementAnimate: false,
                content: function () {
                    return $.ajax({
                        url: getMyAppModel('ingreso-qr/IngresoQR', 'ClienteInformacion'),
                        type: 'POST',
                        data: new FormData(formulario),
                        headers: {
                            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        timeout: 35000,
                    })
                        .done(function (response) {
                            if (response.statusText === 'bien') {
                                self.setTitle(response.statusText);
                                self.setContent(`
                                <center>
                                    Pre Ingreso creado correctamente:<br>
                                </center>
                                ${response.message}
                                <center>
                                    <br>Gracias por preferirnos
                                    <br><b>CDA AUTOMOTOS S.A.S</b>.
                                </center>
                                `);
                                status = true;
                            }
                            else {
                                self.setTitle(response.statusText);
                                self.setContent(response.message);
                            }
                        })
                        .fail(function (response) {
                            self.setTitle('Error fatal');
                            self.setContent(JSON.stringify(response));
                            console.log(response);
                        });
                },
                buttons: {
                    aceptar: function () {
                        if(status){
                            location.reload()
                        }
                     },
                },
            });
        }

    })


    radioFacturar.forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.value === "propietario") {
                $(containerFacturar).hide(100);
                setDatosModulo(containerFacturarElementos, templateDatos);
            }
            else if (e.target.value === "conductor") {
                $(containerFacturar).hide(100);
                setDatosModulo(containerFacturarElementos, templateDatos);
            }
            else {
                $(containerFacturar).show(100);
                setDatosModulo(containerFacturarElementos, templateDatosVacio);
            }
        });
    });

    radioSoyPropietario.forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.value === "si") {
                $(containerConductor).hide(100);
                $(containerRadioConductor).hide(100);
                setDatosModulo(containerConductorElementos, templateDatos);
            }
            else {
                $(containerConductor).show(200);
                $(containerRadioConductor).show(100);
                setDatosModulo(containerConductorElementos, templateDatosVacio);
            }

        });
    });
    const setDatosModulo = (elemento, { documento, tipo, nombre, apellido, whatsapp, correo, direccion }) => {
        // elemento.
        elemento[0].value = documento;
        elemento[1].value = tipo;
        elemento[2].value = nombre;
        elemento[3].value = apellido;
        elemento[4].value = whatsapp;
        elemento[5].value = correo;
        elemento[6].value = direccion;
    }
    const agregarOption = (selectElement, clave, valor) => {
        const option = document.createElement("option");
        option.value = clave;
        option.text = valor;
        selectElement.appendChild(option);
    }

    const setTipoDocumento = () => {
        for (const [clave, valor] of Object.entries(tipoDocumento)) {
            agregarOption(selectPropietario, clave, valor);
            agregarOption(selectConductor, clave, valor);
            agregarOption(selectFacturar, clave, valor);
        }
    }

    return {
        setTipoDocumento
    }

}   