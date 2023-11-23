import './form_contrasena.js';
import './form_informacion.js';



const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
 
});
$tabs.responsiveTabs('activate', 0);


let return_camera = fun_camera_photo(
  'https://' + $(location).attr('host') + '/modulos/mi_cuenta/', // url
  'id_prueba', // referencia
  0 // rotate
);
if (return_camera == true) {

  console.log('true');
} else {
  console.log('false');
}


