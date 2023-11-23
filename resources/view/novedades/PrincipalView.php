<form id="form_novedades_editar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12">
            <h3><b>Importante leer</b></h3>
            <p>
                Acá puede <b>enviar notificaciones</b> al todo el CDA.
            </p>
            <ul>
                <li>Verifique la ortografía.</li>
                <li>Esta información aparece en la <a href="/web">página principal</a>.</li>
                <li>No se guardan copias de respaldo de este módulo.</li>
            </ul>
        </div>
        <div class="col-12">
            <input type="hidden" value="1" id="form_novedades_id" name="id" autocomplete="off" readonly>
            <textarea id="form_novedades_editor" name="editor" class="container-ckeditor"></textarea>
            <hr>
        </div>
        <div class="col-12 align-center">
            <h3>Antes de guardar, previsualiza el contenido <b>¡Es gratis!</b></h3>
            <button class="primary small icon solid fa-eye" id="form_novedades_previsualizar">
                Previsualización</button>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'AceptoTerminos',
                array(
                    'id' => 'nov-1-condiciones',
                    'name' => 'acepto_responsabilidad',
                    'reset' => 'btn-editar-reset',
                    'disabled' => true
                )
            ) ?>
        </div>
    </div>
</form>