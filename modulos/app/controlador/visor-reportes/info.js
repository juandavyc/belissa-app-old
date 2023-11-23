export class InfoReporteClass {
  constructor() {}

  getInfo(_id) {
    // metodo del boton para la info
    let _class = this;
    let self = $.confirm({
      title: false,
      content: "Cargando, espere...",
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      columnClass: 'medium',
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            "/modulos/app/modelo/visor-reportes/visor.modelo.php?m=Info",
          type: "POST",
          data: {
            id: _id,
          },
          headers: {
            "csrf-token": $('meta[name="csrf-token"]').attr("content"),
          },
          dataType: "json",
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === "bien") {


                self.setTitle("Completado!");

              self.setContent(_class.setData(response.message));

            } else if (response.statusText === "sin_resultados") {
              self.setTitle("Sin resultados");
              self.setContent(response.message);
              self.close();
            } else if (
              response.statusText === "no_session" ||
              response.statusText === "no_token"
            ) {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosRecargar();
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle("Error fatal");
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }
  setData(_response) {
    console.log(_response);
    let innerHtml = `<div class='row'>
        <div class="col-12 col-12-small">

        <div class="col-12 align-center">
        <label class="label-orange"> DATOS DE LOG</label>
      </div>        
      <div class="col-4 col-12-small">
        <label class="label-datos"> TIPO LOG </label>
      </div>
      <div class="col-8 col-12-small align-center">
        <label class="label-resultados">${_response.tipo_bel}</label>
      </div>        
      <div class="col-4 col-12-small">
        <label class="label-datos"> MODULO </label>
      </div>
      <div class="col-8 col-12-small align-center">
        <label class="label-resultados">${_response.nombre_mod}</label>
      </div> 
      <div class="col-4 col-12-small">
        <label class="label-datos"> DESCRIPCION </label>
      </div>
      <div class="col-8 col-12-small align-center">
        <label class="label-resultados">${_response.descripcion}</label>
      </div>
      <div class="col-4 col-12-small">
          <label class="label-datos"> FECHA </label>
      </div>
      <div class="col-8 col-12-small align-center">
        <label class="label-resultados">${_response.fecha}</label>
      </div> 
      <div class="col-4 col-12-small">
        <label class="label-datos"> USUARIO </label>
      </div>
      <div class="col-8 col-12-small align-center">
        <label class="label-resultados">${_response.usuario}</label>
      </div> 


        </div>
   </div>
   `;

   return innerHtml;
    //respuesta en html
  }
}
