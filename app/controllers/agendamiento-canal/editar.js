//export class Editar

export class EditarClass {
  constructor() {
    this.validacionFormulario = $('#form_editar_agendamiento').validate({
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
          noSpace: true,
          digits: true,
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
          maxlength: 20,
        },
        correo: {
          required: true,
          minlength: 1,
          maxlength: 40,
          noSpace: true,
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
    // invocar la funcion
    this.callback = null;
    // no se invoquen desde afuera
    this.myModalEditar = new MyModal({
      container: 'dialog-editar-agendamiento',
      title: 'Editar',
      icon: 'fa fa-warning',
      columnClass: 'md',
      closeIcon: true,
      event: {
        onOpen: () => { },
        onClose: () => { },
      },
    });
    this.#funcListener();
    this.#funcDatePicker();
  }

  #funcDatePicker() {
    new Datepicker(document.getElementById("editar-fecha"), {
      todayHighlight: true,
      format: 'dd/mm/yyyy',
      minDate: new Date(),
    }).setDate(new Date());
  }

  #funcListener(_class = this) {

    $('#editar-documento').focusout(function (e) {
      if ($(this).val().length > 4) {
        _class.datosRecargarDocumento($(this).val());
      }
      e.preventDefault();
      return false;
    });

    $('#form_editar_agendamiento').on('submit', function (e) {

      if (_class.validacionFormulario.valid() === true) {
        $.confirm({
          title: 'Mensaje',
          content: `
          <center>
          ¿Está seguro de alterar los datos de la fecha de agendamiento?
          <br>
          Los datos de <b>su sesión serán tomados</b>.
          <br> El estado del agendamiento cambiara a <b>REAGENDADO</b>
          </center> `,
          typeAnimated: true,
          scrollToPreviousElement: false,
          scrollToPreviousElementAnimate: false,
          columnClass: 'xsmall',
          closeIcon: true,
          buttons: {
            si: {
              text: 'Si',
              action: function () {
                _class.datosSubmit();
              },
            },
            no: {
              text: 'No',
              action: function () { },
            },
          },
        });
      }

      e.preventDefault();
      return false;
    });
  }

  datosSubmit() {
    let _class = this;
    let _status = false;
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
          url: getMyAppModel('agendamiento-canal/Agendamiento', 'Create'),
          type: 'POST',
          data: new FormData($('#form_editar_agendamiento')[0]),
          processData: false,
          contentType: false,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
            //console.log(response);
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.myModalEditar.close();
              //self.close();
              _status = true;
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
        aceptar: function () { },
      },
      onDestroy: function () {
        if (_status == true) {
          _class.callback();
        }
      },
    });
  }

  setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    $('#form_editar_agendamiento').trigger('reset');
    $('#editar-placa_vehiculo-html').empty();
    autoCompleteForceCloseAllLists();
  }

  getInformacion(_id = 1, _callback, _class = this) {
    _class.callback = _callback;
    _class.setDefaultFormulario();
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
          url: getMyAppModel('agendamiento-canal/Agendamiento', 'Informacion'),
          type: 'POST',
          data: {
            id_elemento: _id,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              if (response.message.estado.id === 4) {
                $.alert("El Agendamiento fue anulado, ya no se puede cambiar.");
              } 
              else {
                // placa
                $('#editar-id_agendamiento').val(response.message.id);
                $('#editar-id_vehiculo').val(response.message.vehiculo.id);
                $('#editar-id_documento').val(response.message.cliente.id);

                $('#editar-placa_vehiculo-html').html(response.message.vehiculo.placa);
                $('#editar-placa').val(response.message.vehiculo.placa);
                $('#editar-tipo_vehiculo').val(response.message.vehiculo.tipo);

                // agendamiento
                $('#editar-fecha').val(response.message.fecha);
                $('#editar-horario').val(response.message.horario.id);

                // propietario
                $('#editar-tipo_documento').val(response.message.cliente.tipo);
                $('#editar-documento').val(response.message.cliente.documento);
                $('#editar-nombre').val(response.message.cliente.nombre);
                $('#editar-apellido').val(response.message.cliente.apellido);
                $('#editar-telefono').val(response.message.cliente.telefono);
                $('#editar-correo').val(response.message.cliente.correo);
                _class.myModalEditar.open();
              }
              //$('#editar-horario').focus();
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              call_recuperar_session(function (k) {
                _class.getInformacion(_id, _callback, _class);
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
          url: getMyAppModel('callcenter/CallCenter', 'ClienteInformacion'),
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
        aceptar: function () { },
      },
    });
  }
  setDatosDefaultDocumento() {
    $('#editar-tipo_documento').val('default');
    $('#editar-id_documento').val('create_propietario');
    $('#editar-nombre').val('');
    $('#editar-apellido').val('');
    $('#editar-telefono').val('');
    $('#editar-correo').val('');
  }
  setDatosDocumento(_response) {
    $('#editar-tipo_documento').val(_response.documento.id);
    $('#editar-id_documento').val(_response.id);
    $('#editar-nombre').val(_response.nombre);
    $('#editar-apellido').val(_response.apellido);
    $('#editar-telefono').val(_response.telefono.dos);
    $('#editar-correo').val(_response.email);
  }
}
