export class RunClass {
    constructor() {

    }
    
    #setEachOptions(_response, _id) {
      $.each(_response, function (i, item) {
        $('#' + _id).append(
          $('<option>', {
            value: item.id,
            text: item.nombre,
          })
        );
      });
    }
  
    getDatosInicio(_callback) {
      const _class = this;
      let self = $.confirm({
        title: false,
        content: 'Cargando, espere...',
        typeAnimated: true,
        scrollToPreviousElement: false,
        scrollToPreviousElementAnimate: false,
        //columnClass: 'xsmall',
        closeIcon: true,
        content: function () {
          return $.ajax({
            url:  getMyAppModel('usuario/Config'),
            type: 'GET',
            headers: {
              'csrf-token': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
            timeout: 35000,
          })
            .done(function (response) {
              // console.log(response);
              if (response.statusText === 'bien') {
                self.setTitle('Completado');
                self.setContent('Espere un momento...');
  
                _class.#setEachOptions(response.elementos.rango, 'form_0_buscador #form_0_rango');
                _class.#setEachOptions(response.elementos.rango, 'formulario-agregar #rango');
                _class.#setEachOptions(response.elementos.rango, 'formulario-editar #rango');
                
                _class.#setEachOptions(response.elementos.tipo_documento, 'formulario-agregar #tipo-documento');
                _class.#setEachOptions(response.elementos.tipo_documento, 'formulario-editar #tipo-documento');

                _class.#setEachOptions(response.elementos.tipo_canal, 'formulario-agregar #tipo-canal');
                _class.#setEachOptions(response.elementos.tipo_canal, 'formulario-editar #tipo-canal');
                _class.#setEachOptions(response.elementos.tipo_canal, 'formulario-canal #tipo-canal');
               // _class.#setEachOptions(response.elementos.tipo_canal, 'formulario-canal #tipo-canal');
                
               // _class.#setEachOptions(response.elementos.tipo_canal, 'formulario-agregar #rango');

                self.close(true);
              } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                self.close();
  
                call_recuperar_session(function (k) {
                  _class.getDatosInicio();
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
        onClose: function (_status) {
          if(_status) _callback();
        },
      });
    }  
  }
  