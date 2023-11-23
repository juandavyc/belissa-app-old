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
          url: PROTOCOL_HOST + '/modulos/app/modelo/visor-ingreso/ingreso.modelo.php?m=Info',
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
    <div class="row gtr-25 gtr-uniform">
      <div class="col-12 align-center">
        <div class="vh-placa to-copy-hand" id="ingreso-placa_vehiculo-html">${_response.placa}</div>
        <label class="label-orange"> DATOS DEL VEHÍCULO </label>
      </div>
      <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">          
          <div class="col-5 col-12-small">
            <label class="label-datos"> TIPO </label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.tipo_vehiculo}</label>
          </div>
          <div class="col-5 col-12-small">
            <label class="label-datos"> SERVICIO </label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.servicio_vehiculo}</label>
          </div> 
          <div class="col-5 col-12-small">
            <label class="label-datos"> CARROCERIA </label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.carroceria}</label>
          </div>  
          <div class="col-5 col-12-small">
            <label class="label-datos"> VEZ</label>
          </div>
           <div class="col-7 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.vez == 1 ? 'PRIMERA VEZ' : 'SEGUNDA VEZ'}</label>
          </div>           
        </div>
      </div>
      <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
          <div class="col-5 col-12-small">
            <label class="label-datos"> MODELO</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.modelo}</label>
          </div>
          <div class="col-5 col-12-small">
            <label class="label-datos"> MARCA</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.marca}</label>
          </div>
          <div class="col-5 col-12-small">
            <label class="label-datos"> LINEA</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.linea}</label>
          </div>
          <div class="col-5 col-12-small">
            <label class="label-datos"> COLOR</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.color}</label>
          </div>
        </div> 
      </div>  
      <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
          <div class="col-5 col-12-small">
            <label class="label-datos"> KILOMETRAJE</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.kilometraje}</label>
          </div> 
          <div class="col-5 col-12-small">
            <label class="label-datos"> combustible</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.combustible}</label>
          </div> 
          <div class="col-5 col-12-small">
            <label class="label-datos"> FECHA GNCV</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.fecha_gncv}</label>
          </div> 
          <div class="col-5 col-12-small">
            <label class="label-datos"> NRO GNCV</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.nro_gncv}</label>
          </div> 
        </div> 
      </div>      
      <div class="col-8 col-12-small">
        <div class="row gtr-25 gtr-uniform">
          <div class="col-12 align-center">
            <label class="label-orange"> GENERAL</label>
          </div>
          <div class="col-6 col-12-small">
            <div class="row gtr-25 gtr-uniform">
              <div class="col-5 col-12-small">
                <label class="label-datos"> CAPACIDAD</label>
              </div>
              <div class="col-7 col-12-small">
                <label class="to-copy-hand label-resultados">${_response.pasajeros}</label>
              </div>
              <div class="col-5 col-12-small">
                <label class="label-datos"> PUERTAS</label>
              </div>
              <div class="col-7 col-12-small">
                <label class="to-copy-hand label-resultados">${_response.puertas}</label>
              </div>
              <div class="col-5 col-12-small">
                <label class="label-datos"> CAJA</label>
              </div>
              <div class="col-7 col-12-small">
                <label class="to-copy-hand label-resultados">${_response.tipo_caja}</label>
              </div>
            </div>
          </div>
          <div class="col-6 col-12-small">
            <div class="row gtr-25 gtr-uniform">
              <div class="col-5 col-12-small">
                <label class="label-datos"> Blindado</label>
              </div>
              <div class="col-7 col-12-small">
                <label class="to-copy-hand label-resultados">${_response.blindado == 1 ? 'NO' : 'SI'}</label>
              </div>
              <div class="col-5 col-12-small">
                <label class="label-datos"> Polarizado</label>
              </div>
              <div class="col-7 col-12-small">
                <label class="to-copy-hand label-resultados">${_response.polarizado == 1 ? 'NO' : 'SI'}</label>
              </div>  
              <div class="col-5 col-12-small">
                <label class="label-datos"> Eneseñanza</label>
              </div>
              <div class="col-7 col-12-small">
                <label class="to-copy-hand label-resultados">${_response.polarizado == 1 ? 'NO' : 'SI'}</label>
              </div> 
            </div> 
          </div>
        </div>
      </div>    
      <div class="col-4 col-12-small">
        <div class="row gtr-25 gtr-uniform">
          <div class="col-12 align-center">
            <label class="label-orange"> MOTOS</label>
          </div>
          <div class="col-5 col-12-small">
            <label class="label-datos"> MOTOR</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.tiempo_motor}</label>
          </div>
          <div class="col-5 col-12-small">
            <label class="label-datos"> DISEÑO</label>
          </div>
          <div class="col-7 col-12-small">
            <label class="to-copy-hand label-resultados">${_response.disenio_vehiculo}</label>
          </div>
        </div>        
      </div>
      <div class="col-6 col-12-small">
        <fieldset class="fieldset-propietario">
        <legend><i class="fas fa-user"></i>  PROPIETARIO</legend>
          <div class="row gtr-25 gtr-uniform">           
            <div class="col-3 col-12-small">
              <label class="label-datos"> DOCUMENTO</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.documento_propietario}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> NOMBRE</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.nombre_propietario}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> TELEFONO</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.telefono_propietario}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> CORREO</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.correo_propietario}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> DIRECCION</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.direccion_propietario}</label>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="col-6 col-12-small">
        <fieldset class="fieldset-conductor">
        <legend><i class="fas fa-user"></i>  CONDUCTOR</legend>
          <div class="row gtr-25 gtr-uniform">          
            <div class="col-3 col-12-small">
              <label class="label-datos"> DOCUMENTO</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.documento_conductor}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> NOMBRE</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.nombre_conductor}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> TELEFONO</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.telefono_conductor}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> CORREO</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.correo_conductor}</label>
            </div>
            <div class="col-3 col-12-small">
              <label class="label-datos"> DIRECCION</label>
            </div>
            <div class="col-9 col-12-small">
              <label class="to-copy-hand label-resultados">${_response.direccion_conductor}</label>
            </div>
          </div>
        </fieldset>
      </div>      
      <div class="col-2 col-12-small">
        <label class="label-datos"> CANAL</label>
      </div>
      <div class="col-10 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.canal}</label>
      </div>      
      <div class="col-2 col-12-small">
        <label class=" label-datos"> RECEPCIONISTA </label>
      </div>
      <div class="col-4 col-12-small">
        <label class="to-copy-hand label-resultados">${_response.usuario}</label>
      </div> 
      <div class="col-2 col-12-small">
        <label class="label-datos"> FECHA Y HORA </label>
      </div>
      <div class="col-4 col-12-small">
        <label class="lto-copy-hand label-resultados">${_response.fecha_ingreso}</label>
      </div> 
    </div>`;
    return inner_html;
  }
}
