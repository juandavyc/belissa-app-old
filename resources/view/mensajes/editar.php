<div id="dialog-editar-mensaje" title="EDITAR MENSAJE">
    <form id="form_editar_agendamiento">

        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 col-12-small" hidden="">
                <input id="id_mensaje" type="text" name="id_mensaje" autocomplete="off">
            </div>

            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion del mensaje</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-6 col-12-small">
                            <label class="label-datos label-important"> Titulo </label>
                        </div>
                        <div class="col-6 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-calendar icon-input"></i>
                                <div>
                                    <input id="titulo" type="text" name="titulo" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-12-small">
                            <label class="label-datos label-important"> Mensaje </label>
                        </div>
                        <div class="col-6 col-12-small">


                            <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
                            <!-- <input id="editar-fecha" type="text" name="fecha" autocomplete="off"> -->

                        </div>


                    </div>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform_1">
                        <div class="col-12">
                            <input type="checkbox" id="form_1_tab_1_acepto_responsabilidad" name="acepto_responsabilidad" required="">
                            <label for="form_1_tab_1_acepto_responsabilidad" style="text-transform:none;">YO
                                <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>, He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso. </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" class="button primary small fit icon solid fa-undo" disabled>
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>