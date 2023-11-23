let funcCrearTabla = null,
  funcDashboard = null;

export function buscadorInit(_tabla, _dashboard) {
  funcCrearTabla = _tabla;
  funcDashboard = _dashboard;
}
const configuracionTabla = {
  botones: [
    {
      id: 'btn_detalles',
      icon: 'fas fa-angles-right',
      title: 'Detalles',
    },
  ],
  titulo: ['nro', 'placa', 'g', 'e', 'opciones'],
};

$('#container_0_fecha,#container_0_dato').on('click ', function (e) {
  if (this.value == 1) {
    $('#container-contenido').hide(200);
    $('#container-fecha').show(200);
    $('#buscador_contenido').val('xxx');
  } else {
    $('#container-fecha').hide(200);
    $('#container-contenido').show(200);
    $('#buscador_contenido').val('');
  }
});
// submit

$('#form_0_buscador').on('submit', function (e) {
  funcBuscadorSubmit(true);
  e.preventDefault();
  return false;
});

// click events

$('#rtm-tabla-resultado').on('click', '#btn_detalles', function (e) {
  funcDashboard($(this).attr('btn-id'));
  e.preventDefault();
  return false;
});

//

export function funcBuscadorSubmit(_type = false) {
  $('#rtm-tabla-resultado').empty().show(100);

  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url: PROTOCOL_HOST + '/modulos/app/modelo/rtm/rtm.modelo.php?m=Listado',
        type: 'POST',
        data: new FormData($('#form_0_buscador')[0]),
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
            mensajeBienBuscador(response);
            self.close();
          } else if (response.statusText === 'sin_resultados') {
            self.setTitle('Sin resultados');
            self.setContent(response.message);
            mensajeErrorBuscador(response);
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              funcBuscadorSubmit(_type);
            });
          } else {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            mensajeErrorBuscador(response);
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

function mensajeBienBuscador(_response) {
  $('#rtm-tabla-resultado')
    .empty()
    .html(funcCrearTabla(_response.rtm, configuracionTabla));

  $('#dashboard-error-buscador').hide({
    duration: 400,
    done: $('#dashboard-call-center').show(400),
  });
}

function mensajeErrorBuscador(_response, _icon = 'fa-face-sad-cry') {
  let _inner_html = `<div class="col-12 align-center">`;
  _inner_html += `<i class="fa-solid ${_icon} fa-6x"></i>`;
  _inner_html += `</div>`;
  _inner_html += `<div class="col-12 align-center">`;
  _inner_html += `<h3>${escapehtmljs(_response.statusText)}</h3>`;
  _inner_html += `<p>${escapehtmljs(_response.message)}</p>`;
  _inner_html += `<b>- Belissa CallCenter -</b>`;
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

  $('#dashboard-call-center').hide({
    duration: 400,
    done: $('#dashboard-error-buscador').show(400).empty().html(_inner_html),
  });
  $('#rtm-container-resultado').hide(400);
}
