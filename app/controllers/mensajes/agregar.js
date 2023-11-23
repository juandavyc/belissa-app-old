export class MensajeClass {
  constructor() {
    this.validacionFormulario = $("#form_enviar_mensajes_masivos").validate({
      rules: {
        // titulo: {
        //   required: true,
        //   minlength: 4,
        //   maxlength: 40,
        // },
        mensaje_masivo: {
          required: true,
          maxlength: 160,
        },
        acepto_responsabilidad: {
          required: true,
        },
      },
      messages: {
        acepto_responsabilidad:
          "Debe aceptar la responsabilidad de la información",
      },
      errorPlacement: function (label, element) {
        label.addClass("errorMsq");
        element.parent().append(label);
      },
    });

    this.funcListener(this);
  }
  funcSubmit() {
    // console.log("abcabcabc");
    let _class = this;
    let _form = new FormData($('#form_enviar_mensajes_masivos')[0]);
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
            "/modulos/app/modelo/mensajes/mensajes.modelo.php?m=Enviar",
          type: "POST",
          data: _form,
          headers: {
            "csrf-token": $('meta[name="csrf-token"]').attr("content"),
          },
          dataType: "json",
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === "bien") {
              // self.setTitle('Completado');
              // self.setContent('Espere un momento...');
              // self.close();
              // _configForm.class.confirmTableResultados(response);
            } else if (response.statusText === "sin_resultados") {
              // self.setTitle('Completado');
              // self.setContent('Espere un momento...');
              // self.close();
              // // se crea la placa, va por primera vez
              // _configForm.class.ingresoClass.setIngresoPorID(response, $('#ingreso-placa').val(), 1);
              // _configForm.class.ingresoClass.setIngresoPorID(0, $('#ingreso-placa').val().toUpperCase(), 1);
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              // self.close();
              // call_recuperar_session(function (k) {
              //   _class.datosSubmit();
              // });
            } else {
              // self.setTitle(response.statusText);
              // self.setContent(response.message);
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
  funcListener(_class) {
    $("#form_agregar_mensaje").on("submit", function (e) {
      if ($(this).valid() === true) {
        // console.log("BUENASJHKHDJSAJK");
        _class.funcSubmit();
      }
      e.preventDefault();
      return false;
    });
  }
  // setDef() {}
}

