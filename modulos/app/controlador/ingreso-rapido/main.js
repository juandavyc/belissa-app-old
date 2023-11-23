import { RunClass } from '/modulos/app/controlador/ingreso-completo/run.js';
import { PlacaClass } from '/modulos/app/controlador/ingreso-completo/placa.js';
import { DatosClass } from '/modulos/app/controlador/ingreso-completo/datos.js';

import { IngresoClass } from './ingreso.js';
import { VehiculoClass } from '/modulos/app/controlador/ingreso-completo/vehiculo.js';

import { DefectoClass } from '/modulos/app/controlador/ingreso-completo/defecto.js';

import { PropietarioClass } from '/modulos/app/controlador/ingreso-completo/propietario.js';
import { ConductorClass } from '/modulos/app/controlador/ingreso-completo/conductor.js';

const defectoConfig = {
  id: 'ingreso-rapido',
  id_container: '#container-ingreso-defecto',
  btn_agregar: '#ingreso-btn-agregar-defecto',
};

const canvasConfig = {
  id_container: 'ingreso-firma-canvas',
  title_label: 'Firma',
  responsive: '#ingreso-firma-canvas',
};

const runModulo = new RunClass(true);

const ingreso = new IngresoClass();
const placa = new PlacaClass(ingreso);

const defecto = new DefectoClass(defectoConfig);
const vehiculo = new VehiculoClass(runModulo, defecto);
const propietario = new PropietarioClass('ingreso');
const conductor = new ConductorClass('ingreso');


const datos = new DatosClass(new PropietarioClass('editar'), new ConductorClass('editar'));
const firma = new canvas_firma(canvasConfig);

const statusCamera = fun_camera_photo(
  'https://' + $(location).attr('host') + '/modulos/ingreso-rapido/', // url
  'id_prueba', // referencia
  0 // rotate
);

if (statusCamera) {
  ingreso.setClases(placa, vehiculo, propietario, conductor, firma);
  runModulo.getDatosInicio();
}
