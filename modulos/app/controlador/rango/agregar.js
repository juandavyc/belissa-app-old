export class AgregarClass {
  constructor() {
    this.validacionFormulario = $('#form_1_agregar').validate({
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

    this.#funcListener();
  }

  #funcListener() {
    let _class = this;

    $('#form_1_tipo_conexion').on('change', function () {
      $('#form_1_tipo_conexion_seleccionada').empty();
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
      $('#form_1_tipo_conexion_seleccionada').html(_contenido);
    });

    $('#btn-help-conexion').on('click', function (e) {
      $.alert({
        title: '¿Tipo de conexión?',
        content: `Los privilegios del usuario al conectar al servidor:<br>
              <b> C.R.U.D </b><br>
              <b>C</b> -> Crear registros <br>
              <b>R</b> -> (Leer - consultar) registros <br>
              <b>U</b> -> Actualizar registros <br>
              <b>D</b> -> Eliminar registros
              `,
      });
      e.preventDefault();
      return false;
    });

    $('#form_1_agregar').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#btn-agregar-reset').on('click', function (e) {
      _class.setDatosDefault();
    });
  }

  setDatosDefault() {
    this.validacionFormulario.resetForm();
    $('#form_1_agregar').trigger('reset');
  }
  datosSubmit() {
    let configForm = {
      form: new FormData($('#form_1_agregar')[0]),
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
          url: PROTOCOL_HOST + '/modulos/app/modelo/rango/rango.modelo.php?m=Create',
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
          configForm.class.setDatosDefault();
        }
      },
    });
  }
}
