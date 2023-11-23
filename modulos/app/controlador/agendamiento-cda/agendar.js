export class AgendarClass {
  constructor() {
    this.validacionFormulario = $('#form_agendar').validate({
      rules: {
        fecha: {
          required: true,
          noSpace: true,
          maxDate: true,
        },
        horario: {
          required: true,
          valueNotEquals: 'default',
        },
        placa: {
          required: true,
          minlength: 5,
          maxlength: 6,
          noSpace: true,
          placaValidator: true,
        },
        tipo_vehiculo: {
          required: true,
          valueNotEquals: 'default',
        },
        tipo_documento: {
          required: true,
          valueNotEquals: 'default',
        },
        documento: {
          required: true,
          minlength: 2,
          maxlength: 25,
        },
        nombre: {
          required: true,
          minlength: 2,
          maxlength: 40,
          alphanumeric: true,
        },
        apellido: {
          required: true,
          minlength: 2,
          maxlength: 40,
        //   alphanumeric: true,
        },
        telefono: {
          required: true,
          minlength: 1,
        },
        correo: {
          required: true,
          minlength: 1,
          maxlength: 40,
          myEmail: true,
        },
        canal: {
          required: true,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        horario: 'Seleccione un horario.',
        tipo_documento: 'Seleccione un tipo de cedula.',
        tipo_vehiculo: 'Seleccione un tipo de vehiculo.',
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.editar = null;
    this.cupo = null;
    this.autoCompleteInputs();
    this.funcListener(this);
    this.funcDatePicker();
  }
  setEditar(_editar) {
    this.editar = _editar;
  }
  setCupo(_cupo) {
    this.cupo = _cupo;
  }
  datosSubmit() {
    let _class = this;
    let _status = false;
    let _form_data = new FormData($('#form_agendar')[0]);

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/agendamiento-cda/agen.modelo.php?m=Create',
          type: 'POST',
          data: _form_data,
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
              _status = true;
            } else if (response.statusText === 'reagendar') {
              self.close();
              _class.datosReagendar(response.message, response.id);
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
      onClose: function () {
        if (_status == true) {
          _class.setDatosDefault();
          _class.cupo();
        }
      },
    });
  }
  datosReagendar(_message, _id) {
    let _class = this;
    $.confirm({
      title: '¡Reagendar!',
      content: _message,
      buttons: {
        btnAgendar: {
          text: 'ReAgendar',
          btnClass: 'btn-blue',
          action: function () {
            _class.setDatosDefault();
            _class.editar(_id, function () {
              _class.cupo();
            });
          },
        },
        btnCancelar: {
          text: 'cancelar',
          action: function () {},
        },
      },
    });
  }
  datosRecargarPlaca(_vehiculo = 1) {
    let _class = this;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/agendamiento-cda/agen.modelo.php?m=Vehiculo',
          type: 'POST',
          data: {
            vehiculo: _vehiculo,
            rol: 'PLACA',
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
              _class.setDatosDefaultPlaca();
              _class.setDatosPlaca(response.vehiculo[0]);
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              _class.setDatosDefaultPlaca();
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargarPlaca(_vehiculo);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.setDatosDefaultPlaca();
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

  datosRecargarDocumento(_cliente = 1) {
    let _class = this;
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
            cliente: _cliente,
            rol: 'DOCUMENTO',
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
              _class.setDatosDefaultDocumento();
              _class.setDatosDocumento(response.cliente[0]);
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              _class.setDatosDefaultDocumento();
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargarDocumento(_cliente);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.setDatosDefaultDocumento();
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
  setDatosDefault() {
    this.validacionFormulario.resetForm();
    $('#form_agendar').trigger('reset');
    $('#form_agendar')
      .find('input[type=hidden]')
      .each(function () {
        $(this).val($(this).attr('data-default'));
      });

    $('#agendar-datepiker')
      .datepicker({
        dateFormat: 'dd/mm/yy',
      })
      .datepicker('setDate', new Date());
  }

  setDatosDefaultDocumento() {
    $('#agendar-tipo_documento').val('default');
    $('#agendar-id_documento').val('create_propietario');
    $('#agendar-nombre').val('');
    $('#agendar-apellido').val('');
    $('#agendar-telefono').val('');
    $('#agendar-correo').val('');
  }
  setDatosDocumento(_response) {
    $('#agendar-tipo_documento').val(_response.documento.id);
    $('#agendar-id_documento').val(_response.id);
    $('#agendar-nombre').val(_response.nombre);
    $('#agendar-apellido').val(_response.apellido);
    $('#agendar-telefono').val(_response.telefono.dos);
    $('#agendar-correo').val(_response.email);
  }
  setDatosDefaultPlaca() {
    $('#agendar-id_vehiculo').val('create_vehiculo');
    $('#agendar-tipo_vehiculo').val('default');
  }
  setDatosPlaca(_response) {
    $('#agendar-id_vehiculo').val(_response.id);
    $('#agendar-placa').val(_response.placa);
    $('#agendar-tipo_vehiculo').val(_response.tipo.id);
  }

  autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'canal-mercadeo-text',
      id_input_select: 'canal-mercadeo-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_CANAL',
      input_select_default: '1',
      src_table: 'RlN0MVoyblN2SDh6amR6Z0NWZUthdz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });
    autocompleteCreateFather({
      id_input_text: 'form_0-canal-mercadeo-text',
      id_input_select: 'form_0-canal-mercadeo-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_CANAL',
      input_select_default: '%%',
      src_table: 'RlN0MVoyblN2SDh6amR6Z0NWZUthdz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
      is_todo: true,
    });
  }
  funcDatePicker() {
    $('#agendar-datepiker')
      .datepicker({
        changeYear: true,
        changeMonth: true,
        minDate: 0,
        dateFormat: 'yy-m-dd',
        yearRange: '-100:+20',
        dateFormat: 'dd/mm/yy',
      })
      .datepicker('setDate', new Date());
  }
  funcListener(_class) {
    $('#agendar-tipo_vehiculo').change(function () {
      switch (parseInt($(this).val())) {
        case 2:
        case 3:
        case 5:
        case 6:
          $('#agendar-id_tipo_cupo').val(1);
          break;
        case 4:
          $('#agendar-id_tipo_cupo').val(2);
          break;
        default:
          console.log('Error');
      }
    });
    $('#form_agendar').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#agendar-documento').focusout(function (e) {
      if ($(this).val().length >= 4) {
        _class.datosRecargarDocumento($(this).val());
      }
      e.preventDefault();
      return false;
    });
    $('#agendar-placa').focusout(function (e) {
      if ($(this).val().length >= 5) {
        _class.datosRecargarPlaca($(this).val());
      }
      e.preventDefault();
      return false;
    });
    $('#form_agendar_reset').on('click', function (e) {
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
              _class.setDatosDefault();
              _class.cupo();
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
