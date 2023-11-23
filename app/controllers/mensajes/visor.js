export class MensajeVisorClass {
  constructor() {
    this.configuracionTabla = {
      botones: [
        {
          id: "btnEditarMensaje",
          icon: "fas fa-angles-right",
          title: "Detalles",
        },
      ],
      titulo: ["nro", "titulo", "mensaje", "fecha", "opciones"],
    };
    this.#actionListener();
    this.#iniDialog();
  }

  editMessage(_data) {
    let _class = this;

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
            "/modulos/app/modelo/mensajes/mensajes.modelo.php?m=Editar",
          type: "POST",
          data: {
            id: _data,
          },
          headers: {
            "csrf-token": $('meta[name="csrf-token"]').attr("content"),
          },
          dataType: "json",
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === "bien") {
              self.setTitle("Completado!");
              self.setContent("Espere un momento...");
              _class.#getMensajeBien(response);
              self.close();
            } else if (response.statusText === "sin_resultados") {
              self.setTitle("Sin resultados");
              self.setContent(response.message);
              _class.#getMensajeError(response, "fa-server");
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.formularioSubmit();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.#getMensajeError(response, "fa-skull-crossbones");
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }

  formularioSubmit() {
    let _class = this;
    let form = new FormData($("#form_0_buscador_mensajes")[0]);
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
            "/modulos/app/modelo/mensajes/mensajes.modelo.php?m=Visor",
          type: "POST",
          data: form,
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
              self.setTitle("Completado!");
              self.setContent("Espere un momento...");
              _class.#getMensajeBien(response);
              self.close();
            } else if (response.statusText === "sin_resultados") {
              self.setTitle("Sin resultados");
              self.setContent(response.message);
              _class.#getMensajeError(response, "fa-server");
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.formularioSubmit();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.#getMensajeError(response, "fa-skull-crossbones");
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }

  #iniDialog() {
    $('#dialog-editar-mensaje').dialog({
      width: 'auto',
      height: 435,
      modal: true, // bloquear ventana
      fluid: true, // responsive
      resizable: false, // cambien tamaÃ±o
      autoOpen: false, // se abra solo
      hide: 'fold', // animacion
      show: 'fold', // animacion
      open: function (event, ui) {
        $('body').css({ overflow: 'hidden' });
      },
      beforeClose: function (event, ui) {
        $('body').css({ overflow: 'inherit' });
      },
      create: function (event, ui) {
        $(this).css('maxWidth', '910px');
      },
    });
  }

  ShowModalEditar(_value){

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
            "/modulos/app/modelo/mensajes/mensajes.modelo.php?m=getData",
          type: "POST",
          data: {id:_value},
          headers: {
            "csrf-token": $('meta[name="csrf-token"]').attr("content"),
          },
          dataType: "json",
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === "bien") {

              $('#id_mensaje').val(response.mensaje_pred[0].id);
              $('#titulo').val(response.mensaje_pred[0].titulo);
              $('#mensaje ').val(response.mensaje_pred[0].mensaje);
              $('#dialog-editar-mensaje').dialog('open');


              self.setTitle("Completado!");
              self.setContent("Espere un momento...");
              // _class.#getMensajeBien(response);
              self.close();
            } else if (response.statusText === "sin_resultados") {
              self.setTitle("Sin resultados");
              self.setContent(response.message);
              _class.#getMensajeError(response, "fa-server");
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.formularioSubmit();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.#getMensajeError(response, "fa-skull-crossbones");
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });



   
    
  }

  // private
  #actionListener(_class = this) {


    $("#form_0_buscador_mensajes").on("submit", function (e) {
      _class.formularioSubmit();
      e.preventDefault();
      return false;
    });

    $("#container-tabla-buscador").on(
      "click",
      " #btnEditarMensaje",
      function (e) {

        console.log("abaaa");
        
        _class.ShowModalEditar($(this).attr("btn-id"));
        e.preventDefault();
        return false;
      }
    );

    $("#buscador_fecha_radio,#buscador_contenido_radio").on(
      "click ",
      function (e) {
        if (this.value == 1) {
          $("#container-buscador-contenido").hide(200);
          $("#container-buscador-fecha").show(200);
          $("#buscador_contenido").val("xxx");
        } else {
          $("#container-buscador-fecha").hide(200);
          $("#container-buscador-contenido").show(200);
          $("#buscador_contenido").val("");
        }
      }
    );
  }

  #getMensajeBien(_response) {
    let __class = this;
    let _inner_html = `<div class="col-12 align-center">`;
    _inner_html += `<i class="fa-solid fa-arrow-pointer fa-6x"></i>`;
    _inner_html += `</div>`;
    _inner_html += `<div class="col-12 align-center">`;
    _inner_html += `<h2>Seleccionar</h2>`;
    _inner_html += `<b>- Seleccione una <b>placa</b> de la lista -</b>`;
    _inner_html += `</div>`;

    $("#container-tabla-buscador")
      .empty()
      .html(
        this.#drawTableMensaje(_response.mensaje_pred, this.configuracionTabla)
      );

    // $("#container-resultado-buscador").hide({
    //   duration: 400,
    //   done: $("#container-bien-buscador").show(400),
    // });
    // $("#container-callcenter-bien-resultado").hide({      duration: 400,      done: $("#container-callcenter-error-resultado")        .show(400)        .empty()        .html(_inner_html),});
  }

  #getMensajeError(_response, _icon = "fa-face-sad-cry") {
    let _inner_html = `<div class="col-12 align-center">`;
    _inner_html += `<i class="fa-solid ${_icon} fa-6x"></i>`;
    _inner_html += `</div>`;
    _inner_html += `<div class="col-12 align-center">`;
    _inner_html += `<h2>${_response.statusText}</h2>`;
    _inner_html += `<p>${_response.message}</p>`;
    _inner_html += `</div>`;
    _inner_html += `<div class="col-12 align-left">`;
    _inner_html += `<b>No se han encontrados resultados acordes con los criterios de su búsqueda, intente lo siguiente:</b>`;
    _inner_html += `<ul>`;
    _inner_html += `<li>Comprueba la sintaxis.</li>`;
    _inner_html += `<li>Prueba con otras palabras más generales.</li>`;
    _inner_html += `<li>Intente con palabras diferentes que signifiquen lo mismo.</li>`;
    _inner_html += `<li>Intente más tarde.</li>`;
    _inner_html += `</ul>`;
    _inner_html += `</div>`;

    $("#container-bien-buscador").hide({
      duration: 400,
      done: $("#container-error-buscador").show(400).empty().html(_inner_html),
    });
  }
  #drawTableMensaje(_valores, _configuracion) {
    let inner_html = `<table class="alt">`;
    inner_html += `<thead>`;
    inner_html += `<tr>`;
    $.each(_configuracion.titulo, function (key, value) {
      inner_html += `<th>${value}</th>`;
    });
    inner_html += `</tr>`;
    inner_html += `</thead>`;
    inner_html += `<tbody>`;
    $.each(_valores, function (key, value) {
      inner_html += `<tr id="${key}">`;
      $.each(_valores[key], function (key_, value_) {
        inner_html += `<td data-label="${key_}" id="table_${key_}">`;
        if (key_ === "opciones") {
          $.each(_configuracion.botones, function (__key, __value) {
            inner_html += `<button btn-id="${escapehtmljs(value_)}" `;
            inner_html += `id="${__value.id}" `;
            inner_html += `class="button primary small icon solid ${__value.icon}">`;
            inner_html += `</button>`;
          });
        } else if (key_ === "conductor") {
          inner_html += `<b>${escapehtmljs(value_)}</b>`;
        } else if (key_ === "placa") {
          inner_html += `<b>${escapehtmljs(value_)}</b>`;
        } else if (key_ === "propietario") {
          inner_html += `<b>${escapehtmljs(value_)}</b>`;
        } else {
          inner_html += `${escapehtmljs(value_)}`;
        }
        inner_html += `</td>`;
      });
      inner_html += "</tr>";
    });
    inner_html += `</tbody>`;
    inner_html += `</table>`;
    return inner_html;
  }
}
