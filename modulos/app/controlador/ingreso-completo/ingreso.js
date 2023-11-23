export class IngresoClass {
  constructor() {
    this.validacionFormulario = $('#form-ingreso').validate({
      rules: {
        tipo_vehiculo: {
          required: true,
          valueNotEquals: 'default',
        },
        servicio_vehiculo: {
          required: true,
          valueNotEquals: 'default',
        },
        modelo: {
          required: true,
          number: true,
          min: 1800,
          max: 2050,
        },
        combustible: {
          required: true,
          valueNotEquals: 'default',
        },
        certificado_gncv: {
          required: true,
        },
        fecha_gncv: {
          required: true,
        },
        capacidad: {
          required: true,
          number: true,
          min: 0,
          max: 3000,
        },
        puertas: {
          required: true,
          number: true,
          min: 0,
          max: 10,
        },
        kilometraje: {
          required: true,
        },
        tipo_caja: {
          required: true,
          valueNotEquals: 'default',
        },
        delantera_moto: {
          required: true,
          number: true,
          min: 0,
          max: 38,
        },
        trasera_moto: {
          required: true,
          number: true,
          min: 0,
          max: 38,
        },
        delantera_izquierda_liviano: {
          required: true,
          number: true,
          min: 0,
          max: 150,
        },
        trasera_izquierda_liviano: {
          required: true,
          number: true,
          min: 0,
          max: 150,
        },
        trasera_derecha_liviano: {
          required: true,
          number: true,
          min: 0,
          max: 150,
        },
        delantera_derecha_liviano: {
          required: true,
          number: true,
          min: 0,
          max: 150,
        },
        repuesto_liviano: {
          required: true,
          number: true,
          min: 0,
          max: 150,
        },
        propietario_tipo_documento: {
          required: true,
          valueNotEquals: 'default',
        },
        propietario_documento: {
          required: true,
          minlength: 5,
          maxlength: 20,
          noSpace: true,
          alphanumeric: true,
          valueNotEquals: '1110',
        },
        propietario_nombres: {
          required: true,
          minlength: 4,
          maxlength: 50,
          alphanumeric: true,
        },
        propietario_apellidos: {
          required: true,
          minlength: 2,
          maxlength: 50,
          alphanumeric: true,
        },
        propietario_telefono: {
          required: true,
          minlength: 5,
          maxlength: 50,
        },
        propietario_correo: {
          required: true,
          maxlength: 50,
          noSpace: true,
          //myEmail: true,
        },
        direccion_propietario: {
          maxlength: 50,
          alphanumeric: true,
        },
        conductor_tipo_documento: {
          required: true,
          valueNotEquals: 'default',
        },
        conductor_documento: {
          required: true,
          minlength: 5,
          maxlength: 20,
          noSpace: true,
          alphanumeric: true,
          valueNotEquals: '1110',
        },
        conductor_nombres: {
          required: true,
          minlength: 4,
          maxlength: 50,
          alphanumeric: true,
        },
        conductor_apellidos: {
          required: true,
          minlength: 2,
          maxlength: 50,
          alphanumeric: true,
        },
        conductor_telefono: {
          required: true,
          minlength: 5,
          maxlength: 50,
        },
        conductor_correo: {
          //required: true,
          maxlength: 50,
          noSpace: true,
          //myEmail: true,
        },

        observaciones: {
          minlength: 3,
          maxlength: 255,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        tipo_vehiculo: 'Seleccione un tipo de vehiculo de la lista.',
        servicio_vehiculo: 'Seleccione un servicio de vehiculo de la lista.',
        combustible: 'Seleccione un combustible de la lista.',
        tipo_caja: 'Seleccione un tipo de caja de la lista.',
        propietario_tipo_documento: 'Seleccione un tipo de documento de la lista.',
        conductor_tipo_documento: 'Seleccione un tipo de documento de la lista.',
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.placa = null;
    this.vehiculo = null;
    this.propietario = null;
    this.conductor = null;
    this.firma = null;

    this.#funcListener(this);
  }

  setClases(_placa, _vehiculo, _propietario, _conductor, _firma) {
    this.placa = _placa;
    this.vehiculo = _vehiculo;
    this.propietario = _propietario;
    this.conductor = _conductor;
    this.firma = _firma;
  }

  setIngresoPorID(_data, _pla, _vez) {
    let _veh_exists = Object.keys(_data.vehiculo).length;

    this.setDefaultFormulario();
    this.vehiculo.setDefaultContainers();
    this.firma.set_default();
    this.firma.set_resize(); //¿
    this.vehiculo.setId(_veh_exists > 0 ? _data.vehiculo[0].id : 0);
    this.vehiculo.setPlaca(_veh_exists > 0 ? _data.vehiculo[0].placa : _pla);
    this.vehiculo.setVez(_veh_exists > 0 ? _vez : 1);
    // con resultados
    if (_veh_exists > 0) {
      // dispara el buscar
      this.getInformacionVehiculo(_data);
    }
  }

  setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    this.firma.set_default();
    $('#form-ingreso').trigger('reset');
    $('#form-tipo-servicio-placa').hide(200);
    $('#form-datos-cliente-buscar').hide(200);
    $('#form-ingreso').show(200);
  }

  getInformacionVehiculo(_data) {
    let _class = this;
    let data_veh = _data.vehiculo[0];
    let data_prop = data_veh.propietario;
    let data_cond = data_veh.conductor;

    _class.vehiculo.setTipo(data_veh.tipo.id);
    _class.vehiculo.setServicio(data_veh.servicio.id);
    _class.vehiculo.setMarca(data_veh.marca.nombre, data_veh.marca.id);
    _class.vehiculo.setLinea(data_veh.linea.nombre, data_veh.linea.id);
    _class.vehiculo.setModelo(data_veh.modelo);
    _class.vehiculo.setColor(data_veh.color.nombre, data_veh.color.id);
    _class.vehiculo.setCarroceria(data_veh.tipo_carroceria.nombre, data_veh.tipo_carroceria.id);
    _class.vehiculo.setCombustible(data_veh.combustible.id);
    // _class.vehiculo.setCertificadoGNCV(data_veh.);
    // _class.vehiculo.setFechaGNCV(data_veh.);
    _class.vehiculo.setCapacidad(data_veh.pasajeros);
    _class.vehiculo.setPuertas(data_veh.numero_puertas);
    _class.vehiculo.setEnseniaza(data_veh.ensenanza);
    _class.vehiculo.setTipoCaja(data_veh.tipo_caja.id);
    _class.vehiculo.setTiemposMotor(data_veh.tiempos_motor.id);
    _class.vehiculo.setDisenio(data_veh.disenio.id);
    _class.vehiculo.setBlindado(data_veh.blindado);
    _class.vehiculo.setPolarizado(data_veh.polarizado);

    _class.propietario.setTipoDocumento(data_prop.tipo_documento);
    _class.propietario.setDocumento(data_prop.documento);
    _class.propietario.setNombre(data_prop.nombre);
    _class.propietario.setApellido(data_prop.apellido);
    _class.propietario.setTelefono(data_prop.telefono);
    _class.propietario.setCorreo(data_prop.correo);
    _class.propietario.setDireccion(data_prop.direccion);
    _class.propietario.setIdPropietario(data_prop.id);

    _class.conductor.setTipoDocumento(data_cond.tipo_documento);
    _class.conductor.setDocumento(data_cond.documento);
    _class.conductor.setNombre(data_cond.nombre);
    _class.conductor.setApellido(data_cond.apellido);
    _class.conductor.setTelefono(data_cond.telefono);
    _class.conductor.setCorreo(data_cond.correo);
    _class.conductor.setIdconductor(data_cond.id);
  }

  // setIngresoPorID(_id = 1, _placa = 'ABC123', _vez = 1) {
  //   this.setDefaultFormulario();

  //   this.vehiculo.setDefaultContainers();
  //   this.firma.set_default();
  //   this.firma.set_resize(); //
  //   this.vehiculo.setId(_id);
  //   this.vehiculo.setPlaca(_placa);
  //   this.vehiculo.setVez(_vez);
  //   // con resultados
  //   if (_id > 0) {
  //     // dispara el buscar
  //     this.getInformacionVehiculo(_id);
  //   }
  // }

  /*setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    this.firma.set_default();
    $('#form-ingreso').trigger('reset');
    $('#form-tipo-servicio-placa').trigger('reset');
    $('#form-tipo-servicio-placa').show(200);
    $('#form-ingreso').hide(200);
  }*/

  // getInformacionVehiculo(_id) {
  //   // ajax
  //   let _class = this;

  //   //_class.vehiculo.setModelo(123);
  //   //_class.vehiculosetColor(123);
  //   //_class.vehiculo.setCarroceria(123);
  //   //_class.propietario.setNombres(123);
  //   //_class.propietario.setApellidos(123);
  // }

  datosSubmit() {
    let _configForm = {
      form: new FormData($('#form-ingreso')[0]),
      form_temp: new FormData(),
      class: this,
      defecto: {
        contador: 0,
      },
      criterio: {
        contador: 0,
      },
    };

    let tempCriterio = {},
      tempDefecto = {};
    for (const [key, value] of _configForm.form) {
      if (key === 'criterio[' + _configForm.criterio.contador + ']') {
        tempCriterio[_configForm.criterio.contador] = {
          titulo: $('#label-criterio_' + _configForm.criterio.contador).text(),
          respuesta: value,
        };
        _configForm.criterio.contador++;
      } else if (key === 'defecto[' + _configForm.defecto.contador + ']') {
        tempDefecto[_configForm.defecto.contador] = {
          titulo: _configForm.defecto.contador,
          respuesta: value,
        };
        _configForm.defecto.contador++;
      }
    }
    _configForm.form.append('defecto', JSON.stringify(tempDefecto));
    _configForm.form.append('criterio', JSON.stringify(tempCriterio));
    _configForm.form.append('firma', _configForm.class.firma.get_blob);

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/ingreso-completo/ingreso.modelo.php?m=Agregar',
          type: 'POST',
          data: _configForm.form,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);

            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              // self.close();
              _configForm.class.placa.setDefaultFormulario();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosSubmit();
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
    });
  }
  #getImageReferenciaLlanta() {
    $.confirm({
      closeIcon: true,
      title: 'Ejemplo',
      content: '<img src="/images/referencia-llanta.jpg">',
      buttons: {
        somethingElse: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
        },
      },
    });
  }
  #funcListener(_class) {
    $('#form-ingreso').on('submit', function (e) {
      if (_class.validacionFormulario.valid() === true) {
        _class.datosSubmit();
      } else {
        let inner_html = '<ul>';
        $.each(_class.validacionFormulario.errorMap, function (index, value) {
          inner_html += '<li><b>' + index.replaceAll('_', ' ') + '</b> : <i>' + value + '</i></li>';
        });
        inner_html += '</ul>';
        $.alert('¡El formulario tiene algunos datos <b>no válidos</b>, verifíquelos! <br>' + inner_html);
      }
      e.preventDefault();
      return false;
    });

    $('#ingreso-reset').on('click', function (e) {
      $.confirm({
        icon: 'fa fa-triangle-exclamation',
        title: 'Alerta',
        content: '<center>¿Está seguro de cancelar?</center>',
        closeIcon: true,
        columnClass: 'xsmall',
        buttons: {
          btnAceptar: {
            text: 'Aceptar',
            btnClass: 'btn-blue',
            action: function () {
              _class.placa.setDefaultFormulario();
            },
          },
          btnCancelar: {
            text: 'Cancelar',
            action: function () {},
          },
        },
      });
      e.preventDefault();
      return false;
    });

    $('#ingreso-btn-referencia-llanta').on('click', function (e) {
      _class.#getImageReferenciaLlanta();
      e.preventDefault();
      return false;
    });
    // legal
    $('#ingreso-btn-leer-condiciones,#ingreso-btn-leer-privacidad,#ingreso-btn-leer-autorizacion').on('click', function (e) {
      let _container = $(this).attr('data-container');
      let _title = $(this).attr('data-title');
      $.confirm({
        icon: 'fa fa-book',
        title: _title,
        content: $('#' + _container).html(),
        closeIcon: true,
        columnClass: 'large',
        buttons: {
          btnAceptar: {
            text: 'Aceptar',
            btnClass: 'btn-blue',
            action: function () {},
          },
        },
      });

      e.preventDefault();
      return false;
    });
  }
}
