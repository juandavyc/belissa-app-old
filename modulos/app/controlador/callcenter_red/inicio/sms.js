export class SmsClass {
  constructor() {
    this.validacionFormulario = $("#form_sms_personalizado").validate({
      ignore: [], // para el ckeditor
      debug: false, // para el ckeditor
      rules: {
        mensaje: {
          required: true,
          minlength: 10,
          maxlength: 160,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        acepto_terminos_condiciones:
          "Debe aceptar los términos y condiciones de uso.",
      },
      errorPlacement: function (label, element) {
        label.addClass("errorMsq");
        element.parent().append(label);
      },
    });

    this.funcListener(this);
  }
  getNumeroClientes() {
    let tel_1 = $("#datos-propietario-telefono-1").val();
    let tel_2 = $("#datos-conductor-telefono-1").val();

    if(tel_1 === tel_2){
      $("#container-numero-clientes")
      .append(`  
      <input type="checkbox" id="sms-vehiculo" name="numero[]" value="${tel_1}" checked="" >
      <label for="sms-vehiculo"> <b>${$('#datos-propietario-nombre').val()}</b> ( ${tel_1} ) </label>
    `);

    } else{

      $("#container-numero-clientes")
      .append(`  
      <input type="checkbox" id="sms-vehiculo-propietario" name="numero[]" value="${tel_1}" checked="">
      <label for="sms-vehiculo-propietario"> <b>${$('#datos-propietario-nombre').val()}</b> ( ${tel_1} ) </label>
      <input type="checkbox" id="sms-vehiculo-conductor" name="numero[]" value="${tel_2}" checked="">
      <label for="sms-vehiculo-conductor"> <b>${$('#datos-conductor-nombre').val()}</b> ( ${tel_2} ) </label>
    `);

    }

   
  }
  datosSubmit() {

    let _class = this;
    let form_data = new FormData($("#form_sms_personalizado")[0]);

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
            "/modulos/app/modelo/rtm/rtm.modelo.php?m=SendSms",
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
            console.log(response);
            if (response.statusText === "bien") {
              // self.setTitle(response.status);
              // self.setContent(response.message);
              // _class.datosPorTarea(
              //   $("input[name=guardar]:checked", "#form_nota_historial").val()
              // );
              // _class.setResetFormulario();
            } else if (
              response.statusText === "csrf" ||
              response.statusText === "session"
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

  setResetFormulario() {
    this.validacionFormulario.resetForm();
    $("#form_sms_personalizado").trigger("reset");
    $('#container-numero-clientes').empty();

  }

  setDefaultForm() {
    this.setResetFormulario();
    $("#tabs-notas-historial-vehiculo").empty();
  }

  datosRecargar() {
    this.datosPorTarea("vehiculo");
    this.datosPorTarea("propietario");
    this.datosPorTarea("conductor");
  }

  funcListener(_class) {
    $("#form_sms_personalizado").on("submit", function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });

    // $("#btn-notas-vehiculo-recargar").on("click", function (e) {
    //   _class.datosRecargar();
    //   e.preventDefault();
    //   return false;
    // });

    // $(
    //   "#tabs-notas-historial-vehiculo,#tabs-notas-historial-propietario,#tabs-notas-historial-conductor"
    // ).on("click", "#btn-nota-delete", function (e) {
    //   _class.datosEliminar($(this).attr("data-id"), $(this).attr("data-table"));
    //   e.preventDefault();
    //   return false;
    // });
  }
}
