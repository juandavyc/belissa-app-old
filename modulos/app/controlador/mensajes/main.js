
import { MensajeClass } from './agregar.js';
import { MensajeVisorClass } from './visor.js';
import { MensajeMasivoClass } from './enviar.js';

const tabSms = $('#tab-sms');
const Mensaje = new MensajeClass();
const MensajeVisor = new MensajeVisorClass();
const MensajeMasivo = new MensajeMasivoClass();

tabSms.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  disabled: [1, 2],
  click: function (event, tab) {
    if (tab.id == 2) {
      // MensajeVisor

      // console.log("Evento de busqueda");
     // MensajeVisor.formularioSubmit();
    }
  },
});


tabSms.responsiveTabs('activate', 0);




