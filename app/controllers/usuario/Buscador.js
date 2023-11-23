import { InformacionUsuario } from './Informacion.js';
import { informacionCanal } from './canal.js';

export const Buscador = () => {


  const myModal = new MyModal({
    container: 'modal-editar-usuario', // id
    title: 'Editar datos',
    icon: 'fa fa-warning', // fa fa icon
    columnClass: 'md', //xs, sm, md, lg, mx
    event: {
      onOpen: () => { },
      onClose: () => {

      },
    },
  });


  let formularioEditar = null;
  const setFormularioEditar = (formulario) => {
    formularioEditar = formulario;
  }
  const informacionUsuario = InformacionUsuario();
  const personalizacion_tabla = {
    opciones: [
      {
        id: 'btn-informacion',
        icon: 'fas fa-info-circle',
        title: 'Información',
        func: (_id) => {
          informacionUsuario.getInformacion(
            _id,
            (_content) => {
              $.alert({
                title: 'Datos',
                typeAnimated: true,
                scrollToPreviousElement: false,
                scrollToPreviousElementAnimate: false,
                columnClass: 'large',
                closeIcon: true,
                content: informacionUsuario.setDatos(_content),
              })
            }
          );
        },
      },
      {
        id: 'btn-editar',
        icon: 'fas solid fa-edit',
        title: 'Editar',
        func: (_id) => {
          $.alert("Desactivado");
          // informacionUsuario.getInformacion(
          //   _id,
          //   (_content) => {
          //     formularioEditar(_content,myModal);
          //   }
          // );
        }
      },
      {
        id: 'btn-asignar-canal',
        icon: 'fas fa-chart-simple',
        title: 'Asignar canal',
        func: (_id) => {
          informacionCanal(_id)
        },
      },
      {
        id: 'btn_delete',
        icon: 'fas fa-trash-alt',
        title: 'Eliminar',
        func: funcEliminarUsuario,
      },

    ],
    //verificado, sin verificar y asi..
    icono: [],
    // ¿a que campos deben afectar estos iconos?
    campo: {
      documento: {
        tag: 'b',
        class: 'no-class',
        text: true,
      },
      estado: {
        tag: 'b',
        class: 'no-class',
        text: true,
      },
    },
  };
  // en realidad son las clases

  const buscadorUsuario = new VisorBuscador(
    'form_0_buscador',
    'form_0',
    getMyAppModel('usuario/Usuario', 'Listado'),
    personalizacion_tabla,
    true
  );

  // autoiniciar
  setTimeout(function () {
    //buscadorUsuario.formularioSubmit(true);
  }, 500);

  $('#form_0_buscador').on('submit', function (e) {
    BuscadorSubmit();
    e.preventDefault();
    return false;
  });

  const BuscadorSubmit = () => {
    buscadorUsuario.formularioSubmit(true);
  }

  return {
    BuscadorSubmit,
    setFormularioEditar
  }


}



//termina editar usuario

// empieza boton eliminar
function funcEliminarUsuario(_id_element) {
  let temp_razon_eliminar = '';
  $.confirm({
    title: '¿Estás seguro?',
    content: `
        <center>
        Se va a eliminar un elemento. <br> <b>¿Desea continuar?</b>
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
            funcEliminarUsuarioSubmit(_id_element, temp_razon_eliminar);
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

function funcEliminarUsuarioSubmit(_id_element, _razon) {
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
        url: getMyAppModel('usuario/Usuario', 'Delete'),
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
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            _buscador = true;
            //self.close(true);
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              funcEliminarUsuarioSubmit(_id_element, _razon);
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
          buscadorUsuario.formularioSubmit(true);
        }, 500);
      }
    },
  });
}
// termina boton eliminar

//empieza boton de editar
function funcAgregarCanal(_id_element) {
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
        url: getMyAppModel('usuario/Usuario', 'Canal'),
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
          if (response.statusText === 'bien') {
            self.close();
            $('#form_id_agregar_canal').val(response.message['id']);
            $('#form_1_agregar_canal_nombre').val(response.message['nombre_usuario']);
            $('#div_dialog_agregar_canal').dialog('open');
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();

            call_recuperar_session(function (k) {
              funcAgregarCanal(_id_element);
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
}

$('#div_dialog_agregar_canal, #form_agregar_canal').on('submit', function (e) {
  if ($(this).valid() === true) {
    let form_data = new FormData(this);
    $.confirm({
      title: 'Mensaje de Belissa Call Center',
      content: `
  <center>
  ¿Está seguro de alterar los datos del canal de mercadeo?
  Los datos de su sesión serán tomados.
  </center> `,
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'xsmall',
      closeIcon: true,
      buttons: {
        si: {
          text: 'Si',
          action: function () {
            funcGuardarCanalSubmit(form_data);
          },
        },
        no: {
          text: 'No',
          action: function () { },
        },
      },
    });
  }
  e.preventDefault();
  return false;
});

function funcGuardarCanalSubmit(_form) {
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
        url: getMyAppModel('usuario/Usuario', 'Update'),
        type: 'POST',
        data: _form,
        processData: false,
        contentType: false,
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 15000,
      })
        .done(function (response) {
          //console.log(response);
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            $('#div_dialog_agregar_canal').dialog('close');
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              funcGuardarCanalSubmit(_form);
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
      aceptar: function () {
        $('#div_dialog_agregar_canal').dialog('close');
      },
    },
    onClose: function (_buscador = false) {
      // true para ejecutar el buscar
      if (_buscador == true) {
        setTimeout(function () {
          buscadorUsuario.formularioSubmit(true);
        }, 500);
      }
    },
  });
}
// //termina boton editar

// $('#div_dialog_agregar_canal').dialog({
//   width: 'auto',
//   height: 435,
//   modal: true, // bloquear ventana
//   fluid: true, // responsive
//   resizable: false, // cambien tamaño
//   autoOpen: false, // se abra solo
//   hide: 'fold', // animacion
//   show: 'fold', // animacion
//   open: function (event, ui) {
//     $('body').css({ overflow: 'hidden' });
//   },
//   beforeClose: function (event, ui) {
//     $('body').css({ overflow: 'inherit' });
//   },
//   create: function (event, ui) {
//     $(this).css('maxWidth', '910px');
//   },
// });
