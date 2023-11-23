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
  getTipoDocumento() {
    return $('#' + this.tarea + '-conductor_tipo_documento option:selected').text();
  }
  setDocumento(_valor = 1110) {
    $('#' + this.tarea + '-conductor_documento').val(_valor);
  }
  getDocumento() {
    return $('#' + this.tarea + '-conductor_documento').val();
  }
  setNombre(_valor = 'nombres') {
    $('#' + this.tarea + '-conductor_nombres').val(_valor);
  }
  getNombre() {
    return $('#' + this.tarea + '-conductor_nombres').val();
  }
  setApellido(_valor = 'apellidos') {
    $('#' + this.tarea + '-conductor_apellidos').val(_valor);
  }
  getApellido() {
    return $('#' + this.tarea + '-conductor_apellidos').val();
  }
  setTelefono(_valor = '000 000 0000') {
    $('#' + this.tarea + '-telefono_conductor').val(_valor);
  }
  getTelefono() {
    return $('#' + this.tarea + '-telefono_conductor').val();
  }
  setCorreo(_valor = 'correo@correo.com') {
    const myCorreo = _valor.split('@');
    if (myCorreo.length >= 2) {
      $('#' + this.tarea + '-correo_conductor').val(myCorreo[0]);
      $('#' + this.tarea + '-correo_conductor-text').val(myCorreo[1]);
      $('#' + this.tarea + '-correo_conductor-select').val(myCorreo[1]);
    } else {
      $('#' + this.tarea + '-correo_conductor').val(_valor);
    }
  }
  getCorreo() {
    return `${$('#' + this.tarea + '-correo_conductor').val()}@${$('#' + this.tarea + '-correo_conductor-text').val()}`;
  }
  setFirma() {
    // aca el codigo
  }
  setCanalMercadeo() {
    // aca el codigo
  }

  getCanalMercadeo(){
    return $('#' + this.tarea + '-canal-mercadeo-text').val();
  }
  setDatosDefault() {
    this.setIdconductor(0);
    //this.setDocumento('');
    this.setTipoDocumento('default');
    this.setNombre('');
    this.setApellido('');
    this.setTelefono('');
    this.setCorreo('');
    $('#container-conductor-documento').hide(200);
    $('#container-conductor-datos').hide(200);
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
    //$('#container-conductor-datos').show(200);
  }
  #funcListener(_class) {

    $('#' + this.tarea + '-conductor-si').on('click', function (e) {
      _class.setIdconductor(0);
      _class.setTipoDocumento(2);
      _class.setDocumento(99999);
      _class.setNombre('conductor nombre');
      _class.setApellido('conductor apellido');
      _class.setTelefono('1000000001');
      _class.setCorreo('correo@gmail.com');
      $('#container-conductor-documento').hide(200);
      $('#container-conductor-datos').hide(200);
    });
    $('#' + this.tarea + '-conductor-no').on('click', function (e) {
      _class.setDatosDefault();
      _class.setDocumento('');
      $('#container-conductor-documento').show(200);
      $('#container-conductor-datos').hide(200);
    });

    


    
    $('#' + _class.tarea + '-conductor_documento').keydown(function (e) {
      if (e.keyCode == 13) {
        e.preventDefault();  
        if (($(this).val()).length >= 5) {
          //$('#container-propietario-datos').show(200);        
          _class.datosBuscar('DOCUMENTO', $(this).val());
          //_class.setDatosDefault();
        } else {
          $('#form-ingreso')
            .validate()
            .element('#' + _class.tarea + '-conductor_documento');
        }
      }
    });

  }


  #autoCompleteInputs() {
    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("ingreso-canal-mercadeo-text"),
        hidden: document.getElementById("ingreso-canal-mercadeo-select"),
      },
      table: ['id', 'nombre', 'canal'],
      childs: [],
      default: [0, 'Seleccione'],
    });
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

              _class.setIdconductor(response.cliente[0].id);
              _class.setTipoDocumento(response.cliente[0].documento.id);
              _class.setNombre(response.cliente[0].nombre);
              _class.setApellido(response.cliente[0].apellido);
              _class.setTelefono(response.cliente[0].telefono.tres);
              _class.setCorreo(response.cliente[0].email);
              _class.setCorreo(response.cliente[0].email);

              self.close();
              $('#container-conductor-documento').show(100);
              $('#container-conductor-datos').show(200);
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              self.close();
              _class.setIdconductor(0);
              _class.setDatosDefault();
              $('#container-conductor-documento').show(100);
              $('#container-conductor-datos').show(200);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosBuscar(_rol, _value);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.setIdconductor(0);
              $('#container-conductor-documento').show(100);
              $('#container-conductor-datos').show(200);
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
