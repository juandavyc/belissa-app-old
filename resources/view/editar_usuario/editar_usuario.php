<section class="wrapper style4 container max">
    <form id="form_editar_usuario">
        <div class="row gtr-25 gtr-uniform">
            <input type="hidden" name="form_id_editar_usuario" id="form_id_editar_usuario" value="" required />
            <div class="col-4 col-12-mobilep"></div>
            <div class="col-4 col-12-mobilep align-center">
                <span class="image fit p">
                    <a href="/images/sin_imagen.jpg" id="form_0_href_foto" target="_blank">
                        <img src="/images/sin_imagen.png">
                    </a>
                </span>
                <label> SU FOTO</label>
            </div>

            <div class="col-12">
                <div class="photo-control">
                    <div class="photo-info">
                        <label>Foto Usuario </label>
                        <input type="text" id="form_0_foto_usuario" name="foto_usuario" value="/images/sin_imagen.png" readonly />
                    </div>
                    <div class="photo-buttons">
                        <button class="button primary small btn-file-open" id="btn-form_0_foto_usuario" data-folder="usuario/foto" input-id="form_0_foto_usuario"></button>
                        <button class="button primary small btn-camera-open" id="btn-form_0_foto_usuario" data-folder="usuario/foto" input-id="form_0_foto_usuario"></button>
                        <button class="button primary small btn-camera-show" data-id="form_0_foto_usuario"></button>
                    </div>
                </div>
            </div>

            <div class="col-4 col-12-mobilep"></div>
            <div class="col-12">
                <hr>
            </div>

            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Nombre </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                    <div>
                        <input type="text" id="form_1_editar_nombre_usuario" placeholder="Nombre " name="nombre_usuario" value="" maxlength="40" required="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Apellido </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                    <div>
                        <input type="text" id="form_1_editar_apellido_usuario" placeholder="Apellido " name="apellido_usuario" value="" maxlength="40" required="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Documento </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                <i class="fas fa-sort-numeric-up-alt icon-input"></i>
                    <div>
                        <input type="number" id="form_1_editar_documento_usuario" placeholder="Documento " name="documento_usuario" value="" maxlength="40" required="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Correo </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                <i class="fas fa-at icon-input"></i>
                    <div>
                        <input type="email" id="form_1_editar_correo_usuario" placeholder="Correo " name="correo_usuario" value="" maxlength="40" required="" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Rango </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                <i class="fas fa-users icon-input"></i>
                    <input type="text" id="form_11_rango_usuario_editar_input" value="ADMIN" placeholder="Rango" required="" />
                    <input type="hidden" name="rango_usuario_editar" id="form_11_rango_usuario_editar_select" value="1" data-default="1" required="" />
                </div>
            </div>

            <div class="col-2 col-12-small">
                <label class="label-important label-datos"> Fecha de nacimiento</label>
            </div>
            <div class="col-4 input-container">
            <i class="fas fa-calendar icon-input"></i>
                <input type="text" name="fecha_usuario_editar" id="form_1_fecha_usuario_editar" class="input_date_listener" autocomplete="off" required="">
            </div>


            <div class="col-2 col-12-small">
                <label class="label-important label-datos">ESTADO DEL USUARIO</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                <i class="fas fa-arrows-alt-v icon-input"></i>
                    <select id="form_1_estado_usuario" name="estado_usuario">
                        <option value="1">ACTIVO</option>
                        <option value="2">SUSPENDIDO</option>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Firma</legend>
                    <div class="row gtr-25 gtr-uniform">
                        <div class="col-2 col-12-small"></div>
                        <div class="col-8 col-12-small">
                            <div class="canvas-container" id="canvas_firma_usuario" name="firma_usuario"></div>
                        </div>
                        <div class="col-2 col-12-small"></div>
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
</section>