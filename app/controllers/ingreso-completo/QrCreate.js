export const QrCreate = () => {
    
    const qrCode = new QRCode("qr-code-resultado", {
        text: "1234",
        width: 245,
        height: 245,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });

    const qrURL = 'https://beta.automotoscallcenter.com/cda/pre-ingreso/index.php?auth=';
    const qrCodeURL = document.getElementById('qr-code-url');
    const qrCodeVigente = document.getElementById('qr-code-vigente');

    const qrWhatsappInput = document.getElementById('qr-whatsapp');
    const qrWhatsappButton = document.getElementById('btn-qr-whatsapp');

    const myModalQr = new MyModal({
        container: 'modal-qr',
        title: 'Resultado',
        icon: 'fa fa-warning',
        columnClass: 'sm',
        closeIcon: true,
        event: {
            onOpen: () => { },
            onClose: () => {

            },
        },
    });

    // const formulario = document.getElementById('formulario-ingreso-qr');

    // const validacion = validateFormRulesEngine({
    //     form: formulario,
    //     rules: {
    //         placa: {
    //             required: true,
    //             minlength: 5,
    //             maxlength: 6,
    //             noSpace: true,
    //             placaValidator: true,
    //         },
    //         tipo_vehiculo: {
    //             required: true,
    //             valueNotEquals: 'default',
    //         }
    //     }
    // });

    // formulario.addEventListener('submit', (e) => {
    //     e.preventDefault();
    //     if ($(formulario).valid()) {
    //         formularioSubmit();
    //     } else {
    //         validateFormError(validacion);
    //     }

    // });

    qrWhatsappButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.open(`https://web.whatsapp.com/send/?phone=57${qrWhatsappInput.value}&text=${encodeURIComponent(qrCodeURL.getAttribute('href'))}&type=phone_number&app_absent=0`, '_blank');
    });


    const formularioSubmit = () => {

        qrCodeURL.textContent = '';
        qrCodeVigente.textContent = '';

        let self = $.confirm({
            content: function () {
                return $.ajax(
                    getRequestConfig({
                        processData: true,
                        url: getMyAppModel('ingreso-qr/IngresoQR', 'Create'),
                        formData: {
                            placa: '',
                            tipo_vehiculo: '1'
                        },
                        datatype: 'json'
                    })
                ).done(function (response) {
                    if (response.statusText === 'bien') {

                        qrCode.clear();
                        qrCode.makeCode(`${qrURL}${response.id}`);

                        qrCodeURL.textContent = `${qrURL}${response.id}`;
                        qrCodeURL.setAttribute("href", `${qrURL}${response.id}`);
                        qrCodeVigente.textContent = 'Vigente: ' + response.vigente;
                        myModalQr.open();

                        self.close();
                    } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                        self.close();
                        call_recuperar_session(function (k) {
                            formularioSubmit();
                        });
                    } else {
                        self.setTitle(response.statusText);
                        self.setContent(response.message);
                    }
                }).fail(function (response) {
                    self.setTitle('Error fatal');
                    self.setContent(JSON.stringify(response));
                    console.log(response);
                });
            },
            buttons: {
                aceptar: function () { },
            },
        });
    }
    return {
        formularioSubmit
    }
}