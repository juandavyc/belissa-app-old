<form id="form-ingreso" hidden>
    <div class="row gtr-50 gtr-uniform">
        <div class="col-12" hidden>
            <label> id vehiculo </label>
            <input type="text" name="id_vehiculo" id="ingreso-id_vehiculo" value="1" autocomplete="off">
            <label> placa vehiculo </label>
            <input type="text" name="placa" id="ingreso-placa_vehiculo" value="1" autocomplete="off">
            <label> id_propietario </label>
            <input type="text" name="id_propietario" id="ingreso-id_propietario" value="0" autocomplete="off">
            <label> id_conductor </label>
            <input type="text" name="id_conductor" id="ingreso-id_conductor" value="0" autocomplete="off">
            <label> vez </label>
            <input type="text" name="vez" id="ingreso-vez" value="2" autocomplete="off">
        </div>
        <div class="col-12 align-center">
            <div class="vh-placa" id="ingreso-placa_vehiculo-html">ABC123</div>
        </div>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL VEHÍCULO </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-rapido/vehiculo.php';?>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> PRESIÓN DE LLANTAS </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-rapido/llantas.php';?>
        <div class="col-12">
            <hr>
            <h3 class="icon solid fa-arrow-right h3-orange"> DEFECTOS DEL VEHÍCULO </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/defectos.php';?>
        <div class="col-12" hidden>
            <hr>
            <h3 class="icon solid fa-arrow-right h3-orange"> CRITERIOS DE LA INSPECCIÓN</h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-rapido/criterios.php';?>
        <div class="col-12">
            <hr>
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL PROPIETARIO </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/propietario.php';?>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL CONDUCTOR </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/conductor.php';?>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> COMO SE ENTERÓ DE NOSOTROS </h3>
        </div>
        <div class="col-12">
            <label class="label-important label-datos-alt"> Canal de mercadeo </label>
            <div class="input-container">
                <i class="fas fa-briefcase icon-input"></i>
                <div>
                    <input type="text" id="ingreso-canal-mercadeo-text" value=""
                        placeholder="Escriba el canal de mercadeo" autocomplete="off">
                    <input type="hidden" name="canal_mercadeo" id="ingreso-canal-mercadeo-select" value="1"
                        data-default="1" required="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> FIRMA </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/firma.php';?>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> OBSERVACIONES </h3>
        </div>
        <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/observaciones.php';?>
        <div class="col-12">
            <fieldset class="fieldset-save">
                <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12">
                        <input type="checkbox" id="ingreso-acepto_responsabilidad" name="acepto_responsabilidad"
                            required="">
                        <label for="ingreso-acepto_responsabilidad" style="text-transform:none;">Yo
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