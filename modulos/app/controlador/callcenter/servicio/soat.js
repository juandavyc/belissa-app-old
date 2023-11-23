export class SoatClass {
  constructor() {
    this.tabla = null;
    this.validacionFormulario = $('#form_rtm_historial').validate({
      rules: {
        aseguradora: {
          required: true,
        },
        fecha: {
          required: true,
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

    this.configuracionTabla = {
      botones: [],
      titulo: ['nro', 'aseguradora', 'expedición', 'vencimiento', 'estado', 'responsable'],
    };
    this.#autoCompleteInputs();
    this.#funcListener(this);
  }

  setTabla(_tabla) {
    this.tabla = _tabla;
  }

  datosRecargar() {
    let _class = this;
    _class.setDefaultHistorial();
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=RtmHistorial',
          type: 'POST',
          data: {
            vehiculo: $('#datos-vehiculo-id').val(),
            rol: 'ID',
            tipo: 'SOAT',
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
              _class.setDatos(response.soat);
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              $('#tabs-soat-historial').empty().html(response.message);
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargar();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              $('#tabs-soat-historial').empty().html(response.message);
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
  datosSubmit() {
    let configuracion = {
      form: new FormData($('#form_soat_historial')[0]),
      class: this,
      status: false,
    };
    configuracion.form.append('vehiculo', $('#datos-vehiculo-id').val());
    configuracion.form.append('tipo', 'SOAT');

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=RtmAgregar',
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
              configuracion.status = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.datosSubmit();
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
        if (configuracion.status == true) {
          configuracion.class.datosRecargar();
        }
      },
    });
  }

  setDatos(_response) {
    this.setDefaultHistorial();
    $('#tabs-soat-historial').empty().html(this.tabla(_response, this.configuracionTabla));
  }
  setDefaultHistorial() {
    this.setResetFormulario();
    $('#tabs-soat-historial').empty();
  }
  setResetFormulario() {
    this.validacionFormulario.resetForm();
    $('#form_soat_historial').trigger('reset');
    $('#form_soat_historial')
      .find('input[type=hidden]')
      .each(function () {
        $(this).val($(this).attr('data-default'));
      });
  }

  #autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'soat-historial-ase-text',
      id_input_select: 'soat-historial-ase-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_ASEGURADORA',
      input_select_default: '1',
      src_table: 'Ty9nQlpLQ0xBYTM2Q3pGa2VhQ1cvUT09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });
  }
  #funcListener(_class) {
    $('#form_soat_historial').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });

    $('#form_soat_historial_reset').on('click', function (e) {
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
              _class.setResetFormulario();
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

    $('#btn-soat-historial-recargar').on('click', function (e) {
      _class.datosRecargar();
      e.preventDefault();
      return false;
    });
  }
}
