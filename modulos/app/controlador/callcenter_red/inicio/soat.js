const datos_test = [
  {
    nro: 1,
    cda: 'CLAUDIOS SEGUROS SAS',
    expedicion: '30/08/2022',
    vencimiento: '30/08/2023',
    opciones: 'lksfa3skldf34sjksadkjasjk',
  },
  {
    nro: 2,
    cda: 'PATO ASEGUR SAS',
    expedicion: '30/08/2022',
    vencimiento: '30/08/2023',
    opciones: 'lksfa3skldf34sjksadkjasjk',
  },
];

const configuracionTabla = {
  botones: [
    {
      id: 'btn_info',
      icon: 'fas fa-info-circle',
      title: 'Información',
    },
    {
      id: 'btn_delete',
      icon: 'fas fa-times',
      title: 'Eliminar',
    },
  ],
  titulo: ['nro', 'aseguradora', 'expedición', 'vencimiento', 'opciones'],
};

let validateSoatHistorial = $('#form_soat_historial').validate({
  rules: {
    cda: {
      required: true,
    },
    fecha: {
      required: true,
    },
    acepto_terminos_condiciones: {
      required: true,
    },
  },
  messages: {
    acepto_terminos_condiciones:
      'Debe aceptar los términos y condiciones de uso.',
  },
  errorPlacement: function (label, element) {
    label.addClass('errorMsq');
    element.parent().append(label);
  },
});

let funcCrearTabla = null;

export function soatInit(_tabla) {
  funcCrearTabla = _tabla;
}

autocompleteCreateFather({
  id_input_text: 'soat-historial-cda-text',
  id_input_select: 'soat-historial-cda-select',
  url_select_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
  url_insert_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
  input_value_default: 'SIN_ASEGURADORA',
  input_select_default: '1',
  src_table: 'Ty9nQlpLQ0xBYTM2Q3pGa2VhQ1cvUT09',
  src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
  src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
  input_sons: [],
});

export function setDefaultSoatHistorial(_container = false) {
  validateSoatHistorial.resetForm();
  $('#form_soat_historial').trigger('reset');
  // los autocomplete
  $('#form_soat_historial')
    .find('input[type=hidden]')
    .each(function () {
      $(this).val($(this).attr('data-default'));
    });
  if (_container === true) {
    $('#tabs-soat-historial').empty();
  }
}

$('#form_soat_historial').on('submit', function (e) {
  if ($(this).valid() === true) {
    funcSoatHistorialSubmit();
  }
  e.preventDefault();
  return false;
});

$('#btn-soat-historial-actualizar').on('click', function (e) {
  setDatosSoatHistorial(datos_test);
  e.preventDefault();
  return false;
});
$('#form_soat_historial_reset').on('click', function (e) {
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
          setDefaultSoatHistorial(true);
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

function funcSoatHistorialSubmit() {
  setDatosSoatHistorial(datos_test);
}

function setDatosSoatHistorial(_response) {
  $('#tabs-soat-historial')
    .empty()
    .html(funcCrearTabla(_response, configuracionTabla));
}

setTimeout(function () {
  setDatosSoatHistorial(datos_test);
}, 1000);

$('#tabs-soat-historial').on('click', '#btn_info', function (e) {
  console.log('info');
  e.preventDefault();
  return false;
});

$('#tabs-soat-historial').on('click', '#btn_delete', function (e) {
  console.log('delete');
  e.preventDefault();
  return false;
});
