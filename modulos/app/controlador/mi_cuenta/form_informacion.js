let formMiCuenta = $('#form_0_informacion').validate({
  rules: {
    form_0_nombre: {
      required: true,
      minlength: 4,
      maxlength: 25,
    },
    form_0_apellido: {
      required: true,
      minlength: 4,
      maxlength: 40,
    },
  },
});

const json_firma_usuario = {
  id_container: 'canvas_firma_usuario',
  title_label: 'Firma',
  responsive: '#canvas_firma_usuario',
};
export let firma_usuario = new canvas_firma(json_firma_usuario);

$('#form_0_informacion').on('submit', function (e) {
  let formdata = new FormData(this);
  if (firma_usuario.get_status) {
    formdata.append('form_firma', firma_usuario.get_blob);
    fun_form_0_submit(formdata);
  } else {
    $.alert('Falta la firma del usuario.');
  }
  e.preventDefault();
  return false;
});

function fun_form_0_submit(formdata) {
  let _status = false;
  let self = $.confirm({
    title: 'Error ',
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: PROTOCOL_HOST + '/modulos/app/modelo/mi_cuenta/mi_cuenta.modelo.php?m=Create',
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
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            _status = true;
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
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
      aceptar: function () {
        if (_status) {
          location.reload();
        }
      },
    },
  });
  // e.preventDefault();
  // return false;
}

//buscador de los datos basicos
setTimeout(function () {
  fun_buscador();
}, 500);

function fun_buscador() {
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: PROTOCOL_HOST + '/modulos/app/modelo/mi_cuenta/mi_cuenta.modelo.php?m=Info',
        type: 'POST',
        data: {
          data_dev: 'run_one',
        },
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 35000,
      })
        .done(function (response) {
          if (response.statusText === 'bien') {
            let json_message = response.cuenta[0];
            $('#form_0_cedula').html(json_message.documento);
            $('#form_0_nombre').val(json_message.nombre);
            $('#form_0_apellido').val(json_message.apellido);
            $('#form_0_foto_usuario').val(json_message.foto);
            $('#form_0_href_foto > img').attr('src', json_message.foto);
            $('#firma_usuario > img').attr('src', firma_usuario.set_image(json_message.firma));
            $('input:radio[value="' + json_message.interfaz + '"]').prop('checked', true);

            self.close();
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();

            call_recuperar_session(function (k) {
              fun_buscador();
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

// }
// else {
// setTimeout( function() { window.location.href = PROTOCOL_HOST + '/modulos/'; }, 500 );
// }

// console.log(response);

// })
