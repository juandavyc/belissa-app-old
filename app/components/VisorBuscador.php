<?php

if (isset($dir) && isset($data)) {
?>

    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <i class="fa-solid fa-magnifying-glass fa-3x"></i>
            <h3> <b>BUSCADOR</b> : <?= $data->name ?></h3>
        </div>
        <div class="col-12">
            <fieldset>
                <legend>
                    <b class="buscador-b"> Búsqueda:</b>
                    <input type="radio" id="<?= $data->id ?>_basica" name="buscador" value="1" checked="">
                    <label for="<?= $data->id ?>_basica"> Básica</label>
                    <input type="radio" id="<?= $data->id ?>_avanzada" name="buscador" value="2">
                    <label for="<?= $data->id ?>_avanzada"> Avanzada</label>
                </legend>
                <form id="<?= $data->id ?>_buscador">
                    <div class="row gtr-25 gtr-uniform">
                        <!-- buscador avanzado -->
                        <div class="col-12" id="<?= $data->id ?>-container-buscador-avanzado" hidden>
                            <?php require $data->advanced ?>
                        </div>
                        <?php require $data->essential ?>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="col-12 align-right">
            <button id="<?= $data->id ?>_exportar_excel" class="button primary small icon solid fa-file-excel">
                Exportar a EXCEL
            </button>
        </div>
        <div class="col-12">
            <div id="<?= $data->id ?>_container_resultados_title" class="div-resultado-title" hidden></div>
            <div id="<?= $data->id ?>_container_resultados_body" class="div-resultado-body" hidden></div>
            <div id="<?= $data->id ?>_container_resultados_pagination" class="div-resultado-pagination" hidden></div>
        </div>
    </div>
<?php
}

?>