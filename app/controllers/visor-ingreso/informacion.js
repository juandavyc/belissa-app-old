export class InformacionClass {
  constructor() {

    this.myModalInformacion = new MyModal({
      container: 'informacion-ingreso-modal',
      title: 'Datos ingreso',
      icon: 'fa fa-circle-info',
      columnClass: 'lg',
      closeIcon: true,
      event: {
        onOpen: () => { },
        onClose: () => { },
      },
    });

  }

  getInformacion(_id = 1, _callback) {
    const _class = this;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      content: function () {
        return $.ajax({
          url: getMyAppModel('visor-ingreso/VisorIngreso', 'Informacion'),
          type: 'POST',
          data: {
            id_elemento: _id,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle('Completado');
              _callback(response);
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.getInformacion(_id = 1, _callback);
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

  setDatosEnHtml(_response) {
    // limpiar
    $(".to-copy-hand").each(function () {
      $('#' + this.id).empty();
    });
    $("#form-actualizar-vin").trigger('reset');

    $.each(_response, function (key, value) {
      //console.log(key, value);
      switch (key) {
        case 'vez': $('#resultado-' + key).html((value == 1) ? 'PRIMERA VEZ' : 'SEGUNDA VEZ'); break;
        case 'blindado': case 'polarizado': case 'ensenanza': $('#resultado-' + key).html((value == 1) ? 'NO' : 'SI'); break;
        case 'vin': case 'id_vehiculo': $('#resultado-' + key).val(value); break;
        default: $('#resultado-' + key).html(value);
      }
    });
    this.myModalInformacion.open();
  }

  setDatosReimprimir(_response) {
    const arraySocket = {
      'ip': '192.168.1.174',
      'puerto': 6789,
      'pagina': 'http://192.168.1.174/printservice.php',
      'status': 'yes',
    };

    let url = arraySocket.pagina;
    url += "?json=";
    url += encodeURIComponent(JSON.stringify({
      placa: _response.placa,
      tipo: _response.tipo_vehiculo,
      servicio: _response.servicio_vehiculo,
      kilometraje: _response.kilometraje,
      vez: _response.vez,
      telefono: _response.telefono_conductor,
      direccion: _response.direccion_conductor,
      correo: _response.correo_conductor,
      fecha: _response.fecha_ingreso,
    }));
    url += "&config=";
    url += encodeURIComponent(JSON.stringify(arraySocket));
    window.open(url, "Helix Printer Service", "width=400,height=500");
  }




}
