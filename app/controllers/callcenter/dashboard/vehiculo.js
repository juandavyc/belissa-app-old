export class VehiculoClass {
  constructor() {
    this.validacionFormulario = $('#form_datos_vehiculo').validate({
      rules: {
        placa: {
          required: true,
          minlength: 5,
          maxlength: 6,
          noSpace: true,
        },
        tipo: {
          required: true,
          valueNotEquals: 'default',
        },
        servicio: {
          required: true,
          valueNotEquals: 'default',
        },
        modelo: {
          required: true,
          number: true,
          min: 1800,
          max: 2050,
        },
        vin: {
          minlength: 2,
          maxlength: 50,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        tipo: 'Seleccione un tipo de vehículo de la lista.',
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.#actionListener();
    this.#autoCompleteInputs();
  }

  setFormularioDefault(_guardar) {
    this.validacionFormulario.resetForm();

    $(`#datos-vehiculo-top-id-html`).empty();
    $(`#datos-vehiculo-id-html`).empty();
    $(`#datos-vehiculo-placa-html`).empty();

    $('#form_datos_vehiculo').trigger('reset');

    this.#setNoEditable(false);

    if (_guardar == false) {
      $('#container-datos-vehiculo-guardar').hide(200);
    }
  }
  setDatos(_response) {
    $('#btn-datos-vehiculo-recargar').text(' Espere... ').prop('disabled', true);

    $('#datos-vehiculo-top-id-html').html(_response.id);
    $('#datos-vehiculo-id-html').html(_response.id);
    $('#datos-vehiculo-placa-html').html(_response.placa);

    $('#datos-vehiculo-id').val(_response.id);
    $('#datos-vehiculo-placa').val(_response.placa);
    $('#datos-vehiculo-tipo').val(_response.tipo.id == 1 ? 'default' : _response.tipo.id);
    $('#datos-vehiculo-servicio').val(_response.servicio.id == 1 ? 'default' : _response.servicio.id);
    $('#datos-vehiculo-modelo').val(_response.modelo);

    $('#form_datos_vehiculo input[name=ensenanza][value=' + _response.ensenanza + ']').prop('checked', true);

    $('#datos-vehiculo-marca-text').val(_response.marca.nombre);
    $('#datos-vehiculo-marca-select').val(_response.marca.id);
    $('#datos-vehiculo-linea-text').val(_response.linea.nombre);
    $('#datos-vehiculo-linea-select').val(_response.linea.id);
    $('#datos-vehiculo-color-text').val(_response.color.nombre);
    $('#datos-vehiculo-color-select').val(_response.color.id);

    $('#datos-vehiculo-vin').val(_response.vin);

    this.#setNoEditable(true);

    setTimeout(function () {
      $('#btn-datos-vehiculo-recargar').text(' Recargar').prop('disabled', false);
    }, 500);
  }

  formularioSubmit() {
    let configuracion = {
      form: new FormData($('#form_datos_vehiculo')[0]),
      class: this,
      status: false,
    };

    configuracion.form.append('propietario', $('#datos-propietario-id').val());
    configuracion.form.append('conductor', $('#datos-conductor-id').val());

    if ($('#datos-propietario-id').val() != 'create_propietario') {
      if ($('#datos-conductor-id').val() != 'create_conductor') {
        let self = $.confirm({
          title: false,
          content: 'Cargando, espere...',
          typeAnimated: true,
          scrollToPreviousElement: false,
          scrollToPreviousElementAnimate: false,
          content: function () {
            return $.ajax({
              url: getMyAppModel('callcenter/CallCenter', 'VehiculoUpdate'),
              type: 'POST',
              data: configuracion.form,
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
                  $('#datos-vehiculo-placa-html')
                    .empty()
                    .html(escapehtmljs($('#datos-vehiculo-placa').val()));
                } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                  self.close();
                  call_recuperar_session(function (k) {
                    configuracion.class.formularioSubmit();
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
      } else {
        $.alert('Guarde la información del conductor para continuar.');
      }
    } else {
      $.alert('Guarde la información del propietario para continuar.');
    }
  }

  buscarDatos(_idVehiculo) {
    let configuracion = {
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
          url: getMyAppModel('callcenter/CallCenter', 'VehiculoInformacion'),
          type: 'POST',
          data: {
            vehiculo: _idVehiculo,
            rol: 'ID'
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');
              configuracion.class.setDatos(response.vehiculo[0]);

              if ($('#container-datos-vehiculo-guardar').is(':visible')) {
                configuracion.class.#setNoEditable(false);
              }

              self.close(true);
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.buscarPorID(_idVehiculo);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle('Error fatal');
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () { },
      },
    });
  }
  #setNoEditable(_status) {
    $('#form_datos_vehiculo :radio').prop('disabled', _status);
    $('#form_datos_vehiculo :input').prop('readonly', _status);
    $('#form_datos_vehiculo select').prop('disabled', _status);
  }

  #editarDatos() {
    $('#btn-datos-vehiculo-editar').text('Espere...').prop('disabled', true);
    if ($('#container-datos-vehiculo-guardar').is(':visible')) {
      $('#container-datos-vehiculo-guardar').hide(200);
      this.#setNoEditable(true);
    } else {
      $('#container-datos-vehiculo-guardar').show(200);
      this.#setNoEditable(false);
    }
    $('#datos-vehiculo-terminos-condiciones').prop('checked', false);
    setTimeout(function () {
      $('#btn-datos-vehiculo-editar').text(' Editar').prop('disabled', false);
    }, 500);
  }
  #actionListener(_class = this) {
    $('#form_datos_vehiculo').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.formularioSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#btn-datos-vehiculo-editar').on('click', function (e) {
      _class.#editarDatos();
      e.preventDefault();
      return false;
    });
    $('#btn-datos-vehiculo-recargar').on('click', function (e) {
      _class.buscarDatos($('#datos-vehiculo-id').val());
      e.preventDefault();
      return false;
    });
  }
  #autoCompleteInputs() {

    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("datos-vehiculo-color-text"),
        hidden: document.getElementById("datos-vehiculo-color-select"),
      },
      table: ['id', 'nombre', 'color'],
      childs: [],
      default: [0, 'Seleccione'],
    });

    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("datos-vehiculo-marca-text"),
        hidden: document.getElementById("datos-vehiculo-marca-select"),
      },
      table: ['id', 'nombre', 'marca'], // column parent ['id_marca']
      childs: [
        document.getElementById("datos-vehiculo-linea-text"),
        document.getElementById("datos-vehiculo-linea-select")
      ],
      default: [0, 'Seleccione una marca'],
    });

    myAutocomplete({
      parent: document.getElementById("datos-vehiculo-marca-select"),
      create: true,
      input: {
        text: document.getElementById("datos-vehiculo-linea-text"),
        hidden: document.getElementById("datos-vehiculo-linea-select"),
      },
      table: ['id', 'nombre', 'linea', 'id_marca'],
      childs: [],
      default: [0, 'Seleccione una linea'],
    });
  }
}
