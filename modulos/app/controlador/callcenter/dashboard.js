import { VehiculoClass } from './dashboard/vehiculo.js';
import { PropietarioClass } from './dashboard/propietario.js';
import { ConductorClass } from './dashboard/conductor.js';
// servicio
import { RtmClass } from './servicio/rtm.js';
import { SoatClass } from './servicio/soat.js';
// modulo
import { NotasClass } from './modulo/notas.js';
import { SmsClass } from './modulo/sms.js';
import { WhatsappClass } from './modulo/whatsapp.js';
// historico
import { IngresoClass } from './modulo/ingreso.js';
import { AgendamientoClass } from './modulo/agendamiento.js';

export class DashboardClass {
  constructor() {
    this.idFila = 0;

    this.vehiculo = new VehiculoClass();
    this.propietario = new PropietarioClass();
    this.conductor = new ConductorClass();
    // servicio
    this.rtm = new RtmClass();
    this.soat = new SoatClass();
    // modulo
    this.nota = new NotasClass();
    this.sms = new SmsClass();
    this.whatsapp = new WhatsappClass();
    // historico
    this.ingreso = new IngresoClass();
    this.agendamiento = new AgendamientoClass();
    // tabs
    this.tabServicio = $('#tab-servicio');
    this.tabModulo = $('#tab-modulo');

    this.#actionListener();
    this.#iniTabs();
  }

  setDrawTableHistorial(_table) {
    // modulos
    this.rtm.setTabla(_table);
    this.soat.setTabla(_table);
    // historico
    this.ingreso.setTabla(_table);
    this.agendamiento.setTabla(_table);
  }

  buscarPorID(_idVehiculo) {
    let configuracion = {
      id: _idVehiculo,
      status: false,
      class: this,
    };
    configuracion.class.#setDefaultClases();
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=Detalles',
          type: 'POST',
          data: {
            vehiculo: configuracion.id,
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
              configuracion.class.#getMessageBien(response.vehiculo[0]);
              self.close(true);
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              configuracion.class.#getMensageError(response, 'fa-server');
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.buscarPorID(_idVehiculo);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              configuracion.class.#getMensageError(response, 'fa-skull-crossbones');
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

  setRevisado() {
    let configuracion = {
      id: $('#datos-vehiculo-id').val(),
      status: false,
      class: this,
    };
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=Revisado',
          type: 'POST',
          data: {
            vehiculo: configuracion.id,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              $('#container-tabla-buscador tbody #' + configuracion.class.idFila + ' td:eq(3)')
                .empty()
                .html('<label class="label-check" title="REVISADO"></label>');
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.setRevisado();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
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

  #setColorFila(_row = 0, _class = this) {
    // Si quieren que muestre todas las que visita
    // comente la dos lineas de abajo
    $('#container-tabla-buscador tbody #' + _class.idFila + ' td').css('background', 'transparent');
    $('#container-tabla-buscador tbody #' + _class.idFila + ' td').css('color', 'inherit');
    _class.idFila = _row;
    // para mostrar la fila actual
    $('#container-tabla-buscador tbody #' + _class.idFila + ' td').css('background', '#314554');
    $('#container-tabla-buscador tbody #' + _class.idFila + ' td').css('color', '#FFF');
    // funciona y no lo voy a optimizar
  }

  #actionListener(_class = this) {
    $('#container-tabla-buscador').on('click', '#btnVehiculo', function (e) {
      _class.buscarPorID($(this).attr('btn-id'));
      _class.#setColorFila($(this).attr('row'));
      e.preventDefault();
      return false;
    });

    $('#btn-vehiculo-revisado').on('click', function (e) {
      _class.setRevisado();
      e.preventDefault();
      return false;
    });
  }

  #iniTabs(_class = this) {
    _class.tabServicio.responsiveTabs({
      rotate: false,
      startCollapsed: 'accordion',
      collapsible: 'accordion',
      setHash: false,
      click: function (event, tab) {
        if (tab.id == 1) {
          _class.rtm.datosRecargar();
        } else if (tab.id == 2) {
          _class.soat.datosRecargar();
        }
      },
    });

    _class.tabModulo.responsiveTabs({
      rotate: false,
      startCollapsed: 'accordion',
      collapsible: 'accordion',
      setHash: false,
      click: function (event, tab) {
        if (tab.id == 1) {
          _class.nota.datosRecargar();
        } else if (tab.id == 2) {
          _class.sms.setDefaultForm();
          _class.sms.getNumeroClientes();
        } else if (tab.id == 3) {
          _class.whatsapp.getNumeroClientes();
        } else if (tab.id == 4) {
          _class.ingreso.datosRecargar();
        } else if (tab.id == 5) {
          _class.agendamiento.datosRecargar();
        }
      },
    });
  }

  #setDefaultClases() {
    this.vehiculo.setFormularioDefault(false);
    this.propietario.setFormularioDefault(false);
    this.conductor.setFormularioDefault(false);
    this.#setBlurEffectCss(true);

    this.tabModulo.responsiveTabs('activate', 0);
    this.tabServicio.responsiveTabs('activate', 0);
  }

  #getMessageBien(_response) {
    $('#container-callcenter-bien-resultado').show({
      duration: 400,
      done: $('#container-callcenter-error-resultado').hide(400).empty(),
    });
    // set response
    this.vehiculo.setDatos(_response);
    this.propietario.setDatos(_response.propietario, 'dashboard');
    this.conductor.setDatos(_response.conductor, 'dashboard');
    // set blur
    setTimeout(this.#setBlurEffectCss(false), 1000);
  }

  #getMensageError(_response, _icon = 'fa-face-sad-cry') {
    let _inner_html = `<div class="col-12 align-center">`;
    _inner_html += `<i class="fa-solid ${_icon} fa-6x"></i>`;
    _inner_html += `</div>`;
    _inner_html += `<div class="col-12 align-center">`;
    _inner_html += `<h2>${_response.statusText}</h2>`;
    _inner_html += `<p>${_response.message}</p>`;
    _inner_html += `</div>`;

    $('#container-callcenter-bien-resultado').hide({
      duration: 400,
      done: $('#container-callcenter-error-resultado').show(400).empty().html(_inner_html),
    });

    this.#setBlurEffectCss(true);
  }

  #setBlurEffectCss(_status) {
    if (_status) {
      $('#container-callcenter-bien-resultado').css('filter', 'blur(4px)');
    } else {
      $('#container-callcenter-bien-resultado').css('filter', 'blur(0px)');
    }
  }
}
