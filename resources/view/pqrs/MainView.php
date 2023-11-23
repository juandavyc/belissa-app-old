<section class="wrapper style3 container max" id="container-ingreso-cliente">
    <form id="formulario-pqrs">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-6 col-12-small">
                <h3>Contenido</h3>
                <ol>
                    <li><a href="#tratamiento-de-quejas-y-apelaciones">TRATAMIENTO DE QUEJAS Y APELACIONES</a></li>
                    <li><a href="#radique-aqui-su-pqrs-virtual">RADIQUE AQUÍ SU PQRS VIRTUAL</a></li>
                </ol>
                <br>
            </div>
            <div class="col-12">
                <h3 class="align-center" id="tratamiento-de-quejas-y-apelaciones"><b>TRATAMIENTO DE QUEJAS Y APELACIONES</b></h3>
            </div>
            <div class="col-3 col-12-small">
                <ul>
                    <li><b>VERSION: </b> 02</li>
                    <li><b>CODIGO: </b>CAL.F.05</li>
                    <li><b>PÁGINA: </b>1 de 1</li>
                    <li><b>FECHA: </b>2023-03-01</li>
                </ul>
            </div>
            <div class="col-9 col-12-small">
                <ul>
                    <li>
                        Agradecemos sus observaciones y serán atendidas en el menor tiempo posible. 
                        <br>
                        ¡GRACIAS!
                    </li>
                    <li>
                        La información que suministre en este formato será tratada de manera imparcial y confidencial según la <b>Ley 1581 de 2012</b> por parte del <b>CDA</b>.
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <br>
                <p style="text-align: justify;  background: #FFD3D3; border-radius: 10px; padding: 5px;">
                    Recuerde que Cuando CDA deba por ley divulgar información confidencial o cuando esté autorizado por compromisos contractuales, se le notificará acerca de la información proporcionada, salvo que esté prohibido por ley.
                </p>
            </div>
            <div class="col-12">
                <br>
                <h3 class="align-center"><b>RADIQUE AQUÍ </b> SU PQRS VIRTUAL</h3>
                <br>
            </div>
            <div class="col-4 col-12-small">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <?php require $app->ruta->getView('contactenos/Contacto') ?>
                    </div>
                </div>
            </div>
            <div class="col-8 col-12-small" id="radique-aqui-su-pqrs-virtual">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-6 col-12-small">
                        <label for="fecha" class="label-important"> FECHA</label>
                        <div class="input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <div>
                                <input type="text" name="fecha" id="fecha" class="input_date_listener" value="01/01/2023" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-12-small">
                        <label for="asunto" class="label-important"> Asunto</label>
                        <div class="input-container">
                            <i class="fas fa-briefcase icon-input"></i>
                            <div>
                                <select id="asunto" name="asunto" required="">
                                    <option value="0" selected="">SELECCIONAR</option>
                                    <option value="1">QUEJA</option>
                                    <option value="2">PETICIÓN</option>
                                    <option value="3">SUGERENCIA</option>
                                    <option value="4">RECLAMO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p id="descripcion-asunto" style="background: #e3e3e3; border-radius: 4px; padding: 4px;text-align: justify;"></p>
                    </div>
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
                        <label for="descripcion" class="label-important"> Descripcion</label>
                        <p class="align-center"> Describa la situación presentada que dio origen a su <br> <b>(Peticion, Queja, Reclamo o sugerencia)</b></p>
                        <textarea name="descripcion" id="descripcion" rows="5" placeholder="Describa la situación presentada" required></textarea>
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
                    <div class="col-12">
                        <br>
                        <label class="label-important"> Términos</label>
                        <div class="row gtr-25 gtr-uniform">
                            <div class="col-12">
                                <input type="checkbox" id="terminos_condiciones" name="terminos" required="">
                                <label for="terminos_condiciones" style="text-transform:none;">Acepta <a href="/cda/terminos-y-condiciones/" target="_blank">términos, condiciones y políticas de privacidad</a>. </label>
                            </div>
                            <div class="col-6 col-12-small">
                                <button type="submit" id="btn-submit" class="primary fit">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>