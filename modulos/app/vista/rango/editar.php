<div id="container-dialog-editar" title="Editar rango">
    <form id="editar-rango">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12">
                <fieldset>
                    <legend>
                        Datos basicos
                    </legend>
                    <div class="row gtr-25 gtr-uniform">

                        <div class="col-3 col-12-small">
                            <label class="label-datos label-important"> Nombre </label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-align-left icon-input"></i>
                                <div>
                                    <input type="text" placeholder="Administrador supremo" name="nombre" value=""
                                        id="editar-nombre" autocomplete="off" readonly required="">
                                    <input type="hidden" name="id" value="" id="editar-id" required=""
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-5 col-12-small"></div>

                        <div class="col-3 col-12-small">
                            <label class="label-datos label-important"> Tipo de conexión </label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-align-left icon-input"></i>
                                <div>
                                    <select name="tipo_conexion" id='editar-tipo_conexion'>
                                        <option value="1">TIPO I ( C.R.U.D )</option>
                                        <option value="2">TIPO II ( C.R.U )</option>
                                        <option value="3">TIPO III ( C.R )</option>
                                        <option value="4">TIPO IV ( R )</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p id="editar-tipo_conexion_html">
                                Este rango puede: <b>Crear, Leer, actualizar y eliminar</b> (CRUD).
                            </p>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset>
                    <legend>
                        ¿A que módulos tiene acceso?
                    </legend>
                    <div class="row gtr-25 gtr-uniform" id="container-editar-modulos">
                        <?php $_task = 'editar';require DOCUMENT_ROOT . '/modulos/app/vista/rango/modulos.php';?>
                    </div>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <input type="checkbox" id="editar-acepto_responsabilidad" name="acepto_responsabilidad"
                                required="">
                            <label for="editar-acepto_responsabilidad" style="text-transform:none;">Yo
                                <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>, He leído y acepto los <a
                                    href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso. </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" id="btn-editar-reset"
                                class="button primary small fit icon solid fa-undo" disabled>
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>