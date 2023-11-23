export class IngresoClass {
  constructor(_tabla) {
    this.tabla = _tabla;
    this.configuracionTabla = {
      botones: [
        {
          id: 'btn_pdf',
          icon: 'fas fa-file-pdf',
          title: 'PDF',
        },
      ],
      titulo: ['nro', 'conductor', 'vez', 'canal', 'fecha', 'opciones'],
    };
    this.#funcListener(this);
  }
  setTabla(_tabla) {
    this.tabla = _tabla;
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
          url: getMyAppModel('callcenter/CallCenter', 'IngresoListado'),
          type: 'POST',
          data: {
            vehiculo: $('#datos-vehiculo-id').val(),
            rol: 'ID_VEHICULO',
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
              $('#tabs-ingreso-historial').empty().html(response.message);
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargar();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              $('#tabs-ingreso-historial').empty().html(response.message);
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

  setDatos(_response) {
    this.setDefaultIngreso();
    $('#tabs-ingreso-historial').empty().html(this.tabla(_response, this.configuracionTabla));
  }

  setDefaultIngreso() {
    $('#tabs-ingreso-historial').empty();
  }
  getPDF(_id = 1) {
    $.confirm({
      title: 'Resultado en PDF',
      content: `<embed src ="${PROTOCOL_HOST}/pdfs/condiciones_servicio/terminos_correo.php?id=${_id}" width="100%" height="650">`,
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      buttons: {
        aceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () { },
        },
      },
    });
  }

  #funcListener(_class) {
    $('#btn-ingreso-historial-recargar').on('click', function (e) {
      _class.datosRecargar();
      e.preventDefault();
      return false;
    });
    $('#tabs-ingreso-historial').on('click', '#btn_pdf', function (e) {
      _class.getPDF($(this).attr('btn-id'));
      e.preventDefault();
      return false;
    });
  }
}
