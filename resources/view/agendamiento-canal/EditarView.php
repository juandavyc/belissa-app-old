<div id="dialog-editar-agendamiento" class="my-modal">
    <div class="my-modal-container">
        <div class="my-modal-content">
            <form id="form_editar_agendamiento">
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12 align-center">
                        <br>
                        <div class="vh-placa" id="editar-placa_vehiculo-html"></div>
                        <input type="hidden" name="id_agendamiento" id="editar-id_agendamiento" value="" required />
                    </div>
                    <div class="col-12">
                        <label class="label-orange"><i class="fa-solid fa-arrow-right"></i> Datos del agendamiento</label>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Fecha</label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <div>
                                <input id="editar-fecha" type="text" name="fecha" autocomplete="off">
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
                                <select id="editar-horario" name="horario">
                                    <option value="default" selected>Seleccione el horario</option>
                                    <option value="1">En la Mañana</option>
                                    <option value="2">En la Tarde</option>
                                    <option value="3">En la Noche</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="label-orange"><i class="fa-solid fa-arrow-right"></i> Datos del vehículo</label>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Placa</label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fab fa-cc-jcb icon-input"></i>
                            <div>
                                <input type="text" name="placa" id="editar-placa" placeholder="Placa" autocomplete="off" readonly>
                                <input type="hidden" name="id_vehiculo" id="editar-id_vehiculo" value="create_vehiculo" autocomplete="off">
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
                                <select name="tipo_vehiculo" id="editar-tipo_vehiculo">
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
                    <div class="col-12">
                        <label class="label-orange"><i class="fa-solid fa-arrow-right"></i> Datos del propietario</label>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Tipo Documento </label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-sort-numeric-up-alt icon-input"></i>
                            <div>
                                <select name="tipo_documento" id="editar-tipo_documento">
                                    <option value="default" selected="">Seleccionar tipo de documento</option>
                                    <option value="8">CARNET DIPLOMATICO</option>
                                    <option value="1">CEDULA</option>
                                    <option value="3">CEDULA DE EXTRANGERIA</option>
                                    <option value="2">NIT</option>
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
                                <input type="number" name="documento" id="editar-documento" placeholder="Documento" autocomplete="off">
                                <input type="hidden" name="id_documento" id="editar-id_documento" value="create_propietario" autocomplete="off">
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
                                <input type="text" placeholder="Nombres" id="editar-nombre" name="nombre" value="" autocomplete="off">
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
                                <input type="text" placeholder="Apellidos" id="editar-apellido" name="apellido" value="" autocomplete="off">
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
                                <input type="text" name="telefono" id="editar-telefono" placeholder="Telefono" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-12-small"></div>
                    <div class="col-2 col-12-small">
                        <label class="label-important label-datos"> Correo </label>
                    </div>
                    <div class="col-10 col-12-small">
                        <div class="input-container">
                            <i class="fab fa-at icon-input"></i>
                            <div>
                                <input type="email" name="correo" id="editar-correo" placeholder="Correo@correo.com" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-12-small" hidden>
                        <label class="label-datos"> Enviar correo </label>
                    </div>
                    <div class="col-10 col-12-small align-center" hidden>
                        <input type="radio" id="agendar-enviar-email-si" name="enviar" value="1">
                        <label for="agendar-enviar-email-si">Si enviar</label>
                        <input type="radio" id="agendar-enviar-email-no" name="enviar" value="2" checked="">
                        <label for="agendar-enviar-email-no">No enviar</label>
                    </div>
                </div>
                <div class="col-12">
                    <br>
                    <?php $app->ruta->getComponent(
                        'AceptoTerminos',
                        array(
                            'id' => 'form_1_tab_1_acepto_responsabilidad',
                            'name' => 'acepto_terminos_condiciones',
                            'reset' => 'btn-editar-reset-0',
                            'disabled' => true
                        )
                    ) ?>
                </div>
            </form>
        </div>
    </div>
</div>