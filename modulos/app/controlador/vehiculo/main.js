import { EditarVehiculo } from './editar.js';
import { BuscadorVehiculo } from './buscador.js';
import './autocomplete.js';

const editarVehiculo = new EditarVehiculo();
//
const buscadorVehiculo = new BuscadorVehiculo(editarVehiculo);

editarVehiculo.setBuscadorClass(buscadorVehiculo);

const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {
      buscadorVehiculo.formularioRecargar();
    }
  },
});
$tabs.responsiveTabs('activate', 0);
