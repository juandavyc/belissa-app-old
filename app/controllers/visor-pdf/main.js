import { PdfClass } from './pdf.js';

const configTabla = {
  opciones: [
    {
      id: 'btn_pdf_ingreso',
      icon: 'fas fa-arrow-circle-right',
      title: 'TICKET INGRESO',
      func: function (_id) {
        pdf.fun_pdf_ingreso(_id);
      },
    },
    {
      id: 'btn_pdf_psi',
      icon: 'fas fa-bomb',
      title: 'STICKER PSI',
      func: function (_id) {
        pdf.fun_pdf_psi(_id);
      },
    },
    {
      id: 'btn_pdf_terminos',
      icon: 'fas fa-balance-scale-right',
      title: 'TERMINOS CONDICIONES',
      func: function (_id) {
        pdf.fun_pdf_terminos(_id);
      },
    },
    {
      id: 'btn_pdf_stiker_liviano',
      icon: 'fas fa-car-side',
      title: 'STICKER LIVIANO',
      func: function (_id) {
        pdf.fun_stiker_liviano(_id);
      },
    },
    {
      id: 'btn_pdf_stiker_moto',
      icon: 'fas fa-motorcycle',
      title: 'STICKER MOTO',
      func: function (_id) {
        pdf.fun_stiker_moto(_id);
      },
    },
  ],
  campo: {
    placa: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
    tipo: {
      tag: 'label',
      class: ['tip', 'tip', 'tip liviano', 'tip liviano', 'tip moto', 'tip liviano', 'tip taxi', 'tip', 'tip'],
      text: true,
    },
    vez: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
  },
};

const buscador = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  getMyAppModel('visor-pdf/VisorPdf', 'Listado'),
  configTabla,
  true,
  true
);

const pdf = new PdfClass();

// autoiniciar
setTimeout(function () {
  buscador.formularioSubmit(true);
}, 500);

// submit

$('#form_0_buscador').on('submit', function (e) {
  buscador.formularioSubmit(true);
  e.preventDefault();
  return false;
});


