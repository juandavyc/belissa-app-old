<div class="row gtr-25 gtr-uniform">
    <div class="col-12">
        <fieldset>
            <legend>
                Agregar Mensaje predeterminado
            </legend>
            <form id="form_agregar_mensaje">
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-6 col-12-small"> </div>
                    <div class="col-6 col-12-small">
                        <aside class="note-wrap note-yellow">
                            Tenga en cuenta que el titulo de los mensajes no se puede repetir. <br>
                            en caso de quere editarlo
                            <b>Vaya a la pestaña de visor en el boton de editar</b> <br>
                        </aside>
                    </div>

                    <div class="col-4 col-12-small">
                        <label class="label-datos label-important"> Titulo </label>
                    </div>
                    <div class="col-8 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-signature icon-input"></i>
                            <div>
                                <input type="text" id="titulo_mensaje" placeholder="Mensaje revision" name="titulo" value="" maxlength="40" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-12-small">
                        <label class="label-datos label-important"> Mensaje </label>
                    </div>
                    <div class="col-8 col-12-small">

                        <div>
                            <textarea name="mensaje" id="mensaje" cols="30" rows="5" maxlength="160"></textarea>
                            <!-- <input type="text" id="titulo_mensaje" placeholder="Mensaje revision" name="titulo" value="" maxlength="40" required="" autocomplete="off"> -->
                        </div>

                    </div>

                    <div class="col-12">
                        <fieldset class="fieldset-save">
                            <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                            <div class="row gtr-50 gtr-uniform">
                                <div class="col-12">
                                    <input type="checkbox" id="form_1_acepto_responsabilidad" name="acepto_responsabilidad" required="">
                                    <label for="form_1_acepto_responsabilidad" style="text-transform:none;">YO
                                        <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>, He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso. </label>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <button type="submit" class="button primary small fit icon solid fa-save">
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <button type="reset" class="button primary small fit icon solid fa-undo">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>



            </form>
        </fieldset>
    </div>

</div>