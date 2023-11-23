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

    this.#funcVideo();
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
              self.setContent('Espere un momento...');
              self.close();

              _configForm.class.confirmTableResultados(response);
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Completado');
              self.setContent('Espere un momento...');
              self.close();
              // se crea la placa, va por primera vez
              _configForm.class.ingresoClass.setIngresoPorID(response, $('#ingreso-placa').val(), 1);
              // _configForm.class.ingresoClass.setIngresoPorID(0, $('#ingreso-placa').val().toUpperCase(), 1);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
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

  confirmTableResultados(_response) {
    let _config = {
      inner_html: '',
      class: this,
    };

    _config.inner_html = '<table class="alt" style="font-size: 20px;">';
    _config.inner_html += `<thead>`;
    _config.inner_html += `<tr>`;
    _config.inner_html += `<th>Vez</th><th>Fecha</th>`;
    _config.inner_html += `</tr>`;
    _config.inner_html += `</thead>`;
    _config.inner_html += `<tbody>`;

    if (_response.contador > 0) {
      $.each(_response.ingreso.message, function (_key, _value) {
        _config.inner_html += `<tr>`;
        _config.inner_html += `<td data-label="vez">${_value.vez}</td>`;
        _config.inner_html += `<td data-label="fecha"><b>${_value.fecha_ingreso}</b></td>`;
        _config.inner_html += `</tr>`;
      });
    } else {
      _config.inner_html += `<tr>`;
      _config.inner_html += `<td data-label="Estado" colspan="2">Sin resultados</td>`;
      _config.inner_html += `</tr>`;
    }
    _config.inner_html += `</tbody>`;
    _config.inner_html += `</table>`;

    // let _response_v = _response.vehiculo.vehiculo[0];

    $.confirm({
      icon: 'fa fa-warning',
      title: '¡Importante!',
      content: _config.inner_html,
      closeIcon: true,
      buttons: {
        primera: {
          text: '1ra VEZ',
          action: function () {
            _config.class.ingresoClass.setIngresoPorID(_response, 'sinplaca', 1);
          },
        },
        segundo: {
          text: '2da VEZ',
          action: function () {
            _config.class.ingresoClass.setIngresoPorID(_response, 'sinplaca', 2);
          },
        },
      },
    });
  }

  #funcVideo() {
    if (new Date() < new Date('12/15/2022')) {
      $.confirm({
        icon: 'fa fa-warning',
        title: '¡Importante!',
        content: `
        <center>
        <h2>Se cambio la forma de validar la placa</h2>
        <div class="video-container">
        <video class="video" controls="controls">
            <source src="/archivos/documentacion/validar_placa_uuu.mp4" type="video/mp4">
        </video>
        </div>
        </center>`,
        columnClass: 'medium',
        closeIcon: true,
        buttons: {
          aceptar: {
            text: 'Aceptar',
            btnClass: 'btn-blue',
            action: function () {},
          },
        },
      });
    }
  }
}
