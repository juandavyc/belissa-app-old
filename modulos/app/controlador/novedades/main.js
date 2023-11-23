import { iniEditor } from './iniEditor.js';
import { iniContenido } from './contenido.js';
import './editar.js';

const tabAgendar = $('#tab-visor');

tabAgendar.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click: function (event, tab) {
    if (tab.id == 0) {
      iniContenido(1, 'form_novedades_editor');
    } else if (tab.id == 1) {
      iniContenido(2, 'form_servicio_editor');
    } else if (tab.id == 2) {
      iniContenido(3, 'form_dev_editor');
    }
  },
});

iniEditor('form_novedades_editor', 450);
iniEditor('form_servicio_editor', 200);
iniEditor('form_dev_editor', 200);

setTimeout(function () {
  iniContenido(1, 'form_novedades_editor');
  CKEDITOR.instances['form_novedades_editor'].resize('100%', '450');
}, 500);

// test
tabAgendar.responsiveTabs('activate', 0);
