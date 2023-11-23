// import

import { InformacionClass } from './informacion.js';
import { EditarClass } from './editar.js';

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
    {
        id: 'btn_certificar',
        icon: 'fas fa-hand-pointer',
        title: 'Certificar',
        func: function (_id) {
          editar.getInformacion(_id);
           
          },
   
    },
  ],
  campo: {
    placa: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
    tipo: {
      tag: 'label',
      class: ['tip', 'tip', 'tip liviano', 'tip liviano', 'tip moto', 'tip liviano', 'tip taxi', 'tip', 'tip'],
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
  PROTOCOL_HOST + '/modulos/app/modelo/visor-ingreso/ingreso.modelo.php?m=Listado',
  configTabla,
  true,
  true
);

const informacion = new InformacionClass();
const editar = new EditarClass();

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

jQuery(function () {
  $('body').delegate('.to-copy-hand', 'click', function () {
    navigator.clipboard.writeText($(this).html());
    return false;
  });
});
