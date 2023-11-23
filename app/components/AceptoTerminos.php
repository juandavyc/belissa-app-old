<?php
if (isset($dir) && isset($data)) {
?>
    <fieldset class="fieldset-save">
        <legend>
            <i class="fas fa-pencil-alt"> </i> Términos y condiciones
        </legend>
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12">
                <input type="checkbox" id="<?= $data->id ?>" name="<?= $data->name ?>" required="">
                <label for="<?= $data->id ?>" style="text-transform:none;">YO
                    <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>, He leído y acepto los <u>términos y condiciones</u> de uso. </label>
            </div>
            <div class="col-6 col-12-mobilep">
                <button type="submit" class="button primary small fit icon solid fa-save">
                    Guardar
                </button>
            </div>
            <div class="col-6 col-12-mobilep">
                <button type="reset" id="<?= $data->reset ?>" class="button primary small fit icon solid fa-undo" <?= ($data->disabled) ? 'disabled' : '' ?>>
                    Cancelar
                </button>
            </div>
        </div>
    </fieldset>
<?php
}
