

// let validateFormAgregarUsuario = $("#form_ingreso_basico").validate({
//     rules: {
//       documento: {
//         required: true,
//         minlength: 4,
//         maxlength: 20,
//         digits: true,
//         noSpace: true,
//       },
//       nombre: {
//         required: true,
//         minlength: 2,
//         maxlength: 50,
//         alphanumeric: true,
//       },
//       telefono_1: {
//         required: true,
//         minlength: 5,
//         maxlength: 10,
//         digits: true,
//         noSpace: true,
//       },
//       telefono_2: {
//         minlength: 5,
//         maxlength: 10,
//         digits: true,
//       },
//       telefono_3: {
//         minlength: 5,
//         maxlength: 10,
//         digits: true,
//       },
//       email: {
//         required: true,
//         maxlength: 50,
//         noSpace: true,
//         myEmail: true,
//       },
//       direccion: {
//         maxlength: 50,
//         alphanumeric: true,
//       },
//       documento_propietario: {
//         required: true,
//         minlength: 4,
//         maxlength: 20,
//         digits: true,
//         noSpace: true,
//       },
//       nombre_propietario: {
//         required: true,
//         minlength: 2,
//         maxlength: 50,
//         alphanumeric: true,
//       },
//       telefono_1_propietario: {
//         required: true,
//         minlength: 5,
//         maxlength: 10,
//         digits: true,
//         noSpace: true,
//       },
//       telefono_2_propietario: {
//         minlength: 5,
//         maxlength: 10,
//         digits: true,
//       },
//       telefono_3_propietario: {
//         minlength: 5,
//         maxlength: 10,
//         digits: true,
//       },
//       email_propietario: {
//         required: true,
//         maxlength: 50,
//         noSpace: true,
//         myEmail: true,
//       },
//       direccion_propietario: {
//         maxlength: 50,
//         alphanumeric: true,
//       },
//       placa: {
//         required: true,
//         minlength: 6,
//         maxlength: 6,
//         noSpace: true,
//       },
//       tipo: {
//         required: true,
//         valueNotEquals: 'default',
//       },
//       servicio: {
//         required: true,
//         valueNotEquals: 'default',
//       },
//       modelo: {
//         required: true,
//         number: true,
//         min: 1800,
//         max: 2050,
//       },
//       marca: {
//         required: true,
//         minlength: 6,
//         maxlength: 20,
//         alphanumeric: true,
//         noSpace: true,
//       },
//       linea: {
//         required: true,
//         minlength: 6,
//         maxlength: 20,
//         alphanumeric: true,
//         noSpace: true,
//       },
//       color: {
//         required: true,
//         minlength: 6,
//         maxlength: 20,
//         alphanumeric: true,
//         noSpace: true,
//       },
//       acepto_responsabilidad: {
//         required: true,
//       },
//     },
//     messages: {
//       acepto_responsabilidad: "Debe aceptar la responsabilidad de la información",
//     },
//     errorPlacement: function (label, element) {
//       label.addClass("errorMsq");
//       element.parent().append(label);
//     },
//   });


// $("#form_ingreso_basico").on("submit", function (e) {
//     let formdata = new FormData($("#form_ingreso_basico")[0]);
  
//     let self = $.confirm({
//       title: false,
//       content: "Cargando, espere...",
//       typeAnimated: true,
//       scrollToPreviousElement: false,
//       scrollToPreviousElementAnimate: false,
//       content: function () {
//         return $.ajax({
//           url:
//             PROTOCOL_HOST +
//             "/modulos/app/modelo/ingreso_basico/ingreso_basico.modelo.php?m=Create",
//           type: "POST",
//           data: formdata,
//           headers: {
//             "csrf-token": $('meta[name="csrf-token"]').attr("content"),
//           },
//           dataType: "json",
//           processData: false,
//           contentType: false,
//           timeout: 35000,
//         })
//           .done(function (response) {
//             if (response.statusText === "bien") {
//               self.setTitle(response.statusText);
//               self.setContent(response.message);
//               validateForm1.resetForm();
//             } else if (
//               response.statusText === "no_session" ||
//               response.statusText === "no_token"
//             ) {
//               self.close();
//               call_recuperar_session(function (k) {
//                 func_agregar_submit();
//               });
//             } else {
//               self.setTitle(response.statusText);
//               self.setContent(response.message);
//             }
//           })
//           .fail(function (response) {
//             self.setTitle("Error fatal");
//             self.setContent(JSON.stringify(response));
//             console.log(response);
//           });
//       },
//       buttons: {
//         aceptar: function () {},
//       },
//     });
  
//     e.preventDefault();
//     return false;
//   });