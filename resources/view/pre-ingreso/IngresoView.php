<form id="formulario-datos-ingreso">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <h3 class="datos-banner"> Datos del Vehículo</h3>
            <p>Estos datos aparecen en la tarjeta de propiedad</p>
            <br>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-placa"> Placa</label>
            <div class="input-container basico-input-select-placa">
                <i class="fas fa-ticket-simple icon-input"></i>
                <div>
                    <input type="hidden" name="id" value="<?=htmlspecialchars(trim($_GET['auth']))?>" autocomplete="off">
                    <input type="text" id="ingreso-placa" name="placa" placeholder="ABC123" value="<?=htmlspecialchars($authIngreso['placa'])?>" maxlength="6" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="basico-tipo_vehiculo"> Tipo de vehículo</label>
            <div class="input-container basico-input-select-placa">
                <i class="fas fa-list icon-input"></i>
                <div>
                    <select name="tipo_vehiculo" id="basico-tipo_vehiculo">
                        <option value="default" selected="">Seleccionar tipo vehículo</option>
                        <option value="2">LIVIANO</option>
                        <option value="4">MOTO</option>
                        <option value="6">TAXI</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 align-center">
            <h3 class="datos-banner"> Datos del Propietario ante el <b>RUNT</b></h3>
            <p>Son los de la persona o entidad que aparecen en la <b>tarjeta de propiedad</b> del vehículo</p>
            <br>
        </div>
        <div class="col-12" id="propietario-container">
            <div class="row gtr-25 gtr-uniform">
                <?php $tipo = "propietario";
                require $app->ruta->getView('pre-ingreso/Datos') ?>
            </div>
        </div>



        <div class="col-12 align-center">
            <h4 class="datos-banner"> </h4>
        </div>
        <div class="col-12">
            <fieldset class="fieldset-alt align-center">
                <legend># 1</legend>
                <div class="align-center">
                    <h3 class="datos-banner">¿Eres el propietario?</h3>
                    <input type="radio" id="soy-propietario-si" name="soy_el_propietario" value="si">
                    <label for="soy-propietario-si"> Si</label>
                    <input type="radio" id="soy-propietario-no" name="soy_el_propietario" value="no">
                    <label for="soy-propietario-no"> No</label>
                </div>
            </fieldset>
        </div>
        <div class="col-12" id="conductor-container" hidden>
            <div class="row gtr-25 gtr-uniform">
                <?php $tipo = "conductor";
                require $app->ruta->getView('pre-ingreso/Datos') ?>
            </div>
        </div>
        <div class="col-12">
            <fieldset class="fieldset-alt align-center">
                <legend># 2</legend>
                <div class="align-center">
                    <div>
                        <h3 class="datos-banner">Factura dirigida a:</h3>
                    </div>
                    <div>
                        <input type="radio" id="factura-propietario" name="a_quien_facturar" value="propietario">
                        <label for="factura-propietario"> Propietario </label>
                    </div>
                    <div id="radio-container-conductor" hidden>
                        <input type="radio" id="factura-conductor" name="a_quien_facturar" value="conductor">
                        <label for="factura-conductor"> Conductor </label>
                    </div>
                    <div>
                        <input type="radio" id="factura-otro" name="a_quien_facturar" value="otro">
                        <label for="factura-otro"> Otro </label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-12" id="facturar-container" hidden>
            <div class="row gtr-25 gtr-uniform">
                <?php $tipo = "factura";
                require $app->ruta->getView('pre-ingreso/Datos') ?>
            </div>
        </div>
        <div class="col-12 align-center">
            <hr>
            <h3 class="datos-banner"> Foto de la Tarjeta de Propiedad <b>(Opcional)</b></h3>
            <p></p>
        </div>
        <div class="col-6 col-12-small">
            <div class="align-center">
                <img src="/images/foto-delantera.jpg" id="tarjeta-delantera-src" style="width: 22.5em; border: 3px solid #8097b5;">
            </div>
            <br>
            <div class="photo-control">
                <div class="photo-input-container">
                    <label><i class="fas fa-image"></i> Delantera</label>
                    <input type="text" id="tarjeta-delantera" name="tarjeta_delantera" value="/images/sin_imagen.png" readonly="">
                </div>
                <div class="photo-buttons-container">
                    <button class="button primary small btn-camera-open" id="btn-tarjeta-delantera" data-folder="ingreso/foto/tarjeta" input-id="tarjeta-delantera"></button>
                    <button class="button primary small btn-camera-show" data-id="tarjeta-delantera" disabled></button>
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="align-center">
                <img src="/images/foto-trasera.jpg" id="tarjeta-trasera-src" style="width: 22.5em; border: 3px solid #8097b5;">
            </div>
            <br>
            <div class="photo-control">
                <div class="photo-input-container">
                    <label><i class="fas fa-image"></i> Trasera</label>
                    <input type="text" id="tarjeta-trasera" name="tarjeta_trasera" value="/images/sin_imagen.png" readonly="">
                </div>
                <div class="photo-buttons-container">
                    <button class="button primary small btn-camera-open" id="btn-tarjeta-trasera" data-folder="ingreso/foto/tarjeta" input-id="tarjeta-trasera"></button>
                    <button class="button primary small btn-camera-show" data-id="tarjeta-trasera" disabled></button>
                </div>
            </div>
        </div>

        <div class="col-12 align-center">
            <hr>
            <h3 class="datos-banner"> <b>Términos y Condiciones</b></h3>
            <hr>
        </div>
        <div class="col-12">
            <details>
                <summary> TERMINOS Y CONDICIONES DEL SERVICIO </summary>
                <?php require $app->ruta->getView('legal/TerminosCondiciones') ?>
            </details>
        </div>
        <div class="col-12">
            <details>
                <summary> CONDICIONES DE LA INSPECCIÓN </summary>
                <?php require $app->ruta->getView('legal/Condiciones') ?>
            </details>
        </div>
        <div class="col-12">
            <details>
                <summary> AVISO DE PRIVACIDAD </summary>
                <?php require $app->ruta->getView('legal/AvisoPrivacidad') ?>
            </details>
        </div>
        <div class="col-12">
            <details>
                <summary> AUTORIZACIÓN TRATAMIENTO DE DATOS </summary>
                <?php require $app->ruta->getView('legal/Autorizacion') ?>
            </details>
        </div>
        <div class="col-12 align-center">
            <br><br>
            <label class="label-orange"> RECORDATORIOS Y OFERTAS COMERCIALES</label>
            <p>
                Utilizar mis datos personales para contactarme vía <b>telefónica, mensaje de texto y correo electrónico</b>.
            </p>
            <input type="radio" id="ingreso-ofertas_comerciales-si" name="ofertas_comerciales" value="true">
            <label for="ingreso-ofertas_comerciales-si">SI</label>
            <input type="radio" id="ingreso-ofertas_comerciales-no" name="ofertas_comerciales" value="false">
            <label for="ingreso-ofertas_comerciales-no">NO</label>
        </div>
        <div class="col-12">
            <br><br>
            <fieldset class="fieldset-save">
                <legend>
                    <i class="fas fa-pencil-alt"> </i> Términos y condiciones
                </legend>
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <input type="checkbox" id="ingreso_terminos_condiciones" name="terminos_condiciones" required="">
                        <label for="ingreso_terminos_condiciones" style="text-transform:none;">He leído y acepto los <u>Términos y Condiciones</u>. </label>
                    </div>
                    <div class="col-6 col-12-mobilep">
                        <button type="submit" class="button primary small fit icon solid fa-save">
                            Guardar
                        </button>
                    </div>
                    <div class="col-6 col-12-mobilep">
                        <button type="reset" id="btn-cancelar" class="button primary small fit icon solid fa-undo" disabled>
                            Cancelar
                        </button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</form>