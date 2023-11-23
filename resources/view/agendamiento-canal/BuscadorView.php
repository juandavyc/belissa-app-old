<div class="row gtr-25 gtr-uniform">
    <div class="col-6 col-12-small"> </div>
    <div class="col-6 col-12-small">
        <aside class="note-wrap note-yellow">
            El buscador tiene la capacidad para mostrar <br>
            <b>255</b> (<i>Doscientos cincuenta y cinco</i>)
            resultados de manera <b>rápida</b> <br>
            Mas de 255 resultados, <b>consumirá mas recursos de su computadora</b>.
        </aside>
    </div>
    <div class="col-12 align-center">
        <h4>BUSCADOR DE VEHICULOS AGENDADOS</h4>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>
                <b class="buscador-b"> Búsqueda:</b>
                <input type="radio" id="form_0_basica" name="buscador" value="1" checked="">
                <label for="form_0_basica"> Básica</label>
                <input type="radio" id="form_0_avanzada" name="buscador" value="2">
                <label for="form_0_avanzada"> Avanzada</label>
            </legend>
            <form id="form_0_buscador">
                <div class="row gtr-25 gtr-uniform">

                    <div class="col-12" id="form_0-container-buscador-avanzado" hidden>

                        <div class="row gtr-25 gtr-uniform">
                            <div class="col-3 col-12-small">
                                <label> Buscar por</label>
                                <div class="input-container">
                                    <i class="fas fa-list icon-input"></i>
                                    <select id="form_0_filtro" name="filtro" required>
                                        <option value="0">Todo</option>
                                        <option value="1">Placa</option>
                                        <option value="2">Documento</option>
                                        <option value="3">Telefono</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 col-12-small">
                                <label>Contenido</label>
                                <div class="input-container">
                                    <i class="fas fa-align-left icon-input"></i>
                                    <input type="text" name="contenido" id="form_0_contenido" placeholder="Contenido a buscar" value="Todo" autocomplete="off" maxlength="50" readonly="" required />
                                </div>
                            </div>


                            <div class="col-3 col-12-small">
                                <label> Estado agendamiento </label>
                                <div class="input-container">
                                    <i class="fas fa-car icon-input"></i>
                                    <select name="estado_agendamiento" required>
                                        <option value="0" selected>Todo</option>
                                        <option value="1">Sin asistir</option>
                                        <option value="2">Asistio</option>
                                        <option value="3">No asistio</option>
                                        <option value="4">Anulado</option>
                                        <option value="5">Vencidio</option>
                                        <option value="6">ReAgendado</option>
                                        <option value="7">Gestionar</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3 col-12-small align-center">
                                <label>¿ <b><u>Ignorar</u></b> rango de fechas ? </label>
                                <input type="radio" id="form_0_ignorar_si" name="ignorar_fecha" value="1">
                                <label for="form_0_ignorar_si"> Si</label>
                                <input type="radio" id="form_0_ignorar_no" name="ignorar_fecha" value="2" checked="">
                                <label for="form_0_ignorar_no"> No</label>
                            </div>

                            <div class="col-3 col-12-small">
                                <label> Resultados</label>
                                <div class="input-container">
                                    <i class="fas fa-sort-numeric-down icon-input"></i>
                                    <select id="form_0_resultados" name="resultados" required>
                                        <option value="100">100</option>
                                        <option value="255">255</option>
                                        <option value="10000">10.000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Filtro de fecha</label>
                        <div class="input-container">
                            <i class="fas fa-list icon-input"></i>
                            <select id="form_0_tipo_fecha" name="tipo_fecha" required>
                                <option value="0" selected> Debe asistir al CDA</option>
                                <option value="1"> Creacion en el sistema </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Fecha inicial</label>
                        <div class="input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <input type="text" name="fecha_inicial" id="form_0_fecha_inicial" class="input_date_listener" autocomplete="off" required="">
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Fecha final</label>
                        <div class="input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <input type="text" name="fecha_final" id="form_0_fecha_final" class="input_date_listener" autocomplete="off" required="">
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label>Buscar</label>
                        <input type="hidden" name="page" id="form_0_page" value="1" data-default="1">
                        <input type="hidden" name="order" id="form_0_order" value="nro" data-default="nro">
                        <input type="hidden" name="by" id="form_0_by" value="desc" data-default="desc">
                        <button type="submit" class="button primary small fit icon solid fa-search">
                            BUSCAR AGENDAMIENTO
                        </button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
    <div class="col-12 align-right">
        <button id="form_0_exportar_excel" class="button primary small icon solid fa-file-excel">
            Exportar a EXCEL
        </button>
    </div>
    <div class="col-12">
        <div id="form_0_container_resultados_title" class="div-resultado-title" hidden></div>
        <div id="form_0_container_resultados_body" class="div-resultado-body" hidden></div>
        <div id="form_0_container_resultados_pagination" class="div-resultado-pagination" hidden></div>
    </div>
</div>