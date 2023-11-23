<div class="col-6 col-12-mobilep"></div>
<div class="col-6 col-12-mobilep">
    <label class="label-datos-alt-orange"> Copiar datos conductor</label>
    <button id="ingreso-btn-datos-conductor" class="button primary small fit btn-form-event icon solid fa-copy">
        Copiar
        Datos</button>
</div>

<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Tipo de documento</label>
    <div class="input-container">
        <i class="fas fa-arrows-alt-v icon-input"></i>
        <div>
            <select id="ingreso-conductor_tipo_documento" name="conductor_tipo_documento">
                <option value="default" selected="">Seleccionar tipo de documento</option>
                <option value="1">CEDULA</option>
                <option value="2">NIT</option>
                <option value="3">CEDULA DE EXTRANGERIA</option>
                <option value="4">TARJETA IDENTIDAD</option>
            </select>
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Documento</label>
    <div class="input-container">
        <i class="fas fa-id-card icon-input"></i>
        <div>
            <input type="text" placeholder="Documento" id="ingreso-conductor_documento" name="conductor_documento" inputmode="numeric" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Nombres</label>
    <div class="input-container">
        <i class="fas fa-signature icon-input"></i>
        <div>
            <input type="text" placeholder="Nombres conductor" id="ingreso-conductor_nombres" name="conductor_nombres" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Apellidos</label>
    <div class="input-container">
        <i class="fas fa-signature icon-input"></i>
        <div>
            <input type="text" placeholder="Apellidos conductor" id="ingreso-conductor_apellidos" name="conductor_apellidos" value="" autocomplete="off">
        </div>
    </div>
</div>

<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Whatsapp </label>
    <div class="input-container">
        <i class="fas fa-phone-volume icon-input"></i>
        <div>
            <input type="text" placeholder="000 000 0000" id="ingreso-telefono_conductor" name="conductor_telefono" inputmode="numeric" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small"></div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Correo nombre</label>
    <div class="input-container">
        <i class="fas fa-signature icon-input"></i>
        <div>
            <input type="text" placeholder="juan.david" id="ingreso-correo_conductor" name="conductor_correo_nombre" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Correo dominio</label>
    <div class="input-container">
        <i class="fab fa-at icon-input"></i>
        <div>
            <input type="text" id="ingreso-correo_conductor-text" value="" placeholder="gmail.com" autocomplete="off">
            <input type="hidden" name="conductor_correo_dominio" id="ingreso-correo_conductor-select" value="gmail.com" data-default="gmail.com">
        </div>
    </div>
</div>