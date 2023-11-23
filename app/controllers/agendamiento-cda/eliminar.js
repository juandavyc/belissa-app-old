export class EliminarClass {
  constructor() {
    // invocar la funcion
    this.buscador = null;
  }
  setBuscador(_buscador) {
    this.buscador = _buscador;
  }

  getRazon(_id_element, _class = this) {
    let temp_razon_eliminar = '';
    $.confirm({
      title: '¿Estás seguro?',
      content: `
            <center> 
            Vas a anular un agendamiento. 
            <br> <b>Podra cambiar su estado dando click en el boton editar</b> 
            <br> <b>¿Desea continuar?</b>          
            <input type="text" placeholder="Escribe la razón de anular el agendamiento" 
            class="razon-jconfirm" maxlenght="200" autocomplete="off" required />          
            </center> `,
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'medium',
      closeIcon: true,
      buttons: {
        formSubmit: {
          text: 'ELiminar',
          btnClass: 'btn-blue',
          action: function () {
            temp_razon_eliminar = this.$content.find('.razon-jconfirm').val();
            if (!temp_razon_eliminar) {
              $.alert('No puede ser vacio');
              return false;
            } else {
              //self.close();
              _class.#setEliminar(_id_element, temp_razon_eliminar, _class);
            }
          },
        },
        cancel: {
          text: 'Cancelar',
          action: function () {},
        },
      },
    });
  }

  #setEliminar(_id_element, _razon, _class = this) {
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
          url: getMyAppModel('agendamiento-cda/Agendamiento', 'Delete'),
          type: 'POST',
          data: {
            id_elemento: _id_element,
            razon: _razon, // confirm
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _status = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.setEliminar(_id_element, _razon, _class);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
            }
          })
          .fail(function (response) {
            self.setTitle('Error fatal');
            self.setContent(response.statusText + ' // ' + response.responseText);
            console.log(response);
          });
      },
      buttons: {
        aceptar: function () {},
      },
      onDestroy: function () {
        if (_status == true) {
          _class.buscador();
        }
      },
    });
  }
}
