export function drawTablaBuscador(_valores, _configuracion) {
  let inner_html = `<table class="alt gestion-table-min">`;
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
          inner_html += `<button btn-id="${escapehtmljs(_value)}" `;
          inner_html += `id="${__value.id}" `;
          inner_html += `class="button primary small icon solid ${__value.icon}">`;
          inner_html += `</button>`;
        });
        inner_html += `</td>`;
      } else if (_key === 'gestion' || _key === 'estado') {
        inner_html += `<label class="label-${_value.icono}" title="${_value.texto}"></label>`;
      } else {
        inner_html += `${escapehtmljs(_value)}`;
      }
      inner_html += `</td>`;
    });
    inner_html += '</tr>';
  });
  inner_html += `</table>`;
  return inner_html;
}

export function drawTablaHistorial(_valores, _configuracion) {
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
      } else if (key_ === 'cda') {
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
 
export function drawTablaIngreso(_valores, _configuracion) {

  console.log(_valores);

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
      } else if (key_ === 'conductor') {
        inner_html += `<b>${escapehtmljs(value_)}</b>`;
      }
     else if (key_ === 'placa') {
      inner_html += `<b>${escapehtmljs(value_)}</b>`;
    }
    else if (key_ === 'propietario') {
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

function isVigenteDate(_value) {
  if (_value) {
  } else {
  }
}
