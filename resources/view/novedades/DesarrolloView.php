<form id="form_callcenter_dev">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <i class="fa-solid fa-code fa-3x"></i>
        </div>
        <div class="col-12">
            <h3><b>Importante leer</b></h3>
            <p>
                Acá puede <b>enviar notificaciones</b> al equipo de callcenter, tareas o observaciones, las van a ver al
                iniciar el módulo de callcenter.
            </p>
            <ul>
                <li>Verifique la ortografía.</li>
                <li>Esta información aparece en la <a href="/web/callcenter/">página principal</a>.</li>
                <li>No se guardan copias de respaldo de este módulo.</li>
            </ul>
        </div>
        <div class="col-12">
            <b> DESARROLLO</b>
            <input type="hidden" value="3" id="form_dev_id" name="id" autocomplete="off" readonly>
            <textarea id="form_dev_editor" name="editor" class="container-ckeditor"></textarea>
            <hr>
        </div>
        <div class="col-12 align-center">
            <h3>Antes de guardar, previsualiza el contenido <b>¡Es gratis!</b></h3>
            <button class="primary small icon solid fa-eye" id="form_dev_previsualizar">
                Previsualización</button>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'AceptoTerminos',
                array(
                    'id' => 'form_2_acepto_responsabilidad',
                    'name' => 'acepto_responsabilidad',
                    'reset' => 'btn-editar-reset',
                    'disabled' => true
                )
            ) ?>
        </div>
    </div>
</form>