export class PropietarioClass {
  constructor() {
    this.validacionFormulario = $('#form_datos_propietario').validate({
      rules: {
        tipo: {
          required: true,
          valueNotEquals: 'default',
        },
        documento: {
          required: true,
          minlength: 4,
          maxlength: 25,
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
          // alphanumeric: true,
        },
        telefono_1: {
          required: true,
          minlength: 5,
          maxlength: 45,
        },
        telefono_2: {
          minlength: 5,
          maxlength: 45,
        },
        telefono_3: {
          minlength: 5,
          maxlength: 45,
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
        tipo: 'Seleccione un tipo de documento',
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });
    this.#actionListener();
  }

  setFormularioDefault(_guardar) {
    this.validacionFormulario.resetForm();
    $('#datos-propietario-id-html').empty();
    $('#form_datos_propietario').trigger('reset');
    this.#setNoEditable(false);
    if (_guardar == false) {
      $('#container-datos-propietario-guardar').hide(200);
    }
  }
  setDatos(_response, _origen) {
    $('#btn-datos-propietario-recargar').text(' Espere... ').prop('disabled', true);

    $('#datos-propietario-id-html').html(_response.id);
    $('#datos-propietario-id').val(_response.id);
    $('#datos-propietario-tipo').val(_origen == 'dashboard' ? _response.tipo_documento : _response.documento.id);
    $('#datos-propietario-documento').val(_origen == 'dashboard' ? _response.documento : _response.documento.numero);
    $('#datos-propietario-nombre').val(_response.nombre);
    $('#datos-propietario-apellido').val(_response.apellido);

    $('#datos-propietario-telefono-1').val(_origen == 'dashboard' ? _response.telefono_1 : _response.telefono.uno);
    $('#datos-propietario-telefono-2').val(_origen == 'dashboard' ? _response.telefono_2 : _response.telefono.dos);
    $('#datos-propietario-telefono-3').val(_origen == 'dashboard' ? _response.telefono : _response.telefono.tres);

    $('#datos-propietario-email').val(_origen == 'dashboard' ? _response.correo : _response.email);
    $('#datos-propietario-direccion').val(_response.direccion);

    this.#setNoEditable(true);
    setTimeout(function () {
      $('#btn-datos-propietario-recargar').text(' Recargar').prop('disabled', false);
    }, 500);
  }

  formularioSubmit() {
    let configuracion = {
      form: new FormData($('#form_datos_propietario')[0]),
      class: this,
      status: false,
    };

    configuracion.form.append('vehiculo', $('#datos-vehiculo-id').val());
    configuracion.form.append('rol', 'propietario');

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=ClienteUpdate',
          type: 'POST',
          data: configuracion.form,
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
              if ('id' in response) {
                $('#datos-propietario-id-html').html(response.id);
                $('#datos-propietario-id').val(response.id);
              }
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.formularioSubmit();
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

  buscarDatos(_tipo, _valor) {
    let configuracion = {
      class: this,
    };
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=ClienteInfo',
          type: 'POST',
          data: {
            cliente: _valor,
            rol: _tipo,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');
              configuracion.class.setDatos(response.cliente[0], 'propietario');
              if (_tipo == 'DOCUMENTO') {
                configuracion.class.#setNoEditable(false);
              }
              if ($('#container-datos-propietario-guardar').is(':visible')) {
                configuracion.class.#setNoEditable(false);
              }
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              configuracion.class.setFormularioDefault();
              if (_tipo == 'DOCUMENTO') {
                $(`#datos-propietario-documento`).val(_valor);
              }
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.buscarDatos(_tipo, _valor);
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

  #setNoEditable(_status) {
    $('#form_datos_propietario :input').prop('readonly', _status);
    $('#form_datos_propietario select').prop('disabled', _status);
  }
  #editarDatos() {
    $('#btn-datos-propietario-editar').text('Espere...').prop('disabled', true);
    if ($('#container-datos-propietario-guardar').is(':visible')) {
      $('#container-datos-propietario-guardar').hide(200);
      this.#setNoEditable(true);
    } else {
      $('#container-datos-propietario-guardar').show(200);
      this.#setNoEditable(false);
    }
    $('#datos-propietario-terminos-condiciones').prop('checked', false);
    setTimeout(function () {
      $('#btn-datos-propietario-editar').text(' Editar').prop('disabled', false);
    }, 500);
  }
  #actionListener(_class = this) {
    $('#form_datos_propietario').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.formularioSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#btn-datos-propietario-editar').on('click', function (e) {
      _class.#editarDatos();
      e.preventDefault();
      return false;
    });
    $('#btn-datos-propietario-recargar').on('click', function (e) {
      _class.buscarDatos('ID', $(`#datos-propietario-id`).val());
      e.preventDefault();
      return false;
    });

    $('#datos-propietario-documento').focusout(function (e) {
      if (!$(this).is('[readonly]')) {
        _class.buscarDatos('DOCUMENTO', $(this).val());
      }
      e.preventDefault();
      return false;
    });
  }
}
