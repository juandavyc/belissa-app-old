export class IngresoHistorialClass {
    constructor(_tabla) {
      this.tabla = _tabla;
      this.configuracionTabla = {
        botones: [
          {
            id: 'btn_info',
            icon: 'fas fa-info-circle',
            title: 'Información',
          },
          /*{
            id: 'btn_delete',
            icon: 'fas fa-times',
            title: 'Eliminar',
          },*/
        ],
        titulo: ['nro', 'placa', 'fecha','propietario','conductor', 'canal'],
      };
      this.funcListener(this);
    }
   
    datosIngreso() {
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
              '/modulos/app/modelo/rtm/rtm.modelo.php?m=IngresoHistorial',
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

                _class.setDatos(response.message);
                 
                self.close();
              } else if (response.statusText === 'sin_resultados') {
                self.setTitle('Sin resultados');
                self.setContent(response.message);
  
                $('#tabs-rtm-historial').empty().html(response.message);
              } else if (
                response.statusText === 'no_session' ||
                response.statusText === 'no_token'
              ) {
                self.close();
                call_recuperar_session(function (k) {
                  _class.datosRecargar();
                });
              } else {
                self.setTitle(response.statusText);
                self.setContent(response.message);
  
                $('#tabs-rtm-historial').empty().html(response.message);
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
  
    setDatos(_response) {
      this.setDefaultIngreso();
  
      $('#tabs-ingreso-historial')
        .empty()
        .html(this.tabla(_response, this.configuracionTabla));
    }
  
    datosSubmit() {
      let _class = this;
      let _status = false;
      let form_data = new FormData($('#form_rtm_historial')[0]);
      form_data.append('vehiculo', $('#datos-vehiculo-id').val());
  
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
              '/modulos/app/modelo/rtm/rtm.modelo.php?m=RtmAgregar',
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
              console.log(response);
              if (response.statusText === 'bien') {
                self.setTitle(response.statusText);
                self.setContent(response.message);
                _status = true;
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
        onClose: function () {
          if (_status == true) {
            _class.datosRecargar();
          }
        },
      });
    }
  
    setResetFormulario() {
      this.validacionFormulario.resetForm();
      $('#form_rtm_historial').trigger('reset');
      $('#form_rtm_historial')
        .find('input[type=hidden]')
        .each(function () {
          $(this).val($(this).attr('data-default'));
        });
    }
  
    setDefaultIngreso() {
      $('#tabs-ingreso-historial').empty();
    }
  
  
    funcListener(_class) {
      $('#form_rtm_historial').on('submit', function (e) {
        if ($(this).valid() === true) {
          _class.datosSubmit();
        }
        e.preventDefault();
        return false;
      });
  
      $('#form_rtm_historial_reset').on('click', function (e) {
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
  
      $('#btn-rtm-historial-recargar').on('click', function (e) {
        _class.datosRecargar();
        e.preventDefault();
        return false;
      });
    }
  }
  