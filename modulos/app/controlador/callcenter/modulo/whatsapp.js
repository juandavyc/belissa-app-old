export class WhatsappClass {
  constructor() {
    this.#funcListener();
  }

  #funcListener(_class = this) {
    $('#btn-whatsapp-numero-recargar').on('click', function (e) {
      _class.getNumeroClientes();
      e.preventDefault();
      return false;
    });

    $('#container-whatsapp-numeros').on('click', '.btn-whatsapp-propietario', function (e) {
      window.open('https://wa.me/57' + $('#datos-propietario-telefono-' + $(this).attr('input-id')).val(), '_blank');
      e.preventDefault();
      return false;
    });
    $('#container-whatsapp-numeros').on('click', '.btn-whatsapp-conductor', function (e) {
      window.open('https://wa.me/57' + $('#datos-conductor-telefono-' + $(this).attr('input-id')).val(), '_blank');
      e.preventDefault();
      return false;
    });
  }

  getNumeroClientes() {
    let _class = this;
    let _inner_html = ``;

    _class.setDefault();
    // el mismo <label class="label-important label-datos"> Guardar en </label>
    _inner_html += `<div class="row gtr-25 gtr-uniform">`;
    _inner_html += `
      <div class="col-3 col-12-small">
        <label class="label-datos"> Nombre </label>
      </div>
      <div class="col-9 col-12-small">        
        <label class="label-resultados"> ${$('#datos-propietario-nombre').val() + ' ' + $('#datos-propietario-apellido').val()} </label>
      </div>
      <div class="col-3 col-12-small">
        <label class="label-datos"> Telefono # 1 </label>
      </div>
      <div class="col-6 col-12-small">
        <div class="input-container">
          <i class="fas fa-phone-volume icon-input"></i>
          <input type="text" value="${$('#datos-propietario-telefono-1').val()}" autocomplete="off" id="whatsapp-prop-nro-1">
        </div>
      </div>
      <div class="col-3 col-12-small align-right">
        <button class="primary small icon brands fa-whatsapp btn-whatsapp-propietario" input-id="1"> Enviar Whatsapp</a>
      </div>
      <div class="col-3 col-12-small">
        <label class="label-datos"> Telefono # 2 </label>
      </div>
      <div class="col-6 col-12-small">
        <div class="input-container">
          <i class="fas fa-phone-volume icon-input"></i>
          <input type="text" value="${$('#datos-propietario-telefono-2').val()}" autocomplete="off" id="whatsapp-prop-nro-2">
        </div>
      </div>
      <div class="col-3 col-12-small align-right">
        <button class="primary small icon brands fa-whatsapp btn-whatsapp-propietario" input-id="2"> Enviar Whatsapp</a>
      </div>
      <div class="col-3 col-12-small">
        <label class="label-datos"> Telefono # 3</label>
      </div>
      <div class="col-6 col-12-small">
        <div class="input-container">
          <i class="fas fa-phone-volume icon-input"></i>
          <input type="text" value="${$('#datos-propietario-telefono-3').val()}" autocomplete="off" id="whatsapp-prop-nro-3">
        </div>
      </div>
      <div class="col-3 col-12-small align-right">
        <button class="primary small icon brands fa-whatsapp btn-whatsapp-propietario" input-id="3"> Enviar Whatsapp</a>
      </div>`;
    _inner_html += `</div>`;

    // diferentes
    if ($('#datos-propietario-id').val() != $('#datos-conductor-id').val()) {
      _inner_html += `<fieldset>`;
      _inner_html += `<legend class="icon solid fa-user"> Conductor </legend>`;
      _inner_html += `<div class="row gtr-25 gtr-uniform">`;
      _inner_html += `
      <div class="col-3 col-12-small">
        <label class="label-datos"> Nombre </label>
      </div>
      <div class="col-9 col-12-small">
        <label class="label-resultados"> ${$('#datos-conductor-nombre').val() + ' ' + $('#datos-conductor-apellido').val()} </label>
      </div>
      <div class="col-3 col-12-small">
        <label class="label-datos"> Telefono # 1 </label>
      </div>
      <div class="col-6 col-12-small">
        <div class="input-container">
          <i class="fas fa-phone-volume icon-input"></i>
          <input type="text" value="${$('#datos-conductor-telefono-1').val()}" autocomplete="off" id="whatsapp-cond-nro-1">
        </div>
      </div>
      <div class="col-3 col-12-small align-right">
        <button class="primary small icon brands fa-whatsapp btn-whatsapp-conductor" input-id="1"> Enviar Whatsapp</a>
      </div>
      <div class="col-3 col-12-small">
        <label class="label-datos"> Telefono # 2 </label>
      </div>
      <div class="col-6 col-12-small">
        <div class="input-container">
          <i class="fas fa-phone-volume icon-input"></i>
          <input type="text" value="${$('#datos-conductor-telefono-2').val()}" autocomplete="off" id="whatsapp-cond-nro-2">
        </div>
      </div>      
      <div class="col-3 col-12-small align-right">
        <button class="primary small icon brands fa-whatsapp btn-whatsapp-conductor" input-id="2"> Enviar Whatsapp</a>
      </div>
      <div class="col-3 col-12-small">
        <label class="label-datos"> Telefono # 3 </label>
      </div>
      <div class="col-6 col-12-small">
        <div class="input-container">
          <i class="fas fa-phone-volume icon-input"></i>
          <input type="text" value="${$('#datos-conductor-telefono-3').val()}" autocomplete="off" id="whatsapp-cond-nro-3">
        </div>
      </div>
      <div class="col-3 col-12-small align-right">
        <button class="primary small icon brands fa-whatsapp btn-whatsapp-conductor" input-id="3"> Enviar Whatsapp</a>
      </div>`;
      _inner_html += `</div>`;
      _inner_html += `</fieldset>`;
    }

    $('#container-whatsapp-numeros').html(_inner_html);
  }

  setDefault() {
    $('#container-whatsapp-numeros').empty();
  }
}
