<form id="form_1_agregar">
    <div class="row gtr-25 gtr-uniform">

        <div class="col-6 col-12-small"> </div>
        <div class="col-6 col-12-small">
            <aside class="note-wrap note-yellow">
                Verifique que el usuario no exista antes de guardar <br>
                <b>EL CORREO ELECTRONICO</b> sera solicitado en caso tal de querer restablecer la contraseña <br>
            </aside>
        </div>
        <div class="col-12">
            <fieldset>
                <legend>
                    Datos basicos
                </legend>
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <div class="photo-control">
                            <div class="photo-info">
                                <label>Foto Usuario <i class="fas fa-camera"></i></label>
                                <input type="text" id="form_1_foto" name="form_1_foto" value="/images/sin_imagen.png" readonly />
                            </div>
                            <div class="photo-buttons">
                                <button class="button primary small btn-file-open" id="btn-form_1_foto" data-folder="usuario/foto" input-id="form_1_foto"></button>
                                <button class="button primary small btn-camera-open" id="btn-form_1_foto" data-folder="usuario/foto" input-id="form_1_foto"></button>
                                <button class="button primary small btn-camera-show" data-id="form_1_foto"></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Nombre </label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-signature icon-input"></i>
                            <div>
                                <input type="text" id="form_1_nombre_usuario" placeholder="Nombre " name="nombre_usuario" value="" maxlength="40" required="" autocomplete="off">
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
                                <input type="text" id="form_1_apellido_usuario" placeholder="Apellido " name="apellido_usuario" value="" maxlength="40" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Tipo Documento </label>
                    </div>

                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-sort-numeric-up-alt icon-input"></i>
                            <select id="tipo_documento" name="tipo_documento" required="">
                                <option value="1" selected="">Cedula</option>
                                <option value="2">NIT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Documento </label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-id-card icon-input"></i>
                            <div>
                                <input type="number" id="form_1_documento_usuario" placeholder="Documento " name="documento_usuario" value="" maxlength="40" required="" autocomplete="off">
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
                                <input type="email" id="form_1_correo_usuario" placeholder="Correo " name="correo_usuario" value="" maxlength="40" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Rango </label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-users icon-input"></i>
                            <div>
                                <input type="text" id="crear-usuario-rango-text" value="SIN_RANGO" placeholder="Rango" autocomplete="off">
                                <input type="hidden" name="rango" id="crear-usuario-rango-select" value="1" data-default="1" required="">
                            </div>
                        </div>
                    </div>




                    <div class="col-2 col-12-small">
                        <label class="label-important label-datos"> Fecha de nacimiento</label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <input type="text" name="fecha_usuario" id="fecha_usuario" class="input_date_listener" value="01/01/2022" autocomplete="off" required="">
                        </div>
                    </div>

                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Contraseña </label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-key icon-input"></i>
                            <div>
                                <input type="password" id="form_1_contrasena_usuario" placeholder="Contraseña" name="contrasena_usuario" value="" maxlength="40" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>


                </div>
            </fieldset>
        </div>

        <div class="col-12">
            <fieldset>
            <legend> Canal de mercadeo</legend>
                <div class="row gtr-25 gtr-uniform">
                <div class="col-12 col-12-small">
                    <p align="center">
                        <b> EL CANAL DE MERCADO EN BELISSA SE USA PARA OTORGAR ACCESO AL AGENDAMIENTO DE VEHICULOS EN LA PLATAFORMA <br>SELECIONE (SI) Y SE GUARDARA CON EL NOMBRE DEL USUARIO AQUI REGISTRADO Y PODRA ASIGNARLO A UN TIPO DE CANAL DE MERCADEO<br>Y ASI CUANTIFICAR LA EFECTIVIDAD DE SUS ASESORES </i></b>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Que sea un canal de mercadeo? </label>
                </div>
                <div class="col-4 col-12-small align-center">
                    <input type="radio" id="si_canal" name="guardar_canal" value="1">
                    <label for="si_canal"> SI </label>
                    <input type="radio" id="no_canal" name="guardar_canal" value="2" checked="">
                    <label for="no_canal"> NO </label>
                </div>
                <div class="col-2 col-12-small">
                    <label class="label-datos label-important"> Tipo de canal de mercado </label>
                </div>
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-briefcase icon-input"></i>
                        <div>
                            <input type="text" id="crear-tipo-canal-text" value="SIN_ASIGNAR" placeholder="Tipo de canal" />
                            <input type="hidden" name="tipo_canal" id="crear-tipo-canal-select" value="1" data-default="1" required="" />
                        </div>
                    </div>
                </div>
            </fieldset>
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