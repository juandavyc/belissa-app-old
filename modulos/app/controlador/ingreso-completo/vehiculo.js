export class VehiculoClass {
  constructor(_runClass, _defectoClass) {
    this.runClass = _runClass;
    this.defectoClass = _defectoClass;
    this.#autoCompleteInputs();
    this.#funcListener(this);
  }

  setCriterio() {}

  setId(_id = 0) {
    $('#ingreso-id_vehiculo').val(_id);
  }
  setPlaca(_valor = 'abc123') {
    $('#ingreso-placa_vehiculo').val(_valor);
    $('#ingreso-placa_vehiculo-html').empty().html(_valor);
  }
 
  setTipo(_valor = 1) {
    $('#ingreso-tipo_vehiculo').val(_valor);
    this.#setTipoVehiculoTrigger(_valor);
  }
  setServicio(_valor = 1) {
    $('#ingreso-servicio_vehiculo').val(_valor);
  }
  setVez(_valor = 1) {
    $('#ingreso-vez').val(_valor);
  }
  setMarca(_nombre = 'SIN_MARCA', _id = 1) {
    $('#ingreso-marca-text').val(_nombre);
    $('#ingreso-marca-select').val(_id);
  }
  setLinea(_nombre = 'SIN_LINEA', _id = 1) {
    $('#ingreso-linea-text').val(_nombre);
    $('#ingreso-linea-select').val(_id);
  }
  setModelo(_modelo = 2000) {
    $('#ingreso-modelo').val(_modelo);
  }
  setColor(_nombre = 'SIN_COLOR', _id = 1) {
    $('#ingreso-color-text').val(_nombre);
    $('#ingreso-color-select').val(_id);
  }
  setCarroceria(_nombre = 'SIN_CARROCERIA', _id = 1) {
    $('#ingreso-carroceria-text').val(_nombre);
    $('#ingreso-carroceria-select').val(_id);
  }
  setCombustible(_id = 1) {
    $('#ingreso-combustible').val(_id);
    this.#setCombustibleTrigger(_id);
  }

  setCertificadoGNCV(_valor = 'NO_APLICA') {
    $('#ingreso-certificado_gncv').val(_valor);
  }
  setFechaGNCV(_valor = '01/01/2000') {
    $('#ingreso-fecha_gncv').val(_valor);
  }
  setCapacidad(_valor = 2) {
    $('#ingreso-capacidad').val(_valor);
  }
  setPuertas(_valor = 2) {
    $('#ingreso-puertas').val(_valor);
  }
  setEnseniaza(_valor = 1) {
    $('input[name=enseñanza][value=' + _valor + ']').attr('checked', 'checked');
  }
  setKilometraje(_valor = 0) {
    $('#ingreso-kilometraje').val(_valor);
  }

  setTipoCaja(_valor = 0) {
    $('#ingreso-tipo_caja').val(_valor);
  }
  setTiemposMotor(_valor = 1) {
    $('input[name=tiempos_motor][value=' + _valor + ']').attr('checked', 'checked');
  }
  setDisenio(_valor = 1) {
    $('input[name=disenio][value=' + _valor + ']').attr('checked', 'checked');
  }
  setBlindado(_valor = 1) {
    $('input[name=blindado][value=' + _valor + ']').attr('checked', 'checked');
  }
  setPolarizado(_valor = 1) {
    $('input[name=polarizado][value=' + _valor + ']').attr('checked', 'checked');
  }

  setPsiLlantasMoto(_delantera = 29, _trasera = 32) {
    $('#ingreso-llanta-moto-delantera').val(_delantera);
    $('#ingreso-llanta-moto-trasera').val(_trasera);
  }
  setPsiLlantasLiviano(_delizq = 28, _traizq = 32, _trader = 32, _delder = 28, _repuesto = 32) {
    $('#ingreso-llanta-liviano-delantera-izquierda').val(_delizq);
    $('#ingreso-llanta-liviano-trasera-izquierda').val(_traizq);
    $('#ingreso-llanta-liviano-trasera-derecha').val(_trader);
    $('#ingreso-llanta-liviano-delantera-derecha').val(_delder);
    $('#ingreso-llanta-liviano-delantera-respuesto').val(_repuesto);
  }

  #setCombustibleTrigger(_id = 1) {
    if (_id != 'default') {
      if (_id == 2 || _id == 4) {
        $('#container-ingreso-gas-gasolina').show(200);
        this.setCertificadoGNCV('');
        this.setFechaGNCV('');
      } else {
        $('#container-ingreso-gas-gasolina').hide(20);
        this.setCertificadoGNCV('NO_APLICA');
        this.setFechaGNCV('01/01/2000');
      }
    }
  }
  #setTipoVehiculoTrigger(_id = 1) {
    if (_id != 'default') {
      if (_id == 4) {
        this.setFormularioMoto();
        this.setServicio(3);
        this.setCombustible(1);
        this.setCapacidad(2);
        this.setTipoCaja(1);
      } else {
        this.setFormularioLiviano();
        // taxi
        if (_id == 6) {
          this.setServicio(2);
          this.setCombustible('default');
          this.setCapacidad(4);
        } else {
          this.setServicio(3);
          this.setCombustible(1);
        }
        this.setCapacidad(4);
        this.setPuertas(4);
        this.setTipoCaja(1);
      }
    } else {
      this.setServicio('default');
      this.setCombustible('default');
      this.setCapacidad('');
      this.setTipoCaja('default');
    }
  }

  setDefaultContainers() {
    //
    $('#ingreso-placa_vehiculo-html').empty();

    $('#container-ingreso-carroceria').hide(200);
    $('#container-ingreso-puertas').hide(200);
    $('#container-ingreso-polarizado').hide(200);
    $('#container-ingreso-psi-llantas-liviano').hide(200);
    $('#container-ingreso-tiempos-disenio').hide(200);
    $('#container-ingreso-psi-llantas-moto').hide(200);
    $('#container-ingreso-gas-gasolina').hide(200);
  }

  setFormularioLiviano() {
    // mostrar containers
    $('#container-ingreso-carroceria').show(200);
    $('#container-ingreso-puertas').show(200);
    $('#container-ingreso-polarizado').show(200);
    $('#container-ingreso-psi-llantas-liviano').show(200);

    // ocultar containers
    $('#container-ingreso-tiempos-disenio').hide(200);
    $('#container-ingreso-psi-llantas-moto').hide(200);
    $('#container-ingreso-gas-gasolina').hide(200);
    // enviar valores
    this.#setCombustibleTrigger('default');
    this.setCarroceria('SIN_CARROCERIA', 1);
    this.setCapacidad('');
    this.setPuertas('');
    this.setPsiLlantasMoto(0, 0);
    this.setPsiLlantasLiviano('', '', '', '', '');
    this.setTipoCaja('default');

    this.runClass.setCriterio('liviano');
    this.defectoClass.setDefault();
  }

  setFormularioMoto() {
    // mostrar containers
    $('#container-ingreso-tiempos-disenio').show(200);
    $('#container-ingreso-psi-llantas-moto').show(200);
    // ocultar containers
    $('#container-ingreso-carroceria').hide(200);
    $('#container-ingreso-puertas').hide(200);
    $('#container-ingreso-polarizado').hide(200);
    $('#container-ingreso-psi-llantas-liviano').hide(200);
    $('#container-ingreso-gas-gasolina').hide(200);
    // enviar valores
    this.#setCombustibleTrigger('default');
    this.setCarroceria('SIN_CARROCERIA', 1);
    this.setCapacidad(2);
    this.setPuertas(0);
    this.setPsiLlantasMoto('', '');
    this.setPsiLlantasLiviano(0, 0, 0, 0, 0);
    this.setTipoCaja('default');

    this.runClass.setCriterio('moto');
    this.defectoClass.setDefault();
  }

  #funcListener(_class = this) {
    $('#ingreso-btn-kilometraje').on('click', function (e) {
      _class.setKilometraje('NO_FUNCIONAL');
      e.preventDefault();
      return false;
    });
    $('#ingreso-combustible').change(function () {
      _class.#setCombustibleTrigger($(this).val());
    });
    $('#ingreso-tipo_vehiculo').change(function () {
      _class.#setTipoVehiculoTrigger($(this).val());
    });

    $('#ingreso-vehiculo-test-moto').on('click', function (e) {
      _class.setFormularioMoto();
      e.preventDefault();
      return false;
    });

    $('#ingreso-vehiculo-test-liviano').on('click', function (e) {
      _class.setFormularioLiviano();
      e.preventDefault();
      return false;
    });
  }

  #autoCompleteInputs() {
    // marca
    autocompleteCreateFather({
      id_input_text: 'ingreso-marca-text',
      id_input_select: 'ingreso-marca-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_MARCA',
      input_select_default: '1',
      src_table: 'd2JKbGY1S00zRUY5RjN1ZGl5ejFvZz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [
        {
          id_input_text: 'ingreso-linea-text',
          id_input_select: 'ingreso-linea-select',
          input_value_default: '',
          input_select_default: '1',
        },
      ],
    });

    autocompleteCreateSon({
      id_input_text: 'ingreso-linea-text',
      id_input_select: 'ingreso-linea-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/create.php',
      input_value_default: 'SIN_LINEA',
      input_select_default: '1',
      src_table: 'bnlEYmpWaDhDUTYvbFNZcmpEcGo4Zz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      src_father: 'Z0R2dnpPWGtkUlcweUgxMDlnLzRlUT09',
      input_father_name: 'MARCA',
      input_father_text: 'ingreso-marca-text',
      input_father_select: 'ingreso-marca-select',
    });

    autocompleteCreateFather({
      id_input_text: 'ingreso-color-text',
      id_input_select: 'ingreso-color-select',
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
      id_input_text: 'ingreso-carroceria-text',
      id_input_select: 'ingreso-carroceria-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_CARROCERIA',
      input_select_default: '1',
      src_table: 'RXZlYnRwUER3Y3N5RFdaRjcwZUlKdz09',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });

    autocompleteCreateFather({
      id_input_text: 'ingreso-referencia-llanta-text',
      id_input_select: 'ingreso-referencia-llanta-select',
      url_select_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
      url_insert_ajax: PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
      input_value_default: 'SIN_REFERENCIA',
      input_select_default: '1',
      src_table: 'Z3dGaTlybzRYSUszMU9XQWJFcm9DOGVwRHpFVmd6RER2bWEwbEQrbmJETT0=',
      src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
      src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
      input_sons: [],
    });
  }
}
