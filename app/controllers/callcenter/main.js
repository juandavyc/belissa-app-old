import { RecursosClass } from './recursos.js';
import { BuscadorClass } from './buscador.js';
import { DashboardClass } from './dashboard.js';

const recursos = new RecursosClass();
const buscador = new BuscadorClass();
const dashboard = new DashboardClass();

buscador.setDrawTable(recursos.drawTablaBuscador);
dashboard.setDrawTableHistorial(recursos.drawTablaHistorial);
