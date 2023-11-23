export class VehiculoClass {
  constructor(_runClass) {
    this.runClass = _runClass;
    // this.defectoClass = _defectoClass;
    this.#autoCompleteInputs();
    this.#funcListener(this);
  }

  setCriterio() { }

  setId(_id = 0) {
    $('#ingreso-id_vehiculo').val(_id);
  }

  setPlaca(_valor = 'abc123') {
    $('#ingreso-placa_vehiculo').val(_valor);
    $('#ingreso-placa_vehiculo-html').empty().html(_valor);
  }

  getPlaca() {
    return $('#ingreso-placa_vehiculo').val();
  }

  setTipo(_valor = 1) {
    $('#ingreso-tipo_vehiculo').val(_valor);
    this.#setTipoVehiculoTrigger(_valor);
  }

  getTipo() {
    return $('#ingreso-tipo_vehiculo option:selected').text();
  }

  setServicio(_valor = 1) {
    $('#ingreso-servicio_vehiculo').val(_valor);
  }

  getServicio() {
    return $('#ingreso-servicio_vehiculo option:selected').text();
  }

  setVez(_valor = 1) {
    $('#ingreso-vez').val(_valor);
  }

  getVez() {
    return $('#ingreso-vez').val();
  }

  setMarca(_nombre = 'SIN_MARCA', _id = 1) {
    $('#ingreso-marca-text').val(_nombre);
    $('#ingreso-marca-select').val(_id);
  }

  getMarca() {
    return $('#ingreso-marca-text').val()
  }

  setLinea(_nombre = 'SIN_LINEA', _id = 1) {
    $('#ingreso-linea-text').val(_nombre);
    $('#ingreso-linea-select').val(_id);
  }

  getLinea() {
    return $('#ingreso-linea-text').val()
  }

  setModelo(_modelo = 2000) {
    $('#ingreso-modelo').val(_modelo);
  }

  getModelo() {
    return $('#ingreso-modelo').val()
  }

  setColor(_nombre = 'SIN_COLOR', _id = 1) {
    $('#ingreso-color-text').val(_nombre);
    $('#ingreso-color-select').val(_id);
  }
  getColor() {
    return $('#ingreso-color-text').val();
  }

  getModelo() {
    return $('#ingreso-color-text').val()
  }

  setCarroceria(_nombre = 'SIN_CARROCERIA', _id = 1) {
    $('#ingreso-carroceria-text').val(_nombre);
    $('#ingreso-carroceria-select').val(_id);
  }

  getCarroceria() {
    return $('#ingreso-carroceria-text').val()
  }

  setCombustible(_id = 1) {
    $('#ingreso-combustible').val(_id);
    this.#setCombustibleTrigger(_id);
  }

  getCombustible() {
    return $('#ingreso-combustible option:selected').text();
  }

  setCertificadoGNCV(_valor = 'NO_APLICA') {
    $('#ingreso-certificado_gncv').val(_valor);
  }

  getCertificadoGNCV() {
    return $('#ingreso-certificado_gncv').val()
  }

  setFechaGNCV(_valor = '01/01/2000') {
    $('#ingreso-fecha_gncv').val(_valor);
  }

  getFechaGNCV() {
    return $('#ingreso-fecha_gncv').val()
  }

  setCapacidad(_valor = 2) {
    $('#ingreso-capacidad').val(_valor);
  }
  getCapacidad() {
    return $('#ingreso-capacidad').val()
  }
  setPuertas(_valor = 2) {
    $('#ingreso-puertas').val(_valor);
  }
  getPuertas() {
    return $('#ingreso-puertas').val()
  }
  setEnseniaza(_valor = 1) {
    $('input[name=enseñanza][value=' + _valor + ']').attr('checked', 'checked');
  }
  getEnseniaza() {
    return $('input[name=enseñanza]:checked').val()
  }
  setKilometraje(_valor = 0) {
    $('#ingreso-kilometraje').val(_valor);
  }
  getKilometraje() {
    return $('#ingreso-kilometraje').val();
  }
  setTipoCaja(_valor = 0) {
    $('#ingreso-tipo_caja').val(_valor);
  }
  getTipoCaja() {
    return $('#ingreso-tipo_caja').val();
  }
  setTiemposMotor(_valor = 1) {
    $('input[name=tiempos_motor][value=' + _valor + ']').attr('checked', 'checked');
  }
  getTiemposMotor() {
    return $('input[name=tiempos_motor]:checked').val();
  }
  setDisenio(_valor = 1) {
    $('input[name=disenio][value=' + _valor + ']').attr('checked', 'checked');
  }
  getDisenio() {
    return $('input[name=disenio]:checked').val();
  }
  setBlindado(_valor = 1) {
    $('input[name=blindado][value=' + _valor + ']').attr('checked', 'checked');
  }
  getBlindado() {
    return $('input[name=blindado]:checked').val();
  }
  setPolarizado(_valor = 1) {
    $('input[name=polarizado][value=' + _valor + ']').attr('checked', 'checked');
  }
  getPolarizado() {
    return $('input[name=polarizado]:checked').val();
  }

  setPsiLlantasMoto(_delantera = 29, _trasera = 32) {
    $('#ingreso-llanta-moto-delantera').val(_delantera);
    $('#ingreso-llanta-moto-trasera').val(_trasera);
  }
  getPsiLlantasMoto() {
    return `
    Delantera :
    ${$('#ingreso-llanta-moto-delantera').val()} 
    <br> Trasera : 
    ${$('#ingreso-llanta-moto-trasera').val()}
    `
  }
  setPsiLlantasLiviano(_delizq = 28, _traizq = 32, _trader = 32, _delder = 28, _repuesto = 32) {
    $('#ingreso-llanta-liviano-delantera-izquierda').val(_delizq);
    $('#ingreso-llanta-liviano-trasera-izquierda').val(_traizq);
    $('#ingreso-llanta-liviano-trasera-derecha').val(_trader);
    $('#ingreso-llanta-liviano-delantera-derecha').val(_delder);
    $('#ingreso-llanta-liviano-respuesto').val(_repuesto);    
  }
  getPsiLlantasLiviano() {
    return `
    Delantera izquierda :
    ${$('#ingreso-llanta-liviano-delantera-izquierda').val()} 
    <br>Trasera izquierda :
    ${$('#ingreso-llanta-liviano-trasera-izquierda').val()}
    <br> Trasera derecha :
    ${$('#ingreso-llanta-liviano-trasera-derecha').val()}
    <br> Delantera derecha :
    ${$('#ingreso-llanta-liviano-delantera-derecha').val()}    
    `
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
    // this.defectoClass.setDefault();
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
    // this.defectoClass.setDefault();
  }

  #funcListener(_class = this) {

    $('#ingreso-btn-kilometraje').on('click', function (e) {
      e.preventDefault();
      _class.setKilometraje('NO_FUNCIONAL');
    });
    $('#ingreso-combustible').change(function () {
      _class.#setCombustibleTrigger($(this).val());
    });
    $('#ingreso-tipo_vehiculo').change(function () {
      _class.#setTipoVehiculoTrigger($(this).val());
    });
    $('#ingreso-vehiculo-test-moto').on('click', function (e) {
      e.preventDefault();
      _class.setFormularioMoto();
    });
    $('#ingreso-vehiculo-test-liviano').on('click', function (e) {
      e.preventDefault();
      _class.setFormularioLiviano();
    });
  }

  #autoCompleteInputs() {

    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("ingreso-marca-text"),
        hidden: document.getElementById("ingreso-marca-select"),
      },
      table: ['id', 'nombre', 'marca'], // column parent ['id_marca']
      childs: [
        document.getElementById("ingreso-linea-text"),
        document.getElementById("ingreso-linea-select")
      ],
      default: [1, 'Seleccione una marca'],
    });

    myAutocomplete({
      parent: document.getElementById("ingreso-marca-select"),
      create: true,
      input: {
        text: document.getElementById("ingreso-linea-text"),
        hidden: document.getElementById("ingreso-linea-select"),
      },
      table: ['id', 'nombre', 'linea', 'id_marca'],
      childs: [],
      default: [1, 'Seleccione una linea'],
    });

    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("ingreso-color-text"),
        hidden: document.getElementById("ingreso-color-select"),
      },
      table: ['id', 'nombre', 'color'],
      childs: [],
      default: [1, 'Seleccione un color'],
    });

    myAutocomplete({
      parent: true,
      create: true,
      input: {
        text: document.getElementById("ingreso-carroceria-text"),
        hidden: document.getElementById("ingreso-carroceria-select"),
      },
      table: ['id', 'nombre', 'tipo_carroceria'],
      childs: [],
      default: [1, 'Seleccione'],
    });



    if (document.getElementById("ingreso-referencia-llanta-text")) {
      myAutocomplete({
        parent: true,
        create: true,
        input: {
          text: document.getElementById("ingreso-referencia-llanta-text"),
          hidden: document.getElementById("ingreso-referencia-llanta-select"),
        },
        table: ['id', 'nombre', 'referencia_llanta'],
        childs: [],
        default: [1, 'Seleccione'],
      });
    }

  }
}
