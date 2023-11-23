let validateFormEditarCliente = $('#form_cliente').validate({
  rules: {
    nombre: {
      required: true,
      minlength: 4,
      maxlength: 40,
      // alphanumeric: true,      
    },
    apellido: {
      required: true,
      minlength: 4,
      maxlength: 40,
      // alphanumeric: true,      
    },
    documento: {
      required: true,
      minlength: 6,
      maxlength: 20,
      noSpace: true,      
    },
    telefono_1: {
      required: true,
      minlength: 7,
      maxlength: 10,
      noSpace: true,      
    },
    telefono_2: {
      required: true,
      minlength: 7,
      maxlength: 10,
      noSpace: true,      
    },
    telefono_3: {
      required: true,
      minlength: 7,
      maxlength: 10,
      noSpace: true,      
    },
    correo: {
      required: true,
      minlength: 6,
      maxlength: 60,
      noSpace: true,
    },
    direccion: {
      required: true,
      minlength: 10,
      maxlength: 100,
        
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
      func: funcEditarCliente,
    },
   
  ],
  //verificado, sin verificar y asi..
  icono: ['none', 'question', 'check', 'times'],
  // ¿a que campos deben afectar estos iconos?
  campo: ['email', 'paquetes', 'datos'],
};
// en realidad son las clases

export const buscadorCliente = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST + '/modulos/app/modelo/cliente/cliente.modelo.php?m=Listado',
  personalizacion_tabla,
  true //¿ exportar exel ?
);

// autoiniciar
setTimeout(function () {
  buscadorCliente.formularioSubmit(true);
}, 500);

$('#form_0_buscador').on('submit', function (e) {
  // para la validacion del formulario
  buscadorCliente.formularioSubmit(true);
  e.preventDefault();
  return false;
});

$('#form_cliente').on('reset', function (e) {
  validateFormEditarCliente.resetForm();
});

$('#form_cliente').on('reset', function (e) {
     
  window.location.href = PROTOCOL_HOST + '/modulos/gestion/cliente/index.php';  

});


//empieza boton de editar
function funcEditarCliente(_id_element) {
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
          PROTOCOL_HOST + '/modulos/app/modelo/cliente/cliente.modelo.php?m=Info',
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
            $('#form_id_cliente').val(response['cliente'][0]['id']);
            $('#form_1_nombre').val(response['cliente'][0]['nombre']);
            $('#form_1_apellido').val(response['cliente'][0]['apellido']);
            $('#form_1_documento').val(response['cliente'][0]['documento']);
            $('#form_1_tipo_documento').val(response['cliente'][0]['tipo_documento']);
            $('#form_1_telefono_1').val(response['cliente'][0]['telefono_1']);
            $('#form_1_telefono_2').val(response['cliente'][0]['telefono_2']);
            $('#form_1_telefono_3').val(response['cliente'][0]['telefono_3']);
            $('#form_1_correo').val(response['cliente'][0]['correo']);
            $('#form_1_direccion').val(response['cliente'][0]['direccion']);
            $('#div_dialog_editar_cliente').dialog('open');
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();

            call_recuperar_session(function (k) {
              funcEditarVehiculo(_id_element);
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
} //termina funcion funcEditarVehiculo

$('#div_dialog_editar_cliente, #form_cliente').on('submit', function (e) {
  if ($(this).valid() === true) {
    let form_data = new FormData(this);
    $.confirm({
      title: 'Mensaje de Belissa Call Center',
      content: `
  <center>
  ¿Está seguro de alterar los datos del cliente?
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
            funcGuardarClienteSubmit(form_data);
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
}
);

function funcGuardarClienteSubmit(_form) {
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    columnClass: 'small',
    closeIcon: true,
    content: function () {
      return $.ajax({
        url:
          PROTOCOL_HOST + '/modulos/app/modelo/cliente/cliente.modelo.php?m=Update',
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
      
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            $('#div_dialog_editar_cliente').dialog('close');
           
          } else if (
            response.statusText === 'no_session' ||
            response.statusText === 'no_token'
          ) {
            self.close();
            call_recuperar_session(function (k) {
              funcGuardarClienteSubmit(_form);
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
    onClose: function (_buscador = false) {
      // true para ejecutar el buscar
      if (_buscador == true) {
        setTimeout(function () {
          buscadorCliente.formularioSubmit(true);
        }, 500);
      }
    },
  });
}
//termina boton editar


// dialog

$('#div_dialog_editar_cliente').dialog({
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

