export class DefectoClass {
  constructor(_config) {
    this.idGlobal = _config.id;
    this.idContainer = _config.id_container;
    this.btnAgregar = _config.btn_agregar;
    this.arrayDefecto = [];
    this.arrayTemp = [];
    this.contadorDefecto = 0;

    this.funcListener(this);
    this.setDefault();
  }

  setEliminar(_id, _class = this) {
    if (parseInt(_class.arrayDefecto.length) > 1) {
      _class.arrayDefecto.splice(parseInt(_id), 1);
      _class.getValoresAlEliminarAgregar(function (k) {
        _class.setDefectoEnHtml();
      });
    } else {
      $.alert('No puede eliminar el defecto 0');
    }
  }

  setAgregar(_class = this) {
    if (parseInt(_class.arrayDefecto.length) <= 8) {
      this.getValoresAlEliminarAgregar(function (k) {
        _class.setArrayPush();
      });
      this.setDefectoEnHtml();
    } else {
      $.alert('Para más defectos, pague la versión PREMIUM');
    }
  }

  getValoresAlEliminarAgregar(_callback, _class = this) {
    _class.arrayTemp = [];
    _class.arrayTemp = _class.arrayDefecto;
    _class.arrayDefecto = [];
    $.each(_class.arrayTemp, function (_key, _value) {
      _class.setArrayPush($('#' + _value.elemento).val());
    });
    _callback();
  }

  setDefault() {
    this.arrayDefecto = [];
    this.arrayTemp = [];
    this.setArrayPush('/images/sin_imagen.png');
    this.setDefectoEnHtml();
  }

  setArrayPush(_value = '/images/sin_imagen.png') {
    this.arrayDefecto.push({
      id: parseInt(this.arrayDefecto.length),
      elemento: this.idGlobal + '_defecto_' + parseInt(this.arrayDefecto.length),
      titulo: 'defecto_' + parseInt(this.arrayDefecto.length),
      src: _value,
    });
  }

  setDefectoEnHtml(_class = this) {
    // let _class = this;
    $(_class.idContainer).empty();
    $.each(_class.arrayDefecto, function (_key, _value) {
      $(_class.idContainer).append(`
        <div class="col-12">
            <div class="photo-control">
                <div class="photo-info">
                    <label>DEFECTO ${_value.id}</label>
                    <input type="text" id="${_value.elemento}" name="defecto[${_value.id}]" value="${_value.src}" readonly />
                </div>
                <div class="photo-buttons">    
                    <button class="button primary small btn-file-open" id="btn-${_value.elemento}" data-folder="ingreso/defectos" input-id="${_value.elemento}"></button>
                    <button class="button primary small btn-camera-open" id="btn-${_value.elemento}" data-folder="ingreso/defectos" input-id="${_value.elemento}"></button>
                    <button class="button primary small btn-camera-show" data-id="${_value.elemento}"></button> 
                    <button class="button primary small btn-eliminar-defecto icon solid fa-times" data-id="${_value.id}"></button>  
                </div>
            </div>
        </div>
        `);
    });
  }

  funcListener(_class = this) {
    $(this.btnAgregar).on('click', function (e) {
      _class.setAgregar();
      e.preventDefault();
      return false;
    });
    $(this.idContainer).on('click', '.btn-eliminar-defecto', function (e) {
      _class.setEliminar($(this).attr('data-id'));
      e.preventDefault();
      return false;
    });
  }
}
