import { buscadorUsuario } from './buscador.js';
import './agregar.js';
import './datos.js';

const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {
      buscadorUsuario.formularioSubmit(true);
    }
  },
});
$tabs.responsiveTabs('activate', 0);

let return_camera = fun_camera_photo(
  'https://' + $(location).attr('host') + '/modulos/gestion/usuario/', // url
  'usuario', // referencia
  0
);
if (return_camera == true) {
  console.log('true');
} else {
  console.log('false');
}
