export class PropietarioClass {
  constructor(_tarea = 'ingreso') {
    this.tarea = _tarea;
    this.funcListener(this);
    this.autoCompleteInputs(this);
  }

  setIdPropietario(_valor = 1) {
    $('#' + this.tarea + '-id_propietario').val(_valor);
  }

  setTipoDocumento(_valor = 1) {
    $('#' + this.tarea + '-propietario_tipo_documento').val(_valor);
  }
  setDocumento(_valor = 1110) {
    $('#' + this.tarea + '-propietario_documento').val(_valor);
  }
  setNombre(_valor = 'nombres') {
    $('#' + this.tarea + '-propietario_nombres').val(_valor);
  }
  setApellido(_valor = 'apellidos') {
    $('#' + this.tarea + '-propietario_apellidos').val(_valor);
  }
  setTelefono(_valor = '000 000 0000') {
    $('#' + this.tarea + '-telefono_propietario').val(_valor);
  }
  setCorreo(_valor = 'correo@correo.com') {
    const myCorreo = _valor.split('@');
    if (myCorreo.length >= 2) {
      $('#' + this.tarea + '-correo_propietario').val(myCorreo[0]);
      $('#' + this.tarea + '-correo_propietario-text').val(myCorreo[1]);
      $('#' + this.tarea + '-correo_propietario-select').val(myCorreo[1]);
    } else {
      $('#' + this.tarea + '-correo_propietario').val(_valor);
    }
  }
  setDireccion(_valor = 'direccion') {
    $('#' + this.tarea + '-direccion_propietario').val(_valor);
  }

  setDatosDefault() {
    //this.setTipoDocumento('default');
    this.setNombre('');
    this.setApellido('');
    this.setTelefono('');
    this.setCorreo('');
    this.setDireccion('');
  }

  autoCompleteInputs(_class) {
    autocompleteCreateFather({
      id_input_text: 'ingreso-correo_propietario-text',
      id_input_select: 'ingreso-correo_propietario-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php?mail=true',
      input_value_default: 'GMAIL.COM',
      input_select_default: 'GMAIL.COM',
      src_table: 'TEptWmlYOTBWNm4wd3NnSDRISTdTUT09',
      src_index: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });
  }
  funcListener(_class) {
    $('#' + this.tarea + '-propietario_documento').focusout(function (e) {
      if ($(this).val().length >= 5) {
        _class.datosBuscar('DOCUMENTO', $(this).val());
      } else {
        $('#form-ingreso')
          .validate()
          .element('#' + _class.tarea + '-propietario_documento');
      }
      e.preventDefault();
      return false;
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
          url: PROTOCOL_HOST + '/modulos/app/modelo/callcenter/rtm.modelo.php?m=ClienteInfo',
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

              _class.setIdPropietario(response.cliente[0].id);
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
              _class.setIdPropietario(0);
              _class.setDatosDefault();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosBuscar(_rol);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.setIdPropietario(0);
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle('Error fatal');
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }
}
