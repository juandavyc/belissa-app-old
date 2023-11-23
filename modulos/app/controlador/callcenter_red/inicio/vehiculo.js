export class VehiculoClass {
  constructor() {
    this.validacionFormulario = $('#form_datos_vehiculo').validate({
      rules: {
        placa: {
          required: true,
          minlength: 5,
          maxlength: 6,
          noSpace: true,
        },
        tipo: {
          required: true,
          valueNotEquals: 'default',
        },
        servicio: {
          required: true,
          valueNotEquals: 'default',
        },
        modelo: {
          required: true,
          number: true,
          min: 1800,
          max: 2050,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        tipo: 'Seleccione un tipo de vehículo de la lista.',
        tipo: 'Seleccione un tipo de servicio del vehículo de la lista.',
        acepto_terminos_condiciones:
          'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.autoCompleteInputs();
    this.funcListener(this);
  }

  datosSubmit() {
    let _class = this;

    let form_data = new FormData($('#form_datos_vehiculo')[0]);

    form_data.append('propietario', $('#datos-propietario-id').val());
    form_data.append('conductor', $('#datos-conductor-id').val());

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
            '/modulos/app/modelo/rtm/rtm.modelo.php?m=VehiculoUpdate',
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
              $('#datos-vehiculo-placa-html')
                .empty()
                .html(escapehtmljs($('#datos-vehiculo-placa').val()));
              _class.setDatosReadOnly();
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
    $('#btn-datos-vehiculo-editar').text('Espere...').prop('disabled', true);
    setTimeout(function () {
      $('#btn-datos-vehiculo-editar').text(' Editar').prop('disabled', false);
      $('#container-datos-vehiculo-guardar').show(200);
      $('#datos-vehiculo-terminos-condiciones').prop('checked', false);

      $('#form_datos_vehiculo select').prop('disabled', false);
      $('#form_datos_vehiculo :radio').prop('disabled', false);
      $('#form_datos_vehiculo :input').prop('readonly', false);
    }, 500);
  }
  datosRecargar() {
    let _class = this;
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
            '/modulos/app/modelo/rtm/rtm.modelo.php?m=VehiculoInfo',
          type: 'POST',
          data: {
            vehiculo: $('#datos-vehiculo-id').val(),
            rol: 'ID',
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
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');

              _class.setDatos(response.vehiculo[0]);

              self.close();
            } /*else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              
              
              
              $('#rtm-tabla-resultado').empty().html(response.message);
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                funcBuscadorSubmit(_type);
              });
            }*/ else {
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

    $(
      `#datos-vehiculo-placa-html,#datos-vehiculo-top-id-html,#datos-vehiculo-id-html`
    ).empty();

    $('#form_datos_vehiculo').trigger('reset');
    $('#form_datos_vehiculo select').prop('disabled', false);
    $('#form_datos_vehiculo :radio').prop('disabled', false);
    $('#form_datos_vehiculo :input').prop('readonly', false);

    if (_hide == true) {
      $('#container-datos-vehiculo-guardar').hide(200);
    }
  }
  setDatosReadOnly() {
    $('#form_datos_vehiculo select').prop('disabled', true);
    $('#form_datos_vehiculo :radio').prop('disabled', true);
    $('#form_datos_vehiculo :input').prop('readonly', true);

    $('#container-datos-vehiculo-guardar').hide(200);

    $('#datos-vehiculo-terminos-condiciones').prop('checked', false);
  }
  setDatos(_response) {
    this.setDatosDefault();

    $('#btn-datos-vehiculo-recargar')
      .text(' Espere... ')
      .prop('disabled', true);

    $('#datos-vehiculo-top-id-html,#datos-vehiculo-id-html').html(_response.id);

    $('#datos-vehiculo-placa-html').html(_response.placa);

    $('#datos-vehiculo-id').val(_response.id);
    $('#datos-vehiculo-placa').val(_response.placa);
    $('#datos-vehiculo-tipo').val(
      _response.tipo.id == 1 ? 'default' : _response.tipo.id
    );
    $('#datos-vehiculo-servicio').val(
      _response.servicio.id == 1 ? 'default' : _response.servicio.id
    );
    $('#datos-vehiculo-modelo').val(_response.modelo);

    $(
      '#form_datos_vehiculo input[name=ensenanza][value=' +
        _response.ensenanza +
        ']'
    ).prop('checked', true);

    $('#datos-vehiculo-marca-text').val(_response.marca.nombre);
    $('#datos-vehiculo-marca-select').val(_response.marca.id);
    $('#datos-vehiculo-linea-text').val(_response.linea.nombre);
    $('#datos-vehiculo-linea-select').val(_response.linea.id);
    $('#datos-vehiculo-color-text').val(_response.color.nombre);
    $('#datos-vehiculo-color-select').val(_response.color.id);

    $('#form_datos_vehiculo select').prop('disabled', true);
    $('#form_datos_vehiculo :radio').prop('disabled', true);
    $('#form_datos_vehiculo :input').prop('readonly', true);

    setTimeout(function () {
      $('#btn-datos-vehiculo-recargar')
        .text(' Recargar')
        .prop('disabled', false);
    }, 500);
  }
  autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'datos-vehiculo-color-text',
      id_input_select: 'datos-vehiculo-color-select',
      url_select_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_COLOR',
      input_select_default: '1',
      src_table: 'b1cyeVFnY3cxc3JIMk5GUW5wd3Z1Zz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });

    autocompleteCreateFather({
      id_input_text: 'datos-vehiculo-marca-text',
      id_input_select: 'datos-vehiculo-marca-select',
      url_select_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_MARCA',
      input_select_default: '1',
      src_table: 'd2JKbGY1S00zRUY5RjN1ZGl5ejFvZz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [
        {
          id_input_text: 'datos-vehiculo-linea-text',
          id_input_select: 'datos-vehiculo-linea-select',
          input_value_default: 'SIN_LINEA',
          input_select_default: '1',
        },
      ],
    });

    autocompleteCreateSon({
      id_input_text: 'datos-vehiculo-linea-text',
      id_input_select: 'datos-vehiculo-linea-select',
      url_select_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/search.php',
      url_insert_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/create.php',
      input_value_default: 'SIN_LINEA',
      input_select_default: '1',
      src_table: 'bnlEYmpWaDhDUTYvbFNZcmpEcGo4Zz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      src_father: 'Z0R2dnpPWGtkUlcweUgxMDlnLzRlUT09',
      input_father_name: 'MARCA',
      input_father_text: 'datos-vehiculo-marca-text',
      input_father_select: 'datos-vehiculo-marca-select',
    });
  }
  funcListener(_class) {
    $('#form_datos_vehiculo').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#btn-datos-vehiculo-editar').on('click', function (e) {
      _class.datosEditar();
      e.preventDefault();
      return false;
    });

    $('#btn-datos-vehiculo-recargar').on('click', function (e) {
      _class.datosRecargar();
      e.preventDefault();
      return false;
    });

    $('#form_datos_vehiculo_reset').on('click', function (e) {
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
