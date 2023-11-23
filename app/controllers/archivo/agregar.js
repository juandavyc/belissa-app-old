

let validateForm1 = $('#form_1_agregar').validate({
  rules: {
    nombre: {
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
    'modulo[]': {
      required: true,
      minlength: 2,
    },
    acepto_responsabilidad: {
      required: true,
    },
  },
  messages: {
    acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
    'modulo[]': 'Debe seleccionar Mínimo 2 módulos',
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
  validateForm1.resetForm();
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
          '/modulos/app/modelo/archivo/archivo.modelo.php?m=Create',
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
          if (response.status === 'bien') {
            self.setTitle(response.status);
            self.setContent(response.message);
            validateForm1.resetForm();
          } else if (
            response.status === 'csrf' ||
            response.status === 'session'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              func_agregar_submit();
            });
          } else {
            self.setTitle(response.status);
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
document.addEventListener('DOMContentLoaded', function(){
  let formulario = document.getElementById('form_1_agregar');
  formulario.addEventListener('submit', function() {
    formulario.reset();
  });
});