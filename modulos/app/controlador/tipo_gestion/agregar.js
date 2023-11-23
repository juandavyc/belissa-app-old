

let validateFormTipoGestion = $('#form_1_agregar').validate({
  rules: {
    nombre_tipo_gestion: {
      required: true,
      minlength: 4,
      maxlength: 20,
      alphanumeric: true,
      noSpace: true,
    },
    tipo_conexion: {
      required: true,
      range: [1, 4],
    },
    acepto_responsabilidad: {
      required: true,
    },
  },
  messages: {
    acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
    
  },
  errorPlacement: function (label, element) {
    label.addClass('errorMsq');
    element.parent().append(label);
  },
});

$('#form_1_agregar').on('submit', function (e) {
  if ($(this).valid() === true) {    
    func_agregar_submit();
  } else {
  }
  e.preventDefault();
  return false;
});
$('#form_1_agregar').on('reset', function (e) {
  validateFormTipoGestion.resetForm();
});

function func_agregar_submit() {
  let form_data = new FormData($('#form_1_agregar')[0]);
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
          '/modulos/app/modelo/tipo_gestion/tipo_gestion.modelo.php?m=Create',
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
            validateFormTipoGestion.resetForm();
          
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              func_agregar_submit();
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
