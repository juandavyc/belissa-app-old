export class IngresoClass {
  constructor() {
    this.camposHidden = {
      required: true,
      valueNotEquals: ''
    };
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
        marca: this.camposHidden,
        linea: this.camposHidden,
        color: this.camposHidden,
        carroceria: this.camposHidden,
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
        llanta_referencia: this.camposHidden,
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
          valueNotEquals: '1110',
        },
        propietario_nombres: {
          required: true,
          minlength: 2,
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
        propietario_correo_dominio: { required: true },
        direccion_propietario: {
          maxlength: 50,
          alphanumeric: true,
        },
        eres_conductor: {
          required: true,
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
          valueNotEquals: '1110',
        },
        conductor_nombres: {
          required: true,
          minlength: 2,
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
        conductor_correo_dominio: { required: true },

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

    this.firmaBlob = null;
    this.firmaResumen = new MyModal({
      container: 'modal-ingreso-firma',
      title: 'Ingreso Firma',
      icon: 'fa fa-warning',
      columnClass: 'mx',
      closeIcon: true,
      event: {
        onOpen: () => {
          setTimeout(() => {
            this.firmaResumen.scrollTopContent(0);
            this.firma.setResize();
          }, 500);
        },
        onClose: () => {
          this.firmaBlob = this.firma.getBlob;
         },
      },
    });

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
    this.firma.setDefault();
    this.firma.setResize();
    this.vehiculo.setId(_veh_exists > 0 ? _data.vehiculo[0].id : 0);
    this.vehiculo.setPlaca(_veh_exists > 0 ? _data.vehiculo[0].placa : _pla);
    this.vehiculo.setVez(_veh_exists > 0 ? _vez : 1);
    // con resultados
    if (_veh_exists > 0) {
      // dispara el buscar
      this.getInformacionVehiculo(_data);

      $('#container-propietario-datos').show(200);
    }
  }

  setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    this.firma.setDefault();
    this.propietario.setDatosDefault();
    this.conductor.setDatosDefault();
    this.firmaBlob = null;

    $('#form-ingreso').trigger('reset');
    $('#container-placa').hide(200);
    $('#form-datos-cliente-buscar').hide(200);
    $('#form-ingreso').show(200);

    autoCompleteForceCloseAllLists();
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
    _configForm.form.append('firma', _configForm.class.firmaBlob);

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('ingreso-completo/Ingreso', 'Create'),
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
            if (response.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              // self.close();
              _configForm.class.socketAbrirVentana(response.fecha, () => {
                _configForm.class.placa.setDefaultFormulario();
              });
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _configForm.class.datosSubmit();
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
  }

  socketAbrirVentana(_fecha, _callback) {
    const arraySocket = {
      'ip': '192.168.1.174',
      'puerto': 6789,
      'pagina': 'http://192.168.1.174/printservice.php',
      'status': 'yes',
    };

    let tempCorreo = '';
    const isConductor = $('input[name="eres_conductor"]:checked').val();
    const jsonImprimir = {
      placa: $("#ingreso-placa_vehiculo").val(),
      tipo: $("#ingreso-tipo_vehiculo option:selected").text(),
      servicio: $("#ingreso-servicio_vehiculo option:selected").text(),
      kilometraje: $("#ingreso-kilometraje").val(),
      vez: $("#ingreso-vez").val(),
      telefono: '',
      direccion: $("#ingreso-direccion_propietario").val(),
      correo: '',
      fecha: _fecha,
    };


    if (isConductor == 2) {
      tempCorreo = ($("#ingreso-correo_propietario").val()).toUpperCase();
      tempCorreo += '@';
      tempCorreo += $("#ingreso-correo_propietario-text").val().toUpperCase();

      jsonImprimir.correo = tempCorreo;
      jsonImprimir.telefono = ($("#ingreso-telefono_propietario").val()).toUpperCase();
    }
    else {
      tempCorreo = ($("#ingreso-correo_conductor").val()).toUpperCase();
      tempCorreo += '@';
      tempCorreo += $("#ingreso-correo_conductor-text").val().toUpperCase();

      jsonImprimir.correo = tempCorreo;
      jsonImprimir.telefono = ($("#ingreso-telefono_conductor").val()).toUpperCase();
    }

    let url = arraySocket.pagina;
    url += "?json=";
    url += encodeURIComponent(JSON.stringify(jsonImprimir));
    url += "&config=";
    url += encodeURIComponent(JSON.stringify(arraySocket));
    window.open(url, "Helix Printer Service", "width=400,height=500");

    _callback();
  }
  setDatosModalResumen() {

    let inner_html = `
<div class="row gtr-25 gtr-uniform">
    <div class="col-12 align-center">
        <div class="vh-placa">${this.vehiculo.getPlaca()}</div>
        <label class="label-orange"> DATOS DEL VEHÍCULO </label>
    </div>
    <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-5">
                <label class="label-datos"> TIPO </label>
            </div>
            <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getTipo()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> SERVICIO </label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getServicio()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> CARROCERIA </label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getCarroceria()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> VEZ</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getVez()}</label>
            </div>
        </div>
    </div>
    <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-5">
                <label class="label-datos"> MODELO</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getModelo()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> MARCA</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getMarca()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> LINEA</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getLinea()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> COLOR</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getColor()}</label>
            </div>
        </div>
    </div>
    <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-5">
                <label class="label-datos"> KILOMETRAJE</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getKilometraje()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> combustible</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getCombustible()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> FECHA GNCV</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getFechaGNCV()}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> NRO GNCV</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${this.vehiculo.getCertificadoGNCV()}</label>
            </div>
        </div>
    </div>
    <div class="col-8 col-12-small">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12 align-center">
                <label class="label-orange"> GENERAL</label>
            </div>
            <div class="col-6 col-12-small">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-5">
                        <label class="label-datos"> CAPACIDAD</label>
                    </div>
                     <div class="col-7">
                        <label class="label-resultados">${this.vehiculo.getCapacidad()}</label>
                    </div>
                    <div class="col-5">
                        <label class="label-datos"> PUERTAS</label>
                    </div>
                     <div class="col-7">
                        <label class="label-resultados">${this.vehiculo.getPuertas()}</label>
                    </div>
                    <div class="col-5">
                        <label class="label-datos"> CAJA</label>
                    </div>
                     <div class="col-7">
                        <label class="label-resultados">${this.vehiculo.getPuertas()}</label>
                    </div>
                </div>
            </div>
            <div class="col-6 col-12-small">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-5">
                        <label class="label-datos"> Blindado</label>
                    </div>
                     <div class="col-7">
                        <label class="label-resultados">${(this.vehiculo.getBlindado() == 1 ? 'NO' : 'SI')}</label>
                    </div>
                    <div class="col-5">
                        <label class="label-datos"> Polarizado</label>
                    </div>
                     <div class="col-7">
                        <label class="label-resultados">${(this.vehiculo.getPolarizado() == 1 ? 'NO' : 'SI')}</label>
                    </div>
                    <div class="col-5">
                        <label class="label-datos"> Eneseñanza</label>
                    </div>
                     <div class="col-7">
                        <label class="label-resultados">${(this.vehiculo.getEnseniaza() == 1 ? 'NO' : 'SI')}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12 align-center">
                <label class="label-orange"> MOTOS</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> MOTOR</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${(this.vehiculo.getTiemposMotor() == 1 ? '4T' : '2T')}</label>
            </div>
            <div class="col-5">
                <label class="label-datos"> DISEÑO</label>
            </div>
             <div class="col-7">
                <label class="label-resultados">${(this.vehiculo.getDisenio() == 1 ? 'CONVENCIONAL' : 'SCOOTER')}</label>
            </div>
        </div>
    </div>`;
    inner_html += `
    <div class="col-12">
      <label class="label-orange"> PSI </label>
    </div>`;
    if (this.vehiculo.getTipo() === 'MOTO') {
      inner_html += `
      <div class="col-12">
        <p>${this.vehiculo.getPsiLlantasMoto()}</p>
      </div>`;
    }
    else {
      inner_html += `
      <div class="col-12">
        <p>${this.vehiculo.getPsiLlantasLiviano()}</p>
      </div>`;
    }
    inner_html += `
    <div class="col-12">
        <fieldset class="fieldset-alt">
            <legend><i class="fas fa-user"></i> PROPIETARIO</legend>
            <div class="row gtr-25 gtr-uniform">
                <div class="col-5">
                    <label class="label-datos"> DOCUMENTO</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.propietario.getDocumento()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> NOMBRE</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.propietario.getNombre()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> APELLIDO </label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.propietario.getApellido()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> TELEFONO</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.propietario.getTelefono()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> CORREO</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.propietario.getCorreo()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> DIRECCION</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.propietario.getDireccion()}</label>
                </div>
            </div>
        </fieldset>
    </div>`;
    if ($('input[name=eres_conductor]:checked').val() == 1) {
      inner_html += `
      <div class="col-12">
        <fieldset class="fieldset-alt">
            <legend><i class="fas fa-user"></i> CONDUCTOR</legend>
            <div class="row gtr-25 gtr-uniform">
                <div class="col-5">
                    <label class="label-datos"> DOCUMENTO</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.conductor.getDocumento()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> NOMBRE</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.conductor.getNombre()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> APELLIDO </label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.conductor.getApellido()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> TELEFONO</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.conductor.getTelefono()}</label>
                </div>
                <div class="col-5">
                    <label class="label-datos"> CORREO</label>
                </div>
                <div class="col-7">
                    <label class="label-resultados">${this.conductor.getCorreo()}</label>
                </div>               
            </div>
        </fieldset>
      </div>
      `;
    }
    inner_html += `
    <div class="col-5">
        <label class="label-datos"> CANAL</label>
    </div>
    <div class="col-7">
        <label class="label-resultados">${this.conductor.getCanalMercadeo()}</label>
    </div>
</div>`;

    $('#modal-ingreso-resumen').empty().html(inner_html);
    this.firmaResumen.open();
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
      if (_class.firma.getStatus) {
        if (_class.validacionFormulario.valid() === true) {
          _class.datosSubmit();
        } else {
          validateFormError(_class.validacionFormulario);
        }
      } else {
        $.alert("Falta la firma");
      }
      e.preventDefault();
      return false;
    });

    $('#btn-guardar-blob').on('click', function (e) {
      e.preventDefault();
      if (_class.firma.getStatus) {        
        _class.firmaResumen.close();
      }
      else {
        $.alert("Falta la firma");
      }
    });
    
    $('#btn-firma-disparador').on('click', function (e) {
      e.preventDefault();
      _class.setDatosModalResumen();
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
            action: function () { },
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
            action: function () { },
          },
        },
      });

      e.preventDefault();
      return false;
    });
  }
}
