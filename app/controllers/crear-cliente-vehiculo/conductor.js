export class ConductorClass {
  constructor() {
    this.#funcListener(this);
    this.#autoCompleteInputs();
  }

  setId(_valor = 1) {
    $('#ingreso-id_conductor').val(_valor);
  }

  setTipoDocumento(_valor = 1) {
    $('#ingreso-conductor_tipo_documento').val(_valor);
  }
  setDocumento(_valor = 1110) {
    $('#ingreso-conductor_documento').val(_valor);
  }
  setNombre(_valor = 'nombres') {
    $('#ingreso-conductor_nombres').val(_valor);
  }
  setApellido(_valor = 'apellidos') {
    $('#ingreso-conductor_apellidos').val(_valor);
  }
  setTelefono(_valor = '000 000 0000') {
    $('#ingreso-telefono_conductor').val(_valor);
  }
  setCorreo(_valor = 'correo@correo.com') {
    const myCorreo = _valor.split('@');
    if (myCorreo.length >= 2) {
      $('#ingreso-correo_conductor').val(myCorreo[0]);
      $('#ingreso-correo_conductor-text').val(myCorreo[1]);
      $('#ingreso-correo_propietario-select').val(myCorreo[1]);
    } else {
      $('#ingreso-correo_conductor').val(_valor);
    }
  }

  setDatosDefault() {
    this.setTipoDocumento('default');
    this.setNombre('');
    this.setApellido('');
    this.setTelefono('');
    this.setCorreo('');
  }

  setDatosPropietario() {
    this.setId($('#ingreso-id_propietario').val());
    this.setTipoDocumento($('#ingreso-propietario_tipo_documento').val());
    this.setDocumento($('#ingreso-propietario_documento').val());
    this.setNombre($('#ingreso-propietario_nombres').val());
    this.setApellido($('#ingreso-propietario_apellidos').val());
    this.setTelefono($('#ingreso-telefono_propietario').val());
    this.setCorreo($('#ingreso-correo_propietario').val() + '@' + $('#ingreso-correo_propietario-select').val());
  }
  #funcListener(_class) {


    $('#ingreso-conductor_documento').keyup(helixDelay(function (e) {
      if ($(this).val().length >= 5) {
        _class.datosBuscar('DOCUMENTO', $(this).val());
      } else {
        $('#form-ingreso')
          .validate()
          .element('#' + _class.tarea + '-conductor_documento');
      }
    }, 1000));


    $('#ingreso-btn-datos-conductor').on('click', function (e) {
      _class.setDatosPropietario();
      e.preventDefault();
      return false;
    });
  }

  #autoCompleteInputs() {
    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("ingreso-correo_conductor-text"),
        hidden: document.getElementById("ingreso-correo_conductor-select"),
        key: false,
      },
      table: ['id', 'nombre', 'correo'],
      childs: [],
      default: [0, 'Seleccione'],
    });
  }

  datosBuscar(_rol = 'ID', _value = 1110) {
    let _class = this;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('callcenter/CallCenter', 'ClienteInformacion'),
          type: 'POST',
          data: {
            cliente: _value,
            rol: _rol,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            //console.log(response);
            if (response.statusText === 'bien') {
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');

              _class.setId(response.cliente[0].id);
              _class.setTipoDocumento(response.cliente[0].documento.id);
              _class.setNombre(response.cliente[0].nombre);
              _class.setApellido(response.cliente[0].apellido);
              _class.setTelefono(response.cliente[0].telefono.tres);
              _class.setCorreo(response.cliente[0].email);
              //_class.setDireccion(response.cliente[0].direccion);
              //_class.setDatos(response.cliente[0]);

              self.close();
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              self.close();
              _class.setId(0);
              _class.setDatosDefault();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosBuscar(_rol, _value);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.setId(0);
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
}
