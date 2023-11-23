<div class="col-6 col-12-small">
    <label class="label-important" for="ingreso-<?= $tipo ?>_documento"> Documento</label>
    <div class="input-container">
        <i class="fas fa-hashtag icon-input"></i>
        <div>
            <input type="text" id="ingreso-<?= $tipo ?>_documento" name="<?= $tipo ?>_documento" placeholder="Documento" autocomplete="off" maxlength="50" required />
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label for="ingreso-<?= $tipo ?>-tipo-documento">Tipo Documento</label>
    <div class="input-container">
        <i class="fas fa-list icon-input"></i>
        <div>
            <select id="ingreso-<?= $tipo ?>-tipo-documento" name="<?= $tipo ?>_tipo_documento">
                <option value="default" selected="">Seleccionar tipo de documento</option>
            </select>
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important" for="ingreso-<?= $tipo ?>_nombres"> Nombres</label>
    <div class="input-container">
        <i class="fas fa-signature icon-input"></i>
        <div>
            <input type="text" placeholder="Nombres" id="ingreso-<?= $tipo ?>_nombres" name="<?= $tipo ?>_nombres" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important" for="ingreso-<?= $tipo ?>_apellidos"> Apellidos</label>
    <div class="input-container">
        <i class="fas fa-signature icon-input"></i>
        <div>
            <input type="text" placeholder="Apellidos" id="ingreso-<?= $tipo ?>_apellidos" name="<?= $tipo ?>_apellidos" value="" autocomplete="off">
        </div>
    </div>
</div>

<div class="col-6 col-12-small">
    <label class="label-important" for="ingreso-telefono_<?= $tipo ?>"> Whatsapp </label>
    <div class="input-container">
        <i class="fas fa-phone-volume icon-input"></i>
        <div>
            <input type="text" placeholder="000 000 0000" id="ingreso-telefono_<?= $tipo ?>" name="<?= $tipo ?>_telefono" inputmode="numeric" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-12">
    <label class="label-important" for="ingreso-correo_<?= $tipo ?>"> Correo </label>
    <div class="input-container">
        <i class="fas fa-signature icon-input"></i>
        <div>
            <input type="text" placeholder="correo@correo.com" id="ingreso-correo_<?= $tipo ?>" name="<?= $tipo ?>_correo" value="" autocomplete="off">
        </div>
    </div>
</div>
<div class="col-12">
    <label class="label-important" for="ingreso-direccion_<?= $tipo ?>"> Dirección</label>
    <div class="input-container">
        <i class="fas fa-map-marked-alt icon-input"></i>
        <div>
            <input type="text" placeholder="Calle 00 # 00 - 00" id="ingreso-direccion_<?= $tipo ?>" autocomplete="off" name="<?= $tipo ?>_direccion" value="">
        </div>
    </div>
</div>
<div class="col-12" id="<?= $tipo ?>-rut" hidden>
    <hr>
    <?php $app->ruta->getComponent(
        'FileChooserCameraControl',
        array(
            'id' => $tipo . '-rut',
            'name' => $tipo . '_rut',
            'title' => 'Foto RUT (Opcional)',
            'icon' => 'fa-image',
            'value' => '/images/sin_imagen.png',
            'folder' => 'ingreso/foto/rut'
        )
    ) ?>
</div>