export class IngresoClass {
  constructor() {
    this.validacionFormulario = $("#form-ingreso").validate({
      rules: {
        tipo_vehiculo: {
          required: true,
          valueNotEquals: "default",
        },
        servicio_vehiculo: {
          required: true,
          valueNotEquals: "default",
        },
        modelo: {
          required: true,
          number: true,
          min: 1800,
          max: 2050,
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
          maxlength: 50,
          noSpace: true,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        tipo_vehiculo: "Seleccione un tipo de vehiculo de la lista.",
        servicio_vehiculo: "Seleccione un servicio de vehiculo de la lista.",
        acepto_terminos_condiciones:
          "Debe aceptar los términos y condiciones de uso.",
      },
      errorPlacement: function (label, element) {
        label.addClass("errorMsq");
        element.parent().append(label);
      },
    });

    this.placa = null;
    this.vehiculo = null;
    this.propietario = null;
    this.conductor = null;
    this.#funcListener(this);
  }


  setClases(_placa, _vehiculo, _propietario, _conductor) {
    this.placa = _placa;
    this.vehiculo = _vehiculo;
    this.propietario = _propietario;
    this.conductor = _conductor;
  }

  setIngresoDatos(_data, _placa) {

    this.setDefaultFormulario();
    this.vehiculo.setDefault();
    if(_data == null){
      this.vehiculo.setId(0);
      this.vehiculo.setPlaca(_placa);
    }
    else{
      let _vehiculo_existe = Object.keys(_data.vehiculo[0]).length;     
      this.vehiculo.setId(_vehiculo_existe > 0 ? _data.vehiculo[0].id : 0);
      this.vehiculo.setPlaca(_vehiculo_existe > 0 ? _data.vehiculo[0].placa : _placa);
      if (_vehiculo_existe > 0) {
        this.setInformacionVehiculo(_data.vehiculo[0]);
      }
    }
    
  }

  setInformacionVehiculo(_data) {

    this.vehiculo.setTipo(_data.tipo.id);
    this.vehiculo.setServicio(_data.servicio.id);
    this.vehiculo.setModelo(_data.modelo);

    this.propietario.setId(_data.propietario.id);
    this.propietario.setTipoDocumento(_data.propietario.tipo_documento);
    this.propietario.setDocumento(_data.propietario.documento);
    this.propietario.setNombre(_data.propietario.nombre);
    this.propietario.setApellido(_data.propietario.apellido);
    this.propietario.setTelefono(_data.propietario.telefono);
    this.propietario.setCorreo(_data.propietario.correo);
    this.propietario.setDireccion(_data.propietario.direccion);

    this.conductor.setId(_data.conductor.id);
    this.conductor.setTipoDocumento(_data.conductor.tipo_documento);
    this.conductor.setDocumento(_data.conductor.documento);
    this.conductor.setNombre(_data.conductor.nombre);
    this.conductor.setApellido(_data.conductor.apellido);
    this.conductor.setTelefono(_data.conductor.telefono);
    this.conductor.setCorreo(_data.conductor.correo);

  }
  setDefaultFormulario() {
    this.validacionFormulario.resetForm();
    $("#form-ingreso").trigger("reset");
    $("#form-tipo-servicio-placa").hide(200);
    $("#form-datos-cliente-buscar").hide(200);
    $("#form-ingreso").show(200);
    autoCompleteForceCloseAllLists();
  }
  datosSubmit() {
    let _configForm = {
      form: new FormData($("#form-ingreso")[0]),
      form_temp: new FormData(),
      class: this,
      defecto: {
        contador: 0,
      },
      criterio: {
        contador: 0,
      },
    };

    let self = $.confirm({
      title: false,
      content: "Cargando, espere...",
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('ingreso-dividido/IngresoDividido', 'VehiculoUpdate'),
          type: "POST",
          data: _configForm.form,
          headers: {
            "csrf-token": $('meta[name="csrf-token"]').attr("content"),
          },
          dataType: "json",
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
           
            if (response.statusText === "bien") {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _configForm.class.placa.setDefaultFormulario();
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
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
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
            // console.log(response);
          });
      },
      buttons: {
        aceptar: function () {
        },
      },
    });


  }

  #funcListener(_class) {
    $("#form-ingreso").on("submit", function (e) {
      if (_class.validacionFormulario.valid() === true) {
        _class.datosSubmit();
      } else {
        let inner_html = "<ul>";
        $.each(_class.validacionFormulario.errorMap, function (index, value) {
          inner_html +=
            "<li><b>" +
            index.replaceAll("_", " ") +
            "</b> : <i>" +
            value +
            "</i></li>";
        });
        inner_html += "</ul>";
        $.alert(
          "¡El formulario tiene algunos datos <b>no válidos</b>, verifíquelos! <br>" +
          inner_html
        );
      }
      e.preventDefault();
      return false;
    });

    $("#ingreso-reset").on("click", function (e) {
      $.confirm({
        icon: "fa fa-triangle-exclamation",
        title: "Alerta",
        content: "<center>¿Está seguro de cancelar?</center>",
        closeIcon: true,
        columnClass: "xsmall",
        buttons: {
          btnAceptar: {
            text: "Aceptar",
            btnClass: "btn-blue",
            action: function () {
              _class.placa.setDefaultFormulario();
            },
          },
          btnCancelar: {
            text: "Cancelar",
            action: function () { },
          },
        },
      });
      e.preventDefault();
      return false;
    });
  }
}
