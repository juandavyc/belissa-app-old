<section class="wrapper style3 container max">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12">
            <div class="align-center">
                <h3><b>Formulario de Contacto</b></h3>
                <h4>Tienes alguna inquietud o pregunta, no dudes en hacérnoslo saber.</h3>
                    <hr />
            </div>
        </div>
        <div class="col-4 col-12-small">
            <div class="row gtr-25 gtr-uniform">
                <div class="col-12">
                    <?php require $app->ruta->getView('contactenos/Contacto') ?>
                </div>
            </div>
        </div>
        <div class="col-8 col-12-small">
            <form id="formulario-contactenos">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-6 col-12-small">
                        <label for="nombres" class="label-important"> Nombre completo</label>
                        <div class="input-container">
                            <i class="fas fa-signature icon-input"></i>
                            <div>
                                <input type="text" name="nombre" id="nombres" value="" placeholder="Su nombre y apellido" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-12-small">
                        <label for="correo" class="label-important"> Correo </label>
                        <div class="input-container">
                            <i class="fas fa-at icon-input"></i>
                            <div>
                                <input type="text" name="correo" id="correo" value="" placeholder="Su Correo electronico" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-12-small">
                        <label for="telefono" class="label-important"> Telefono</label>
                        <div class="input-container">
                            <i class="fas fa-phone-volume icon-input"></i>
                            <div>
                                <input type="text" name="telefono" id="telefono" value="" placeholder="Su Telefono" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-12-small">
                        <label for="placa" class="label-important"> Placa</label>
                        <div class="input-container">
                            <i class="fas fa-ticket-simple icon-input"></i>
                            <div>
                                <input type="text" name="placa" id="placa" value="" placeholder="ABC012" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="mensaje" class="label-important"> Mensaje</label>
                        <textarea name="mensaje" id="mensaje" rows="5" placeholder="Su mensaje" required></textarea>
                    </div>
                    <div class="col-6 col-12-small">
                        <label for="notificacion" class="label-important"> Notificación de respuesta</label>
                        <div class="input-container">
                            <i class="fas fa-bell icon-input"></i>
                            <div>
                                <select id="notificacion" name="notificacion" required="">
                                    <option value="0" selected="">SELECCIONAR</option>
                                    <option value="1">CELULAR</option>
                                    <option value="2">CORREO ELECTRONICO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 col-12-small">
                        <label class="label-important"> Términos</label>
                        <div class="row gtr-25 gtr-uniform">
                            <div class="col-12">
                                <input type="checkbox" id="terminos_condiciones" name="terminos" required="">
                                <label for="terminos_condiciones" style="text-transform:none;">Acepta <a href="/cda/terminos-y-condiciones/" target="_blank">términos, condiciones y políticas de privacidad</a>. </label>
                            </div>
                            <div class="col-6 col-12-small">
                                <br>
                                <button type="submit" id="btn-submit" class="primary fit">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>