import { iniEditor } from '/app/controllers/novedades/iniEditor.js';

export class NotasClass {
  constructor() {
    this.validacionFormulario = $('#form_nota_historial').validate({
      ignore: [], // para el ckeditor
      debug: false, // para el ckeditor
      rules: {
        nota_guardar: {
          required: true,
        },
        nota: {
          required: function () {
            CKEDITOR.instances['form_nota_editor'].updateElement();
          },
          minlength: 10,
        },
        acepto_terminos_condiciones: {
          required: true,
        },
      },
      messages: {
        acepto_terminos_condiciones: 'Debe aceptar los términos y condiciones de uso.',
        nota: {
          required: 'La nota no puede estar vacía.',
          minlength: 'Debe contener mínimo 10 Caracteres.',
          maxlength: 'Debe contener máximo 250 Caracteres.',
        },
      },
      errorPlacement: function (label, element) {
        label.addClass('errorMsq');
        element.parent().append(label);
      },
    });

    this.#funcListener(this);
  }

  datosSubmit() {
    let configuracion = {
      form: new FormData($('#form_nota_historial')[0]),
      class: this,
    };

    configuracion.form.append('vehiculo', $('#datos-vehiculo-id').val());
    configuracion.form.append('propietario', $('#datos-propietario-id').val());
    configuracion.form.append('conductor', $('#datos-conductor-id').val());

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('callcenter/CallCenter', 'NotaCreate'),
          type: 'POST',
          data: configuracion.form,
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          processData: false,
          contentType: false,
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle(response.status);
              self.setContent(response.message);
              configuracion.class.datosPorTarea($('input[name=guardar]:checked', '#form_nota_historial').val());
              configuracion.class.setResetFormulario();
            } else if (response.statusText === 'csrf' || response.statusText === 'session') {
              self.close();
              call_recuperar_session(function (k) {
                configuracion.class.datosSubmit();
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

  setResetFormulario() {
    this.validacionFormulario.resetForm();
    $('#form_nota_historial').trigger('reset');
    $('#form_nota_historial')
      .find('input[type=hidden]')
      .each(function () {
        $(this).val($(this).attr('data-default'));
      });

    CKEDITOR.instances['form_nota_editor'].setData('', function () {
      this.updateElement();
    });
  }

  setDefaultHistorial() {
    this.setResetFormulario();
    $('#tabs-notas-historial-vehiculo').empty();
    $('#tabs-notas-historial-propietario').empty();
    $('#tabs-notas-historial-conductor').empty();
  }

  datosRecargar() {
    this.datosPorTarea('vehiculo');
    this.datosPorTarea('propietario');
    this.datosPorTarea('conductor');
  }

  datosEnContainer(_response, _task) {
    let inner_html = ``;
    $.each(_response, function (key, value) {
      inner_html += `<div class="message-notas-sms">`;
      inner_html += `${value.nota} `;
      inner_html += `<span class="identificador-notas-sms">`;
      inner_html += `${value.usuario} - <b>${value.fecha}</b>`;
      inner_html += `</span>`;
      inner_html += `<div class="message-notas-sms-delete" `;
      inner_html += `id="btn-nota-delete" `;
      inner_html += `data-id="${value.id}" data-table="${_task}"> `;
      inner_html += `</div>`;
      inner_html += `</div>`;
    });

    return inner_html;
  }

  datosEliminar(_id, _table) {
    let _class = this;

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('callcenter/CallCenter', 'NotaDelete'),
          type: 'POST',
          data: {
            id: _id,
            table: _table,
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle(response.status);
              self.setContent(response.message);
              _class.datosPorTarea(_table);
            } else if (response.statusText === 'csrf' || response.statusText === 'session') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosEliminar(_id);
              });
            } else {
              self.setTitle(response.status);
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
  datosPorTarea(_task = 'vehiculo') {
    let _class = this;
    let _target = 1;

    if (_task === 'vehiculo') {
      _target = $('#datos-vehiculo-id').val();
      $('#tabs-notas-historial-' + _task)
        .empty()
        .html();
    } else if (_task === 'propietario') {
      _target = $('#datos-propietario-id').val();
      $('#tabs-notas-historial-' + _task)
        .empty()
        .html();
    } else {
      _target = $('#datos-conductor-id').val();
      $('#tabs-notas-historial-' + _task)
        .empty()
        .html();
    }

    let self = $.confirm({
      title: false,
      content: 'Cargando, espere...',
      typeAnimated: true,
      scrollToPreviousElement: false,
      scrollToPreviousElementAnimate: false,
      content: function () {
        return $.ajax({
          url: getMyAppModel('callcenter/CallCenter', 'NotaListado'),
          type: 'POST',
          data: {
            target: _target,
            task: _task,
            rol: 'ID',
          },
          headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
          },
          dataType: 'json',
          timeout: 35000,
        })
          .done(function (response) {
            if (response.statusText === 'bien') {
              self.setTitle('Completado!');
              self.setContent('Espere un momento...');
              $('#tabs-notas-historial-' + _task)
                .empty()
                .html(_class.datosEnContainer(response.nota, _task));
              self.close();
            } else if (response.statusText === 'sin_resultados') {
              self.setTitle('Sin resultados');
              self.setContent(response.message);
              self.close();
              $('#tabs-notas-historial-' + _task)
                .empty()
                .html(response.message);
            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
              self.close();
              call_recuperar_session(function (k) {
                _class.datosPorTarea(_task);
              });
            } else {
              self.setTitle(response.statusText);
              self.setContent(response.message);
              $('#tabs-notas-historial-' + _task)
                .empty()
                .html(response.message);
            }
          })
          .fail(function (response) {
            console.log(response);
            self.setTitle('Error fatal');
            self.setContent(JSON.stringify(response));
          });
      },
      buttons: {
        aceptar: function () {},
      },
    });
  }

  #funcListener(_class) {
    iniEditor('form_nota_editor', 150);

    $('#form_nota_historial').on('submit', function (e) {
      if ($(this).valid() === true) {
        _class.datosSubmit();
      }
      e.preventDefault();
      return false;
    });

    $('#btn-notas-vehiculo-recargar').on('click', function (e) {
      _class.datosRecargar();
      e.preventDefault();
      return false;
    });

    $('#tabs-notas-historial-vehiculo,#tabs-notas-historial-propietario,#tabs-notas-historial-conductor').on(
      'click',
      '#btn-nota-delete',
      function (e) {
        let data = {
          id: $(this).attr('data-id'),
          table: $(this).attr('data-table'),
        };
        $.confirm({
          icon: 'fa fa-warning',
          title: '!Alerta ¡',
          content: `
                <center>
                ¿Está seguro que continuar?
                </center> `,
          typeAnimated: true,
          scrollToPreviousElement: false,
          scrollToPreviousElementAnimate: false,
          columnClass: 'xsmall',
          closeIcon: true,
          buttons: {
            si: {
              text: 'Si',
              btnClass: 'btn-blue',
              action: function () {
                _class.datosEliminar(data.id, data.table);
              },
            },
            no: {
              text: 'No',
              action: function () {},
            },
          },
        });
        e.preventDefault();
        return false;
      }
    );
  }
}
