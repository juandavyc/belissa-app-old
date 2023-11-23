<!-- ingreso-input-mod -->
<div class="col-12">
            <div class="container small align-center">
                <div class="input-container">
                    <div>
                        <div class="ingreso-input-documento">
                            <input type="text" placeholder="Documento" id="ingreso-propietario_documento" name="propietario_documento" value="" autocomplete="off">
                        </div>
                    </div>
                    <button class="primary small btn-buscar-documento" id="ingreso-btn-propietario-documento" style="border-radius: 15px;background: #565686;"> 
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
<div class="col-12" id="container-propietario-datos" hidden>
    <div class="row gtr-50 gtr-uniform">        
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Tipo de documento</label>
            <div class="input-container">
                <i class="fas fa-arrows-alt-v icon-input"></i>
                <div>
                    <select id="ingreso-propietario_tipo_documento" name="propietario_tipo_documento">
                        <option value="default" selected="">Seleccionar tipo de documento</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres propietario" id="ingreso-propietario_nombres" name="propietario_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos propietario" id="ingreso-propietario_apellidos" name="propietario_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="ingreso-telefono_propietario" name="propietario_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Correo nombre</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="juan.david" id="ingreso-correo_propietario" name="propietario_correo_nombre" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Correo dominio</label>
            <div class="input-container">
                <i class="fas fa-at icon-input"></i>
                <div>
                    <input type="text" id="ingreso-correo_propietario-text" value="" placeholder="gmail.com" autocomplete="off">
                    <input type="hidden" name="propietario_correo_dominio" id="ingreso-correo_propietario-select" value="gmail.com" data-default="gmail.com">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-datos-alt"> Dirección</label>
            <div class="input-container">
                <i class="fas fa-map-marked-alt icon-input"></i>
                <div>
                    <input type="text" placeholder="Diag 16b # 108 - 25" id="ingreso-direccion_propietario" autocomplete="off" name="propietario_direccion" value="">
                </div>
            </div>
        </div>
    </div>
</div>