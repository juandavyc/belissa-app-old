import { RunClass } from './run.js';
import { PlacaClass } from './placa.js';
import { DatosClass } from './datos.js';

import { IngresoClass } from './ingreso.js';
import { VehiculoClass } from './vehiculo.js';

import { DefectoClass } from './defecto.js';

import { PropietarioClass } from './propietario.js';
import { ConductorClass } from './conductor.js';

const defectoConfig = {
  id: 'ingreso-completo',
  id_container: '#container-ingreso-defecto',
  btn_agregar: '#ingreso-btn-agregar-defecto',
};

const canvasConfig = {
  id_container: 'ingreso-firma-canvas',
  title_label: 'Firma',
  responsive: '#ingreso-firma-canvas',
};

const runModulo = new RunClass(false);

const ingreso = new IngresoClass();
const placa = new PlacaClass(ingreso);

const defecto = new DefectoClass(defectoConfig);
const vehiculo = new VehiculoClass(runModulo, defecto);
const propietario = new PropietarioClass('ingreso');
const conductor = new ConductorClass('ingreso');

const datos = new DatosClass(new PropietarioClass('editar'), new ConductorClass('editar'));

const firma = new canvas_firma(canvasConfig);

const statusCamera = fun_camera_photo(
  'https://' + $(location).attr('host') + '/modulos/ingreso-completo/', // url
  'ingreso', // referencia
  0 // rotate
);

if (statusCamera) {
  ingreso.setClases(placa, vehiculo, propietario, conductor, firma);
  runModulo.getDatosInicio();
}
