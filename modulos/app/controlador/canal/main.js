import { buscadorCanal } from './buscador.js';
import {fun_tipo_canal_submit} from './buscador_tipo_canal.js';
import './agregar.js';
import './datos.js';
//import './form_informacion.js';

fun_tipo_canal_submit(fun_tipo_canal_submit);


const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {      
      buscadorCanal.formularioSubmit(true);
    }
     else if(tab.id == 2){
      fun_tipo_canal_submit();
    }
  },
});
$tabs.responsiveTabs('activate', 0);
