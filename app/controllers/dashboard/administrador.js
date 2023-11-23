export class AdministradorClass {
  constructor() {

    this.btnRecargar = $('#btn-dashboard-admin-recargar');
    this.mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    this.valor = {
      moto: 157437,
      liviano: 228196,
    };
    this.arrResponse = null;
    this.isRun = 0;
    this.timeRedraw = 0;
    //this.arrOchoDias = {};

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

    this.temp = {
      mes: {
        actual: {
          liviano: 0,
          moto: 0,
        },
        anterior: {
          liviano: 0,
          moto: 0,
        },
      },
      anterior: {
        mes: 0,
        total: 0,
      },
      actual: {
        mes: 0,
        total: 0,
      },
      ocho: {
        dias: [],
      },
    };

    this.#iniCharts();
    this.#iniFecha();
    this.#actionListener();
    this.getDatos();
  }

  getDatos() {
    let configuracion = {
      class: this,
    };
    $.ajax({
      url: getMyAppModel('dashboard/Administrador'),
      type: 'get',
      dataType: 'json',
      headers: {
        'csrf-token': $('meta[name="csrf-token"]').attr('content'),
      },
    })
      .done(function (response) {
        // console.log(response);
        if (response.statusText === 'bien') {
          configuracion.class.#setElementos(response.elementos);
        } else if (response.status === 'csrf' || response.status === 'session') {
          call_recuperar_session(function (k) {
            configuracion.class.getDatos();
          });
        } else {
          $.alert(JSON.stringify(response));
        }
        //configuracion.class.btnRecargar.text('Actualizar');
        setTimeout(() => configuracion.class.btnRecargar.removeAttr('disabled'), 2000);
        /*$('html, body').animate(
          {
            scrollTop: $('.dashboard-perfil').offset().top - 50,
          },
          200
        );*/
      })
      .fail(function (response) {
        $.alert(JSON.stringify(response));
        configuracion.class.btnRecargar.removeAttr('disabled');
        //configuracion.class.btnRecargar.text('Actualizar');
      });
  }

  #setElementos(_response) {
    let _class = this;

    _class.temp = {
      mes: {
        actual: {
          liviano: 0,
          moto: 0,
        },
        anterior: {
          liviano: 0,
          moto: 0,
        },
      },
      anterior: {
        mes: 0,
        total: 0,
      },
      actual: {
        mes: 0,
        total: 0,
      },
      ocho: {
        dias: [],
      },
    };

    $.each(_response.mes.actual.elemento.ingreso, function (key, value) {
      if (value.id_tipo == 4) {
        _class.temp.mes.actual.moto = _class.temp.mes.actual.moto + value.total;
      } else {
        _class.temp.mes.actual.liviano = _class.temp.mes.actual.liviano + value.total;
      }
    });
    $.each(_response.mes.anterior.elemento.ingreso, function (key, value) {
      if (value.id_tipo == 4) {
        _class.temp.mes.anterior.moto = _class.temp.mes.anterior.moto + value.total;
      } else {
        _class.temp.mes.anterior.liviano = _class.temp.mes.anterior.liviano + value.total;
      }
    });

    _class.temp.actual.mes = _response.mes.actual.elemento.mes;
    _class.temp.anterior.mes = _response.mes.anterior.elemento.mes;

    _class.temp.actual.total = _response.mes.actual.liviano + _response.mes.actual.moto;
    _class.temp.anterior.total = _response.mes.anterior.liviano + _response.mes.anterior.moto;

    // ocho dias
    $.each(_class.fecha.dias, function (_key, _value) {
      Object.assign(_class.temp.ocho.dias, { [_key]: {} });
      Object.assign(_class.temp.ocho.dias[_key], { fecha: _value, liviano: 0, moto: 0 });
    });

    $.each(_class.temp.ocho.dias, function (key, value) {
      $.each(_response.ocho.elemento[value.fecha], function (_key, _value) {
        if (typeof _value === 'object') {
          if (_value.tipo == 4) {
            _class.temp.ocho.dias[key].moto = _value.total;
          } else {
            _class.temp.ocho.dias[key].liviano = _class.temp.ocho.dias[key].liviano + _value.total;
          }
        }
      });
    });

    _class.#htmlMesActual(_class.temp);
    _class.#drawMesActualAnterior(_class.temp);

    _class.#htmlOchoDiasCantidad(_class.temp.ocho);
    _class.#drawOcho(_class.temp.ocho, '#container-ocho-dias-cantidad-grafico', 'cantidad');
    _class.#htmlOchoDiasFacturado(_class.temp.ocho);
    _class.#drawOcho(_class.temp.ocho, '#container-ocho-dias-facturado-grafico', 'facturacion');

    _class.isRun = 1;
  }

  #iniCharts() {
    google.charts.load('current', { packages: ['corechart', 'bar'] });
    $('#dash-admin').show(400);
  }

  #iniFecha(_class = this) {
    _class.fecha.inicial.setDate(_class.fecha.inicial.getDate() - 7);
    _class.fecha.temp = _class.fecha.inicial;
    for (_class.fecha.temp; _class.fecha.temp <= this.fecha.final; _class.fecha.temp.setDate(_class.fecha.temp.getDate() + 1)) {
      _class.fecha.dias.push(_class.fecha.temp.toLocaleDateString(undefined, this.fecha.configuracion));
    }
    _class.fecha.inicial = _class.fecha.dias[0];
    _class.fecha.final = _class.fecha.final.toLocaleDateString(undefined, this.fecha.configuracion);
  }
  #htmlOchoDiasCantidad(_response) {
    this.#drawTable('#container-ocho-dias-cantidad-tabla', _response, 'contar');
    $('#container-ocho-dias-nombre')
      .empty()
      .html('( <b>' + this.fecha.inicial + '</b> a <b>' + this.fecha.final + '</b> )');
  }
  #htmlOchoDiasFacturado(_response) {
    this.#drawTable('#container-ocho-dias-facturado-tabla', _response, 'facturacion');
  }
  #htmlMesActual(_response) {
    let _class = this;
    let _inner_html = '<div class="row gtr-25 gtr-uniform">';
    $.each(_response.mes.actual, function (key, value) {
      _inner_html += '<div class="col-6 col-12-small">';
      _inner_html += '<div class="dashboard-servicio">';
      _inner_html += '<div class="row gtr-25 gtr-uniform">';
      _inner_html += '<div class="col-8 col-12-mobilep">';
      _inner_html += `<h4>${key.toUpperCase()} </h4>`;
      _inner_html += `<p> ${_class.#formatNumber(value)}</p>`;
      _inner_html += '</div>';
      _inner_html += '<div class="col-4 col-12-mobilep align-right">';
      _inner_html += '<i class="fa-solid fa-box fa-3x"></i>';
      _inner_html += '</div>';
      _inner_html += '</div>';
      _inner_html += '</div>';
      _inner_html += '</div>';
      _inner_html += '<div class="col-6 col-12-small">';
      _inner_html += '<div class="dashboard-servicio">';
      _inner_html += '<div class="row gtr-25 gtr-uniform">';
      _inner_html += '<div class="col-8 col-12-mobilep">';
      _inner_html += `<h4> Facturado </h4>`;
      _inner_html += `<p> ${_class.#formatNumber(value * _class.valor[key])}</p>`;
      _inner_html += '</div>';
      _inner_html += '<div class="col-4 col-12-mobilep align-right">';
      _inner_html += '<i class="fa-solid fa-dollar-sign fa-3x"></i>';
      _inner_html += '</div>';
      _inner_html += '</div>';
      _inner_html += '</div>';
      _inner_html += '</div>';
    });

    _inner_html += '<div class="col-6 col-12-small">';
    _inner_html += '<div class="dashboard-servicio servicio-alt">';
    _inner_html += '<div class="row gtr-25 gtr-uniform">';
    _inner_html += '<div class="col-8 col-12-mobilep">';
    _inner_html += `<h4>Total </h4>`;
    //_inner_html += `<p> ${_class.#formatNumber(_response.mes.actual.liviano + _response.mes.actual.moto)}</p>`;
    _inner_html += `<p> ${_class.#formatNumber(1234)}</p>`;
    _inner_html += '</div>';
    _inner_html += '<div class="col-4 col-12-mobilep align-right">';
    _inner_html += '<i class="fa-solid fa-box fa-3x"></i>';
    _inner_html += '</div>';
    _inner_html += '</div>';
    _inner_html += '</div>';
    _inner_html += '</div>';
    _inner_html += '<div class="col-6 col-12-small">';
    _inner_html += '<div class="dashboard-servicio servicio-alt">';
    _inner_html += '<div class="row gtr-25 gtr-uniform">';
    _inner_html += '<div class="col-8 col-12-mobilep">';
    _inner_html += `<h4> Facturado </h4>`;
    _inner_html += `<p> ${_class.#formatNumber(
      _response.mes.actual.liviano * _class.valor.liviano + _response.mes.actual.moto * _class.valor.moto
    )}</p>`;

    _inner_html += '</div>';
    _inner_html += '<div class="col-4 col-12-mobilep align-right">';
    _inner_html += '<i class="fa-solid fa-dollar-sign fa-3x"></i>';
    _inner_html += '</div>';
    _inner_html += '</div>';
    _inner_html += '</div>';
    _inner_html += '</div>';

    $('#container-facturado-mes-nombre')
      .empty()
      .html('<i class="fa-solid fa-dollar-sign"></i> Facturado en el mes de: <b>' + _class.mes[_response.actual.mes - 1] + '</b>');

    $('#container-facturado-mes-numero').empty().html(_inner_html);
  }

  #drawOcho(_response, _container, _tarea) {
    let _class = this;
    let _data = new google.visualization.DataTable();

    _data.addColumn('string', 'Dia');
    _data.addColumn('number', 'Liviano');
    _data.addColumn('number', 'Moto');

    $.each(_response.dias, function (key, value) {
      let temp = [];
      temp.push(value.fecha.slice(0, 5));
      if (_tarea == 'facturacion') {
        temp.push(value.liviano * _class.valor.liviano);
        temp.push(value.moto * _class.valor.moto);
      } else {
        temp.push(value.liviano);
        temp.push(value.moto);
      }

      _data.addRow(temp);
    });

    let _options = {
      title: _class.fecha.inicial + ' a ' + _class.fecha.final,
      legend: 'bottom',
      chartArea: { width: '80%' },
      height: 200,
      colors: ['#4285F4', '#2C9047'],
      pointSize: 10,
    };

    let chart = new google.visualization.AreaChart($(_container)[0]);
    chart.draw(_data, _options);
  }
  #drawMesActualAnterior(_response) {
    let _class = this;
    let data = [];

    let tempHeader = ['Facturacion', 'TOTAL', { type: 'string', role: 'annotation' }];

    tempHeader.push('MOTO');
    tempHeader.push({ type: 'string', role: 'annotation' });
    tempHeader.push('LIVIANO');
    tempHeader.push({ type: 'string', role: 'annotation' });

    data.push(tempHeader);

    $.each(_response.mes, function (key, value) {
      let tempRow = [];
      tempRow.push(_class.mes[_response[key].mes - 1]);
      tempRow.push(value.liviano * _class.valor.liviano + value.moto * _class.valor.moto);
      tempRow.push('$ ' + _class.#formatNumber(value.liviano * _class.valor.liviano + value.moto * _class.valor.moto));
      tempRow.push(value.moto * _class.valor.moto);
      tempRow.push('$ ' + _class.#formatNumber(value.moto * _class.valor.moto));
      tempRow.push(value.liviano * _class.valor.liviano);
      tempRow.push('$ ' + _class.#formatNumber(value.liviano * _class.valor.liviano));

      data.push(tempRow);
    });

    let _chartdata = new google.visualization.arrayToDataTable(data);

    let _options = {
      title: 'De ' + _class.mes[_response.anterior.mes - 1] + ' a ' + _class.mes[_response.actual.mes - 1],
      chartArea: { width: '60%' }, // { width: 300, height: 250 },
      hAxis: {
        title: 'Aproximado facturado',
        minValue: 0,
        minValue: (_response.anterior.total + _response.actual.total) * 2,
      },
      colors: ['#FF6D01', '#4285F4', '#2C9047', '#EA4335'],
    };

    let _chart = new google.visualization.BarChart($('#container-facturado-mes-grafico')[0]);
    _chart.draw(_chartdata, _options);
  }

  #reDrawCharts() {
    let _class = this;
    google.charts.setOnLoadCallback(_class.#drawMesActualAnterior(_class.temp));
    google.charts.setOnLoadCallback(_class.#drawOcho(_class.temp.ocho, '#container-ocho-dias-cantidad-grafico', 'cantidad'));
    google.charts.setOnLoadCallback(_class.#drawOcho(_class.temp.ocho, '#container-ocho-dias-facturado-grafico', 'facturacion'));
  }
  #actionListener(_class = this) {
    $(_class.btnRecargar).on('click', function (e) {
      _class.btnRecargar.attr('disabled', 'disabled');
      //_class.btnRecargar.text('Espere');
      _class.getDatos();
      e.preventDefault();
      return false;
    });

    $(window).on('resize', function () {
      if (_class.isRun == 1) {
        if (Date.now() - 100 > _class.timeRedraw) {
          _class.timeRedraw = Date.now();
          _class.#reDrawCharts();
        }
      }
    });
  }
  #formatNumber($input) {
    $input = parseInt($input.toString().replace(/\D/g, ''), 10);
    $input = $input.toLocaleString('en-US');
    return $input.toString().replaceAll(',', '.');
  }

  #drawTable(_container, _response, _tarea) {
    let _class = this;
    let _inner_html = '<table class="dashboard-table-min">';
    let _total = {
      liviano: 0,
      moto: 0,
    };

    _inner_html += '<thead>';
    _inner_html += '<tr>';
    _inner_html += '<th style="text-align: center;"> Dia </th>';
    _inner_html += '<th> Liviano </th>';
    _inner_html += '<th> Moto </th>';
    _inner_html += '</tr>';
    _inner_html += '</thead>';
    _inner_html += '<tbody>';

    $.each(_response.dias, function (key, value) {
      _inner_html += '<tr>';
      _inner_html += `<td data-label="Dia">${value.fecha}</td>`;
      if (_tarea == 'facturacion') {
        _inner_html += `<td data-label="Liviano"> ${_class.#formatNumber(value.liviano * _class.valor.liviano)}</td>`;
        _inner_html += `<td data-label="Moto"> ${_class.#formatNumber(value.moto * _class.valor.moto)}</td>`;
      } else {
        _inner_html += `<td data-label="Liviano">${value.liviano}</td>`;
        _inner_html += `<td data-label="Moto">${value.moto}</td>`;
      }

      _inner_html += '</tr>';

      _total.liviano = _total.liviano + value.liviano;
      _total.moto = _total.moto + value.moto;
    });

    if (_tarea == 'facturacion') {
      _total.liviano = _total.liviano * _class.valor.liviano;
      _total.moto = _total.moto * _class.valor.moto;
    }

    _inner_html += '</tbody>';
    _inner_html += '<tfoot>';
    _inner_html += '<tr>';
    _inner_html += `<td data-label="Total">Total</td>`;
    _inner_html += `<td data-label="Liviano">${_tarea == 'facturacion' ? '$' : ''} ${_class.#formatNumber(_total.liviano)}</td>`;
    _inner_html += `<td data-label="Moto">${_tarea == 'facturacion' ? '$' : ''} ${_class.#formatNumber(_total.moto)}</td>`;
    _inner_html += '</tr>';
    _inner_html += '</tfoot>';
    _inner_html += '</table>';

    $(_container).empty().html(_inner_html);
  }
}
