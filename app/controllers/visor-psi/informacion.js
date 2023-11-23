export class InformacionClass {
  constructor() {}

  getInformacion(_id = 1, _class = this) {
    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'large',
      closeIcon: true,
      content: function () {
        return $.ajax({
          url:   getMyAppModel('visor-psi/VisorPsi', 'Informacion'),
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
              self.setContent(_class.setDatos(response.message));
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

  setDatos(_response) {
    let inner_html = `
    <div class="row gtr-25 gtr-uniform">
      <div class="col-12 align-center">
        <div class="vh-placa" id="ingreso-placa_vehiculo-html">${_response.placa}</div>
        <label class="label-orange"> DATOS DEL VEHÍCULO </label>
      </div>
      <div class="col-2 col-12-small">
        <label class="label-datos">TIPO</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.tipo_vehiculo}</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="label-datos">CARROCERIA</label>
      </div>  
      <div class="col-2 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.carroceria}</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="label-datos">LINEA</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.linea}</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="label-datos">VEZ</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.linea == 1 ? 'Primera vez' : 'Segunda vez'}</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="label-datos">PASAJEROS</label>
      </div>
      <div class="col-2 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.pasajeros}</label>
      </div>`;

    if (_response.tipo_vehiculo == 'MOTO') {
      inner_html += `
        <div class="col-12 align-center">
         <label class="label-orange"> DATOS DE LOS PSI</label>
        </div>
        <div class="col-3 col-12-small">
          <label class="label-datos">LLANTA DELANTERA </label>
        </div>
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.moto_delantera}</label>
        </div> 
        <div class="col-3 col-12-small">
          <label class="label-datos">LLANTA TRASERA </label>
        </div>
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.moto_trasera}</label>
        </div>
      </div>`;
      return inner_html;
    } else {
      inner_html += `
        <div class="col-12 align-center">
          <label class="label-orange"> DATOS DE LOS PSI</label>
        </div>
        <div class="col-3 col-12-small">
          <label class="label-datos">DELANTERA DERECHA </label>
        </div>
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.liviano_delantera_derecha}</label>
        </div>     
        <div class="col-3 col-12-small">
          <label class="label-datos">DELANTERA IZQUIERDA </label>
        </div>
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.liviano_delantera_izquierda}</label>
        </div>
        <div class="col-3 col-12-small">
          <label class="label-datos">TRASERA DERECHA </label>
        </div>
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.liviano_trasera_derecha}</label>
        </div>   
        <div class="col-3 col-12-small">
          <label class="label-datos">TRASERA IZQUIERDA </label>
        </div> 
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.liviano_trasera_izquierda}</label>
        </div>
        <div class="col-3 col-12-small">
          <label class="label-datos">LLANTA DE REPUESTO </label>
        </div>
        <div class="col-3 col-12-small">
          <label class="to-copy-hand label-resultados">${_response.psi.repuesto}</label>
        </div>
      </div>`;
      return inner_html;
    }
  }
}
