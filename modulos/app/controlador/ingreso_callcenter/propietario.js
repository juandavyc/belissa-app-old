export class PropietarioClass {
  constructor() {
    this.validacionFormulario = $('#form_ingreso_basico').validate({
      rules: {
        documento: {
          required: true,
          minlength: 4,
          maxlength: 20,
          digits: true,
          noSpace: true,
        },
        nombre: {
          required: true,
          maxlength: 50,
          alphanumeric: true,
        },
        apellido: {
          required: true,
          maxlength: 50,
          alphanumeric: true,
        },
        telefono_1: {
          required: true,
          minlength: 5,
          maxlength: 10,
          digits: true,
          noSpace: true,
        },
        telefono_2: {
          minlength: 5,
          maxlength: 10,
          digits: true,
        },
        telefono_3: {
          minlength: 5,
          maxlength: 10,
          digits: true,
        },
        email: {
          required: true,
          maxlength: 50,
          noSpace: true,
          myEmail: true,
        },
        direccion: {
          maxlength: 50,
          alphanumeric: true,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        acepto_terminos_condiciones:
          'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.funcListener(this);
  }

  datosSubmit() {
    let _class = this;
    let form_data = new FormData($('#form_datos_propietario')[0]);
    form_data.append('vehiculo', $('#datos-vehiculo-id').val());
    form_data.append('rol', 'propietario');

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/rtm/rtm.modelo.php?m=ClienteUpdate',
          type: 'POST',
          data: form_data,
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
              self.setContent(response.message);
              console.log('id' in response);
              _class.setDatosReadOnly('id' in response ? response.id : false);
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosSubmit();
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
        aceptar: function () {},
      },
    });
  }

  datosEditar() {
    $('#btn-datos-propietario-editar').text('Espere...').prop('disabled', true);
    setTimeout(function () {
      $('#btn-datos-propietario-editar')
        .text(' Editar')
        .prop('disabled', false);
      $('#container-datos-propietario-guardar').show(200);
      $('#datos-propietario-terminos-condiciones').prop('checked', false);
      $('#form_datos_propietario :input').prop('readonly', false);
    }, 500);
  }

  datosRecargar(_rol = 'ID') {
    let _class = this;
    let _cliente = $(`#datos-propietario-${_rol.toLowerCase()}`).val();
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/rtm/rtm.modelo.php?m=ClienteInfo',
          type: 'POST',
          data: {
            cliente: _cliente,
            rol: _rol,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              _class.setDatosDefault();
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');
              _class.setDatos(response.cliente[0]);
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              _class.setDatosDefault();
              self.close();
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargar(_rol);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle('Error fatal');
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }

  setDatosDefault(_hide = true) {
    $('#datos-propietario-nombre').val('');
    $('#datos-propietario-apellido').val('');
    $('#datos-propietario-telefono-1').val('');
    $('#datos-propietario-telefono-2').val('');
    $('#datos-propietario-telefono-3').val('');
    $('#datos-propietario-email').val('');
    $('#datos-propietario-direccion').val('');
  }
  setDatosReadOnly(_id_create = false) {
    $('#form_datos_propietario :input').prop('readonly', true);
    $('#container-datos-propietario-guardar').hide(200);
    $('#datos-propietario-terminos-condiciones').prop('checked', false);
    // id de clientes nuevos
    if (_id_create != false && _id_create.toString().length > 0) {
      $('#datos-propietario-id-html').html(_id_create);
      $('#datos-propietario-id').val(_id_create);
    }
  }

  setDatos(_response) {
    this.setDatosDefault();

    $('#btn-datos-propietario-recargar')
      .text(' Espere... ')
      .prop('disabled', true);

    $('#datos-propietario-id-html').html(_response.id);
    $('#datos-propietario-id').val(_response.id);
    $('#datos-propietario-documento').val(_response.documento.numero);
    $('#datos-propietario-nombre').val(_response.nombre);
    $('#datos-propietario-apellido').val(_response.apellido);
    $('#datos-propietario-telefono-1').val(_response.telefono.uno);
    $('#datos-propietario-telefono-2').val(_response.telefono.dos);
    $('#datos-propietario-telefono-3').val(_response.telefono.tres);
    $('#datos-propietario-email').val(_response.email);
    $('#datos-propietario-direccion').val(_response.direccion);

    $('#form_datos_propietario :input').prop('readonly', true);
    $('#container-datos-propietario-guardar').hide(200);

    setTimeout(function () {
      $('#btn-datos-propietario-recargar')
        .text(' Recargar')
        .prop('disabled', false);
    }, 500);
  }

  funcListener(_class) {
    // submit
    $('#form_datos_propietario').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    // editar datos
    $('#btn-datos-propietario-editar').on('click', function (e) {
      _class.datosEditar();
      e.preventDefault();
      return false;
    });
    // recargar datos
    $('#btn-datos-propietario-recargar').on('click', function (e) {
      _class.datosRecargar('ID');
      e.preventDefault();
      return false;
    });
    // buscar datos
    $('#datos-propietario-documento').focusout(function (e) {
      if (!$(this).is('[readonly]')) {
        _class.datosRecargar('DOCUMENTO');
      }
      e.preventDefault();
      return false;
    });
    // reset formulario
    // $('#form_reset').on('click', function (e) {
    //   $.confirm({
    //     icon: 'fa fa-warning',
    //     title: '! Alerta ¡',
    //     content: `
    //     <center>
    //     ¿Está seguro que continuar?
    //     </center> `,
    //     typeAnimated: true,
    //     scrollToPreviousElement: false,
    //     scrollToPreviousElementAnimate: false,
    //     columnClass: 'xsmall',
    //     closeIcon: true,
    //     buttons: {
    //       si: {
    //         text: 'Si',
    //         btnClass: 'btn-blue',
    //         action: function () {
    //           _class.setDatosDefault(false);
    //         },
    //       },
    //       no: {
    //         text: 'No',
    //         action: function () {},
    //       },
    //     },
    //   });
    //   e.preventDefault();
    //   return false;
    // });
  }
}
