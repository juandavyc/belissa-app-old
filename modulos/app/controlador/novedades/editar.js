$('#form_novedades_editar').on('submit', function (e) {
  func_editar_submit('form_novedades_editor', 'form_novedades_editar');
  e.preventDefault();
  return false;
});

$('#form_callcenter_editar').on('submit', function (e) {
  func_editar_submit('form_servicio_editor', 'form_callcenter_editar');
  e.preventDefault();
  return false;
});
$('#form_callcenter_dev').on('submit', function (e) {
  func_editar_submit('form_dev_editor', 'form_callcenter_dev');
  e.preventDefault();
  return false;
});

$('#form_novedades_previsualizar').on('click', function (e) {
  $.confirm({
    title: '¡Previsualización!',
    content: CKEDITOR.instances['form_novedades_editor'].getData(),
    buttons: {
      aceptar: function () {},
    },
  });
  e.preventDefault();
  return false;
});

$('#form_servicio_previsualizar').on('click', function (e) {
  $.confirm({
    title: '¡Previsualización!',
    content: CKEDITOR.instances['form_servicio_editor'].getData(),
    buttons: {
      aceptar: function () {},
    },
  });
  e.preventDefault();
  return false;
});

$('#form_dev_previsualizar').on('click', function (e) {
  $.confirm({
    title: '¡Previsualización!',
    content: CKEDITOR.instances['form_dev_editor'].getData(),
    buttons: {
      aceptar: function () {},
    },
  });
  e.preventDefault();
  return false;
});
function func_editar_submit(_editor, _formulario) {
  CKEDITOR.instances[_editor].updateElement();
  let form_data = new FormData($('#' + _formulario)[0]);
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: PROTOCOL_HOST + '/modulos/app/modelo/novedades/novedad.modelo.php?m=Update',
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
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              func_editar_submit();
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
