export class EditarClass {
  constructor() {

    this.buscador = null;
    this.formulario = document.getElementById('formulario-editar');

    this.objects = {
      id: this.formulario.querySelector('#id'),
      nombre: this.formulario.querySelector('#nombre'),
      tipo_conexion: this.formulario.querySelector('#tipo_conexion'),
      tipo_conexion_html: this.formulario.querySelector('#tipo_conexion_html'),
      reset: this.formulario.querySelector('#btn-editar-reset'),
    };

    this.validacionFormulario = $(this.formulario).validate({
      rules: {
        nombre: {
          required: true,
          minlength: 4,
          maxlength: 20,
          alphanumeric: true,
          //noSpace: true,
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


    this.myDialog = new MyModal({
      container: 'dialog-editar',
      title: 'Editar',
      icon: 'fa fa-warning',
      columnClass: 'md',
      event: {
        onOpen: () => { },
        onClose: () => { },
      },
    });
    this.#funcListener(this);
  }

  setBuscador(_buscador) {
    this.buscador = _buscador;
  }

  #funcListener(_class) {


    $(_class.objects.tipo_conexion).on('change', function () {
      $(_class.objects.tipo_conexion_html).empty();
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
      $(_class.objects.tipo_conexion_html).html(_contenido);
    });

    $(_class.formulario).on('submit', function (e) {
      e.preventDefault();
      if ($(this).valid() === true) {
        _class.datosSubmit(new FormData(_class.formulario));
      }
    });
    $(_class.objects.reset).on('click', function (e) {
      _class.setDatosDefault();
    });
  }

  setDatosDefault() {
    this.validacionFormulario.resetForm();
    $(this.formulario).trigger('reset');
  }

  datosSubmit(_form) {
       
    let configForm = {
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
          url: getMyAppModel('rango/Rango', 'Update'),
          type: 'POST',
          data: _form,
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
        aceptar: function () { },
      },
      onClose: function () {
        if (configForm.status == true) {
          configForm.class.myDialog.close();
          configForm.class.buscador();
        }
      },
    });
  }

  setDatosEnFormulario(_response) {
    const _class = this;
    _class.setDatosDefault();
    $(_class.objects.id).val(_response.id);
    $(_class.objects.nombre).val(_response.nombre);
    $(_class.objects.tipo_conexion).val(_response.conexion.id).trigger('change');

    $.each(_response.modulos, function (_key, _value) {
      $("#editar_modulo_"+_value).prop('checked', true);
    });
    this.myDialog.open();
  }
}
