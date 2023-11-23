<form id="form-ingreso" hidden>
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12" hidden>
            <hr>
            <label> id vehiculo </label>
            <input type="text" name="id_vehiculo" id="ingreso-id_vehiculo" value="1" autocomplete="off">
            <label> placa vehiculo </label>
            <input type="text" name="placa" id="ingreso-placa_vehiculo" value="1" autocomplete="off">
            <label> id_propietario </label>
            <input type="text" name="id_propietario" id="ingreso-id_propietario" value="0" autocomplete="off">
            <label> id_conductor </label>
            <input type="text" name="id_conductor" id="ingreso-id_conductor" value="0" autocomplete="off">
        </div>
        <div class="col-12 align-center">
            <div class="vh-placa" id="ingreso-placa_vehiculo-html">ABC123</div>
        </div>       
        <?php require $app->ruta->getView('ingreso-dividido/Vehiculo') ?>
        <div class="col-12">
            <hr>
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL PROPIETARIO </h3>
        </div>
        <?php require $app->ruta->getView('ingreso-dividido/Propietario') ?>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL CONDUCTOR </h3>
        </div>
        <?php require $app->ruta->getView('ingreso-dividido/Conductor') ?>        
        <div class="col-12">
            <fieldset class="fieldset-save">
                <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12">
                        <input type="checkbox" id="form_1_acepto_responsabilidad" name="acepto_responsabilidad"
                            required="">
                        <label for="form_1_acepto_responsabilidad" style="text-transform:none;">YO
                            <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>, He leído y acepto
                            los términos y condiciones de uso.
                        </label>
                    </div>
                    <div class="col-6 col-12-mobilep">
                        <button type="reset" class="button primary small fit icon solid fa-undo" id="ingreso-reset">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-6 col-12-mobilep">
                        <button type="submit" class="button primary small fit icon solid fa-save">
                            Guardar
                        </button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</form>