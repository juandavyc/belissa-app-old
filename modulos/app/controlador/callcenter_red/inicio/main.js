import { buscadorInit } from './buscador.js';

import { drawTablaBuscador, drawTablaHistorial, drawTablaIngreso } from './tabla.js';

import {
  dashboardDetalles,
  dashboardServicios,
  dashboardModulos,
  dashboardVehiculo,
} from './dashboard.js';

import { PropietarioClass } from './propietario.js';
import { ConductorClass } from './conductor.js';
import { VehiculoClass } from './vehiculo.js';

// tabs 1
// tabs 0
import { RtmClass } from './rtm.js';





// tabs 2
// tab 1
import { NotasClass } from './notas.js';
// tab 2
import { SmsClass } from './sms.js';
//tab 3 
import { IngresoHistorialClass } from './ingreso_historico.js';
/*
import { soatInit, setDefaultSoatHistorial } from './soat.js';
*/

// import './editar.js';

// iniEditor('editor', 350);

const propietario = new PropietarioClass();
const conductor = new ConductorClass();
const vehiculo = new VehiculoClass();

const rtm = new RtmClass(drawTablaHistorial);

const notas = new NotasClass();
const sms = new SmsClass();
const ingreso = new IngresoHistorialClass(drawTablaIngreso);

dashboardDetalles(propietario, conductor, vehiculo);
dashboardServicios(rtm);
dashboardModulos(notas,sms,ingreso);

buscadorInit(drawTablaBuscador, dashboardVehiculo);
/*


rtmInit(drawTablaHistorial);
soatInit(drawTablaHistorial);
*/
