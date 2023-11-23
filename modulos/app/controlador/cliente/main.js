import { buscadorCliente } from './buscador.js';






const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {      
      buscadorCliente.formularioSubmit(true);
    }
  },
});
$tabs.responsiveTabs('activate', 0);
