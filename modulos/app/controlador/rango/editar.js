export class EditarClass {
  constructor() {
    this.buscador = null;
    this.myDialog = null;

    this.validacionFormulario = $('#editar-rango').validate({
      rules: {
        nombre: {
          required: true,
          minlength: 4,
          maxlength: 20,
          alphanumeric: true,
          noSpace: true,
        },
        tipo_conexion: {
          required: true,
          range: [1, 4],
        },
        'modulo[]': {
          required: true,
          minlength: 3,
        },
        acepto_responsabilidad: {
          required: true,
        },
      },
      messages: {
        acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
        'modulo[]': 'Debe seleccionar Mínimo 3 módulos',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.#funcDialog();
    this.#funcListener();
  }

  setBuscador(_buscador) {
    this.buscador = _buscador;
  }
  #funcDialog() {
    let _class = this;
    _class.myDialog = $('#container-dialog-editar').dialog({
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
  }

  #funcListener() {
    let _class = this;

    $('#editar-tipo_conexion').on('change', function () {
      $('#editar-tipo_conexion_html').empty();
      let _contenido = '';
      switch (parseInt(this.value)) {
        case 1:
          _contenido = 'Este rango puede:<b> Crear, Leer, actualizar y eliminar</b> información (CRUD).';
          break;
        case 2:
          _contenido = 'Este rango puede: <b>Crear, Leer y actualizar</b> información (CRU).';
          break;
        case 3:
          _contenido = 'Este rango puede: <b>Crear y Leer</b> información (CR).';
          break;
        case 4:
          _contenido = 'Este rango puede: <b>Leer</b> información (R).';
          break;
        default:
          _contenido = 'Este rango puede: Fuera de limites :c';
          break;
      }
      $('#editar-tipo_conexion_html').html(_contenido);
    });

    $('#editar-rango').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#btn-editar-reset').on('click', function (e) {
      _class.setDatosDefault();
    });
  }

  setDatosDefault() {
    this.validacionFormulario.resetForm();
    $('#editar-rango').trigger('reset');
  }

  datosSubmit() {
    let configForm = {
      form: new FormData($('#editar-rango')[0]),
      class: this,
      status: false,
    };

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/rango/rango.modelo.php?m=Update',
          type: 'POST',
          data: configForm.form,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              configForm.status = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configForm.class.datosSubmit();
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
      onClose: function () {
        if (configForm.status == true) {
          configForm.class.myDialog.dialog('close');
          configForm.class.buscador();
        }
      },
    });
  }

  setDatosEnFormulario(_response) {
    this.setDatosDefault();
    $('#editar-id').val(_response.id);
    $('#editar-nombre').val(_response.nombre);
    $('#editar-tipo_conexion').val(_response.conexion.id).trigger('change');

    $.each(_response.modulos, function (_key, _value) {
      $("#container-editar-modulos input:checkbox[value='" + _value + "']").prop('checked', true);
    });
    this.myDialog.dialog('open');
  }
}
