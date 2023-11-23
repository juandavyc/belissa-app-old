const personalizacion_tabla = {
  opciones: [
    {
      id: 'btn_infor',
      icon: 'fas fa-info-circle',
      title: 'Información',
      func: func_say_hello_1, // function del evento del boton
    },
    {
      id: 'btn_delete',
      icon: 'fas fa-times',
      title: 'Datos',
      func: func_say_hello_4,
    },
  ],
  //verificado, sin verificar y asi..
  icono: ['none', 'question', 'check', 'times'],
  // ¿a que campos deben afectar estos iconos?
  campo: ['email', 'paquetes', 'datos'],
};
// en realidad son las clases

const buscadorRango = new VisorBuscador(
  'form_0_buscador',
  'form_0',
  PROTOCOL_HOST + '/modulos/app/modelo/rango/rango.modelo.php?m=Listado',
  personalizacion_tabla,
  true //¿ exportar exel ?
);

// autoiniciar
setTimeout(function () {
  buscadorRango.formularioSubmit(true);
}, 1000);

$('#form_0_buscador').on('submit', function (e) {
  // para la validacion del formulario
  buscadorRango.formularioSubmit(true);
  e.preventDefault();
  return false;
});

function func_say_hello_1(_id_element = 1) {
  console.log('hello 1 _ ' + _id_element);
}
function func_say_hello_2(_id_element = 1) {
  console.log('hello 2_ ' + _id_element);
}
function func_say_hello_3(_id_element = 1) {
  console.log('hello 3_ ' + _id_element);
}
function func_say_hello_4(_id_element = 1) {
  console.log('hello 4_ ' + _id_element);
}
function func_say_hello_5(_id_element = 1) {
  console.log('hello 5_ ' + _id_element);
}
