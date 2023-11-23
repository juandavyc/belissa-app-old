//export class certificar
// 
// 
export class CertificarClass {
  constructor(_buscador) {
    this.statusCertificado = false;
    this.validacionFormulario = $('#form_certificar_vehiculo').validate({
      rules: {
        fecha: {
          required: true,
          noSpace: true,
          maxDate: true,
        },
        acepto_responsabilidad: {
          required: true,
        },
      },
      messages: {
        horario: 'Seleccione un horario',
        acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });
    // invocar la funcion
    this.callback = null;
    // no se invoquen desde afuera
    this.myModalCertificar = new MyModal({
      container: 'certificar-ingreso-modal',
      title: 'Certificar',
      icon: 'fa fa-warning',
      columnClass: 'md',
      closeIcon: true,
      event: {
        onOpen: () => { },
        onClose: () => {
          if (this.statusCertificado) {
            _buscador.formularioSubmit(true);
          }
        },
      },
    });
    this.#funcListener();
    this.#sessionStore();

  }
  #sessionStore() {
    $("#certificado-whatsapp-texto").val(sessionStorage.getItem('whatsApp-texto'));
    $("#certificado-correo-texto").val(sessionStorage.getItem('correo-texto'));
    $("#certificado-correo-titulo").val(sessionStorage.getItem('correo-titulo'));
  }
  #funcListener(_class = this) {

    $('#btn-certificado-correo-texto').on('click', function (e) {
      e.preventDefault();
      sessionStorage.setItem('correo-texto', $('#certificado-correo-texto').val());
      sessionStorage.setItem('correo-titulo', $('#certificado-correo-titulo').val());
      $.alert("Guardado");
    });
    $('#btn-certificado-whatsapp-texto').on('click', function (e) {
      e.preventDefault();
      sessionStorage.setItem('whatsApp-texto', $('#certificado-whatsapp-texto').val());
      $.alert("Guardado");
    });

    //enviar  btn-certificado-telefono_conductor
    $('#btn-certificado-telefono_propietario').on('click', function (e) {
      e.preventDefault();
      _class.sendWhatsApp($('#certificado-whatsapp-texto').val(), $('#certificado-telefono_propietario').val());
    });
    $('#btn-certificado-correo_propietario').on('click', function (e) {
      e.preventDefault();
      _class.sendEmail($('#certificado-correo-titulo').val(), $('#certificado-correo-texto').val(), $('#certificado-correo_propietario').val());
    });
    $('#btn-certificado-telefono_conductor').on('click', function (e) {
      e.preventDefault();
      _class.sendWhatsApp($('#certificado-whatsapp-texto').val(), $('#certificado-telefono_conductor').val());

    });
    $('#btn-certificado-correo_conductor').on('click', function (e) {
      e.preventDefault();
      _class.sendEmail($('#certificado-correo-titulo').val(), $('#certificado-correo-texto').val(), $('#certificado-correo_conductor').val());
    });

    $('#btn-certificado-whatsapp-texto').on('click', function (e) {
      e.preventDefault();
      sessionStorage.setItem('whatsApp-texto', $('#certificado-whatsapp-texto').val());
    });


    $('#form-actualizar-vin').on('submit', function (e) {
      e.preventDefault();
      _class.datosVinSubmit(_class);
    });

    $('#form-actualizar-vin').on('submit', function (e) {
      e.preventDefault();
      _class.datosVinSubmit(_class);
    });


    $('#form_certificar_vehiculo').on('submit', function (e) {
      e.preventDefault();
      if (_class.validacionFormulario.valid() === true) {
        _class.datosSubmit();
      }
    });
  }

  sendWhatsApp(whatsAppText, whatsAppNumber) {
    window.open(`https://web.whatsapp.com/send/?phone=57${whatsAppNumber}&text=${encodeURIComponent(whatsAppText)}&type=phone_number&app_absent=0`, '_blank');
  }
  sendEmail(emailTitle, emailText, emailTo) {
    window.open(`https://mail.google.com/mail/?view=cm&fs=1&to=${emailTo}&su=${emailTitle}&body=${encodeURIComponent(emailText)}`, '_blank');
  }

  datosVinSubmit(_class = this) {
    let _status = false;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'xsmall',
      closeIcon: true,
      autoClose: 'aceptar|1000',
      content: function () {
        return $.ajax({
          url: getMyAppModel('visor-ingreso/VisorIngreso', 'VehiculoUpdate'),
          type: 'POST',
          data: new FormData($('#form-actualizar-vin')[0]),
          processData: false,
          contentType: false,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosVinSubmit(_class);
              });
            } else {
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
        aceptar: function () { },
      },
      onDestroy: function () {
      },
    });
  }

  datosSubmit(_class = this) {

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'xsmall',
      closeIcon: true,
      content: function () {
        return $.ajax({
          url: getMyAppModel('visor-ingreso/VisorIngreso', 'Update'),
          type: 'POST',
          data: new FormData($('#form_certificar_vehiculo')[0]),
          processData: false,
          contentType: false,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
            //console.log(response);
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.statusCertificado = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosSubmit(_class);
              });
            } else {
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
        aceptar: function () { },
      },
      onDestroy: function () {
        if (_class.statusCertificado == true) {
          _class.myModalCertificar.close();
        }
      },
    });
  }

  setDefaultFormulario() {
    this.statusCertificado = false;
    this.validacionFormulario.resetForm();

    $('#form_certificar_vehiculo').trigger('reset');

    this.#sessionStore();

  }

  getInformacion(_id = 1, _callback, _class = this) {
    _class.callback = _callback;
    _class.setDefaultFormulario();
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'xsmall',
      closeIcon: true,
      content: function () {
        return $.ajax({
          url: getMyAppModel('visor-ingreso/VisorIngreso', 'Informacion'),
          type: 'POST',
          data: {
            id_elemento: _id,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              //  console.log(response.message);
              $('#certificar-id_vehiculo').val(response.message.id_vehiculo);
              $('#certificar-id_ingreso').val(response.message.id);
              $('#certificar-placa_vehiculo-html').html(response.message.placa);

              $('#certificado-telefono_propietario').val(response.message.telefono_propietario);
              $('#certificado-correo_propietario').val(response.message.correo_propietario);

              $('#certificado-telefono_conductor').val(response.message.telefono_conductor);
              $('#certificado-correo_conductor').val(response.message.correo_conductor);

              _class.myModalCertificar.open();
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.getInformacion(_id, _callback, _class);
              });
            } else {
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
        aceptar: function () { },
      },
    });
  }
}
