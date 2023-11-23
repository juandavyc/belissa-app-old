import { ReportesVisorClass } from "./visor.js";
import { InfoReporteClass } from "./informacion.js";

const inforeporte = new InfoReporteClass();
const tabSms = $("#tab-visor");
const buscadorReportes = new VisorBuscador(
  "form_0_buscador",
  "form_0",
  getMyAppModel('bitacora/Bitacora', 'Listado'),
  {
    opciones: [
      {
        id: "btn-informacion",
        icon: "fas solid fa-circle-info",
        title: "Informacion",
        func: function(_id){
          inforeporte.getInfo(_id);
        },
      },
    ],
    campo: ["tipo", "modulo", "usuario"],
  },
  true //¿ exportar exel ?
);

const ReportesClass = new ReportesVisorClass(buscadorReportes);

