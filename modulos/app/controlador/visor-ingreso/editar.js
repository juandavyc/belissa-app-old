//export class Editar

export class EditarClass {
  constructor() {
    this.validacionFormulario = $('#form_certificar_vehiculo').validate({
      rules: {
        fecha: {
          required: true,
          noSpace: true,
          maxDate: true,
        },
      
        acepto_responsabilidad: {
          required: true,
        },
      },
      messages: {
        horario: 'Seleccione un horario',
        acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });
    // invocar la funcion
    this.callback = null;
    // no se invoquen desde afuera
    this.#iniDialog();
    this.#funcListener();
   
  }

  #funcListener(_class = this) {
    $('#form_certificar_vehiculo').on('submit', function (e) {
      if (_class.validacionFormulario.valid() === true) {
        $.confirm({
          title: 'Mensaje de Belissa Call Center',
          content: `
          <center>
          ¿Está seguro de certificar este vehiculo?
          <br>
A esta fecha se le agregaran 365 dias para ser gestionado por Call Center
          <br>
          Los datos de <b>su sesión serán tomados</b>.
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
              action: function () {},
            },
          },
        });
      }

      e.preventDefault();
      return false;
    });
  }
  #iniDialog() {
    $('#dialog-certificar').dialog({
      width: 'auto',
      height: 'auto',
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
      },
      create: function (event, ui) {
        $(this).css('maxWidth', '910px');
      },
    });
  }

  datosSubmit(_class = this) {
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
          url: PROTOCOL_HOST + '/modulos/app/modelo/visor-ingreso/ingreso.modelo.php?m=Update',
          type: 'POST',
          data: new FormData($('#form_certificar_vehiculo')[0]),
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
              $('#dialog-certificar').dialog('close');
              //self.close();
              _status = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosSubmit(_class);
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
      onDestroy: function () {
        if (_status == true) {
          // _class.callback();
        }
      },
    });
  }

  setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    $('#form_certificar_vehiculo').trigger('reset');
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
          url: PROTOCOL_HOST + '/modulos/app/modelo/visor-ingreso/ingreso.modelo.php?m=Info',
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
            //  console.log(response.message);
             $('#editar-id_certificar').val(response.message.id_vehiculo);
             $('#editar-placa_vehiculo-html').html(response.message.placa);
             $('#dialog-certificar').dialog('open');
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
        aceptar: function () {},
      },
    });
  }
}
