<div class="row gtr-25 gtr-uniform">
    <div class="col-12">
        <fieldset>
            <legend>Datos básicos</legend>
            <div class="row gtr-25 gtr-uniform">
                <div class="col-12" hidden>
                    <input type="text" name="id" id="id" value="0">
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Nombre </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-signature icon-input"></i>
                        <div>
                            <input type="text" id="nombre" placeholder="Nombre " name="nombre" value="" maxlength="40" required="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Apellido </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-signature icon-input"></i>
                        <div>
                            <input type="text" id="apellido" placeholder="Apellido" name="apellido" value="" maxlength="40" required="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Tipo Documento </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-sort-numeric-up-alt icon-input"></i>
                        <select id="tipo-documento" name="tipo_documento" required="">

                        </select>
                    </div>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Documento </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-id-card icon-input"></i>
                        <div>
                            <input type="number" id="documento" placeholder="Documento" name="documento" value="" maxlength="40" required="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Correo </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-at icon-input"></i>
                        <div>
                            <input type="email" id="correo" placeholder="Correo " name="correo" value="" maxlength="40" required="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Rango </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-users icon-input"></i>
                        <div>
                            <select id="rango" name="rango" required="">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-important label-datos"> Nacimiento</label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-calendar icon-input"></i>
                        <div>
                            <input type="text" name="nacimiento" id="nacimiento" class="input_date_listener" value="<?= $app->getCurrentDate() ?>" autocomplete="off" required="">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12">
        <?php $app->ruta->getComponent(
            'CanvasFirma',
            array(
                'id' => 'firma-usuario',
                'name' => 'firma_usuario',
                'title' => 'Su firma'
            )
        ) ?>
    </div>
</div>