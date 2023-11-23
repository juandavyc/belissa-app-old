let validateFormEditarTipoGestion = $('#form_tipo_gestion').validate({
  rules: {
    tipo_conexion: {
      required: true,
      range: [1, 4],
    },
    acepto_responsabilidad: {
      required: true,
    },
  },
  messages: {
    acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
  },
  errorPlacement: function (label, element) {
    label.addClass('errorMsq');
    element.parent().append(label);
  },
});

const personalizacion_tabla = {
  opciones: [
    {
      id: 'btn_edit',
      icon: 'fas solid fa-edit',
      title: 'Editar',
      func: funcEditarTipoGestion,
    },
    {
      id: 'btn_delete',
      icon: 'fas fa-trash-alt',
      title: 'Eliminar',
      func: funcEliminarTipoGestion,
    },
  ],
  //verificado, sin verificar y asi..
  icono: ['none', 'question', 'check', 'times'],
  // ¿a que campos deben afectar estos iconos?
  campo: ['email', 'paquetes', 'datos'],
};
// en realidad son las clases

export const buscadorTipoGestion = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST +
    '/modulos/app/modelo/tipo_gestion/tipo_gestion.modelo.php?m=Listado',
  personalizacion_tabla,
  true //¿ exportar exel ?
);

// autoiniciar
setTimeout(function () {
  buscadorTipoGestion.formularioSubmit(true);
}, 1000);

$('#form_0_buscador').on('submit', function (e) {
  // para la validacion del formulario
  buscadorTipoGestion.formularioSubmit(true);
  e.preventDefault();
  return false;
});

$('#form_tipo_gestion').on('reset', function (e) {
  validateFormEditarTipoGestion.resetForm();
});

//empieza boton de editar
function funcEditarTipoGestion(_id_element) {
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
          PROTOCOL_HOST +
          '/modulos/app/modelo/tipo_gestion/tipo_gestion.modelo.php?m=Info',
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
            $('#form_id_tipo_gestion').val(response.message['id']);
            $('#form_1_tipo_gestion_nombre').val(
              response.message['nombre_tipo_gestion']
            );
            $('#div_dialog_editar_tipo_gestion').dialog('open');
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();

            call_recuperar_session(function (k) {
              funcEditarTipoGestion(_id_element);
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
      aceptar: function () {},
    },
  });
} //termina funcion funcEditarTipoGestion

$('#div_dialog_editar_tipo_gestion, #form_tipo_gestion').on(
  'submit',
  function (e) {
    if ($(this).valid() === true) {
      let form_data = new FormData(this);

      $.confirm({
        title: 'Mensaje de Belissa Call Center',
        content: `
      <center>
      ¿Está seguro de alterar los datos del tipo de gestion?
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
              funcGuardarTipoGestionSubmit(form_data);
            },
          },
          no: {
            text: 'No',
            action: function () {},
          },
        },
      });
    }
    e.preventDefault();
    return false;
  }
);

function funcGuardarTipoGestionSubmit(_form) {
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
          PROTOCOL_HOST +
          '/modulos/app/modelo/tipo_gestion/tipo_gestion.modelo.php?m=Update',
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
          // console.log(response);
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            $('#div_dialog_editar_tipo_gestion').dialog('close');
            self.close(true);
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              funcGuardarTipoGestionSubmit(_form);
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
      aceptar: function () {},
    },
    onClose: function (_buscador = false) {
      // true para ejecutar el buscar
      if (_buscador == true) {
        setTimeout(function () {
          buscadorTipoGestion.formularioSubmit(true);
        }, 500);
      }
    },
  });
}
//termina boton editar

// empieza boton eliminar
function funcEliminarTipoGestion(_id_element) {
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
            funcEliminarTipoGestionSubmit(_id_element, temp_razon_eliminar);
          }
        },
      },
      cancel: {
        text: 'Cancelar',
        action: function () {},
      },
    },
  });
}

function funcEliminarTipoGestionSubmit(_id_element, _razon) {
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
          PROTOCOL_HOST +
          '/modulos/app/modelo/tipo_gestion/tipo_gestion.modelo.php?m=Delete',
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
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              funcEliminarTipoGestionSubmit(_id_element, _razon);
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
      aceptar: function () {},
    },
    onDestroy: function () {
      // true para ejecutar el buscar
      if (_buscador == true) {
        setTimeout(function () {
          buscadorTipoGestion.formularioSubmit(true);
        }, 500);
      }
    },
  });
}
// termina boton eliminar

// dialog

$('#div_dialog_editar_tipo_gestion').dialog({
  width: 'auto',
  height: 435,
  modal: true, // bloquear ventana
  fluid: true, // responsive
  resizable: false, // cambien tamaño
  autoOpen: false, // se abra solo
  hide: 'fold', // animacion
  show: 'fold', // animacion
  open: function (event, ui) {
    $('body').css({ overflow: 'hidden' });
  },
  beforeClose: function (event, ui) {
    $('body').css({ overflow: 'inherit' });
  },
  create: function (event, ui) {
    $(this).css('maxWidth', '910px');
  },
});
