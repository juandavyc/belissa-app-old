// import
import { AgendarClass } from './agendar.js';
import { InformacionClass } from './informacion.js';
import { EditarClass } from './editar.js';
import { EliminarClass } from './eliminar.js';
import { CupoClass } from './cupo.js';

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
      id: 'btn_editar',
      icon: 'fas solid fa-edit',
      title: 'Editar',
      func: function (_id) {
        editar.getInformacion(_id, function () {
          buscador.formularioSubmit(true);
        });
      },
    },
    {
      id: 'btn_delete',
      icon: 'fas fa-trash-alt',
      title: 'Anular',
      func: function (_id) {
        eliminar.getRazon(_id);
      },
    },
  ],
  //icono: [],

  campo: {
    // item SIN ARRAY aplicar estilos
    placa: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
    horario: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
    // item con ARRAY
    estado: {
      tag: 'label',
      // 0, 1:sin_asistir, 2:asistio <<-- de la base de datos
      class: ['estado no', 'estado sin-asistir', 'estado asistio', 'estado no-asistio', 'estado anulado', 'estado vencido', 'estado reagendado'],
      text: true, // <label>TEXT</label> // text: false, <label></label>
    },
  },
};

const buscador = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  getMyAppModel('agendamiento-cda/Agendamiento', 'Listado'),
  configTabla,
  true 
);

const agendar = new AgendarClass();
const informacion = new InformacionClass();
const editar = new EditarClass();
const eliminar = new EliminarClass();
const cupo = new CupoClass();

eliminar.setBuscador(function () {
  buscador.formularioSubmit(true);
});
agendar.setEditar(function (_id, _callback) {
  editar.getInformacion(_id, function () {
    _callback();
  });
});
agendar.setCupo(function () {
  cupo.getListado();
});

tabAgendar.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    if (tab.id == 0) {
      buscador.formularioSubmit(true);
    } else if (tab.id == 1 || tab.id == 2) {
      cupo.getListado();
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
