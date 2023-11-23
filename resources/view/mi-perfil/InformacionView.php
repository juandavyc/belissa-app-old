<form id="form_0_informacion" name="form_0_informacion">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <i class="fas fao-circle fa-3x"></i>
        </div>
        <div class="col-4 col-12-mobilep"></div>
        <div class="col-4 col-12-mobilep align-center">
            <span class="image fit">
                <img src="/images/sin_imagen.png" id="form_0_foto_usuario-src">
            </span>
            <label> SU FOTO</label>
        </div>

        <div class="col-12">
            <?php $app->ruta->getComponent(
                'FileChooserCameraControl',
                array(
                    'id' => 'form_0_foto_usuario',
                    'name' => 'foto_usuario',
                    'title' => 'Foto del usuario',
                    'icon' => 'fa-user',
                    'value' => '/images/sin_imagen.png',
                    'folder' => 'usuario/foto'
                )
            ) ?>
        </div>
        <div class="col-12">
            <br>
        </div>
        <div class="col-4 col-12-mobilep">
            <label class="label-orange"> DATOS BÁSICOS</label>
        </div>
        <div class="col-8 col-12-mobilep">
            <hr>
        </div>
        <div class="col-2 col-12-small">
            <label class="label-datos"> Cedula </label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-resultados" id="form_0_cedula">0</label>
        </div>
        <div class="col-6 col-12-small"></div>
        <div class="col-2 col-12-small">
            <label class="label-important label-datos"> Nombre(s) </label>
        </div>
        <div class="col-4 col-12-small">
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" name="nombre" id="form_0_nombre" placeholder="Nombre" autocomplete="off" value="" required="">
                </div>
            </div>
        </div>
        <div class="col-2 col-12-small">
            <label class="label-important label-datos"> Apellido(s)</label>
        </div>
        <div class="col-4 col-12-small">
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" name="apellido" id="form_0_apellido" placeholder="Apellido" autocomplete="off" value="" required="">
                </div>
            </div>
        </div>
        <div class="col-4 col-12-mobilep">
            <label class="label-orange"> INTERFAZ </label>
        </div>
        <div class="col-8 col-12-mobilep">
            <hr>
        </div>
        <div class="col-2 col-12-small"></div>
        <div class="col-4 col-12-small align-center">
            <img src="/images/ui_white.jpg"><br>
            <input type="radio" id="form_0_white" name="interfaz" value="1" checked>
            <label for="form_0_white"> Blanco azul</label>
        </div>
        <div class="col-4 col-12-small align-center">
            <img src="/images/ui_black.jpg"><br>
            <input type="radio" id="form_0_black" name="interfaz" value="2" disabled>
            <label for="form_0_black"> Negro verde</label>
        </div>
        <div class="col-2 col-12-small"></div>
        <div class="col-2 col-12-small"></div>
        <div class="col-8 col-12-small">
            <div class="canvas-container" id="canvas_firma_usuario" name="firma_usuario"></div>
        </div>
        <div class="col-2 col-12-small"></div>


        <div class="col-12">
            <?php $app->ruta->getComponent(
                'AceptoTerminos',
                array(
                    'id' => 'form_0_acepto_responsabilidad',
                    'name' => 'acepto_responsabilidad',
                    'reset' => 'btn-editar-reset-0',
                    'disabled' => true
                )
            ) ?>
        </div>
    </div>
</form>