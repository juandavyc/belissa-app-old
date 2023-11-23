<div class="container small">

    <form id="form_1_contrasena" name="form_1_contrasena">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12 align-center">
                <i class="fas fa-key fa-3x"></i>
            </div>
            <div class="col-12">
                <label class="label-important"> Ingrese su antigua contraseña </label>
            </div>
            <div class="col-12">
                <div class="input-container">
                    <input type="password" name="form_1_antigua_contrasena" id="form_1_antigua_contrasena" class="input-contrasenia" placeholder="Antigua contraseña" autocomplete="off" value="" maxlength="25" required="">
                    <i class="fas fa-eye icon-input icon-contrasenia" data-check="1" data-id="form_1_antigua_contrasena"></i>
                </div>
            </div>
            <div class="col-12">
                <label class="label-important"> Ingrese su nueva contraseña </label>
            </div>
            <div class="col-12">
                <div class="input-container">
                    <input type="password" name="form_1_nueva_contrasena" id="form_1_nueva_contrasena" class="input-contrasenia" placeholder="Nueva contraseña" autocomplete="off" value="" maxlength="25" required="">
                    <i class="fas fa-eye icon-input icon-contrasenia" data-check="1" data-id="form_1_nueva_contrasena"></i>
                </div>
            </div>
            <div class="col-12">
                <label class="label-important"> Confirmar su nueva contraseña </label>
            </div>
            <div class="col-12">
                <div class="input-container">
                    <input type="password" name="form_1_confirmar_contrasena" id="form_1_confirmar_contrasena" class="input-contrasenia" placeholder="Confirmar contraseña" autocomplete="off" value="" maxlength="25" required="">
                    <i class="fas fa-eye icon-input icon-contrasenia" data-check="1" data-id="form_1_confirmar_contrasena"></i>
                </div>
            </div>
            <div class="col-12">
                <?php $app->ruta->getComponent(
                    'AceptoTerminos',
                    array(
                        'id' => 'form_1_acepto_responsabilidad',
                        'name' => 'acepto_responsabilidad',
                        'reset' => 'btn-editar-reset-1',
                        'disabled' => true
                    )
                ) ?>
            </div>
        </div>
    </form>
</div>