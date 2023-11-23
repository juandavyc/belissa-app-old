export class PdfClass {
  constructor() {}

  fun_pdf_ingreso(_id = 1, _class = this) {
    $.confirm({
      title: 'Resultado en PDF',
      content: `<embed src ="${PROTOCOL_HOST}/pdfs/pdf_ingreso/pdf_ingreso_correo.php?id=${_id}&ing=true" width="100%" height="650">`,
      
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      buttons: {
        aceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () {},
        },
      },
    });
  }

  fun_pdf_psi(_id = 1, _class = this) {
    $.confirm({
      title: 'Resultado en PDF',
      content: `<embed src ="${PROTOCOL_HOST}/pdfs/pdf_ingreso/pdf_ingreso_correo.php?id=${_id}&psi=true" width="100%" height="650">`,
      
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      buttons: {
        aceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () {},
        },
      },
    });
  }


  fun_pdf_terminos(_id = 1, _class = this) {
    $.confirm({
      title: 'Resultado en PDF',
      content: `<embed src ="${PROTOCOL_HOST}/pdfs/condiciones_servicio/terminos_correo.php?id=${_id}" width="100%" height="650">`,
      
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      buttons: {
        aceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () {},
        },
      },
    });
  }

  fun_stiker_liviano(_id = 1, _class = this) {
    $.confirm({
      title: 'Resultado en PDF',
      content: `<embed src ="${PROTOCOL_HOST}/pdfs/stiker/stiker_liviano.php" width="100%" height="650">`,
      
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      buttons: {
        aceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () {},
        },
      },
    });
  }

  fun_stiker_moto(_id = 1, _class = this) {
    $.confirm({
      title: 'Resultado en PDF',
      content: `<embed src ="${PROTOCOL_HOST}/pdfs/stiker/stiker_moto.php" width="100%" height="650">`,
      
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      buttons: {
        aceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () {},
        },
      },
    });
  }

}
