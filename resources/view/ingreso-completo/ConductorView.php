<div class="col-12">
    <fieldset class="fieldset-alt">
        <legend>Conductor</legend>
        <div class="align-center">
            <h2 class="h2-eres-conductor">¿Es el <b>Conductor</b>?</h2>
            <input type="radio" id="ingreso-conductor-si" name="eres_conductor" value="2">
            <label for="ingreso-conductor-si" class="radio-eres-conductor">SI</label>
            <input type="radio" id="ingreso-conductor-no" name="eres_conductor" value="1">
            <label for="ingreso-conductor-no" class="radio-eres-conductor">NO</label>
        </div>
    </fieldset>
</div>

<div class="col-12" id="container-conductor-documento" hidden>
    <div class="container small align-center">
        <div class="input-container">
            <div>
                <div class="ingreso-input-documento">
                    <input type="text" placeholder="Documento" id="ingreso-conductor_documento" name="conductor_documento" value="" autocomplete="off" inputmode="text">
                </div>
                <b class="documento-instruccion">Al finalizar pulse ENTER</b>
            </div>
            <!-- <button class="primary small btn-buscar-documento" id="ingreso-btn-conductor-documento" style="border-radius: 15px;background: #565686;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button> -->
        </div>
    </div>
</div>

<div class="col-12" id="container-conductor-datos" hidden>
    <div class="row gtr-50 gtr-uniform">
        <div class="col-12">
            <label class="label-important label-datos-alt"> Tipo de documento</label>
            <div class="input-container">
                <i class="fas fa-arrows-alt-v icon-input"></i>
                <div>
                    <select id="ingreso-conductor_tipo_documento" name="conductor_tipo_documento">
                        <option value="default" selected="">Seleccionar tipo de documento</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12">
            <label class="label-important label-datos-alt"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres conductor" id="ingreso-conductor_nombres" name="conductor_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-important label-datos-alt"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos conductor" id="ingreso-conductor_apellidos" name="conductor_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="col-12">
            <label class="label-important label-datos-alt"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="ingreso-telefono_conductor" name="conductor_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-important label-datos-alt"> Correo nombre</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="juan.david" id="ingreso-correo_conductor" name="conductor_correo_nombre" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-important label-datos-alt"> Correo dominio</label>
            <div class="input-container">
                <i class="fas fa-at icon-input"></i>
                <div>
                    <input type="text" id="ingreso-correo_conductor-text" value="" placeholder="gmail.com" autocomplete="off">
                    <input type="hidden" name="conductor_correo_dominio" id="ingreso-correo_conductor-select" value="gmail.com" data-default="gmail.com">
                </div>
            </div>
        </div>
    </div>
</div>