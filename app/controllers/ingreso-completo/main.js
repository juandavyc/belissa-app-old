import { RunClass } from './run.js';
import { PlacaClass } from './placa.js';
//import { DatosClass } from './datos.js';
import { IngresoClass } from './ingreso.js';
import { VehiculoClass } from './vehiculo.js';
// import { DefectoClass } from './defecto.js';
import { PropietarioClass } from './propietario.js';
import { ConductorClass } from './conductor.js';

// hidden
$.validator.setDefaults({ ignore: [] });

const runModulo = new RunClass(false);

const ingreso = new IngresoClass();
const placa = new PlacaClass(ingreso);

// const defecto = new DefectoClass(defectoConfig);
const vehiculo = new VehiculoClass(runModulo);
const propietario = new PropietarioClass('ingreso');
const conductor = new ConductorClass('ingreso');

//const datos = new DatosClass(new PropietarioClass('editar'), new ConductorClass('editar'));

const firma = new CanvasFirma({
  container: document.getElementById('ingreso-firma-canvas'),
  title: "Firma del conductor",
});

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

ingreso.setClases(placa, vehiculo, propietario, conductor, firma);
runModulo.getDatosInicio();