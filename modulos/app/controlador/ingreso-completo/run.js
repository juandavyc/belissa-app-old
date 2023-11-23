export class RunClass {
  constructor(_criterio = false) {
    this.criterio = _criterio;
    this.containerCriterio = '#container-ingreso-criterio';
    this.arrayCriterioMoto = [];
    this.arrayCriterioLiviano = [];
    this.funcListener();
  }

  setDefaultCriterio() {
    $(this.containerCriterio).empty();
  }

  #setCriterioMoto(_object) {
    this.arrayCriterioMoto = _object;
  }
  #setCriterioLiviano(_object) {
    this.arrayCriterioLiviano = _object;
  }
  getCriterioMoto() {
    return this.arrayCriterioMoto;
  }
  getCriterioLiviano() {
    return this.arrayCriterioLiviano;
  }

  setCriterio(_tipo = 'liviano') {
    let config = {
      container: this.containerCriterio,
      inner_html: '',
      tipo: null,
      class: this,
    };
    // jsjsjs ok
    if (_tipo.toLowerCase() === 'liviano') {
      config.tipo = this.getCriterioLiviano();
    } else {
      config.tipo = this.getCriterioMoto();
    }

    $(config.container).empty();
    $.each(config.tipo, function (_key, _value) {
      config.inner_html += `<div class="col-12 align-center">`;
      config.inner_html += `<label id="label-criterio_${_key}">${_value.titulo}</label>`;
      $.each(_value.respuesta, function (__key, __value) {
        config.inner_html += `<input type="radio" name="criterio[${_key}]" `;
        config.inner_html += ` id="criterio${_key}${__value}" value="${__value}"  `;
        if (config.class.criterio == true) {
          config.inner_html += ` ${_value.rapido == __value ? 'checked' : ''}> `;
        } else {
          config.inner_html += ` ${_value.defecto == __value ? 'checked' : ''}> `;
        }

        config.inner_html += ` <label for="criterio${_key}${__value}">${__value}</label>`;
      });
      config.inner_html += `</div>`;
    });
    $(config.container).html(config.inner_html);
  }

  #setEachOptions(_response, _id) {
    $.each(_response, function (i, item) {
      $('#' + _id).append(
        $('<option>', {
          value: item.id,
          text: item.nombre,
        })
      );
    });
  }

  getDatosInicio(_class = this) {
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'xsmall',
      closeIcon: true,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/ingreso-completo/ingreso.config.php',
          type: 'GET',
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            console.log(response);
            if (response.statusText === 'bien') {
              self.setTitle('Completado');
              self.setContent('Espere un momento...');

              _class.#setEachOptions(response.elementos.tipo_vehiculo, 'ingreso-tipo_vehiculo');
              _class.#setEachOptions(response.elementos.servicio_vehiculo, 'ingreso-servicio_vehiculo');
              _class.#setEachOptions(response.elementos.combustible, 'ingreso-combustible');
              _class.#setEachOptions(response.elementos.tipo_caja, 'ingreso-tipo_caja');
              _class.#setEachOptions(response.elementos.tipo_documento, 'ingreso-propietario_tipo_documento');
              _class.#setEachOptions(response.elementos.tipo_documento, 'ingreso-conductor_tipo_documento');

              _class.#setEachOptions(response.elementos.tipo_documento, 'editar-propietario_tipo_documento');
              _class.#setEachOptions(response.elementos.tipo_documento, 'editar-conductor_tipo_documento');

              _class.#setCriterioMoto(response.elementos.criterio.moto);
              _class.#setCriterioLiviano(response.elementos.criterio.liviano);

              self.close(true);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();

              call_recuperar_session(function (k) {
                _class.getDatosInicio();
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
      onClose: function (_status) {},
    });
  }

  funcListener(_class = this) {
    $('#btn-ingreso-config-test').on('click', function (e) {
      _class.getDatosInicio();
      e.preventDefault();
      return false;
    });

    $('#ingreso-criterio-test-moto').on('click', function (e) {
      _class.setCriterio('moto');
      e.preventDefault();
      return false;
    });
    $('#ingreso-criterio-test-liviano').on('click', function (e) {
      _class.setCriterio('liviano');
      e.preventDefault();
      return false;
    });
  }
}
