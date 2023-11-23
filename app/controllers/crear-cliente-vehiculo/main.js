import { PlacaClass } from './placa.js';
import { IngresoClass } from './ingreso.js';

import { VehiculoClass } from './vehiculo.js';
import { PropietarioClass } from './propietario.js';
import { ConductorClass } from './conductor.js';

const ingreso = new IngresoClass();
const placa = new PlacaClass(ingreso);
const vehiculo = new VehiculoClass();

const propietario = new PropietarioClass();
const conductor = new ConductorClass();


ingreso.setClases(placa, vehiculo, propietario, conductor);
