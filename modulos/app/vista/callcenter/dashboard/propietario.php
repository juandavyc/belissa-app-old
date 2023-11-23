<form id="form_datos_propietario">
    <fieldset class="container-datos-cliente">
        <legend> DATOS PROPIETARIO </legend>
        <div class="row">
            <div class="col-3 col-12-mobilep align-left">
                <label class="label-id" id="datos-propietario-id-html"></label>
            </div>
            <div class="col-9 col-12-mobilep align-right">
                <button class="primary small icon solid fa-pencil btn-editar-actualizar"
                    id="btn-datos-propietario-editar"> Editar</button>
                <button class="primary small icon solid fa-rotate btn-editar-actualizar"
                    id="btn-datos-propietario-recargar"> Recargar </button>
            </div>
            <div class="col-12" hidden>
                <label> id </label>
                <input type="text" placeholder="id-conductor" name="id" id="datos-propietario-id"
                    value="create_propietario" autocomplete="off">
            </div>
            <div class="col-3 col-12-small">
                <label> Tipo </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-arrows-alt-v icon-input"></i>
                    <div>
                        <select name="tipo" id="datos-propietario-tipo">
                            <option value="default" selected="">Seleccionar tipo de documento</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Documento </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-id-card icon-input"></i>
                    <div>
                        <input type="text" placeholder="Documento" name="documento" id="datos-propietario-documento"
                            value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Nombre </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-signature icon-input"></i>
                    <div>
                        <input type="text" placeholder="Nombre" name="nombre" id="datos-propietario-nombre" value=""
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Apellido </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-signature icon-input"></i>
                    <div>
                        <input type="text" placeholder="Apellido" name="apellido" id="datos-propietario-apellido"
                            value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Tel # 1 </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-phone-volume icon-input"></i>
                    <div>
                        <input type="text" placeholder="000 000 00000" name="telefono_1"
                            id="datos-propietario-telefono-1" value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Tel # 2 </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-phone-volume icon-input"></i>
                    <div>
                        <input type="text" placeholder="000 000 00000" name="telefono_2"
                            id="datos-propietario-telefono-2" value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Tel # 3 </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-phone-volume icon-input"></i>
                    <div>
                        <input type="text" placeholder="000 000 00000" name="telefono_3"
                            id="datos-propietario-telefono-3" value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Email </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-at icon-input"></i>
                    <div>
                        <input type="email" placeholder="email@email.com" name="email" id="datos-propietario-email"
                            value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Direccion </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-map-marked-alt icon-input"></i>
                    <div>
                        <input type="text" placeholder="Direccion" name="direccion" id="datos-propietario-direccion"
                            value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-12" id="container-datos-propietario-guardar" hidden>
                <hr>
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <input type="checkbox" id="datos-propietario-terminos-condiciones"
                                name="acepto_terminos_condiciones">
                            <label for="datos-propietario-terminos-condiciones" style="text-transform:none;">Yo
                                <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>,
                                He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y
                                    condiciones</a> de uso. </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" id="form_datos_propietario_reset"
                                class="button primary small fit icon solid fa-undo" disabled>
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </fieldset>
</form>