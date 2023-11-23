import { InformacionClass } from './informacion.js';
import { CertificarClass } from './certificar.js';
import { EditarPlaca } from './editar.js';
import { VideoRechazo } from './video.js';


const configTabla = {
  opciones: [
    {
      id: 'btn-informacion',
      icon: 'fas fa-info-circle',
      title: 'Información',
      func: function (_id) {
        informacion.getInformacion(_id,
          (response) => {
            informacion.setDatosEnHtml(response.message)
          });
      },
    },
    {
      id: 'btn-certificar',
      icon: 'fas fa-hand-pointer',
      title: 'Certificar',
      func: function (_id) {
        certificar.getInformacion(_id);
      },
    },
    {
      id: 'btn-editar',
      icon: 'fas fa-pencil',
      title: 'Editar',
      func: function (_id) {
        informacion.getInformacion(_id,
          (response) => {
            editar.pruebaEditar(response)
          }
        )
      },
    },
    {
      id: 'btn-imprimir',
      icon: 'fas fa-print',
      title: 'Información',
      func: function (_id) {
        informacion.getInformacion(_id,
          (response) => {
            $.confirm({
              title: 'Impresora',
              content: '¿Desea volver a imprimir este Ticket de ingreso?',
              buttons: {
                aceptar: {
                  text: 'Aceptar',
                  btnClass: 'btn-blue',
                  action: function () {
                    informacion.setDatosReimprimir(response.message)
                  }
                },
                cancelar: function () {

                }
              }
            });
          });
      },
    },
    {
      id: 'btn-video',
      icon: 'fas fa-video',
      title: 'Video de rechazo',
      func: function (_id) {
        informacion.getInformacion(_id,
          (response) => {
            video.pruebaVideo(response.message.placa)
          }
        )
      },
    }
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
    enviado: {
      tag: 'b',
      class: 'no-class',
      text: true,
    },
  },
};

const buscador = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  getMyAppModel('visor-ingreso/VisorIngreso', 'Listado'),
  configTabla,
  true
);

const informacion = new InformacionClass();
const certificar = new CertificarClass(buscador);
const editar = EditarPlaca(buscador);
const video = VideoRechazo();

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

jQuery(function () {
  $('body').delegate('.to-copy-hand', 'click', function () {
    navigator.clipboard.writeText($(this).html());
    return false;
  });
});
