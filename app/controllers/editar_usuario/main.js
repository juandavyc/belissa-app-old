import { fun_get_data } from './editar_usuario.js';
import './datos.js';




let return_camera = fun_camera_photo(
  'https://' + $(location).attr('host') + '/modulos/gestion/editar_usuario/', // url
  'id_prueba', // referencia
  0 // rotate
);
if (return_camera == true) {
  console.log('true');
  
  setTimeout(function () {
    fun_get_data();
  }, 500);
  
} else {
  console.log('false');
}


