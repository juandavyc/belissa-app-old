<form id="form_0_buscador">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12">
            <div class="row gtr-25 gtr-uniform">
                <div class="col-12 align-center">
                    <i class="fa-solid fa-circle-question fa-3x"></i>
                    <h2 class="h2-desea">¿Desea buscar por?</h2>
                    <p>¿No tienes idea que de buscador usar? Puedes ver la <a
                            href="/web/documentacion/">documentación</a> es <b>¡Gratis!</b>
                    </p>
                </div>
                <div class="col-12 align-center">
                    <input type="radio" id="buscador_fecha_radio" name="buscador" value="1" checked="">
                    <label for="buscador_fecha_radio"> Fecha</label>
                    <input type="radio" id="buscador_contenido_radio" name="buscador" value="2">
                    <label for="buscador_contenido_radio"> Dato especifico</label>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="container-buscador">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-8 col-12-small" id="container-buscador-fecha">
                        <label> Ingrese la fecha</label>
                        <div class="input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <input type="text" name="fecha" class="input_date_listener" autocomplete=" off" required="">
                        </div>
                    </div>
                    <div class="col-8 col-12-small" id="container-buscador-contenido" hidden>
                        <div class="row gtr-25 gtr-uniform">
                            <div class="col-4 col-12-small">
                                <label> Buscar por</label>
                                <div class="input-container">
                                    <i class="fas fa-align-left icon-input"></i>
                                    <div>
                                        <select name="filtro">
                                            <optgroup label="vehiculo">
                                                <option value="1">ID</option>
                                                <option value="2" selected>Placa</option>
                                                <option value="3">Modelo</option>
                                                <option value="4">VIN</option>
                                            </optgroup>
                                            <optgroup label="Propietario">
                                                <option value="5">ID</option>
                                                <option value="6">Documento</option>
                                                <option value="7">Nombre</option>
                                                <option value="8">Apellido</option>
                                                <option value="9">Telefono # 1 </option>
                                                <option value="10">Telefono # 2 </option>
                                                <option value="11">Telefono # 3 </option>
                                                <option value="12">Correo </option>
                                                <option value="13">Direccion </option>
                                            </optgroup>
                                            <optgroup label="Conductor">
                                                <option value="14">ID</option>
                                                <option value="15">Documento</option>
                                                <option value="16">Nombre</option>
                                                <option value="17">Apellido</option>
                                                <option value="18">Telefono # 1 </option>
                                                <option value="19">Telefono # 2 </option>
                                                <option value="20">Telefono # 3 </option>
                                                <option value="21">Correo </option>
                                                <option value="22">Direccion </option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 col-12-small">
                                <label> Contenido</label>
                                <div class="input-container">
                                    <i class="fas fa-align-left icon-input"></i>
                                    <div>
                                        <input type="text" name="contenido" id="buscador_contenido"
                                            placeholder="Contenido a buscar" value="%%" autocomplete="off"
                                            maxlength="50" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-12-small">
                        <label> Buscar</label>
                        <button type="submit" class="button primary small fit icon solid fa-server">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>