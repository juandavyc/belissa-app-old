<?php
if (isset($dir) && isset($data)) {
?>
    <div class="col-12">
        <fieldset>
            <legend style="color:blueviolet;">Mercadeo</legend>
            <div class="row gtr-25 gtr-uniform">
                <div class="col-12 col-12-small">
                    <p class="align-center">
                        Este usuario al ser un canal de mercadeo, <u><b>puede agendar placas</b></u>
                        <br>
                        El Nombre se compone por el <b>Nombre y Apellido </b>
                    </p>
                    <input type="hidden" id="<?= $data->id ?>-id-canal" name="canal" value="<?= $data->value ?>">
                </div>
                <div class="col-4 col-12-small">
                    <label class="label-datos label-important"> <?= $data->content ?></label>
                </div>
                <div class="col-8 col-12-small">
                    <input type="radio" id="<?= $data->id ?>-si-canal" name="canal" value="1">
                    <label for="<?= $data->id ?>-si-canal"> SI </label>
                    <input type="radio" id="<?= $data->id ?>-no-canal" name="canal" value="2" checked="">
                    <label for="<?= $data->id ?>-no-canal"> NO </label>
                </div>
                <div class="col-4 col-12-small">
                    <label class="label-datos label-important"> Tipo de canal </label>
                </div>
                <div class="col-8 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-briefcase icon-input"></i>
                        <div>
                            <select id="tipo-canal" name="tipo_canal" required="">
                            </select>
                        </div>
                    </div>
                </div>
        </fieldset>
    </div>
<?php
}
