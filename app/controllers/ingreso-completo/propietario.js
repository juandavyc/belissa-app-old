export class PropietarioClass {
  constructor(_tarea = 'ingreso') {
    this.tarea = _tarea;
    this.funcListener(this);
    this.autoCompleteInputs(this);

    // container-propietario-datos
  }

  setIdPropietario(_valor = 1) {
    $('#' + this.tarea + '-id_propietario').val(_valor);
  }

  setTipoDocumento(_valor = 1) {
    $('#' + this.tarea + '-propietario_tipo_documento').val(_valor);
  }
  getTipoDocumento() {
    return $('#' + this.tarea + '-propietario_tipo_documento option:selected').text();
  }

  setDocumento(_valor = 1110) {
    $('#' + this.tarea + '-propietario_documento').val(_valor);
  }
  getDocumento() {
    return $('#' + this.tarea + '-propietario_documento').val();
  }

  setNombre(_valor = 'nombres') {
    $('#' + this.tarea + '-propietario_nombres').val(_valor);
  }
  
  getNombre() {
    return $('#' + this.tarea + '-propietario_nombres').val();
  }
  setApellido(_valor = 'apellidos') {
    $('#' + this.tarea + '-propietario_apellidos').val(_valor);
  }
  getApellido() {
    return $('#' + this.tarea + '-propietario_apellidos').val();
  }
  setTelefono(_valor = '000 000 0000') {
    $('#' + this.tarea + '-telefono_propietario').val(_valor);
  }
  getTelefono() {
    return $('#' + this.tarea + '-telefono_propietario').val();
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
  getCorreo() {
    return `${$('#' + this.tarea + '-correo_propietario').val()}@${$('#' + this.tarea + '-correo_propietario-text').val()}`;
  }  
  setDireccion(_valor = 'direccion') {
    $('#' + this.tarea + '-direccion_propietario').val(_valor);
  }
  getDireccion() {
    return $('#' + this.tarea + '-direccion_propietario').val();
  } 

  setDatosDefault() {
    this.setIdPropietario(0);
    this.setTipoDocumento('default');
    //this.setDocumento('');
    this.setNombre('');
    this.setApellido('');
    this.setTelefono('');
    this.setCorreo('');
    this.setDireccion('');
    $('#container-propietario-datos').hide(200);
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
    // $('#' + this.tarea + '-btn-propietario-documento').on('click', function (e) {
    //   e.preventDefault();     
    //   if (($('#' + _class.tarea + '-propietario_documento').val()).length >= 5) {
    //     //$('#container-propietario-datos').show(200);        
    //     _class.datosBuscar('DOCUMENTO', $('#' + _class.tarea + '-propietario_documento').val());
    //     //_class.setDatosDefault();
    //   } else {
    //     $('#form-ingreso')
    //       .validate()
    //       .element('#' + _class.tarea + '-propietario_documento');
    //   }
    // });

    $('#' + _class.tarea + '-propietario_documento').keydown(function (e) {
       
      if (e.keyCode == 13) {
        e.preventDefault();  
        if (($(this).val()).length >= 5) {
          //$('#container-propietario-datos').show(200); 
          _class.datosBuscar('DOCUMENTO', $(this).val());
          //_class.setDatosDefault();
        } else {
          $('#form-ingreso')
            .validate()
            .element('#' + _class.tarea + '-propietario_documento');
        }
      }
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
              self.close();
              $('#container-propietario-datos').show(200);
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              self.close();
              _class.setIdPropietario(0);
              _class.setDatosDefault();
              $('#container-propietario-datos').show(200);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(() => {
                _class.datosBuscar(_rol, _value);
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
        aceptar: function () { },
      },
    });
  }
}
