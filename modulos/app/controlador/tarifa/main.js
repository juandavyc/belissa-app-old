import { buscadorTarifa } from './buscador.js';
import {fun_tarifa_submit} from './buscador_tarifa.js';
import './agregar.js';


fun_tarifa_submit(fun_tarifa_submit);


const $tabs = $('#tab-visor');
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    // callback al pulsar la pestaña 0 ejecute el buscador
    if (tab.id == 0) {      
      buscadorTarifa.formularioSubmit(true);
    }
     else if(tab.id == 1){
      fun_tarifa_submit();
    }
  },
});
$tabs.responsiveTabs('activate', 0);

const number = document.querySelector('.number');

function formatNumber (n) {
	n = String(n).replace(/\D/g, "");
  return n === '' ? n : Number(n).toLocaleString();
}
number.addEventListener('keyup', (e) => {
	const element = e.target;
	const value = element.value;
  element.value = formatNumber(value);
});
