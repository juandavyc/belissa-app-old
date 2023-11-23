import { buscadorTipoGestion } from './buscador.js';
import {fun_tipo_gestion_submit} from './buscador_tipo_canal.js';
import './agregar.js';


fun_tipo_gestion_submit(fun_tipo_gestion_submit);


const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {      
      buscadorTipoGestion.formularioSubmit(true);
    }
     else if(tab.id == 2){
      fun_tipo_gestion_submit();
    }
  },
});
$tabs.responsiveTabs('activate', 0);
