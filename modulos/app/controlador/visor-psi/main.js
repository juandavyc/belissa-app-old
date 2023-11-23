// import

import { InformacionClass } from './informacion.js';

const tabAgendar = $('#tab-visor');

const configTabla = {
  opciones: [
    {
      id: 'btn_informacion',
      icon: 'fas fa-info-circle',
      title: 'Información',
      func: function (_id) {
        informacion.getInformacion(_id);
      },
    },
  ],
  campo: {
    placa: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
    vez: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
  },
};
 
const buscador = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST + '/modulos/app/modelo/visor-psi/ingreso.modelo.php?m=Listado',
  configTabla,
  true //¿ exportar exel ?
);

const informacion = new InformacionClass();

tabAgendar.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    if (tab.id == 0) {
      buscador.formularioSubmit(true);
    }
  },
});
// test
tabAgendar.responsiveTabs('activate', 0);

// autoiniciar
setTimeout(function () {
  buscador.formularioSubmit(true);
}, 500);

// submit

$('#form_0_buscador').on('submit', function (e) {
  buscador.formularioSubmit(true);
  e.preventDefault();
  return false;
});
