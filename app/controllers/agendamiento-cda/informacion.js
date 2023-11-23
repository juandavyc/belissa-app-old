export class InformacionClass {
  constructor() {}

  getInformacion(_id = 1, _class = this) {
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
          url: getMyAppModel('agendamiento-cda/Agendamiento', 'Informacion'),
          type: 'POST',
          data: {
            id_elemento: _id,
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
              self.setContent(_class.#setDatosEnHtml(response.message));
              //console.log(response.message);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.getInformacion(_id);
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

  #setDatosEnHtml(_response) {
    let inner_html = `
      <div class="row">
        <div class="col-12 align-center">
             <div class="vh-placa" id="ingreso-placa_vehiculo-html">${_response.vehiculo.placa}</div>
        </div>
        <div class="col-12 align-center">
          <label class="label-orange"> DATOS DEL CLIENTE</label>
        </div>        
        <div class="col-4 col-12-small">
          <label class="label-datos"> NOMBRE DEL CLIENTE</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.cliente.nombre} ${_response.cliente.apellido}</label>
        </div>        
        <div class="col-4 col-12-small">
          <label class="label-datos"> TELEFONO</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.cliente.telefono}</label>
        </div> 
        <div class="col-4 col-12-small">
          <label class="label-datos"> CORREO</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.cliente.correo}</label>
        </div>
        <div class="col-12 align-center">
          <label class="label-orange"> DATOS DEL AGENDAMIENTO</label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos">FECHA EN QUE ASISTE</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.fecha}</label>
        </div> 
        <div class="col-4 col-12-small">
          <label class="label-datos"> HORARIO</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.horario.nombre}</label>
        </div> 
        <div class="col-4 col-12-small">
          <label class="label-datos"> CANAL</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.canal.nombre}</label>
        </div> 
        <div class="col-4 col-12-small">
          <label class="label-datos"> ESTADO</label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.estado.nombre}</label>
        </div>`;
        if(_response.estado.nombre == 'Anulado'){
          inner_html += `
          <div class="col-4 col-12-small">
           <label class="label-datos"> RAZON ANULADO</label>
          </div>
          <div class="col-8 col-12-small">
           <label class="label-resultados">${_response.razon}</label>
          </div> 
          <div class="col-12 align-center">
           <label class="label-orange"> RESPONSABLE </label>
          </div>
          <div class="col-4 col-12-small">
           <label class="label-datos"> USUARIO </label>
          </div>
          <div class="col-8 col-12-small">
           <label class="label-resultados">${_response.usuario}
          </label>
          </div> 
          <div class="col-4 col-12-small">
           <label class="label-datos"> CREADO </label>
          </div>
          <div class="col-8 col-12-small">
          <label class="label-resultados"> ${_response.fecha_agendo}</label>
          </div> 
        </div> `;
          return inner_html;
        } else {
          inner_html += `       
        <div class="col-12 align-center">
          <label class="label-orange"> RESPONSABLE </label>
        </div>
        <div class="col-4 col-12-small">
          <label class="label-datos"> USUARIO </label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados">${_response.usuario}
        </label>
        </div> 
        <div class="col-4 col-12-small">
          <label class="label-datos"> CREADO </label>
        </div>
        <div class="col-8 col-12-small">
          <label class="label-resultados"> ${_response.fecha_agendo}</label>
        </div> 
        </div> `;

    return inner_html;
  }
}
}