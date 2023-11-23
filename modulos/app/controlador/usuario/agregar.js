let validateFormAgregarUsuario = $("#form_1_agregar").validate({
  rules: {
    nombre_usuario: {
      required: true,
      minlength: 4,
      maxlength: 40,
      alphanumeric: true,
      
    },
    apellido_usuario: {
      required: true,
      minlength: 4,
      maxlength: 40,
      alphanumeric: true,
      
    },
    documento_usuario: {
      required: true,
      minlength: 6,
      maxlength: 20,
      noSpace: true,
    },
    correo_usuario: {
      required: true,
      minlength: 6,
      maxlength: 60,
      noSpace: true,
    },
    contrasena_usuario: {
      required: true,
      minlength: 6,
      maxlength: 20,
      alphanumeric: true,
      noSpace: true,
    },
    acepto_responsabilidad: {
      required: true,
    },
  },
  messages: {
    acepto_responsabilidad: "Debe aceptar la responsabilidad de la información",
  },
  errorPlacement: function (label, element) {
    label.addClass("errorMsq");
    element.parent().append(label);
  },
});



const json_firma_usuario = {
  id_container: "canvas_firma_usuario",
  title_label: "Firma",
  responsive: "#canvas_firma_usuario",
};
export let firma_usuario = new canvas_firma(json_firma_usuario);


$('#form_1_agregar').on('submit', function (e) {
  if ($(this).valid() === true) {  
  let form_data = new FormData(this);
  if (firma_usuario.get_status) {
    form_data.append('form_firma', firma_usuario.get_blob);
    func_agregar_submit(form_data);       
  } else {
    $.alert('Falta la firma del usuario.');
  }
}
  e.preventDefault(); 
  return false;
});



$("#form_1_agregar").on("reset", function (e) {
  validateFormAgregarUsuario.resetForm();
});

function func_agregar_submit(form_data) {
  let self = $.confirm({
    title: false,
    content: "Cargando, espere...",
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url:
          PROTOCOL_HOST +
          "/modulos/app/modelo/usuario/usuario.modelo.php?m=Create",
        type: "POST",
        data: form_data,
        headers: {
          "csrf-token": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        processData: false,
        contentType: false,
        timeout: 35000,
      })
        .done(function (response) {
          if (response.statusText === "bien") {           
            self.setTitle(response.statusText);
            self.setContent(response.message);
            validateFormAgregarUsuario.resetForm();  
            $('#form_1_agregar').trigger('reset');
             
          } else if (
            response.statusText === "no_session" ||
            response.statusText === "no_token"
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
          self.setTitle("Error fatal");
          self.setContent(JSON.stringify(response));
          console.log(response);
        });
    },
    buttons: {
      aceptar: function () {},
    },
  });
}

