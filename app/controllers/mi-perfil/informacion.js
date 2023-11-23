export const firma_usuario = new CanvasFirma({
  container: document.getElementById('canvas_firma_usuario'),
  title: "Su firma",
});
const formulario = document.getElementById('form_0_informacion');

const elemento = {
  cedula: formulario.querySelector('#form_0_cedula'),
  foto: formulario.querySelector('#form_0_foto_usuario'),
  foto_src: formulario.querySelector('#form_0_foto_usuario-src'),
  nombre: formulario.querySelector('#form_0_nombre'),
  apellido: formulario.querySelector('#form_0_apellido'),
  white: formulario.querySelector('#form_0_white'),
  firma: firma_usuario
};

const validacion = $(formulario).validate({
  rules: {
    nombre: {
      required: true,
      minlength: 4,
      maxlength: 25,
      alphanumeric: true,
    },
    apellido: {
      required: true,
      minlength: 4,
      maxlength: 40,
      alphanumeric: true,
    },
  },
  messages: {   
    acepto_responsabilidad: 'Debe aceptar los términos y condiciones de uso.',
  },
  errorPlacement: function (label, element) {
    label.addClass('errorMsq');
    element.parent().append(label);
  },
});


$(formulario).on('submit', function (e) {
  e.preventDefault();
  if ($(this).valid() === true) {
    if (firma_usuario.getStatus) {
      let formdata = new FormData(this);
      formdata.append('form_firma', firma_usuario.getBlob);
      formularioSubmit(formdata);

    } else {
      $.alert('Falta la firma del usuario.');
    }
  }
});

function formularioSubmit(formdata) {
  let self = $.confirm({
    title: 'Error ',
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: getMyAppModel('mi-perfil/MiPerfil', 'Update'),
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
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              formularioSubmit(formdata);
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
        
      },
    },
  });
}

//buscador de los datos basicos
setTimeout(function () {
  getInformacion();
}, 500);

function getInformacion() {
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: getMyAppModel('mi-perfil/MiPerfil', 'Informacion'),
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
            const {documento, nombre, apellido, foto, firma} = response.cuenta[0];
            elemento.cedula.textContent = documento;
            elemento.nombre.value = nombre;
            elemento.apellido.value = apellido;
            elemento.foto.value = foto;
            elemento.foto_src.src = foto;
            elemento.firma.setImage(firma);
            self.close();
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              getInformacion();
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
      aceptar: function () { },
    },
  });
}