export class PlacaClass {
  constructor(_ingreso) {
    this.ingresoClass = _ingreso;

    this.verificarPlaca = {
      class: {
        primero: 'ingreso-placa-primero',
        segundo: 'ingreso-placa-segundo',
      },
      temp: '',
      intento: 1,
    };

    // this.verificarPlaca = {
    //   class: {
    //     primero: 'ingreso-placa-primero',
    //     segundo: 'ingreso-placa-segundo',
    //   },
    //   temp: 'bee973',
    //   intento: 2,
    // };

    this.validacionFormulario = $('#form-tipo-servicio-placa').validate({
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
    this.#funcListener(this);
  }

  #funcListener(_class) {
    $('#form-tipo-servicio-placa').on('submit', function (e) {
      if ($(this).valid() === true && _class.verificarPlaca.intento == 2) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#tipo-servicio-placa-reset').on('click', function (e) {
      _class.setDefaultFormulario();
      e.preventDefault();
      return false;
    });

    $('#ingreso-placa').keydown(function (e) {
      if (e.keyCode == 13) {
        if ($('#form-tipo-servicio-placa').valid() === true) {
          if (_class.verificarPlaca.intento == 1) {
            _class.setVerificarPlacaPrimero();
          } else if (_class.verificarPlaca.intento == 2) {
            _class.setVerificarPlacaSegundo();
          }
        }
      }
    });
  }

  setDefaultVerificarPlaca() {
    $('#btn-ingreso-submit').attr('disabled', true);
    $('#ingreso-placa').removeAttr('class').attr('class', this.verificarPlaca.class.primero);
    $('#ingreso-placa').attr('readonly', false).val('');
    $('#ingreso-placa-instruccion').html('Escriba la placa <b>(Al finalizar pulse ENTER)</b>');
    this.verificarPlaca.temp = '';
    this.verificarPlaca.intento = 1;
  }

  setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    this.setDefaultVerificarPlaca();
    $('#form-tipo-servicio-placa').trigger('reset');
    $('#form-tipo-servicio-placa').show(200);
    $('#form-datos-cliente-buscar').show(200);
    $('#form-ingreso').hide(200);
  }

  setVerificarPlacaPrimero() {
    this.verificarPlaca.temp = $('#ingreso-placa').val();
    this.verificarPlaca.intento = 2;
    $('#ingreso-placa').removeAttr('class').attr('class', this.verificarPlaca.class.segundo);
    $('#ingreso-placa').val('');
    $('#ingreso-placa-instruccion').html('Escriba la placa de nuevo para continuar <b>(Al finalizar pulse ENTER)</b>');
  }

  setVerificarPlacaSegundo() {
    if (this.verificarPlaca.temp == $('#ingreso-placa').val()) {
      $('#ingreso-placa').attr('readonly', true);
      $('#btn-ingreso-submit').attr('disabled', false);
      $('#ingreso-placa-instruccion').html('¡Placa verificada!');
      $('#ingreso-placa').removeAttr('class');
    } else {
      this.setDefaultVerificarPlaca();
      $.alert('Las placas no son iguales');
    }
  }

  datosSubmit() {
    let _configForm = {
      form: new FormData($('#form-tipo-servicio-placa')[0]),
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
          url: getMyAppModel('ingreso-dividido/IngresoDividido', 'VehiculoInformacion'),
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
              self.setContent('Espere un momento...');
              self.close();
              _configForm.class.ingresoClass.setIngresoDatos(response, null);
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Completado');
              self.setContent('Espere un momento...');
              self.close();
              _configForm.class.ingresoClass.setIngresoDatos(null, $('#ingreso-placa').val().toUpperCase());
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _configForm.class.datosSubmit();
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
