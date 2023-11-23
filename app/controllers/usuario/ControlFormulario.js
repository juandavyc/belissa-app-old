export const ControlFormulario = (id) => {

  const formulario = document.getElementById('formulario-' + id);

  const firma = new CanvasFirma({
    container: formulario.querySelector('#firma-usuario'),
    title: "Su firma",
  });

  const objects = {
    id: formulario.querySelector('#id'),
    foto_src: formulario.querySelector('#foto-usuario-' + id + '-src'),
    foto_input: formulario.querySelector('#foto-usuario-' + id),
    nombre: formulario.querySelector('#nombre'),
    apellido: formulario.querySelector('#apellido'),
    tipo_documento: formulario.querySelector('#tipo-documento'),
    documento: formulario.querySelector('#documento'),
    correo: formulario.querySelector('#correo'),
    rango: formulario.querySelector('#rango'),
    nacimiento: formulario.querySelector('#nacimiento'),
    canal: {
      si: formulario.querySelector('#' + id + '-si_canal'),
      no: formulario.querySelector('#' + id + '-no_canal'),
      tipo: formulario.querySelector('#tipo_canal'),
    },
    reset: formulario.querySelector('#btn-editar-reset')
  };

  const validacionFormulario = $(formulario).validate({
    rules: {
      nombre: {
        required: true,
        minlength: 4,
        maxlength: 40,
        alphanumeric: true,
      },
      apellido: {
        required: true,
        minlength: 4,
        maxlength: 40,
        alphanumeric: true,
      },
      documento: {
        required: true,
        minlength: 6,
        maxlength: 20,
        noSpace: true,
      },
      correo: {
        required: true,
        minlength: 6,
        maxlength: 60,
        noSpace: true,
      },
      nacimiento: {
        dateITA: true
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

  $(formulario).on('submit', function (e) {
    e.preventDefault();
    if ($(this).valid() === true) {
      if (firma.getStatus) {
        const formData = new FormData(this);
        formData.append('firma', firma.getBlob);
        formularioSubmit(formData);
      }
      else {
        $.alert("Falta la firma");
      }
    }
  });

  $(objects.reset).on("reset", function (e) {
    setDefault(false);
  });

  const formularioSubmit = (form_data) => {
    let self = $.confirm({
      title: false,
      content: "Cargando, espere...",
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('usuario/Usuario', 'Create'),
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
              if (response.usuario.statusText === "bien") {
                setDefault();
              }
              self.setTitle(response.usuario.statusText);
              self.setContent(`${response.message} <br> ${response.usuario.message} <br> ${response.canal.message}`);
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              self.close();
              call_recuperar_session(function (k) {
                formularioSubmit(form_data)
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(`${response.message} <br> ${response.usuario.message} <br> ${response.canal.message}`);
            }
          })
          .fail(function (response) {
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
            console.log(response);
          });
      },
      buttons: {
        aceptar: function () { },
      },
    });
  }

  const setDefault = (_trigger = true) => {
    if (_trigger) $(formulario).trigger('reset');
    $(objects.foto_src).attr('src', '/images/sin_imagen.png');
    validacionFormulario.resetForm();
    firma.setDefault();
  }

  const adjustCanvasSize = () => {
    firma.setResize();
  }

  const setDatos = (usuario, myModal) => {

    setDefault();

    objects.id.value = usuario.id;
    objects.foto_src.src = usuario.foto;
    objects.foto_input.value = usuario.foto;
    objects.nombre.value = usuario.nombre;
    objects.apellido.value = usuario.apellido;

    objects.documento.value = usuario.documento;
    objects.tipo_documento.value = usuario.tipo_documento;

    objects.correo.value = usuario.correo;

    objects.rango.value = usuario.rango.id;
    objects.nacimiento.value = usuario.fecha_nacimiento;


    //objects.firma.value = usuario.id;
    //objects.fecha_nacimiento.src = usuario.foto;


    myModal.open();

    setTimeout(() => {
      firma.setResize();
      firma.setImage(usuario.firma);
    }, 200);

  }


  return {
    adjustCanvasSize,
    setDatos
  };

}