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
            <div class="vh-placa" id="ingreso-placa_vehiculo-html"></div>
        </div>
        <?php require $app->ruta->getView('crear-cliente-vehiculo/Vehiculo') ?>
        <div class="col-12">
            <hr>
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL PROPIETARIO </h3>
        </div>
        <?php require $app->ruta->getView('crear-cliente-vehiculo/Propietario') ?>
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS DEL CONDUCTOR </h3>
        </div>
        <?php require $app->ruta->getView('crear-cliente-vehiculo/Conductor') ?>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'AceptoTerminos',
                array(
                    'id' => 'form_1_acepto_responsabilidad',
                    'name' => 'acepto_responsabilidad',
                    'reset' => 'ingreso-reset',
                    'disabled' => false
                )
            ) ?>
        </div>
    </div>
</form>