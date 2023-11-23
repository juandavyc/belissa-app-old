import { RunClass } from './run.js';
import { Buscador } from './Buscador.js';
import { ControlFormulario } from './ControlFormulario.js';



new FileChooserCamera(
  {
    folder: 'usuario/foto',
    rotate: 0,
    url: {
      file: PROTOCOL_HOST + '/app/models/filechooser-camera/UploadFile.php',
      photo: PROTOCOL_HOST + '/app/models/filechooser-camera/UploadCamera.php'
    }
  }
);

const _run = new RunClass();
const _tabs = $('#tab-visor');


const formularioAgregar = ControlFormulario('agregar');
const formularioEditar = ControlFormulario('editar');

const buscador = Buscador();

buscador.setFormularioEditar(formularioEditar.setDatos);

_tabs.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  click:  (event, tab) =>{
    if (tab.id == 0) {
      buscador.BuscadorSubmit();
    }
    else if (tab.id == 1) {
      setTimeout(()=>{
        formularioAgregar.adjustCanvasSize();
      },200);
    }    
  },
});
_tabs.responsiveTabs('activate', 0);

_run.getDatosInicio(() => {
   buscador.BuscadorSubmit();
});

