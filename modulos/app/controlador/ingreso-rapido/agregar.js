export class IngresoClass {
  constructor() {
    this.validacionFormulario = $('#form_ingreso_placa').validate({
      rules: {
        placa: {
          required: true,
          minlength: 5,
          maxlength: 6,
          noSpace: true,
          placaValidator: true,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        tipo: 'Seleccione un tipo de vehículo de la lista.',
        tipo: 'Seleccione un tipo de servicio del vehículo de la lista.',
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });
    this.autoCompleteInputs();
    this.funcListener(this);
  }
  datosSubmit(_firma) {
    let formdata = new FormData($('#form_ingreso_placa')[0]);
    formdata.append('firma_1', _firma.get_blob);

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/ingreso_rtm/ingreso.modelo.php?m=Create',
          type: 'POST',
          data: formdata,
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
              // validateForm1.resetForm();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
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
  setData(_data) {
    console.log(_data);
  }
  getData(_data = 'VEHICULO', _type = 'ID', _value = 0) {
    let _class = this;

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/ingreso_rtm/ingreso.modelo.php?m=getData',
          type: 'POST',
          data: {
            data: _data,
            type: _type,
            value: _value,
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
              _class.resetForm($('#form_ingreso_placa'));
              _class.setData(response.vehiculo[0]);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
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
  resetForm(_form) {
    $(_form).trigger('reset');
  }
  autoCompleteInputs() {
    autocompleteCreateFather({
      id_input_text: 'datos-vehiculo-color-text',
      id_input_select: 'datos-vehiculo-color-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_COLOR',
      input_select_default: '1',
      src_table: 'b1cyeVFnY3cxc3JIMk5GUW5wd3Z1Zz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });

    autocompleteCreateFather({
      id_input_text: 'datos-ingreso-canal-input',
      id_input_select: 'datos-ingreso-canal-select',
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
      id_input_text: 'datos-vehiculo-marca-text',
      id_input_select: 'datos-vehiculo-marca-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
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
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/create.php',
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
    const json_firma_1 = {
      id_container: 'canvas_firma_1',
      title_label: 'Firma',
      responsive: '#canvas_firma_1',
    };
    let firma_1 = new canvas_firma(json_firma_1);

    $('#btn_next').on('click', function (e) {
      let _placa = $('#datos-vehiculo-placa');
      if (_placa.valid()) {
        _class.getData('VEHICULO', 'PLACA', _placa.val());

        $('#container-ingreso-placa').hide(100);
        $('#container-ingreso-datos').show(100);
        $('#form_2_placa').html($('#datos-vehiculo-placa').val());
      }
    });

    $('#form_0_servicio').on('change', function (e) {
      let val_ser = $(this).val();
      let placa_inp = $('#form_2_placa');

      if (val_ser == 3) {
        placa_inp.removeClass();
        placa_inp.addClass('vh-placa');
      } else if (val_ser == 2) {
        placa_inp.removeClass();
        placa_inp.addClass('vh-placa-publico');
      }
    });

    $('#form_ingreso_placa').on('submit', function (e) {
      if ($(this).valid() === true) {
        if (firma_1.get_status) {
          _class.datosSubmit(firma_1.get_blob);
        } else {
          $.alert('Sin firma');
        }
      }
      e.preventDefault();
      return false;
    });

    $('#btn-add-photo-control').on('click', function (e) {
      let def_actual = 0;
      // console.log("Agregar input de foto con arreglo");

      $('#container-defectos').append(`<div class="col-12">
    <div class="photo-control">
        <div class="photo-info">
            <label>DEFECTO ${def_actual++}</label>
            <input type="text" id="form_3_defecto_${def_actual}" name="form_3_defectos[]" value="/images/sin_imagen.png" readonly />
        </div>
        <div class="photo-buttons">    
            <button class="button primary small btn-file-open" id="btn-form_3_defecto_${def_actual}" data-folder="uploads/defecto" input-id="form_3_defecto_${def_actual}"></button>
            <button class="button primary small btn-camera-open" id="btn-form_3_defecto_${def_actual}" data-folder="uploads/defecto" input-id="form_3_defecto_${def_actual}"></button>
            <button class="button primary small btn-camera-show" data-id="form_3_defecto_${def_actual}"></button>    
        </div>
    </div>
    </div>`);

      e.preventDefault;
      return false;
    });
  }
}
