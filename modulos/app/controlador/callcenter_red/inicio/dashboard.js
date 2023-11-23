export class DashboardClass {
  constructor() {
    this.funcListener(this);
  }

  funcListener(_class) {}
}

const $tabServicio = $('#tab-servicio');
const $tabModulo = $('#tab-modulo');

const _messageCargando = {
  statusText: 'Cargando...',
  message: 'Espere un momento, esto no debería demorar...',
};

let classPropietario = null,
  classConductor = null,
  classVehiculo = null;

let classRtm = null;



let classNota = null;
let classSms = null;
let classIngreso = null;

let funcDatosRtmHistorial = null;
export function dashboardDetalles(
  _class_propietario,
  _class_conductor,
  _class_vehiculo
  //_datos_vehiculo,
  //_datos_rtm_historial
) {
  classPropietario = _class_propietario;
  classConductor = _class_conductor;
  classVehiculo = _class_vehiculo;
  //funcDatosVehiculo = _datos_vehiculo;
  // servicios
  //funcDatosRtmHistorial = _datos_rtm_historial;
}

export function dashboardServicios(_class_rtm) {
  classRtm = _class_rtm;
}
 
export function dashboardModulos(_class_nota,_class_sms, _class_ingreso) {
  classNota = _class_nota;
  classSms = _class_sms;
  classIngreso = _class_ingreso;
}

$tabServicio.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    if (tab.id == 1) {
      classRtm.setDefaultHistorial();
      classRtm.datosRecargar();
    }
  },
}); 

$tabModulo.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    if (tab.id == 1) {
      classNota.setDefaultHistorial();
      classNota.datosRecargar();
    } else if (tab.id == 2){
      classSms.setDefaultForm();
      classSms.getNumeroClientes();
    
    } else if (tab.id == 7){
      classIngreso.setDefaultIngreso();
      classIngreso.datosIngreso();
    }
  },
});

$tabServicio.responsiveTabs('activate', 0);
$tabModulo.responsiveTabs('activate', 0);

export function dashboardVehiculo(_id_buscar) {
  //console.log(_id_buscar);

  //messageTablaOpciones(_messageCargando, 'fa-arrows-turn-right');

  setFilterBlurEffect(true);

  classVehiculo.setDatosDefault();
  classPropietario.setDatosDefault();
  classConductor.setDatosDefault();

  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    content: function () {
      return $.ajax({
        url:
          PROTOCOL_HOST + '/modulos/app/modelo/rtm/rtm.modelo.php?m=Detalles',
        type: 'POST',
        data: {
          vehiculo: _id_buscar,
        },
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 35000,
      })
        .done(function (response) {
          if (response.statusText === 'bien') {
            self.setTitle('Completado!');
            self.setContent('Espere un momento...');
            classVehiculo.setDatos(response.vehiculo[0]);
            if (response.propietario.statusText === 'bien') {
              classPropietario.setDatos(response.propietario.cliente[0]);

              if (response.conductor.statusText === 'bien') {
                classConductor.setDatos(response.conductor.cliente[0]);
                setFilterBlurEffect(false);
              } else {
                messageTablaOpciones(response.propietario, 'fa-user-xmark');
              }
            } else {
              messageTablaOpciones(response.propietario, 'fa-user-xmark');
            }

            self.close(true);
          } else if (response.statusText === 'sin_resultados') {
            self.setTitle('Sin resultados');
            self.setContent(response.message);

            messageTablaOpciones(response, 'fa-server');
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              dashboardVehiculo(_id_buscar);
            });
          } else {
            self.setTitle(response.statusText);
            self.setContent(response.message);

            messageTablaOpciones(response, 'fa-skull-crossbones');
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

  $tabServicio.responsiveTabs('activate', 0);
  $tabModulo.responsiveTabs('activate', 0);
}

function messageTablaOpciones(_response, _icon = 'fa-face-sad-cry') {
  let _inner_html = `<div class="col-12 align-center">`;
  _inner_html += `<i class="fa-solid ${_icon} fa-6x"></i>`;
  _inner_html += `</div>`;
  _inner_html += `<div class="col-12 align-center">`;
  _inner_html += `<h3>${escapehtmljs(_response.statusText)}</h3>`;
  _inner_html += `<p>${escapehtmljs(_response.message)}</p>`;
  _inner_html += `<b>- Belissa CallCenter -</b>`;
  _inner_html += `</div>`;

  $('#rtm-container-resultado').hide({
    duration: 400,
    done: $('#rtm-container-error-resultado').show({
      duration: 400,
      done: $('#rtm-container-error-resultado').empty().html(_inner_html),
    }),
  });

  $('#rtm-container-resultado').css('filter', 'blur(0px)');
}

function setFilterBlurEffect(_active = true) {
  if (_active) {
    $('#rtm-container-resultado').css('filter', 'blur(4px)');
  } else {
    $('#rtm-container-resultado').css('filter', 'blur(0px)');
  }

  $('#rtm-container-resultado').show({
    duration: 400,
    done: $('#rtm-container-error-resultado').hide(400),
  });
}
