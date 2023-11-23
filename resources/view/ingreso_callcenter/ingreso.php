<form id="form_ingreso_basico" name="form_ingreso_basico">
    <div id="form_datos_vehiculo" class="col-12 col-12-small">
        <div class="col-12 col-12-small">
            <fieldset class="container-datos-vehiculo">
                <legend> DATOS VEHÍCULO </legend>
                <div class="row">
                    <div class="col-12">
                        <label class="label-id" id="datos-vehiculo-id-html"></label>
                    </div>
                    <div class="col-12" hidden>
                        <label> id </label>
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="number" placeholder="id-vehiculo" name="id_vehiculo" id="datos-vehiculo-id" value="0" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Placa </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Placa" name="placa" id="datos-vehiculo-placa" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small"></div>
                    <div class="col-3 col-12-small">
                        <label> Tipo </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <select name="tipo" id="datos-vehiculo-tipo">
                                    <option value="default" selected>Seleccione el tipo de vehículo</option>
                                    <option value="2">LIVIANO</option>
                                    <option value="3">4X4</option>
                                    <option value="4">PESADO</option>
                                    <option value="5">MOTO</option>
                                    <option value="6">REMOLQUE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small"></div>
                    <div class="col-3 col-12-small">
                        <label> Servicio </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <select name="servicio" id="datos-vehiculo-servicio">
                                    <option value="default" selected>Seleccione el servicio del vehículo</option>
                                    <option value="4">DIPLOMATICO</option>
                                    <option value="5">ENSEÑANZA</option>
                                    <option value="7">ESPECIAL</option>
                                    <option value="6">OFICIAL</option>
                                    <option value="3">PARTICULAR</option>
                                    <option value="2">PUBLICO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small"></div>
                    <div class="col-3 col-12-small">
                        <label> Modelo </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="number" placeholder="Modelo" name="modelo" id="datos-vehiculo-modelo" value="" inputmode="numeric" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small"></div>
                    <div class="col-3 col-12-small">
                        <label> Enseñanza </label>
                    </div>
                    <div class="col-6 col-12-small align-center">
                        <input type="radio" id="datos-vehiculo-ensenanza-si" name="ensenanza" value="1" checked="">
                        <label for="datos-vehiculo-ensenanza-si">SI</label>
                        <input type="radio" id="datos-vehiculo-ensenanza-no" name="ensenanza" value="2">
                        <label for="datos-vehiculo-ensenanza-no">NO</label>
                    </div>
                    <div class="col-3 col-12-small"></div>
        
                    <div class="col-3 col-12-small">
                        <label class="icon solid fa-bolt"> Marca </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" id="datos-vehiculo-marca-text" value="SIN_MARCA" placeholder="Marca" autocomplete="off">
                                <input type="hidden" name="marca" id="datos-vehiculo-marca-select" value="1" data-default="1" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small"></div>
                    <div class="col-3 col-12-small">
                        <label class="icon solid fa-bolt"> Linea </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" id="datos-vehiculo-linea-text" value="SIN_LINEA" placeholder="Linea" autocomplete="off">
                                <input type="hidden" name="linea" id="datos-vehiculo-linea-select" value="1" data-default="1" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small"></div>
                    <div class="col-3 col-12-small">
                        <label class="icon solid fa-bolt"> Color </label>
                    </div>
                    <div class="col-6 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" id="datos-vehiculo-color-text" value="SIN_COLOR" placeholder="Nombre del color" />
                                <input type="hidden" name="color" id="datos-vehiculo-color-select" value="1" data-default="1" required="" />
                            </div>
                        </div>
                    </div>
            </fieldset>
        </div>
        <div class="col-12" id="div-form-2-datos">
            <fieldset class="container-datos-cliente">
                <legend> DATOS CONDUCTOR </legend>
                <div class="row">
                    <div class="col-12">
                        <label class="label-id" id="datos-conductor-id-html"></label>
                    </div>
                    <div class="col-12" hidden>
                        <label> id </label>
                        <input type="number" placeholder="id-conductor" name="id_conductor" id="datos-conductor-id" value="0" required="" autocomplete="off">
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Documento </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Documento" name="documento" id="datos-conductor-documento" value="" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Nombre </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Nombre" name="nombre" id="datos-conductor-nombre" value="" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Apellido </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Apellido" name="apellido" id="datos-conductor-apellido" value="" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Tel # 1 </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="000 000 00000" name="telefono_1" id="datos-conductor-telefono-1" value="" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Tel # 2 </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="000 000 00000" name="telefono_2" id="datos-conductor-telefono-2" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Tel # 3 </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="000 000 00000" name="telefono_3" id="datos-conductor-telefono-3" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Email </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="email" placeholder="email@email.com" name="email" id="datos-conductor-email" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Direccion </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Direccion" name="direccion" id="datos-conductor-direccion" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
            </fieldset>
        </div>
        <div class="col-12 col-12-small">
            <fieldset class="container-datos-cliente">
                <legend> DATOS PROPIETARIO </legend>
                <div class="row">

                    <div class="col-12">
                        <label class="label-id" id="datos-propietario-id-html"></label>
                    </div>
                    <div class="col-12" hidden>
                        <label> id </label>
                        <input type="number" placeholder="id-propietario" name="id_propietario" id="datos-propietario-id" value="0" autocomplete="off">
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Documento </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Documento" name="documento_propietario" id="datos-propietario-documento" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Nombre </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Nombre y apellido" name="nombre_propietario" id="datos-propietario-nombre" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Apellido </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Apellido" name="apellido_propietario" id="datos-propietario-apellido" value="" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Tel # 1 </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="000 000 00000" name="telefono_1_propietario" id="datos-propietario-telefono-1" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Tel # 2 </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="000 000 00000" name="telefono_2_propietario" id="datos-propietario-telefono-2" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Tel # 3 </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="000 000 00000" name="telefono_3_propietario" id="datos-propietario-telefono-3" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Email </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="email" placeholder="email@email.com" name="email_propietario" id="datos-propietario-email" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Direccion </label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Direccion" name="direccion_propietario" id="datos-propietario-direccion" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-12" >
                        <hr>
                        <fieldset class="fieldset-save">
                            <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                            <div class="row gtr-50 gtr-uniform">
                                <div class="col-12">
                                    <input type="checkbox" id="datos-propietario-terminos-condiciones" name="acepto_terminos_condiciones">
                                    <label for="datos-propietario-terminos-condiciones" style="text-transform:none;">YO
                                        <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>,
                                        He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y
                                            condiciones</a> de uso. </label>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <button type="submit" class="button primary small fit icon solid fa-save">
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <button type="reset" id="form_reset" class="button primary small fit icon solid fa-undo">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</form>