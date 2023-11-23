let validateFormagregarCanal = $('#form_agregar_canal').validate({
  rules: {
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
      id: 'btn_infor',
      icon: 'fas fa-info-circle',
      title: 'Información',
      func: funcInformacionUsuario, // function del evento del boton
    },
    {
      id: 'btn_edit',
      icon: 'fas solid fa-edit',
      title: 'Editar',
      func: funcEditarUsuario,
    },
    {
      id: 'btn_delete',
      icon: 'fas fa-trash-alt',
      title: 'Eliminar',
      func: funcEliminarUsuario,
    },
    {
      id: 'btn_mas',
      icon: 'fas fa-poll',
      title: 'Agregar canal',
      func: funcAgregarCanal,
    },
  ],
  //verificado, sin verificar y asi..
  icono: ['none', 'question', 'check', 'times'],
  // ¿a que campos deben afectar estos iconos?
  campo: ['email', 'paquetes', 'datos'],
};
// en realidad son las clases

export const buscadorUsuario = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST + '/modulos/app/modelo/usuario/usuario.modelo.php?m=Listado',
  personalizacion_tabla,
  true //¿ exportar exel ?
);

// autoiniciar
setTimeout(function () {
  buscadorUsuario.formularioSubmit(true);
}, 500);

$('#form_0_buscador').on('submit', function (e) {
  // para la validacion del formulario
  buscadorUsuario.formularioSubmit(true);
  e.preventDefault();
  return false;
});

$('#form_agregar_canal').on('reset', function (e) {
  validateFormagregarCanal.resetForm();
});

//empieza informacion usuario
function funcInformacionUsuario(_id_element) {
  let self = $.confirm({
    title: false,
    content: 'Cargando, espere...',
    typeAnimated: true,
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    columnClass: 'medium',
    closeIcon: true,
    content: function () {
      return $.ajax({
        url: PROTOCOL_HOST + '/modulos/app/modelo/usuario/usuario.modelo.php?m=Info',
        type: 'POST',
        data: {
          id_elemento: _id_element,
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
            self.setContent(asignar_datos(response.message));
            console.log(response.message);
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              funcInformacionUsuario(_id_element);
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
}

// asignador de datos
function asignar_datos(_response) {
  let inner_html = `
  <div class="row">    

  <div class="col-4 col-12-mobilep align-center">
  </div> 
  <div class="col-4 col-12-mobilep align-center">
          <span class="image fit p" >                
                    <img src=${_response.foto}>
                </a>
         </span>
         <label> SU FOTO</label>
   </div>   
          <div class="col-4 col-12-mobilep align-center">
   </div> 

   <div class="col-12">
          <hr>
   </div>
        
    <div class="col-6 col-12-small">
      <label class="label-datos"> NOMBRE DEL USUARIO</label>
    </div>
    <div class="col-6 col-12-small">
      <label class="label-resultados">
        ${_response.nombre_usuario}
      </label>
    </div>

    <div class="col-6 col-12-small">
      <label class="label-datos"> DOCUMENTO DEL USUARIO</label>
    </div>
    <div class="col-6 col-12-small">
      <label class="label-resultados">
        ${_response.documento}
      </label>
    </div>

    <div class="col-6 col-12-small">
    <label class="label-datos"> DOCUMENTO DEL USUARIO</label>
  </div>
  <div class="col-6 col-12-small">
    <label class="label-resultados">
      ${_response.correo}
    </label>
  </div>

    <div class="col-6 col-12-small">
      <label class="label-datos"> FECHA DE NACIMIENTO</label>
    </div>
    <div class="col-6 col-12-small">
      <label class="label-resultados">
        ${_response.fecha_nacimiento}
      </label>
    </div>

    <div class="col-6 col-12-small">
    <label class="label-datos"> RANGO DEL USUARIO</label>
  </div>
  <div class="col-6 col-12-small">
    <label class="label-resultados">
      ${_response.rango_nombre}
    </label>
  </div>

  <div class="col-6 col-12-small">
  <label class="label-datos"> ESTADO DEL USUARIO</label>
</div>
<div class="col-6 col-12-small">
  <label class="label-resultados">
    ${_response.estado}
  </label>
</div>

<div class="col-12 col-12-small">
<label class="label-datos" style="text-align:center"> ESTE USUARIO TIENE ACCESO A ESTOS MODULOS</label>
</div>
<div class="col-12 col-12-small">
  <label class="label-resultados"  style="text-align:center">
    ${_response.modulos}
  </label>
</div>

<div class="col-12">
          <hr>
   </div>



<div class="col-4 col-12-mobilep align-center">
</div> 
<div class="col-4 col-12-mobilep align-center">
        <span class="image fit small" >                
                  <img src=${_response.firma}>
              </a>
       </span>
       <label> SU FIRMA</label>
 </div>   
        <div class="col-4 col-12-mobilep align-center">
 </div> 
 <div class="col-12">
          <hr>
   </div>
  
     <div class="col-6 col-12-small">
      <label class="label-datos"> FECHA CREADO </label>
    </div>
    <div class="col-6 col-12-small">
      <label class="label-resultados">
        ${_response.fecha}
      </label>
    </div>
     <div class="col-6 col-12-small">
      <label class="label-datos"> USUARIO RESPONSABLE </label>
    </div>
    <div class="col-6 col-12-small">
      <label class="label-resultados">
        ${_response.nombre_responsable}
      </label>
    </div>
    </div>
    
      `;

  return inner_html;
}
//termina informacion usuario

//editar usuario
function funcEditarUsuario(_id_element) {
  window.location.href = PROTOCOL_HOST + '/modulos/gestion/editar_usuario/index.php?id=' + _id_element;
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
        action: function () {},
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
        url: PROTOCOL_HOST + '/modulos/app/modelo/usuario/usuario.modelo.php?m=Delete',
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
      aceptar: function () {},
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
        url: PROTOCOL_HOST + '/modulos/app/modelo/usuario/usuario.modelo.php?m=Informacion',
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
      aceptar: function () {},
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
          action: function () {},
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
        url: PROTOCOL_HOST + '/modulos/app/modelo/usuario/usuario.modelo.php?m=Update',
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
//termina boton editar

$('#div_dialog_agregar_canal').dialog({
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
