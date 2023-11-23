<form id="form-datos-cliente-buscar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12">
            <i class="fa-solid fa-pen-to-square"></i> Editar datos del ingreso
        </div>
        <div class="col-8 col-12-mobilep">
            <div class="input-container">
                <i class="fas fa-align-left icon-input"></i>
                <div>
                    <input type="text" placeholder="Placa" name="placa" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-4 col-12-mobilep">
            <button type="submit" class="button primary fit icon solid fa-arrow-right">
                Buscar
            </button>
        </div>
    </div>
</form>
<form id="form-datos-cliente-editar" hidden>
    <div class="row gtr-25 gtr-uniform">
        <div class="col-6 col-12-mobilep">
            <button class="primary small icon solid fa-arrow-left" id="editar-btn-volver-top"> Volver</button>
        </div>
        <div class="col-12 align-center">
            <div class="vh-placa" id="editar-placa_vehiculo-html">ABC123</div>
        </div>
        <div class="col-12" hidden>
            <label> id_ingreso </label>
            <input type="text" name="id_ingreso" id="editar-id_ingreso" value="0" autocomplete="off">
            <label> id_vehiculo </label>
            <input type="text" name="id_vehiculo" id="editar-id_vehiculo" value="0" autocomplete="off">
            <label> id_propietario </label>
            <input type="text" name="id_propietario" id="editar-id_propietario" value="0" autocomplete="off">
            <label> id_conductor </label>
            <input type="text" name="id_conductor" id="editar-id_conductor" value="0" autocomplete="off">
        </div>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL PROPIETARIO </h3>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Tipo de documento</label>
            <div class="input-container">
                <i class="fas fa-arrows-alt-v icon-input"></i>
                <div>
                    <select id="editar-propietario_tipo_documento" name="propietario_tipo_documento">
                        <option value="default" selected="">Seleccionar tipo de documento</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Documento</label>
            <div class="input-container">
                <i class="fas fa-id-card icon-input"></i>
                <div>
                    <input type="text" placeholder="Documento" id="editar-propietario_documento"
                        name="propietario_documento" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres propietario" id="editar-propietario_nombres"
                        name="propietario_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos propietario" id="editar-propietario_apellidos"
                        name="propietario_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="editar-telefono_propietario"
                        name="propietario_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small"></div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Correo nombre</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="juan.david" id="editar-correo_propietario"
                        name="propietario_correo_nombre" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Correo dominio</label>
            <div class="input-container">
                <i class="fab fa-at icon-input"></i>
                <div>
                    <input type="text" id="editar-correo_propietario-text" value="" placeholder="gmail.com"
                        autocomplete="off">
                    <input type="hidden" name="propietario_correo_dominio" id="editar-correo_propietario-select"
                        value="gmail.com" data-default="gmail.com">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-datos-alt"> Dirección</label>
            <div class="input-container">
                <i class="fas fa-map-marked-alt icon-input"></i>
                <div>
                    <input type="text" placeholder="Diag 16b # 108 - 25" id="editar-direccion_propietario"
                        autocomplete="off" name="propietario_direccion" value="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL CONDUCTOR </h3>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Tipo de documento</label>
            <div class="input-container">
                <i class="fas fa-arrows-alt-v icon-input"></i>
                <div>
                    <select id="editar-conductor_tipo_documento" name="conductor_tipo_documento">
                        <option value="default" selected="">Seleccionar tipo de documento</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Documento</label>
            <div class="input-container">
                <i class="fas fa-id-card icon-input"></i>
                <div>
                    <input type="text" placeholder="Documento" id="editar-conductor_documento"
                        name="conductor_documento" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres conductor" id="editar-conductor_nombres"
                        name="conductor_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos conductor" id="editar-conductor_apellidos"
                        name="conductor_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="editar-telefono_conductor"
                        name="conductor_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="col-6 col-12-small"></div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Correo nombre</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="juan.david" id="editar-correo_conductor"
                        name="conductor_correo_nombre" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important label-datos-alt"> Correo dominio</label>
            <div class="input-container">
                <i class="fab fa-at icon-input"></i>
                <div>
                    <input type="text" id="editar-correo_conductor-text" value="" placeholder="gmail.com"
                        autocomplete="off">
                    <input type="hidden" name="conductor_correo_dominio" id="editar-correo_conductor-select"
                        value="gmail.com" data-default="gmail.com">
                </div>
            </div>
        </div>
        <div class="col-12">
            <fieldset class="fieldset-save">
                <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12">
                        <input type="checkbox" id="editar-terminos-condiciones" name="acepto_terminos_condiciones">
                        <label for="editar-terminos-condiciones" style="text-transform:none;">Yo
                            <b>JUANO</b>, He leído y acepto los términos y condiciones de uso. </label>
                    </div>
                    <div class="col-6 col-12-mobilep">
                        <button type="submit" class="button primary small fit icon solid fa-save">
                            Guardar
                        </button>
                    </div>
                    <div class="col-6 col-12-mobilep">
                        <button type="reset" class="button primary small fit icon solid fa-undo" id="editar-btn-reset">
                            Cancelar
                        </button>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-6 col-12-mobilep">
            <button class="primary small icon solid fa-arrow-left" id="editar-btn-volver-bottom"> Volver</button>
        </div>
    </div>
</form>