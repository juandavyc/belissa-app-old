import {buscadorArchivo} from './buscador.js';
import './agregar.js';
//import './form_informacion.js';

const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {      
      buscadorArchivo.formularioSubmit(true);
    }
  },
});
$tabs.responsiveTabs('activate', 0);




//traer al boton de subir el nombre del archivo
function actualizarInputFile() {
  var filename = "'" + this.value.replace(/^.*[\\\/]/, '') + "'";
  this.parentElement.style.setProperty('--fn', filename);
  }
  
  document.querySelectorAll(".file-select input").forEach((ele)=>ele.addEventListener('change', actualizarInputFile));

  