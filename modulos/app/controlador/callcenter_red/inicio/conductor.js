export class ConductorClass {
  constructor() {
    this.validacionFormulario = $('#form_datos_conductor').validate({
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
    let form_data = new FormData($('#form_datos_conductor')[0]);
    form_data.append('vehiculo', $('#datos-vehiculo-id').val());
    form_data.append('rol', 'conductor');

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
    $('#btn-datos-conductor-editar').text('Espere...').prop('disabled', true);
    setTimeout(function () {
      $('#btn-datos-conductor-editar').text(' Editar').prop('disabled', false);
      $('#container-datos-conductor-guardar').show(200);
      $('#datos-conductor-terminos-condiciones').prop('checked', false);
      $('#form_datos_conductor :input').prop('readonly', false);
    }, 500);
  }

  datosRecargar(_rol = 'id') {
    let _class = this;
    let _cliente = $(`#datos-conductor-${_rol.toLowerCase()}`).val();
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
            cliente: $(`#datos-conductor-${_rol.toLowerCase()}`).val(),
            rol: _rol,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === 'bien') {
              console.log("ok");
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');

              _class.setDatos(response.cliente[0]);

              if (_rol === 'DOCUMENTO') {
                _class.datosEditar();
              }
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);

              _class.setDatosDefault();
              _class.datosEditar();
              if (_rol === 'DOCUMENTO') {
                $(`#datos-conductor-documento`).val(_cliente);
              }
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargar((_rol = 'id'));
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
    this.validacionFormulario.resetForm();
    $('#datos-conductor-id-html').empty();
    $('#form_datos_conductor').trigger('reset');
    $('#form_datos_conductor :input').prop('readonly', false);

    if (_hide == true) {
      $('#container-datos-conductor-guardar').hide(200);
    }
  }

  setDatosReadOnly(_id_create = false) {
    $('#form_datos_conductor :input').prop('readonly', true);
    $('#container-datos-conductor-guardar').hide(200);
    $('#datos-conductor-terminos-condiciones').prop('checked', false);

    if (_id_create != false && _id_create.toString().length > 0) {
      $('#datos-conductor-id-html').html(_id_create);
      $('#datos-conductor-id').val(_id_create);
    }
  }
  setDatos(_response) {

    
    // this.setDatosDefault(); 

    $('#btn-datos-conductor-recargar')
      .text(' Espere... ')
      .prop('disabled', true);

    $('#datos-conductor-id-html').html(_response.id);
    $('#datos-conductor-id').val(_response.id);
    $('#datos-conductor-documento').val(_response.documento.numero);
    $('#datos-conductor-nombre').val(_response.nombre);
    $('#datos-conductor-apellido').val(_response.apellido);
    $('#datos-conductor-telefono-1').val(_response.telefono.uno);
    $('#datos-conductor-telefono-2').val(_response.telefono.dos);
    $('#datos-conductor-telefono-3').val(_response.telefono.tres);
    $('#datos-conductor-email').val(_response.email);
    $('#datos-conductor-direccion').val(_response.direccion);

    $('#form_datos_conductor :input').prop('readonly', true);
    $('#container-datos-conductor-guardar').hide(200);

    setTimeout(function () {
      $('#btn-datos-conductor-recargar')
        .text(' Recargar')
        .prop('disabled', false);
    }, 500);
  }
  funcListener(_class) {
    // submit
    $('#form_datos_conductor').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    // editar datos
    $('#btn-datos-conductor-editar').on('click', function (e) {
      _class.datosEditar();
      e.preventDefault();
      return false;
    });
    // recargar datos
    $('#btn-datos-conductor-recargar').on('click', function (e) {
      _class.datosRecargar('ID');
      e.preventDefault();
      return false;
    });

    // buscar datos
    $('#datos-conductor-documento').focusout(function (e) {
      if (!$(this).is('[readonly]')) {
        _class.datosRecargar('DOCUMENTO');
      }
      e.preventDefault();
      return false;
    });
    // reset formulario
    $('#form_datos_conductor_reset').on('click', function (e) {
      $.confirm({
        icon: 'fa fa-warning',
        title: '! Alerta ¡',
        content: `
        <center>
        ¿Está seguro que continuar?
        </center> `,
        typeAnimated: true,
        scrollToPreviousElement: false,
        scrollToPreviousElementAnimate: false,
        columnClass: 'xsmall',
        closeIcon: true,
        buttons: {
          si: {
            text: 'Si',
            btnClass: 'btn-blue',
            action: function () {
              _class.setDatosDefault(false);
            },
          },
          no: {
            text: 'No',
            action: function () {},
          },
        },
      });
      e.preventDefault();
      return false;
    });
  }
}
