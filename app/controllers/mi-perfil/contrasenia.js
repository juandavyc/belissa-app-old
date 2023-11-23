
$('.input-contrasenia').click(function () {

  let temp_status = $(this).attr('data-check');
  let temp_input = $(this).attr('data-id');
  if (temp_status == 1) {
    $(this).attr('data-check', 2);
    $('#' + temp_input).prop('type', 'text');

  }
  else {
    $(this).attr('data-check', 1);
    $('#' + temp_input).prop('type', 'password');
  }

});


$('#form_1_contrasena').on('submit', function (e) {

  $.confirm({
    title: 'Mensaje de Belissa Call Center',
    content:
      '<center>' +
      '<b>SU CONTRASEÑA ES PERSONAL E INTRANSFERIBLE</b><br>' +
      '¿Está seguro de que desea cambiar su contraseña? <br><b> Se cerrara la sesion y debera iniciarla con la nueva contraseña </b></br>' +
      '</center> ',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    closeIcon: true,
    columnClass: 'small',
    buttons: {
      si: {
        text: 'Si',
        action: function () {
          fun_form_1_submit();
        },
      },
      no: {
        text: 'No',
        action: function () { },
      },
    },
  });

  e.preventDefault();
  return false;
});


function fun_form_1_submit() {
  let formdata = new FormData($('#form_1_contrasena')[0]);

  let self = $.confirm({
    title: 'Error ',
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: getMyAppModel('mi-perfil/MiPerfil', 'Contrasenia'),
        type: 'POST',
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 5000,
      })
        .done(function (response) {

          if (response.statusText === "bien") {

            self.setTitle(response.statusText);
            self.setContent(response.message);

            setTimeout(function () {
              self.close();
              window.location.href = PROTOCOL_HOST + '/web/cerrar/';
            }, 2000);

          } else if (
            response.statusText === "no_session" ||
            response.statusText === "no_token"
          ) {
            self.close();
            call_recuperar_session(function (k) {
              fun_form_1_submit();
            });
          } else {
            self.setTitle(response.statusText);
            self.setContent(response.message);
          }
        })
        .fail(function (response) {
          self.setTitle("Error fatal");
          self.setContent(JSON.stringify(response));
          console.log(response);
        });
    },
    onClose: function (_param) {
    },
    buttons: {
      aceptar: function () { },
    },
  });

}


