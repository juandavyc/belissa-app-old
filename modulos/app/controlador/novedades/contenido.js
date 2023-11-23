export function iniContenido(_id, _element) {
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: PROTOCOL_HOST + '/modulos/app/modelo/novedades/novedad.modelo.php?m=Read',
        type: 'POST',
        data: {
          id: _id,
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
            self.setTitle('Bien');
            self.setContent('Cargando, espere...');
            CKEDITOR.instances[_element].setData(response.message.contenido);
            self.close();
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              iniContenido(_id, _element);
            });
          } else {
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
