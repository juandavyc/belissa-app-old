<div id="certificar-ingreso-modal" class="my-modal"> 
    <div class="my-modal-container">
        <div class="my-modal-content">
            <form id="form_certificar_vehiculo">
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12 align-center">
                        <div class="vh-placa" id="certificar-placa_vehiculo-html"></div>
                    </div>
                    <div class="col-12" hidden>
                        <input type="text" name="id_vehiculo" id="certificar-id_vehiculo" value="0" required />
                        <input type="text" name="id_ingreso" id="certificar-id_ingreso" value="0" required />
                    </div>
                    <div class="col-6 col-12-small">
                        <fieldset>
                            <legend><i class="fa-solid fa-envelope"></i> Correo</legend>
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-12 align-center">
                                    <label for="certificado-correo-texto"> Texto Correo </label>
                                </div>
                                <div class="col-12">
                                    <div class="input-container">
                                        <i class="fas fa-align-left icon-input"></i>
                                        <input type="text" id="certificado-correo-titulo" value="" autocomplete="off" placeholder="Título">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea id="certificado-correo-texto" rows="4" placeholder="Contenido"></textarea>
                                </div>
                                <div class="col-12 align-right">
                                    <button class="primary small icon solid fa-floppy-disk" id="btn-certificado-correo-texto"> Guardar</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-6 col-12-small">
                        <fieldset>
                            <legend><i class="fa-brands fa-whatsapp"></i> WhatsApp</legend>
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-12 align-center">
                                    <label for="certificado-whatsapp-texto"> Texto WhatsApp </label>
                                </div>
                                <div class="col-12">
                                    <input type="text" readonly style="opacity: 0;">
                                </div>
                                <div class="col-12">
                                    <textarea id="certificado-whatsapp-texto" rows="4" placeholder="Contenido"></textarea>
                                </div>
                                <div class="col-12 align-right">
                                    <button class="primary small icon solid fa-floppy-disk" id="btn-certificado-whatsapp-texto"> Guardar</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-6 col-12-small">
                        <fieldset class="fieldset-propietario">
                            <legend><i class="fas fa-user"></i> PROPIETARIO</legend>
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-3 col-12-small">
                                    <label class="label-datos"> TELEFONO</label>
                                </div>
                                <div class="col-7 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-phone icon-input"></i>
                                        <input type="text" id="certificado-telefono_propietario" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2 col-12-small">
                                    <button id="btn-certificado-telefono_propietario" class="button primary small icon brands fa-whatsapp"></button>
                                </div>
                                <div class="col-3 col-12-small">
                                    <label class="label-datos"> CORREO</label>
                                </div>
                                <div class="col-7 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-envelope icon-input"></i>
                                        <input type="text" id="certificado-correo_propietario" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2 col-12-small">
                                    <button id="btn-certificado-correo_propietario" class="primary small icon solid fa-envelope"></button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-6 col-12-small">
                        <fieldset class="fieldset-conductor">
                            <legend><i class="fas fa-user"></i> CONDUCTOR</legend>
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-3 col-12-small">
                                    <label class="label-datos"> TELEFONO</label>
                                </div>
                                <div class="col-7 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-phone icon-input"></i>
                                        <input type="text" id="certificado-telefono_conductor" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2 col-12-small">
                                    <button id="btn-certificado-telefono_conductor" class="button primary small icon brands fa-whatsapp"></button>
                                </div>
                                <div class="col-3 col-12-small">
                                    <label class="label-datos"> CORREO</label>
                                </div>
                                <div class="col-7 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-envelope icon-input"></i>
                                        <input type="text" id="certificado-correo_conductor" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2 col-12-small">
                                    <button id="btn-certificado-correo_conductor" class="primary small icon solid fa-envelope"></button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <legend><i class="fas fa-file-signature"></i> Resultado RTM</legend>
                            <div class="row gtr-50 gtr-uniform">
                                <div class="col-2 col-12-small">
                                    <label class="label-datos label-important"> Fecha de RTM</label>
                                </div>
                                <div class="col-4 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-calendar icon-input"></i>
                                        <div>
                                            <input type="text" name="fecha_certificado" id="form_fecha_certificado" class="input_date_listener" autocomplete="off" value="<?= date('d/m/Y') ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 col-12-small">
                                    <label class="label-datos label-important"> Resultado</label>
                                </div>
                                <div class="col-4 col-12-small align-center">
                                   <div class="input-container">
                                        <i class="fas fa-list icon-input"></i>
                                        <select name="resultado" required>
                                            <option value="1"> Aprobada</option>
                                            <option value="2"> Rechazada</option>  
                                            <option value="4"> Se retiro del CDA</option>
                                            <option value="5"> No pudo completar pruebas</option>
                                            <!-- <option value="3" selected> Sin estado</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <?php $app->ruta->getComponent(
                            'AceptoTerminos',
                            array(
                                'id' => 'form_1_tab_1_acepto_responsabilidad',
                                'name' => 'acepto_responsabilidad',
                                'reset' => 'btn-certificar-reset-1',
                                'disabled' => true
                            )
                        ) ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>