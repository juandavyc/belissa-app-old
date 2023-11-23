
import './agregar.js';
import  { PropietarioClass } from './propietario.js';
import { ConductorClass } from './conductor.js';
import { VehiculoClass } from './vehiculo.js';


const propietario = new PropietarioClass();
const conductor = new ConductorClass();
const vehiculo = new VehiculoClass();

const $tabs = $("#tab-visor");
$tabs.responsiveTabs({
  rotate: false,
  startCollapsed: "accordion",
  collapsible: "accordion",
  setHash: false,
});
$tabs.responsiveTabs("activate", 0); 