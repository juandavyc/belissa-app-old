import { RunClass } from '/app/controllers/ingreso-completo/run.js';
import { PlacaClass } from '/app/controllers/ingreso-completo/placa.js';
// import { DatosClass } from '/app/controllers/ingreso-completo/datos.js';

import { IngresoClass } from './ingreso.js';
import { VehiculoClass } from '/app/controllers/ingreso-completo/vehiculo.js';

// import { DefectoClass } from '/app/controllers/ingreso-completo/defecto.js';

import { PropietarioClass } from '/app/controllers/ingreso-completo/propietario.js';
import { ConductorClass } from '/app/controllers/ingreso-completo/conductor.js';

// modal firma

// hidden
$.validator.setDefaults({ ignore: [] });

const runModulo = new RunClass(true);

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
    rotate: 0
  }
);

ingreso.setClases(placa, vehiculo, propietario, conductor, firma);

runModulo.getDatosInicio();