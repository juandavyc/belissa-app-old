export function fun_tipo_canal_submit() {

    let head = ["nro", "nombre"];
    let self = $.confirm({
      title: false,
      content: "Cargando, espere...",
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url:
            PROTOCOL_HOST +
            '/modulos/app/modelo/canal/canal.modelo.php?m=Tab',
          type: "POST",
          headers: {
            "csrf-token": $('meta[name="csrf-token"]').attr("content"),
          },
          dataType: "json",
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
  
            if (response.statusText === 'bien') {
              self.setTitle("Completado!");
              self.setContent("Espere un momento...");

              $("#div_table ").html(
                "<table>" +
                "<tr>" +
                "<td><b>NUMERO</b></td>" +
                "<td><b>NOMBRE</b></td>" +
                "</tr>" +
                "<tbody>" +
                getTbodyTable1(response.message) +
                "</tbody>" +
                "</table>"
              );

              
  
              self.close();
            } else if (response.statusText === "sin_resultados") {
              self.setTitle("Completado!");
              self.setContent("Espere un momento...");
              self.close();
            } else if (
                response.statusText === 'no_session' ||
                response.statusText === 'no_token'
            ) {
              self.close();
              call_recuperar_session(function (k) {
                fun_tipo_canal_submit(_type);
              });
            } else {
              self.setTitle(response.status);
              self.setContent(response.message);
            }
          })
          .fail(function (response) {
            self.setTitle('Error fatal');
            self.setContent(response.statusText + ' // ' + response.responseText);
            console.log(response);
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }
  

  function getTbodyTable1($array) {
    let inner_html = "";
    $.each($array, function (key, value) {
      inner_html += '<tr id="' + key + '">';
      $.each($array[key], function (keyy, valuee) {
        inner_html +=
          '<td data-label="' +
          keyy +
          '" id="table_' +
          keyy +
          '">' +
          escapehtmljs(valuee) +
          "</td>";

      // console.log($array[key]);
      });
      inner_html += "</tr>";
    });
    inner_html += "";
    return inner_html;
  }
  

 