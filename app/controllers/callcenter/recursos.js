export class RecursosClass {
  constructor() {
    // 12/11/2022
    this.respaldo = {
      tipo_vehiculo: {
        0: {
          id: 3,
          nombre: '4X4',
        },
        1: {
          id: 2,
          nombre: 'LIVIANO',
        },
        2: {
          id: 4,
          nombre: 'MOTO',
        },
        3: {
          id: 5,
          nombre: 'REMOLQUE',
        },
        4: {
          id: 6,
          nombre: 'TAXI',
        },
      },
      servicio_vehiculo: {
        0: {
          id: 4,
          nombre: 'DIPLOMATICO',
        },
        1: {
          id: 6,
          nombre: 'ESPECIAL',
        },
        2: {
          id: 5,
          nombre: 'OFICIAL',
        },
        3: {
          id: 3,
          nombre: 'PARTICULAR',
        },
        4: {
          id: 2,
          nombre: 'PUBLICO',
        },
      },
      tipo_documento: {
        0: {
          id: 8,
          nombre: 'CARNET DIPLOMATICO',
        },
        1: {
          id: 1,
          nombre: 'CEDULA',
        },
        2: {
          id: 3,
          nombre: 'CEDULA DE EXTRANGERIA',
        },
        3: {
          id: 2,
          nombre: 'NIT',
        },
        4: {
          id: 6,
          nombre: 'NO SE SABE',
        },
        5: {
          id: 5,
          nombre: 'PASAPORTE',
        },
        6: {
          id: 7,
          nombre: 'REGISTRO CIVIL',
        },
        7: {
          id: 4,
          nombre: 'TARJETA IDENTIDAD',
        },
        8: {
          id: 9,
          nombre: 'TI2',
        },
      },
      novedad: {
        servicio: {
          id: 2,
          contenido: '<b>Modo recuperacion novedad 1</b>',
        },
        modulo: {
          id: 3,
          contenido: '<b>Modo recuperacion novedad 2</b>',
        },
      },
    };
    this.#getDatosInicio();
    // this.#ejecutarRespaldo();
  }

  #ejecutarRespaldo(_class = this) {
    _class.#setEachOptions(_class.respaldo.tipo_documento, 'datos-propietario-tipo');
    _class.#setEachOptions(_class.respaldo.tipo_documento, 'datos-conductor-tipo');
    _class.#setEachOptions(_class.respaldo.tipo_vehiculo, 'datos-vehiculo-tipo');
    _class.#setEachOptions(_class.respaldo.servicio_vehiculo, 'datos-vehiculo-servicio');
    _class.#setNovedad(_class.respaldo.novedad.servicio, 'tabs-servicio');
    _class.#setNovedad(_class.respaldo.novedad.modulo, 'tabs-modulo');
  }
  #setNovedad(_response, _id) {
    $('#' + _id)
      .empty()
      .html(_response.contenido);
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
  #getDatosInicio() {
    let _class = this;
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
          url: getMyAppModel('callcenter/Config'),
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

              _class.#setEachOptions(response.elementos.tipo_documento, 'datos-propietario-tipo');
              _class.#setEachOptions(response.elementos.tipo_documento, 'datos-conductor-tipo');
              _class.#setEachOptions(response.elementos.tipo_vehiculo, 'datos-vehiculo-tipo');
              _class.#setEachOptions(response.elementos.servicio_vehiculo, 'datos-vehiculo-servicio');

              _class.#setNovedad(response.elementos.novedad.servicio, 'tabs-servicio');
              _class.#setNovedad(response.elementos.novedad.modulo, 'tabs-modulo');

              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.getDatosInicio();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message + '<br> <b>Se ejecuto el respaldo</b>');
              _class.#ejecutarRespaldo();
            }
          })
          .fail(function (response) {
            self.setTitle('Error fatal');
            self.setContent(JSON.stringify(response) + '<br> <b>Se ejecuto el respaldo</b>');
            _class.#ejecutarRespaldo();
            console.log(response);
          });
      },
      buttons: {
        aceptar: function () {},
      },
      onClose: function () {},
    });
  }
  drawTablaBuscador(_valores, _configuracion) {
    let inner_html = `<table class="alt buscador-table-min">`;
    inner_html += `<thead>`;
    inner_html += `<tr>`;
    $.each(_configuracion.titulo, function (key, value) {
      inner_html += `<th>${value}</th>`;
    });
    inner_html += `</tr>`;
    inner_html += `</thead>`;

    $.each(_valores, function (key, value) {
      inner_html += `<tr id="${key}">`;
      $.each(_valores[key], function (_key, _value) {
        inner_html += `<td data-label="${_key}">`;
        if (_key === 'opciones') {
          $.each(_configuracion.botones, function (__key, __value) {
            inner_html += `<button btn-id="${(_value)}" `;
            inner_html += `id="${__value.id}" `;
            inner_html += `row="${key}" `;
            inner_html += `class="button primary small icon solid ${__value.icon}">`;
            inner_html += `</button>`;
          });
          inner_html += `</td>`;
        } else if (_key === 'revisado') {
          inner_html += `<label class="label-${_value.icono}" title="${_value.texto}"></label>`;
        } else {
          inner_html += `${(_value)}`;
        }
        inner_html += `</td>`;
      });
      inner_html += '</tr>';
    });
    inner_html += `</table>`;
    return inner_html;
  }
  drawTablaHistorial(_valores, _configuracion) {
    let inner_html = `<table class="alt">`;
    inner_html += `<thead>`;
    inner_html += `<tr>`;
    $.each(_configuracion.titulo, function (key, value) {
      inner_html += `<th>${value}</th>`;
    });
    inner_html += `</tr>`;
    inner_html += `</thead>`;
    inner_html += `<tbody>`;
    $.each(_valores, function (key, value) {
      inner_html += `<tr id="${key}">`;
      $.each(_valores[key], function (key_, value_) {
        inner_html += `<td data-label="${key_}" id="table_${key_}">`;
        if (key_ === 'opciones') {
          $.each(_configuracion.botones, function (__key, __value) {
            inner_html += `<button btn-id="${escapehtmljs(value_)}" `;
            inner_html += `id="${__value.id}" `;
            inner_html += `class="button primary small icon solid ${__value.icon}">`;
            inner_html += `</button>`;
          });
        } else if (key_ === 'vigente') {
          inner_html += `<label class=`;
          inner_html += `"label-${value_ == true ? 'no-vigente' : 'vigente'}">`;
          inner_html += `${value_ == true ? 'NO VIGENTE' : 'VIGENTE'}`;
          inner_html += `</label> `;
        } else if (key_ === 'cda' || key_ === 'aseguradora') {
          inner_html += `<b>${escapehtmljs(value_)}</b>`;
        } else {
          inner_html += `${escapehtmljs(value_)}`;
        }
        inner_html += `</td>`;
      });
      inner_html += '</tr>';
    });
    inner_html += `</tbody>`;
    inner_html += `</table>`;
    return inner_html;
  }
}
