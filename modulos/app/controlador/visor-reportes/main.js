import { ReportesVisorClass } from "./visor.js";
import { InfoReporteClass } from "./info.js";
import "./autocomplete.js";

const inforeporte = new InfoReporteClass();
const tabSms = $("#tab-visor");
const buscadorReportes = new VisorBuscador(
  "form_0_buscador",
  "form_0",
  PROTOCOL_HOST +
    "/modulos/app/modelo/visor-reportes/visor.modelo.php?m=Listado",
  {
    opciones: [
      {
        id: "btn_informacion",
        icon: "fas solid fa-info",
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

tabSms.responsiveTabs({
  rotate: false,
  startCollapsed: "accordion",
  collapsible: "accordion",
  setHash: false,
  disabled: [1, 2],
  click: function (event, tab) {},
});

tabSms.responsiveTabs("activate", 0);
