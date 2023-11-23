export class DatosClass {
  // conductor
  // propietario
  constructor(_propietario, _conductor) {
    this.propietario = _propietario;
    this.conductor = _conductor;

    this.validacionFormularioBuscar = $('#form-datos-cliente-buscar').validate({
      rules: {
        placa: {
          required: true,
          minlength: 5,
          maxlength: 6,
          noSpace: true,
          placaValidator: true,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.validacionFormularioEditar = $('#form-datos-cliente-editar').validate({
      rules: {
        propietario_tipo_documento: {
          required: true,
          valueNotEquals: 'default',
        },
        propietario_documento: {
          required: true,
          minlength: 4,
          maxlength: 20,
          noSpace: true,
          alphanumeric: true,
        },
        propietario_nombres: {
          required: true,
          minlength: 4,
          maxlength: 50,
          alphanumeric: true,
        },
        propietario_apellidos: {
          required: true,
          minlength: 2,
          maxlength: 50,
          alphanumeric: true,
        },
        propietario_telefono: {
          required: true,
          minlength: 5,
          maxlength: 50,
        },
        propietario_correo: {
          required: true,
          maxlength: 50,
          noSpace: true,
          //myEmail: true,
        },
        direccion_propietario: {
          maxlength: 50,
          alphanumeric: true,
        },
        conductor_tipo_documento: {
          required: true,
          valueNotEquals: 'default',
        },
        conductor_documento: {
          required: true,
          minlength: 4,
          maxlength: 20,
          noSpace: true,
          alphanumeric: true,
        },
        conductor_nombres: {
          required: true,
          minlength: 4,
          maxlength: 50,
          alphanumeric: true,
        },
        conductor_apellidos: {
          required: true,
          minlength: 2,
          maxlength: 50,
          alphanumeric: true,
        },
        conductor_telefono: {
          required: true,
          minlength: 5,
          maxlength: 50,
        },
        conductor_correo: {
          maxlength: 50,
          noSpace: true,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.#funcListener();
    this.#autoCompleteInputs();
  }

  #datosBuscarSubmit() {
    const _configForm = {
      form: new FormData($('#form-datos-cliente-buscar')[0]),
      class: this,
    };

    this.#setDefaultFormularioEditar();

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/ingreso-completo/ingreso.modelo.php?m=ConsultarVehiculo',
          type: 'POST',
          data: _configForm.form,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === 'bien') {
              self.setTitle('Completado');
              self.setContent('Espere..');
              if (response.ingreso.statusText === 'bien') {
                _configForm.class.#setDatosVehProCond(response, self);
              } else {
                self.setContent('El vehículo no cuenta con un ingreso al CDA.');
              }
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Completado');
              self.setContent('Sin resultados para este vehículo.');
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _configForm.class.#datosBuscarSubmit();
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
  #datosEditarSubmit() {
    let _configForm = {
      form: new FormData($('#form-datos-cliente-editar')[0]),
      class: this,
      status: false,
    };

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/ingreso-completo/ingreso.modelo.php?m=EditarDatos',
          type: 'POST',
          data: _configForm.form,
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
              self.setTitle('Completado');
              self.setContent(response.message);
              _configForm.status = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _configForm.class.#datosEditarSubmit();
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
      onClose: function () {
        if (_configForm.status == true) {
          _configForm.class.#setDefaultFormularioBuscar();
        }
      },
    });
  }
  #funcListener(_class = this) {
    $('#form-datos-cliente-buscar').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.#datosBuscarSubmit();
      }
      e.preventDefault();
      return false;
    });

    $('#form-datos-cliente-editar').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.#datosEditarSubmit();
      }
      e.preventDefault();
      return false;
    });

    $('#editar-btn-volver-top,#editar-btn-volver-bottom,#editar-btn-reset').on('click', function (e) {
      _class.#setDefaultFormularioBuscar();
      e.preventDefault();
      return false;
    });
  }

  #setDefaultFormularioBuscar() {
    this.validacionFormularioBuscar.resetForm();
    $('#form-datos-cliente-buscar').trigger('reset');
    $('#form-datos-cliente-editar').hide(200);
    $('#form-datos-cliente-buscar').show(200);
    $('#form-tipo-servicio-placa').show(200);
  }
  #setDefaultFormularioEditar() {
    this.validacionFormularioBuscar.resetForm();
    $('#form-datos-cliente-editar').trigger('reset');
    $('#editar-placa_vehiculo-html').empty();
  }

  #setDatosVehProCond(_response, _self) {
    $('#form-datos-cliente-editar').trigger('reset');
    $('#editar-id_ingreso').val(_response.ingreso.message[0].id);
    $('#editar-id_vehiculo').val(_response.vehiculo[0].id);
    $('#editar-placa_vehiculo-html').empty().html(_response.vehiculo[0].placa);
    //propietario
    this.propietario.setIdPropietario(_response.vehiculo[0].propietario.id);
    this.propietario.setTipoDocumento(_response.vehiculo[0].propietario.tipo_documento);
    this.propietario.setDocumento(_response.vehiculo[0].propietario.documento);
    this.propietario.setNombre(_response.vehiculo[0].propietario.nombre);
    this.propietario.setApellido(_response.vehiculo[0].propietario.apellido);
    this.propietario.setTelefono(_response.vehiculo[0].propietario.telefono);
    this.propietario.setCorreo(_response.vehiculo[0].propietario.correo);
    this.propietario.setDireccion(_response.vehiculo[0].propietario.direccion);
    // conductor
    this.conductor.setIdconductor(_response.vehiculo[0].conductor.id);
    this.conductor.setTipoDocumento(_response.vehiculo[0].conductor.tipo_documento);
    this.conductor.setDocumento(_response.vehiculo[0].conductor.documento);
    this.conductor.setNombre(_response.vehiculo[0].conductor.nombre);
    this.conductor.setApellido(_response.vehiculo[0].conductor.apellido);
    this.conductor.setTelefono(_response.vehiculo[0].conductor.telefono);
    this.conductor.setCorreo(_response.vehiculo[0].conductor.correo);

    $('#form-datos-cliente-editar').show(200);
    $('#form-tipo-servicio-placa').hide(200);
    $('#form-datos-cliente-buscar').hide(200);

    _self.close();
  }

  #autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'editar-correo_propietario-text',
      id_input_select: 'editar-correo_propietario-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php?mail=true',
      input_value_default: 'GMAIL.COM',
      input_select_default: 'GMAIL.COM',
      src_table: 'TEptWmlYOTBWNm4wd3NnSDRISTdTUT09',
      src_index: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });
    autocompleteCreateFather({
      id_input_text: 'editar-correo_conductor-text',
      id_input_select: 'editar-correo_conductor-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php?mail=true',
      input_value_default: 'GMAIL.COM',
      input_select_default: 'GMAIL.COM',
      src_table: 'TEptWmlYOTBWNm4wd3NnSDRISTdTUT09',
      src_index: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });
  }
}
