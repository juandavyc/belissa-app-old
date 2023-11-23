export class InformacionClass {
  constructor() {
    this.myDialog = $.confirm({
      title: '',
      content: '',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'medium',
      closeIcon: true,
      lazyOpen: true,
      buttons: {
        btnAceptar: {
          text: 'Aceptar',
          btnClass: 'btn-blue',
          action: function () {},
        },
      },
    });
  }

  getInformacion(_id = 1, _callback) {
    let configForm = {
      class: this,
    };

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'medium',
      closeIcon: true,
      content: function () {
        return $.ajax({
          url: getMyAppModel('rango/Rango', 'Detalles'),
          type: 'POST',
          data: {
            id: _id,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle('Completado');
              self.close();
              _callback(response.rango);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                configForm.class.getInformacion(_id);
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
    });
  }

  setDatosEnHtml(_response) {
    let inner_html = `

    <div class="row gtr-25 gtr-uniform">
        <div class="col-4 col-12-small">
            <label class="label-datos"> NOMBRE </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">${_response.nombre}</label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> CONEXION </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">${_response.conexion.nombre}</label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> PRIVILEGIOS </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">${_response.conexion.privilegios}</label>
        </div>`;  
    inner_html += `
      <div class="col-4 col-12-small">
          <label class="label-datos"> MODULOS </label>
      </div>
      <div class="col-8 col-12-small">
        <ol>`;
    $.each(_response.modulos, function (_key, _value) {
      inner_html += `<li>${_value.toUpperCase()}</li>`;
    });
    inner_html += `
        </ol>
    </div>`;
    inner_html += `
        <div class="col-4 col-12-small">
            <label class="label-datos"> FECHA </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">${_response.fecha}</label>
        </div>
    </div>`;
    this.myDialog.open();
    this.myDialog.setTitle('Completado');
    this.myDialog.setContent(inner_html);
  }
}
