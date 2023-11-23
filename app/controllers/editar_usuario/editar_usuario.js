let validateFormEditarUsuario = $("#form_editar_usuario").validate({
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
        // alphanumeric: true,
        
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
  
  
  $('#form_editar_usuario').on('submit', function (e) {
    if ($(this).valid() === true) {  
    let form_data = new FormData(this);
    if (firma_usuario.get_status) {
      form_data.append('form_firma', firma_usuario.get_blob);
      fun_form_0_submit(form_data);       
    } else {
      $.alert('Falta la firma del usuario.');
    }
  }
    e.preventDefault(); 
    return false;
  });

    
  $('#form_editar_usuario').on('reset', function (e) {
     
    window.location.href = PROTOCOL_HOST + '/modulos/gestion/usuario/index.php';  
  
  });
  
  
  
  $("#form_editar_usuario").on("reset", function (e) {
    validateFormEditarUsuario.resetForm();
  });
  
  function fun_form_0_submit(form_data) {
    let self = $.confirm({
      title: 'Error ',
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/editar_usuario/editar_usuario.modelo.php?m=Create',
          type: 'POST',
          data: form_data,
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
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              validateFormEditarUsuario.resetForm();          
             
       
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                fun_form_0_submit();
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
        modificar: function () {},
        aceptar: function () {window.location.href = PROTOCOL_HOST + '/modulos/gestion/usuario/index.php'},
        
      },
    });
 
  }
  
  export function fun_get_data(_id_usuario) {
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      closeIcon: true,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/editar_usuario/editar_usuario.modelo.php?m=Info',
          type: 'POST',
          data: {
            id: $('meta[name="csrf-id"]').attr('content'),
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 15000,
        })
          .done(function (response) {
  
            if (response.statusText === 'bien') {
              self.close();
              
              $('#form_id_editar_usuario').val($('meta[name="csrf-id"]').attr('content'));
              $('#form_1_editar_nombre_usuario').val(
                response.message[0]['nombre']
              );
              $('#form_0_foto_usuario').val(response.message[0]['foto']);
              $('#form_0_href_foto > img').attr(
                'src',
                response.message[0]['foto']
              );
              $('#form_1_editar_apellido_usuario').val(
                response.message[0]['apellido']
              );
              $('#form_1_editar_documento_usuario').val(
                response.message[0]['documento']
              );
              $('#form_1_editar_correo_usuario').val(
                response.message[0]['correo']
              );
           
              $('#form_1_fecha_usuario_editar').val(
                response.message[0]['fecha_nacimiento']
              );
              $('#form_11_rango_usuario_editar_input').val(
                response.message[0]['rango']
              );
              $('#form_11_rango_usuario_editar_select').val(
                response.message[0]['id_rango']
              );
  
              $('#form_1_estado_usuario').val(response.message[0]['estado']);
  
              
              $('#firma_usuario > img').attr('src', firma_usuario.set_image(response.message[0]['firma']));
              
            } else if (
              response.statusText === 'no_session' ||
              response.statusText === 'no_token'
            ) {
              self.close();
  
              call_recuperar_session(function (k) {
                fun_get_data(_id_usuario);
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
    });
  }
  
  