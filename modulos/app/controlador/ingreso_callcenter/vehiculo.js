export class VehiculoClass {
  constructor() {
    this.validacionFormulario = $('#form_datos_vehiculo').validate({
      rules: {
        placa: {
          required: true,
          minlength: 6,
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
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        tipo: 'Seleccione un tipo de vehículo de la lista.',
        tipo: 'Seleccione un tipo de servicio del vehículo de la lista.',
        acepto_terminos_condiciones:
          'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });
 
    this.autoCompleteInputs();
    this.funcListener(this);
  }

  datosSubmit() {
    let _class = this;
    let form_data = new FormData($('#form_ingreso_basico')[0]);
    let self = $.confirm({
      title: false,
      content: "Cargando, espere...",
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            "/modulos/app/modelo/ingreso_callcenter/ingreso_callcenter.modelo.php?m=Create",
          type: "POST",
          data: form_data,
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

              console.log("bien");
              console.log(response);
              // validateForm1.resetForm();
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              self.close();
              call_recuperar_session(function (k) {
                func_agregar_submit();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
            }
          })
          .fail(function (response) {
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
            console.log(response);
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }

  
  datosEditar() {
    $('#btn-datos-vehiculo-editar').text('Espere...').prop('disabled', true);
    setTimeout(function () {
      $('#btn-datos-vehiculo-editar').text(' Editar').prop('disabled', false);
      $('#container-datos-vehiculo-guardar').show(200);
      $('#datos-vehiculo-terminos-condiciones').prop('checked', false);

      $('#form_datos_vehiculo select').prop('disabled', false);
      $('#form_datos_vehiculo :radio').prop('disabled', false);
      $('#form_datos_vehiculo :input').prop('readonly', false);
    }, 500);
  } 


  datosRecargar(_rol = 'ID') {

    let _class = this;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/ingreso_callcenter/ingreso_callcenter.modelo.php?m=VehiculoInfo',
          type: 'POST',
          data: {
            vehiculo: $('#datos-vehiculo-id').val(),
            rol: _rol
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === 'bien') {

              _class.setDatosDefault(1,false);

              self.setTitle('Completado!');
              self.setContent('Espere un momento...');

              _class.setDatos(response.vehiculo[0]);

              self.close();
            } else if(response.statusText === 'sin_resultados'){
              _class.setDatosDefault(1,false);
              self.close();
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


  datosInfo(_data = '0',_rol = 'ID') {

    let _class = this;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/ingreso_callcenter/ingreso_callcenter.modelo.php?m=VehiculoInfo',
          type: 'POST',
          data: {
            vehiculo: _data,
            rol: _rol
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {

              _class.setDatosDefault(1,false);
              //alerta sobre que el vehiculo ya tuvo un ingreso anteriormente, 

              $.confirm({
                icon: 'fa fa-warning',
                title: '! Alerta ¡',
                content: `
                <center>
                ¿Este vehiculo ya contiene datos, si los cambia será permanentemente?
                </center> `,
                typeAnimated: true,
                scrollToPreviousElement: false,
                scrollToPreviousElementAnimate: false,
                columnClass: 'xsmall',
                closeIcon: true,
                buttons: {
                  si: {
                    text: 'Si',
                    btnClass: 'btn-blue',
                    action: function () {},
                  },
                  no: {
                    text: 'No',
                    action: function () {
                      _class.setDatosDefault(1,false);
                    },
                  },
                },
              });



              //si edita sera bajo su propia responsabilidad, los datos de la sesion seran almacenados
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');
              
              _class.setDatos(response.vehiculo[0]);
              
              self.close();
            } else if(response.statusText === 'sin_resultados'){

              _class.setDatosDefault(1,false);
              self.close();
            } else{

              _class.setDatosDefault(1,false);
              self.close();
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


  setDatosDefault(_reset= 1,_hide = true) {

    $(
      `#datos-vehiculo-id-html,#datos-conductor-id-html,#datos-propietario-id-html`
    ).empty();


      $('#datos-vehiculo-tipo').val('default');
      $('#datos-vehiculo-servicio').val('default');
      $('#datos-vehiculo-modelo').val('');
      $('#datos-vehiculo-ensenanza-no').val(2);
      $('#datos-vehiculo-marca-text').val('SIN_MARCA');
      $('#datos-vehiculo-marca-select').val(1);
      $('#datos-vehiculo-linea-text').val('SIN_LINEA');
      $('#datos-vehiculo-linea-select').val(1);
      $('#datos-vehiculo-color-text').val('SIN_COLOR');
      $('#datos-vehiculo-color-select').val(1);


      $("#datos-conductor-id-html").empty();
      
      $('#datos-conductor-documento').val('');
      $('#datos-conductor-nombre').val('');
      $('#datos-conductor-apellido').val('');
      $('#datos-conductor-telefono-1').val('');
      $('#datos-conductor-telefono-2').val('');
      $('#datos-conductor-telefono-3').val('');
      $('#datos-conductor-email').val('');
      $('#datos-conductor-direccion').val('');
      
      $("#datos-propietario-id-html").empty();
      
      $('#datos-propietario-documento').val('');
      $('#datos-propietario-nombre').val('');
      $('#datos-propietario-apellido').val('');
      $('#datos-propietario-telefono-1').val('');
      $('#datos-propietario-telefono-2').val('');
      $('#datos-propietario-telefono-3').val('');
      $('#datos-propietario-email').val('');
      $('#datos-propietario-direccion').val('');


    // $('#form_ingreso_basico').trigger('reset');
  }
  setDatosReadOnly() {
    $('#form_datos_vehiculo select').prop('disabled', true);
    $('#form_datos_vehiculo :radio').prop('disabled', true);
    $('#form_datos_vehiculo :input').prop('readonly', true);

    $('#container-datos-vehiculo-guardar').hide(200);

    $('#datos-vehiculo-terminos-condiciones').prop('checked', false);
  }


  setDatos(_response) {
    this.setDatosDefault(1,false);

    $('#btn-datos-vehiculo-recargar')
      .text(' Espere... ')
      .prop('disabled', true);

    $('#datos-vehiculo-top-id-html,#datos-vehiculo-id-html').html(_response.id);

    $('#datos-vehiculo-placa-html').html(_response.placa);

    $('#datos-vehiculo-id').val(_response.id);
    $('#datos-vehiculo-placa').val(_response.placa);
    $('#datos-vehiculo-tipo').val(
      _response.tipo.id == 1 ? 'default' : _response.tipo.id
    );
    $('#datos-vehiculo-servicio').val(
      _response.servicio.id == 1 ? 'default' : _response.servicio.id
    );
    $('#datos-vehiculo-modelo').val(_response.modelo);

    $(
      '#form_datos_vehiculo input[name=ensenanza][value=' +
        _response.ensenanza +
        ']'
    ).prop('checked', true);

    $('#datos-vehiculo-marca-text').val(_response.marca.nombre);
    $('#datos-vehiculo-marca-select').val(_response.marca.id);
    $('#datos-vehiculo-linea-text').val(_response.linea.nombre);
    $('#datos-vehiculo-linea-select').val(_response.linea.id);
    $('#datos-vehiculo-color-text').val(_response.color.nombre);
    $('#datos-vehiculo-color-select').val(_response.color.id);

    $('#datos-propietario-id-html').html(_response.propietario.cliente[0].id);
    $('#datos-propietario-id').val(_response.propietario.cliente[0].id);
    $('#datos-propietario-documento').val(_response.propietario.cliente[0].documento.numero);
    $('#datos-propietario-nombre').val(_response.propietario.cliente[0].nombre);
    $('#datos-propietario-apellido').val(_response.propietario.cliente[0].apellido);
    $('#datos-propietario-telefono-1').val(_response.propietario.cliente[0].telefono.uno);
    $('#datos-propietario-telefono-2').val(_response.propietario.cliente[0].telefono.dos);
    $('#datos-propietario-telefono-3').val(_response.propietario.cliente[0].telefono.tres);
    $('#datos-propietario-email').val(_response.propietario.cliente[0].email);
    $('#datos-propietario-direccion').val(_response.propietario.cliente[0].direccion);

    $('#form_datos_propietario :input').prop('readonly', true);
    $('#container-datos-propietario-guardar').hide(200);


    $('#datos-conductor-id-html').html(_response.conductor.cliente[0].id);
    $('#datos-conductor-id').val(_response.conductor.cliente[0].id);
    $('#datos-conductor-documento').val(_response.conductor.cliente[0].documento.numero);
    $('#datos-conductor-nombre').val(_response.conductor.cliente[0].nombre);
    $('#datos-conductor-apellido').val(_response.conductor.cliente[0].apellido);
    $('#datos-conductor-telefono-1').val(_response.conductor.cliente[0].telefono.uno);
    $('#datos-conductor-telefono-2').val(_response.conductor.cliente[0].telefono.dos);
    $('#datos-conductor-telefono-3').val(_response.conductor.cliente[0].telefono.tres);
    $('#datos-conductor-email').val(_response.conductor.cliente[0].email);
    $('#datos-conductor-direccion').val(_response.conductor.cliente[0].direccion);

    $('#form_datos_conductor :input').prop('readonly', true);
    $('#container-datos-conductor-guardar').hide(200);



    setTimeout(function () {
      $('#btn-datos-vehiculo-recargar')
        .text(' Recargar')
        .prop('disabled', false);
    }, 500);
  }
  autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'datos-vehiculo-color-text',
      id_input_select: 'datos-vehiculo-color-select',
      url_select_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_COLOR',
      input_select_default: '1',
      src_table: 'b1cyeVFnY3cxc3JIMk5GUW5wd3Z1Zz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });

    autocompleteCreateFather({
      id_input_text: 'datos-vehiculo-marca-text',
      id_input_select: 'datos-vehiculo-marca-select',
      url_select_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_MARCA',
      input_select_default: '1',
      src_table: 'd2JKbGY1S00zRUY5RjN1ZGl5ejFvZz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [
        {
          id_input_text: 'datos-vehiculo-linea-text',
          id_input_select: 'datos-vehiculo-linea-select',
          input_value_default: 'SIN_LINEA',
          input_select_default: '1',
        },
      ],
    });

    autocompleteCreateSon({
      id_input_text: 'datos-vehiculo-linea-text',
      id_input_select: 'datos-vehiculo-linea-select',
      url_select_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/search.php',
      url_insert_ajax:
        PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/create.php',
      input_value_default: 'SIN_LINEA',
      input_select_default: '1',
      src_table: 'bnlEYmpWaDhDUTYvbFNZcmpEcGo4Zz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      src_father: 'Z0R2dnpPWGtkUlcweUgxMDlnLzRlUT09',
      input_father_name: 'MARCA',
      input_father_text: 'datos-vehiculo-marca-text',
      input_father_select: 'datos-vehiculo-marca-select',
    });
  }


  funcListener(_class) {
    $('#form_ingreso_basico').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
    $('#btn-datos-vehiculo-editar').on('click', function (e) {
      _class.datosEditar();
      e.preventDefault();
      return false;
    });

    $('#btn-datos-vehiculo-recargar').on('click', function (e) {
      _class.datosRecargar();
      e.preventDefault();
      return false;
    });
    $('#datos-vehiculo-placa').focusout(function (e) {

      if (!$(this).is('[readonly]')) {
        _class.datosInfo($(this).val().toUpperCase(),'PLACA');
      }
      e.preventDefault();
      return false;
    });
    $('#form_reset').on('click', function (e) {
      $.confirm({
        icon: 'fa fa-warning',
        title: '! Alerta ¡',
        content: `
        <center>
        ¿Está seguro que continuar?
        </center> `,
        typeAnimated: true,
        scrollToPreviousElement: false,
        scrollToPreviousElementAnimate: false,
        columnClass: 'xsmall',
        closeIcon: true,
        buttons: {
          si: {
            text: 'Si',
            btnClass: 'btn-blue',
            action: function () {
              _class.setDatosDefault(1,false);
            },
          },
          no: {
            text: 'No',
            action: function () {},
          },
        },
      });
      e.preventDefault();
      return false;
    });

    $('#form_datos_vehiculo_reset').on('click', function (e) {
      $.confirm({
        icon: 'fa fa-warning',
        title: '! Alerta ¡',
        content: `
        <center>
        ¿Está seguro que continuar?
        </center> `,
        typeAnimated: true,
        scrollToPreviousElement: false,
        scrollToPreviousElementAnimate: false,
        columnClass: 'xsmall',
        closeIcon: true,
        buttons: {
          si: {
            text: 'Si',
            btnClass: 'btn-blue',
            action: function () {
              _class.setDatosDefault(2,false);
            },
          },
          no: {
            text: 'No',
            action: function () {},
          },
        },
      });
      e.preventDefault();
      return false;
    });
  }
}


