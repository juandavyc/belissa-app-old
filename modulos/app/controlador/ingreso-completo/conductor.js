export class ConductorClass {
  constructor(_tarea = 'ingreso') {
    this.tarea = _tarea;
    this.#funcListener(this);
    this.#autoCompleteInputs();
  }

  setIdconductor(_valor = 1) {
    $('#' + this.tarea + '-id_conductor').val(_valor);
  }

  setTipoDocumento(_valor = 1) {
    $('#' + this.tarea + '-conductor_tipo_documento').val(_valor);
  }
  setDocumento(_valor = 1110) {
    $('#' + this.tarea + '-conductor_documento').val(_valor);
  }
  setNombre(_valor = 'nombres') {
    $('#' + this.tarea + '-conductor_nombres').val(_valor);
  }
  setApellido(_valor = 'apellidos') {
    $('#' + this.tarea + '-conductor_apellidos').val(_valor);
  }
  setTelefono(_valor = '000 000 0000') {
    $('#' + this.tarea + '-telefono_conductor').val(_valor);
  }
  setCorreo(_valor = 'correo@correo.com') {
    const myCorreo = _valor.split('@');
    if (myCorreo.length >= 2) {
      $('#' + this.tarea + '-correo_conductor').val(myCorreo[0]);
      $('#' + this.tarea + '-correo_conductor-text').val(myCorreo[1]);
      $('#' + this.tarea + '-correo_propietario-select').val(myCorreo[1]);
    } else {
      $('#' + this.tarea + '-correo_conductor').val(_valor);
    }
  }
  setFirma() {
    // aca el codigo
  }
  setCanalMercadeo() {
    // aca el codigo
  }

  setDatosDefault() {
    //this.setTipoDocumento('DEFAULT');
    this.setNombre('');
    this.setApellido('');
    this.setTelefono('');
    this.setCorreo('');
  }

  setDatosPropietario() {
    // me dio pereza!
    this.setIdconductor($('#' + this.tarea + '-id_propietario').val());
    this.setTipoDocumento($('#' + this.tarea + '-propietario_tipo_documento').val());
    this.setDocumento($('#' + this.tarea + '-propietario_documento').val());
    this.setNombre($('#' + this.tarea + '-propietario_nombres').val());
    this.setApellido($('#' + this.tarea + '-propietario_apellidos').val());
    this.setTelefono($('#' + this.tarea + '-telefono_propietario').val());
    this.setCorreo($('#' + this.tarea + '-correo_propietario').val() + '@' + $('#' + this.tarea + '-correo_propietario-select').val());
  }
  #funcListener(_class) {
    $('#' + this.tarea + '-conductor_documento').focusout(function (e) {
      if ($(this).val().length >= 5) {
        _class.datosBuscar('DOCUMENTO', $(this).val());
      } else {
        $('#form-ingreso')
          .validate()
          .element('#' + _class.tarea + '-conductor_documento');
      }
      e.preventDefault();
      return false;
    });
    $('#' + this.tarea + '-btn-datos-conductor').on('click', function (e) {
      _class.setDatosPropietario();
      e.preventDefault();
      return false;
    });
  }

  #autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'ingreso-canal-mercadeo-text',
      id_input_select: 'ingreso-canal-mercadeo-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_CANAL',
      input_select_default: '1',
      src_table: 'RlN0MVoyblN2SDh6amR6Z0NWZUthdz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });

    autocompleteCreateFather({
      id_input_text: 'ingreso-correo_conductor-text',
      id_input_select: 'ingreso-correo_conductor-select',
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

              _class.setIdconductor(response.cliente[0].id);
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
              _class.setIdconductor(0);
              _class.setDatosDefault();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosBuscar(_rol);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.setIdconductor(0);
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
