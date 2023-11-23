<form id="form_1_agregar">
    <div class="row gtr-25 gtr-uniform">

        <div class="col-6 col-12-small"> </div>
        <div class="col-6 col-12-small">
            <aside class="note-wrap note-yellow">
                Este módulo es de ejemplo, <br>
                sí nota algún error notifique.
            </aside>
        </div>
        <div class="col-12">
            <fieldset>
                <legend>
                    Datos basicos
                </legend>
                <div class="row gtr-25 gtr-uniform">


                    <div class="col-3 col-12-small">
                        <label class="label-datos label-important"> Tipo de archivo </label>
                    </div>

                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <select name="tipo_archivo" id='form_1_tipo_archivo' onChange="mostrar(this.value);" required>
                                    <option value="0">SELECCIONAR EL TIPO DE ARCHIVO</option>
                                    <option value="1">FOTO</option>
                                    <option value="2">VIDEO</option>
                                    <option value="3">PDF</option>
                                    <option value="4">EXCEL</option>
                                    <option value="5">DOCUMENTO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="form_foto" style="display: none;">
                        <label><b>Foto a guardar </b></label>
                        <div class="file-select">
                            <input type="file" name="archivos[foto]" accept="image/*">
                        </div>
                    </div>

                    <div class="col-12" id="form_video" style="display: none;">
                        <label><b>Video a guardar </b></label>
                        <div class="file-select">
                            <input type="file" name="archivos[video]" accept="video/*" />
                        </div>
                    </div>

                    <div class="col-12" id="form_pdf" style="display: none;">
                        <label><b>Pdf a guardar </b></label>
                        <div class="file-select">
                            <input type="file" name="archivos[pdf]" accept=".pdf" />
                        </div>
                    </div>

                    <div class="col-12" id="form_excel" style="display: none;">
                        <label><b>Excel a guardar </b></label>
                        <div class="file-select">
                            <input type="file" name="archivos[excel]" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        </div>
                    </div>

                    <div class="col-12" id="form_documento" style="display: none;">
                        <label><b>Documento a guardar</b></label>
                        <div class="file-select">
                            <input type="file" name="archivos[documento]" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                        </div>
                    </div>
                </div>
            </fieldset>
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
    </div>
</form>