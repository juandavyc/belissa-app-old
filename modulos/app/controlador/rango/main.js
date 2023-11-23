import { AgregarClass } from './agregar.js';
import { EditarClass } from './editar.js';
import { InformacionClass } from './informacion.js';
//import './form_informacion.js';

const tabRango = $('#tab-visor');

const configTabla = {
  opciones: [
    {
      id: 'btn_informacion',
      icon: 'fas fa-info-circle',
      title: 'Información',
      func: function (_id) {
        informacion.getInformacion(_id, function (_response) {
          informacion.setDatosEnHtml(_response);
        });
      },
    },
    {
      id: 'btn_editar',
      icon: 'fas solid fa-edit',
      title: 'Editar',
      func: function (_id) {
        informacion.getInformacion(_id, function (_response) {
          editar.setDatosEnFormulario(_response);
        });
      },
    },
  ],
  campo: {
    nombre: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
  },
};

const buscador = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST + '/modulos/app/modelo/rango/rango.modelo.php?m=Listado',
  configTabla,
  true
);

const agregar = new AgregarClass();
const editar = new EditarClass();
const informacion = new InformacionClass();

editar.setBuscador(function () {
  buscador.formularioSubmit(true);
});

tabRango.responsiveTabs({
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
tabRango.responsiveTabs('activate', 0);
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
