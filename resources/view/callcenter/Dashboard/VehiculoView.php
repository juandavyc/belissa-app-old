<form id="form_datos_vehiculo">
    <fieldset class="container-datos-vehiculo">
        <legend> DATOS VEHÍCULO </legend>
        <div class="row">
            <div class="col-3 col-12-mobilep align-left">
                <label class="label-id" id="datos-vehiculo-id-html"></label>
            </div>
            <div class="col-9 col-12-mobilep align-right">
                <button class="primary small icon solid fa-pencil btn-editar-actualizar" id="btn-datos-vehiculo-editar">
                    Editar</button>
                <button class="primary small icon solid fa-rotate btn-editar-actualizar"
                    id="btn-datos-vehiculo-recargar"> Recargar </button>
            </div>
            <div class="col-12" hidden>
                <label> id </label>
                <div class="input-container">
                    <i class="fas fa-align-left icon-input"></i>
                    <div>
                        <input type="text" placeholder="id-conductor" name="id" id="datos-vehiculo-id"
                            value="create_vehiculo" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label> Placa </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fab fa-cc-jcb icon-input"></i>
                    <div>
                        <input type="text" placeholder="Placa" name="placa" id="datos-vehiculo-placa" value=""
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label> Tipo </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fa-car-side icon-input"></i>
                    <div>
                        <select name="tipo" id="datos-vehiculo-tipo">
                            <option value="default" selected>Seleccione el tipo de vehículo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label> Servicio </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fas fa-taxi icon-input"></i>
                    <div>
                        <select name="servicio" id="datos-vehiculo-servicio">
                            <option value="default" selected>Seleccione el servicio del vehículo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label> Modelo </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fa-align-left icon-input"></i>
                    <div>
                        <input type="number" placeholder="Modelo" name="modelo" id="datos-vehiculo-modelo" value=""
                            inputmode="numeric" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label> Enseñanza </label>
            </div>
            <div class="col-6 col-12-small align-center">
                <input type="radio" id="datos-vehiculo-ensenanza-si" name="ensenanza" value="2">
                <label for="datos-vehiculo-ensenanza-si">SI</label>
                <input type="radio" id="datos-vehiculo-ensenanza-no" name="ensenanza" value="1" checked="">
                <label for="datos-vehiculo-ensenanza-no">NO</label>
            </div>
            <div class="col-3 col-12-small"></div>

            <div class="col-3 col-12-small">
                <label class="icon solid fa-bolt"> Marca </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fa-code-branch icon-input"></i>
                    <div>
                        <input type="text" id="datos-vehiculo-marca-text" value="SIN_MARCA" placeholder="Marca"
                            autocomplete="off">
                        <input type="hidden" name="marca" id="datos-vehiculo-marca-select" value="1" data-default="1"
                            required="">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label class="icon solid fa-bolt"> Linea </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fa-code-branch icon-input"></i>
                    <div>
                        <input type="text" id="datos-vehiculo-linea-text" value="SIN_LINEA" placeholder="Linea"
                            autocomplete="off">
                        <input type="hidden" name="linea" id="datos-vehiculo-linea-select" value="1" data-default="1"
                            required="">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label class="icon solid fa-bolt"> Color </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fa-palette icon-input"></i>
                    <div>
                        <input type="text" id="datos-vehiculo-color-text" value="SIN_COLOR"
                            placeholder="Nombre del color" />
                        <input type="hidden" name="color" id="datos-vehiculo-color-select" value="1" data-default="1"
                            required="" />
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-3 col-12-small">
                <label> VIN </label>
            </div>
            <div class="col-6 col-12-small">
                <div class="input-container">
                    <i class="fas fa-key icon-input"></i>
                    <div>
                        <input type="text" placeholder="VIN" name="vin" id="datos-vehiculo-vin" value=""
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-12" id="container-datos-vehiculo-guardar" hidden>
                <hr>
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <input type="checkbox" id="datos-vehiculo-terminos-condiciones"
                                name="acepto_terminos_condiciones">
                            <label for="datos-vehiculo-terminos-condiciones" style="text-transform:none;">Yo
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
                            <button type="reset" id="form_datos_vehiculo_reset"
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