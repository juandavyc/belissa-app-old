autocompleteCreateFather({
  id_input_text: 'form-1-editar-marca-input',
  id_input_select: 'form-1-editar-marca-select',
  url_select_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
  url_insert_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
  input_value_default: 'SIN_MARCA',
  input_select_default: '1',
  src_table: 'd2JKbGY1S00zRUY5RjN1ZGl5ejFvZz09',
  src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
  src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
  input_sons: [
    {
      id_input_text: 'form-1-editar-linea-input',
      id_input_select: 'form-1-editar-linea-select',
      input_value_default: 'SIN_LINEA',
      input_select_default: '1',
    },
  ],
});

autocompleteCreateSon({
  id_input_text: 'form-1-editar-linea-input',
  id_input_select: 'form-1-editar-linea-select',
  url_select_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/search.php',
  url_insert_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/son/create.php',
  input_value_default: 'SIN_LINEA',
  input_select_default: '1',
  src_table: 'NE8va3lmbUVrbWhHSTZ0Qkg4d3J5Zz09',
  src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
  src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
  src_father: 'Z0R2dnpPWGtkUlcweUgxMDlnLzRlUT09',
  input_father_name: 'MARCA',
  input_father_text: 'form-1-editar-marca-input',
  input_father_select: 'form-1-editar-marca-select',
});

autocompleteCreateFather({
  id_input_text: 'form-1-editar-color-input',
  id_input_select: 'form-1-editar-color-select',
  url_select_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/search.php',
  url_insert_ajax:
    PROTOCOL_HOST + '/modulos/app/clases/autocomplete/father/create.php',
  input_value_default: 'SIN_COLOR',
  input_select_default: '1',
  src_table: 'azVtZkNWODkvMVh1cjlFZUtMQmdJQT09',
  src_index: 'WEN5N3ZLSW0xS2F5cmdqU291MndsQT09',
  src_value: 'SGc5QWRvVVV1TkNrUVJ3dEdodHFGUT09',
  input_sons: [],
});
