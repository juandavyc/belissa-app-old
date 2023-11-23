export class EditarVehiculo {
  constructor() {
    this.buscadorClass = null;
    this.validacionFormulario = $('#form_editar_vehiculo').validate({
      rules: {
        placa: {
          required: true,
          minlength: 5,
          maxlength: 6,
          noSpace: true,
          placaValidator: true,
        },
        acepto_responsabilidad: {
          required: true,
        },
      },
      messages: {
        acepto_responsabilidad:
          'Debe aceptar la responsabilidad de la información',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.funcListener(this);
    this.crearDialog(this);
  }

  setBuscadorClass(_class) {
    this.buscadorClass = _class;
  }

  setResetFormulario() {
    this.validacionFormulario.resetForm();
    $('#form_editar_vehiculo').trigger('reset');
    $('#form_editar_vehiculo')
      .find('input[type=hidden]')
      .each(function () {
        $(this).val($(this).attr('data-default'));
      });
  }

  crearDialog(_class) {
    $('#div_dialog_editar_vehiculo').dialog({
      width: 'auto',
      height: 435,
      modal: true, // bloquear ventana
      fluid: true, // responsive
      resizable: false, // cambien tamaño
      autoOpen: false, // se abra solo
      hide: 'fold', // animacion
      show: 'fold', // animacion
      open: function (event, ui) {
        $('body').css({ overflow: 'hidden' });
      },
      beforeClose: function (event, ui) {
        $('body').css({ overflow: 'inherit' });
        _class.setResetFormulario();
      },
      create: function (event, ui) {
        $(this).css('maxWidth', '910px');
      },
    });
  }
  funcListener(_class) {
    $('#form_editar_vehiculo_reset').on('click', function (e) {
      _class.setResetFormulario();
      e.preventDefault();
      return false;
    });

    $('#form_editar_vehiculo').on('submit', function (e) {
      if ($(this).valid() === true) {
        $.confirm({
          icon: 'fa fa-warning',
          title: 'Mensaje de Belissa Call Center',
          content: `
              <center>
                ¿Está seguro de alterar los datos del vehiculo?
                <br>
                <b>Los datos de su sesión serán tomados</b>.
              </center> `,
          typeAnimated: true,
          scrollToPreviousElement: false,
          scrollToPreviousElementAnimate: false,
          columnClass: 'small',
          closeIcon: true,
          buttons: {
            si: {
              text: 'Si',
              btnClass: 'btn-blue',
              action: function () {
                _class.guardarDatos();
              },
            },
            no: {
              text: 'No',
              action: function () {},
            },
          },
        });
      }
      e.preventDefault();
      return false;
    });
  }

  guardarDatos() {
    let _class = this;
    let _status = false;
    let form_data = new FormData($('#form_editar_vehiculo')[0]);
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
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/vehiculo/vehiculo.modelo.php?m=Update',
          type: 'POST',
          data: form_data,
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
              $('#div_dialog_editar_vehiculo').dialog('close');
              // self.close(true);
              _status = true;
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.guardarDatos();
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
        if (_status == true) {
          _class.buscadorClass.formularioRecargar();
        }
      },
    });
  }

  datosVehiculo(_id_element) {
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
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/vehiculo/vehiculo.modelo.php?m=Info',
          type: 'POST',
          data: {
            id: _id_element,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.close();
              $('#form_id_vehiculo').val(response['vehiculo'][0]['id']);
              $('#form_1_placa').val(response['vehiculo'][0]['placa']);
              $('#form_1_tipo_vehiculo').val(
                response['vehiculo'][0]['tipo']['id']
              );
              $('#form_1_servicio').val(
                response['vehiculo'][0]['servicio']['id']
              );
              $('#form_1_ensenanza').val(response['vehiculo'][0]['ensenanza']);
              $('#form_1_modelo').val(response['vehiculo'][0]['modelo']);
              $('#form-1-editar-marca-input').val(
                response['vehiculo'][0]['marca']['nombre']
              );
              $('#form-1-editar-marca-select').val(
                response['vehiculo'][0]['marca']['id']
              );
              $('#form-1-editar-linea-input').val(
                response['vehiculo'][0]['linea']['nombre']
              );
              $('#form-1-editar-linea-select').val(
                response['vehiculo'][0]['linea']['id']
              );
              $('#form-1-editar-color-input').val(
                response['vehiculo'][0]['color']['nombre']
              );
              $('#form-1-editar-color-select').val(
                response['vehiculo'][0]['color']['id']
              );
              $('#div_dialog_editar_vehiculo').dialog('open');
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();

              call_recuperar_session(function (k) {
                editarVehiculo(_id_element);
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
}
