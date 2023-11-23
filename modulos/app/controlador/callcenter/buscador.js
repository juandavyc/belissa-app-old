export class BuscadorClass {
  constructor() {
    this.drawTable = null;
    this.configuracionTabla = {
      botones: [
        {
          id: 'btnVehiculo',
          icon: 'fas fa-angles-right',
          title: 'Detalles',
        },
      ],
      titulo: ['nro', 'placa', 'tipo', 'e', 'opciones'],
    };
    this.#actionListener();
  }
  // public
  setDrawTable(_table) {
    this.drawTable = _table;
  }

  formularioSubmit() {
    let configuracion = {
      formulario: new FormData($('#form_0_buscador')[0]),
      status: false,
      class: this,
    };
    $('#container-tabla-buscador').empty().show(100);
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=Listado',
          type: 'POST',
          data: configuracion.formulario,
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
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');
              configuracion.class.#getMensajeBien(response);
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              configuracion.class.#getMensajeError(response, 'fa-server');
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.formularioSubmit();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              configuracion.class.#getMensajeError(response, 'fa-skull-crossbones');
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle('Error fatal');
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
    $('#form_0_buscador').on('submit', function (e) {
      _class.formularioSubmit();
      e.preventDefault();
      return false;
    });

    $('#buscador_fecha_radio,#buscador_contenido_radio').on('click ', function (e) {
      if (this.value == 1) {
        $('#container-buscador-contenido').hide(200);
        $('#container-buscador-fecha').show(200);
        $('#buscador_contenido').val('xxx');
      } else {
        $('#container-buscador-fecha').hide(200);
        $('#container-buscador-contenido').show(200);
        $('#buscador_contenido').val('');
      }
    });
  }

  #getMensajeBien(_response) {
    let _inner_html = `<div class="col-12 align-center">`;
    _inner_html += `<i class="fa-solid fa-arrow-pointer fa-6x"></i>`;
    _inner_html += `</div>`;
    _inner_html += `<div class="col-12 align-center">`;
    _inner_html += `<h2>Seleccionar</h2>`;
    _inner_html += `<b>- Seleccione una <b>placa</b> de la lista -</b>`;
    _inner_html += `</div>`;

    $('#container-tabla-buscador').empty().html(this.drawTable(_response.rtm, this.configuracionTabla));

    $('#container-error-buscador').hide({
      duration: 400,
      done: $('#container-bien-buscador').show(400),
    });
    $('#container-callcenter-bien-resultado').hide({
      duration: 400,
      done: $('#container-callcenter-error-resultado').show(400).empty().html(_inner_html),
    });
  }

  #getMensajeError(_response, _icon = 'fa-face-sad-cry') {
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

    $('#container-bien-buscador').hide({
      duration: 400,
      done: $('#container-error-buscador').show(400).empty().html(_inner_html),
    });
  }
}
