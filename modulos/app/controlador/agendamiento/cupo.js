export class CupoClass {
  constructor() {
    this.validacionFormulario = $('#form_cupo').validate({
      rules: {
        moto: {
          required: true,
          number: true,
          min: 10,
          max: 200,
        },
        liviano: {
          required: true,
          number: true,
          min: 10,
          max: 200,
        },
        acepto_responsabilidad: {
          required: true,
        },
      },
      messages: {
        horario: 'Seleccione un horario',
        estado_agendamiento: 'Seleccione un estado de agendamiento',
        acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });
    this.fecha = {
      configuracion: {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
      },
      inicial: new Date(),
      final: new Date(),
      dias: [],
      temp: '',
    };

    this.#funcListener();
    this.#establecerFecha();
  }

  #establecerFecha(_class = this) {
    _class.fecha.final.setDate(_class.fecha.inicial.getDate() + 29);
    _class.fecha.temp = _class.fecha.inicial;
    for (_class.fecha.temp; _class.fecha.temp <= this.fecha.final; _class.fecha.temp.setDate(_class.fecha.temp.getDate() + 1)) {
      _class.fecha.dias.push(_class.fecha.temp.toLocaleDateString(undefined, this.fecha.configuracion));
    }
    _class.fecha.inicial = _class.fecha.inicial.toLocaleDateString(undefined, this.fecha.configuracion);
    _class.fecha.final = _class.fecha.final.toLocaleDateString(undefined, this.fecha.configuracion);
  }

  // setDefaultFormulario() {
  //   this.validacionFormulario.resetForm();
  //   $('#form_editar_agendamiento').trigger('reset');
  // }
  setDefaultCupo() {
    $('#container-cupos').empty();
    $('#cupo-liviano-html').empty();
    $('#cupo-moto-html').empty();

    $('#container-cupos-agendar').empty();
    $('#cupo-liviano-agendar-html').empty();
    $('#cupo-moto-agendar-html').empty();
  }

  getListado() {
    let _class = this;
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/agendamiento/agendamiento.modelo.php?m=Cupo',
          type: 'GET',
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            if (response.cupo.statusText === 'bien') {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              _class.#drawCupo(response);
              self.close();
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.getListado();
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
      onClose: function () {},
    });
  }

  datosSubmit() {
    let _class = this;
    let _status = false;
    let _form_data = new FormData($('#form_cupo')[0]);
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: PROTOCOL_HOST + '/modulos/app/modelo/agendamiento-cda/agen.modelo.php?m=CupoEdit',
          type: 'POST',
          data: _form_data,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            if (response.liviano.statusText === 'bien' && response.moto.statusText) {
              self.setTitle(response.liviano.statusText);
              self.setContent(response.liviano.message);
              _status = true;
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosSubmit();
              });
            } else {
              self.setTitle('Error');
              self.setContent(response.liviano.message + '<br>' + response.moto.message);
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
      onClose: function () {
        if (_status == true) {
          _class.getListado();
        }
      },
    });
  }

  #funcListener(_class = this) {
    $('#btn-cupo-recargar,#btn-cupo-agendar-recargar').on('click', function (e) {
      _class.getListado();
      e.preventDefault();
      return false;
    });
    $('#form_cupo').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });
  }

  #drawCupo(_response, _class = this) {
    // _class.setDefaultFormulario();
    _class.setDefaultCupo();
    // formulario
    $('#cupo-moto').val(_response.cupo.message.moto.cupo);
    $('#cupo-liviano').val(_response.cupo.message.liviano.cupo);

    $('#cupo-moto-html').html(_response.cupo.message.moto.cupo);
    $('#cupo-liviano-html').html(_response.cupo.message.liviano.cupo);

    $('#cupo-moto-agendar-html').html(_response.cupo.message.moto.cupo);
    $('#cupo-liviano-agendar-html').html(_response.cupo.message.liviano.cupo);

    let maxRows = 10,
      contador = 0;
    let _inner_html = `<div class="row gtr-50 gtr-uniform">`;
    _inner_html += `<div class="col-4 col-12-small">`;
    _inner_html += `<ul class="alt">`;

    $.each(_class.fecha.dias, function (_key, _value) {
      if (contador == maxRows) {
        _inner_html += `</ul>`;
        _inner_html += `</div>`;
        _inner_html += `<div class="col-4 col-12-small">`;
        _inner_html += `<ul class="alt">`;
        contador = 0;
      }

      _inner_html += `<li> ${_value} `;

      if (_value in _response.listado.message) {
        $.each(_response.listado.message[_value], function (__key, __value) {
          if (typeof __value === 'object') {
            if (__value.libre < 10) {
              if (__key == 'MOTO') {
                _inner_html += `( <b class="b-warning">${__value.libre}</b> - `;
              } else if (__key == 'LIVIANO') {
                _inner_html += `<b class="b-warning">${__value.libre}</b> ) `;
              }
            } else {
              if (__key == 'MOTO') {
                _inner_html += `( <b class="b-moto">${__value.libre}</b> - `;
              } else if (__key == 'LIVIANO') {
                _inner_html += `<b class="b-liviano">${__value.libre}</b> ) `;
              }
            }
          } else {
            if (__key == 'MOTO') {
              _inner_html += `( <b class="b-moto">${_response.cupo.message.moto.cupo}</b> - `;
            } else if (__key == 'LIVIANO') {
              _inner_html += `<b class="b-liviano">${_response.cupo.message.liviano.cupo}</b> )`;
            }
          }
        });
      } else {
        _inner_html += `( <b class="b-moto">${_response.cupo.message.moto.cupo}</b> - `;
        _inner_html += `<b class="b-liviano">${_response.cupo.message.liviano.cupo}</b> )`;
      }

      _inner_html += `</li>`;

      contador++;
    });
    _inner_html += `</ul>`;
    _inner_html += `</div>`;
    _inner_html += `</div>`;
    $('#container-cupos').html(_inner_html);
    $('#container-cupos-agendar').html(_inner_html);
  }
}
