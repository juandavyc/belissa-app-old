export class PropietarioClass {
  constructor() {
    this.funcListener(this);
    this.autoCompleteInputs(this);
  }

  setId(_valor = 1) {
    $('#ingreso-id_propietario').val(_valor);
  }
  setTipoDocumento(_valor = 1) {
    $('#ingreso-propietario_tipo_documento').val(_valor);
  }
  setDocumento(_valor = 1110) {
    $('#ingreso-propietario_documento').val(_valor);
  }
  setNombre(_valor = 'nombres') {
    $('#ingreso-propietario_nombres').val(_valor);
  }
  setApellido(_valor = 'apellidos') {
    $('#ingreso-propietario_apellidos').val(_valor);
  }
  setTelefono(_valor = '000 000 0000') {
    $('#ingreso-telefono_propietario').val(_valor);
  }
  setCorreo(_valor = 'correo@correo.com') {
    const myCorreo = _valor.split('@');
    if (myCorreo.length >= 2) {
      $('#ingreso-correo_propietario').val(myCorreo[0]);
      $('#ingreso-correo_propietario-text').val(myCorreo[1]);
      $('#ingreso-correo_propietario-select').val(myCorreo[1]);
    } else {
      $('#ingreso-correo_propietario').val(_valor);
    }
  }
  setDireccion(_valor = 'direccion') {
    $('#ingreso-direccion_propietario').val(_valor);
  }

  setDatosDefault() {
    this.setTipoDocumento('default');
    this.setNombre('');
    this.setApellido('');
    this.setTelefono('');
    this.setCorreo('');
    this.setDireccion('');
  }

  autoCompleteInputs(_class) {
    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("ingreso-correo_propietario-text"),
        hidden: document.getElementById("ingreso-correo_propietario-select"),
        key: false,
      },
      table: ['id', 'nombre', 'correo'],
      childs: [],
      default: [0, 'Seleccione'],
    });
  }
  funcListener(_class) { 
    $('#ingreso-propietario_documento').keyup(helixDelay(function (e) {
      if ($(this).val().length >= 5) {
        _class.datosBuscar('DOCUMENTO', $(this).val());
      } else {
        $('#form-ingreso')
          .validate()
          .element('#' + _class.tarea + '-propietario_documento');
      }
    }, 1000));
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
              _class.setDireccion(response.cliente[0].direccion);
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
                _class.datosBuscar(_rol,_value);
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
