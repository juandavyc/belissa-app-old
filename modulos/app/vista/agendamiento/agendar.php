<div class="container medium">
    <form id="form_agendar">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12 align-center">
                <i class="icon solid fas fa-calendar-day fa-3x"></i>
            </div>
            <div class="col-10 col-12-small align-center">
                <b>Fecha</b> ( <b class="b-moto">Cupo libre moto</b> – <b class="b-liviano">Cupo libre liviano</b> )
                <br>
                Motos: <b class="b-moto" id="cupo-moto-agendar-html"></b> Liviano: <b class="b-liviano"
                    id="cupo-liviano-agendar-html"></b>
            </div>
            <div class="col-2 col-12-small align-right">
                <button class="primary small icon solid fa-rotate align-right" id="btn-cupo-agendar-recargar">
                    Recargar</button>
            </div>
            <div class="col-12">
                <div id="container-cupos-agendar"></div>
            </div>
            <div class="col-3 col-12-mobilep">
                <label class="label-orange"> <i class="fa-solid fa-arrow-right"></i> Paso # 1</label>
            </div>
            <div class="col-9 col-12-mobilep">
                <hr>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Fecha</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-calendar icon-input"></i>
                    <div>
                        <input type="text" id="agendar-datepiker" name="fecha" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Horario</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-align-left icon-input"></i>
                    <div>
                        <select name="horario">
                            <option value="default" selected>Seleccione el horario</option>
                            <option value="1">En la Mañana</option>
                            <option value="2">En la Tarde</option>
                            <option value="3">En la Noche</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-3 col-12-mobilep">
                <label class="label-orange"> <i class="fa-solid fa-arrow-right"></i> Paso # 2</label>
            </div>
            <div class="col-9 col-12-mobilep">
                <hr>
            </div>

            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Placa</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fab fa-cc-jcb icon-input"></i>
                    <div>
                        <input type="text" name="placa" id="agendar-placa" placeholder="Placa" autocomplete="off">
                        <input type="hidden" name="id_vehiculo" id="agendar-id_vehiculo" value="create_vehiculo"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important">Tipo vehículo</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fab fa-cc-jcb icon-input"></i>
                    <div>
                        <select name="tipo_vehiculo" id="agendar-tipo_vehiculo">
                            <option value="default" selected="">Seleccionar tipo vehículo</option>
                            <option value="3">4X4</option>
                            <option value="2">LIVIANO</option>
                            <option value="4">MOTO</option>
                            <!-- <option value="5">REMOLQUE</option> -->
                            <option value="6">TAXI</option>
                        </select>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 align-center">
                <label class="label-orange"> Datos del propietario</label>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Tipo Documento </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-sort-numeric-up-alt icon-input"></i>
                    <div>
                        <select name="tipo_documento" id="agendar-tipo_documento">
                            <option value="default" selected="">Seleccionar tipo de documento</option>
                            <option value="8">CARNET DIPLOMATICO</option>
                            <option value="1">CEDULA</option>
                            <option value="3">CEDULA DE EXTRANGERIA</option>
                            <option value="2">NIT</option>
                            <option value="6">NO SE SABE</option>
                            <option value="5">PASAPORTE</option>
                            <option value="7">REGISTRO CIVIL</option>
                            <option value="4">TARJETA IDENTIDAD</option>
                            <option value="9">TI2</option>
                        </select>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-important label-datos"> Documento</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-id-card icon-input"></i>
                    <div>
                        <input type="number" name="documento" id="agendar-documento" placeholder="Documento"
                            autocomplete="off">
                        <input type="hidden" name="id_documento" id="agendar-id_documento" value="create_propietario"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Nombre(s) </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-signature icon-input"></i>
                    <div>
                        <input type="text" placeholder="Nombres" id="agendar-nombre" name="nombre" value=""
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-datos label-important"> Apellido(s) </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-signature icon-input"></i>
                    <div>
                        <input type="text" placeholder="Apellidos" id="agendar-apellido" name="apellido" value=""
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-important label-datos"> Telefono</label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-phone-volume icon-input"></i>
                    <div>
                        <input type="text" name="telefono" id="agendar-telefono" placeholder="Telefono"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-2 col-12-small">
                <label class="label-important label-datos"> Correo </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fab fa-at icon-input"></i>
                    <div>
                        <input type="email" name="correo" id="agendar-correo" placeholder="Correo@correo.com"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-mobilep">
                <label class="label-orange"> <i class="fa-solid fa-arrow-right"></i> Paso # 3</label>
            </div>
            <div class="col-9 col-12-mobilep">
                <hr>
            </div>

            <div class="col-2 col-12-small">
                <label class="label-datos"> Enviar correo </label>
            </div>
            <div class="col-10 col-12-small align-center">
                <input type="radio" id="agendar-enviar-email-si" name="enviar" value="1">
                <label for="agendar-enviar-email-si">Si enviar</label>
                <input type="radio" id="agendar-enviar-email-no" name="enviar" value="2" checked="">
                <label for="agendar-enviar-email-no">No enviar</label>

            </div>
           
            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform_1">
                        <div class="col-12">
                            <input type="checkbox" id="agendar-acepto-terminos-condiciones"
                                name="acepto_terminos_condiciones" required="">
                            <label for="agendar-acepto-terminos-condiciones" style="text-transform:none;">Yo
                                <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>, He leído y acepto los
                                <a href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso.
                            </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" id="form_agendar_reset"
                                class="button primary small fit icon solid fa-undo">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>