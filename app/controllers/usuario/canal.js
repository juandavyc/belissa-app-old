const formulario = document.getElementById('formulario-canal');

const objects = {
  id: formulario.querySelector('#id'),
  nombre: formulario.querySelector('#nombre'),
  tipo: formulario.querySelector('#tipo'),
  reset: formulario.querySelector('#btn-editar-reset')
};

const validacionFormulario = $(formulario).validate({
  rules: {
    nombre: {
      required: true,
      minlength: 4,
      maxlength: 40,
      alphanumeric: true,
    },
    tipo: {
      required: true,
    },
    acepto_responsabilidad: {
      required: true,
    },
  },
  messages: {
    acepto_responsabilidad: 'Debe aceptar la responsabilidad de la información',
  },
  errorPlacement: function (label, element) {
    label.addClass('errorMsq');
    element.parent().append(label);
  },
});

const myModal = new MyModal({
  container: 'dialog-asginar-canal',
  title: 'Asignar canal',
  icon: 'fa fa-warning',
  columnClass: 'md',
  event: {
    onOpen: () => { },
    onClose: () => { },
  }
});

$(formulario).on('submit', function (e) {
  e.preventDefault();
  if ($(this).valid() === true) {
    setCanal(new FormData(this));
  }
});

const setCanal = (_form) => {
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
        url: getMyAppModel('usuario/Usuario', 'Update'),
        type: 'POST',
        data: _form,
        processData: false,
        contentType: false,
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 15000,
      })
        .done(function (response) {
          //console.log(response);
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            myModal.close();
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              setCanal(_form);
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
      aceptar: function () {
      
      },
    },
    onClose: function (_buscador = false) {
      
    },
  });
}


const setDefault = () => {
  $(formulario).trigger("reset");
  validacionFormulario.resetForm();
}

const asignarDatos = ({id, nombre, apellido}) => {
  setDefault();
  $(objects.id).val(id);
  $(objects.nombre).val(`${nombre.trim()} ${apellido.trim()}`);
  myModal.open();
}

export const informacionCanal = (_id_element) => {
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
        url: getMyAppModel('usuario/Usuario', 'ClienteInformacion'),
        type: 'POST',
        data: {
          id: _id_element,
        },
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 15000,
      })
        .done(function (response) {
          if (response.statusText === 'bien') {
            asignarDatos(response.usuario);
            self.close();
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              informacionCanal(_id_element);
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
      aceptar: function () { },
    },
  });
}

const asignarCanal = (_form) => {
  let buscador = false;
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
        url: getMyAppModel('usuario/Usuario', 'ClienteUpdate'),
        type: 'POST',
        data: _form,
        processData: false,
        contentType: false,
        headers: {
          'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
        timeout: 15000,
      })
        .done(function (response) {
          if (response.statusText === 'bien') {
            self.setTitle(response.statusText);
            self.setContent(response.message);
            myModal.close();
          } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
            self.close();
            call_recuperar_session(function (k) {
              asignarCanal(_form);
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
      aceptar: function () {
      },
    },
    onClose: function () {
      if (buscador == true) {
        console.log("eco");
      }
    },
  });
}


