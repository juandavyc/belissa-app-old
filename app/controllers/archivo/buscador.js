const personalizacion_tabla = {
  opciones: [
   
    {
      id: 'btn_downloader',
      icon: 'fas solid fa-download',
      title: 'Descargar',
      func: func_descargar_archivo,
    },
    {
      id: 'btn_delete',
      icon: 'fas fa-trash-alt',
      title: 'Eliminar',
      func: funcEliminarArchivo,
    },
  ],
  //verificado, sin verificar y asi..
  icono: ['none', 'question', 'check', 'times'],
  // ¿a que campos deben afectar estos iconos?
  campo: ['email', 'paquetes', 'datos'],
};
// en realidad son las clases

export const buscadorArchivo = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST + '/modulos/app/modelo/archivo/archivo.modelo.php?m=Listado',
  personalizacion_tabla,
  true //¿ exportar exel ?

);

// autoiniciar
setTimeout(function () {
  buscadorArchivo.formularioSubmit(true);
}, 1000);

$('#form_0_buscador').on('submit', function (e) {
  // para la validacion del formulario
  buscadorArchivo.formularioSubmit(true);
  e.preventDefault();
  return false;
});


//boton descargar
function func_descargar_archivo(_id_element) {

  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    columnClass: 'xsmall',
    closeIcon: true,
    content: function () {
      return $.ajax({
        url:
          PROTOCOL_HOST + '/modulos/app/modelo/archivo/archivo.modelo.php?m=Update',
        type: 'POST',
        data: {
          id: _id_element,
        },
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 15000,
      })
          .done(function (response) {
            if(response.statusText === 'bien'){
// console.log();
              window.location.href =  PROTOCOL_HOST +  '/modulos/app/modelo/archivo/descargar.php?ruta='+ response.message['ruta'];  

            self.close();             
           

          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();

            call_recuperar_session(function (k) {
              funcEditarCanal(_id_element);
            });
          } else {
            self.setTitle(response.statusText);
            self.setContent(response.message);
          }
        })
        .fail(function (response) {
          self.setTitle('Error fatal');
          self.setContent(JSON.stringify(response));
          console.log(response);
        });
    },
    buttons: {
      aceptar: function () { },
    },
  });
} //termina funcion funcEditarCanal

// empieza boton eliminar
function funcEliminarArchivo(_id_element) {
  let temp_razon_eliminar = '';
  $.confirm({
    title: '¿Estás seguro?',
    content: `
        <center> 
        Se va a eliminar un archivo por completo. <br> <b>NO SE PODRA RECUPERAR</b> 
        <br> <b>¿Desea continuar?</b> 
        <input type="text" placeholder="Escribe una razón de eliminar" 
        class="razon-jconfirm" maxlenght="200" autocomplete="off" required />
        </center> `,
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    columnClass: 'medium',
    closeIcon: true,
    buttons: {
      formSubmit: {
        text: 'ELiminar',
        btnClass: 'btn-blue',
        action: function () {
          temp_razon_eliminar = this.$content.find('.razon-jconfirm').val();
          if (!temp_razon_eliminar) {
            $.alert('No puede ser vacio');
            return false;
          } else {
            self.close();
   
            funcEliminarArchivoSubmit(_id_element, temp_razon_eliminar);
          }
        },
      },
      cancel: {
        text: 'Cancelar',
        action: function () { },
      },
    },
  });
}

function funcEliminarArchivoSubmit(_id_element, _razon) {
  let _buscador = false;
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    columnClass: 'xsmall',
    closeIcon: true,
    content: function () {
      return $.ajax({
        url:
          PROTOCOL_HOST + '/modulos/app/modelo/archivo/archivo.modelo.php?m=Delete',
        type: 'POST',
        data: {
          id_elemento: _id_element,
          razon: _razon, // confirm
        },
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 35000,
      })
        .done(function (response) {
          console.log(response.ruta);
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            _buscador = true;
            return $.ajax({
              url:
            PROTOCOL_HOST + '/modulos/app/modelo/archivo/eliminar.php?ruta='+ response.ruta,
          })
            //self.close(true);
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              funcEliminarArchivoSubmit(_id_element, _razon);
            });
          } else {
            self.setTitle(response.statusText);
            self.setContent(response.message);
          }
        })
        .fail(function (response) {
          self.setTitle('Error fatal');
          self.setContent(response.statusText + ' // ' + response.responseText);
          console.log(response);
        });
    },
    buttons: {
      aceptar: function () { },
    },
    onDestroy: function () {
      // true para ejecutar el buscar
      if (_buscador == true) {
        setTimeout(function () {
          buscadorArchivo.formularioSubmit(true);
        }, 500);
      }
    },
  });
}
// termina boton eliminar