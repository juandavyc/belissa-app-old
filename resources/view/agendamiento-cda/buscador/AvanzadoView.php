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
                <option value="4">Canal</option>
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
        <label> Tipo vehículo</label>
        <div class="input-container">
            <i class="fab fa-cc-jcb icon-input"></i>
            <div>
                <select name="tipo_vehiculo" id="form_0_tipo_vehiculo">
                    <option value="0">Todo</option>
                    <option value="2">LIVIANO</option>
                    <option value="5">MOTO</option>
                    <option value="7">TAXI</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-3 col-12-small">
        <label> Horario </label>
        <div class="input-container">
            <i class="fas fa-align-left icon-input"></i>
            <div>
                <select name="horario" id="form_0_horario">
                    <option value="0" selected="">Todo</option>
                    <option value="1">En la Mañana</option>
                    <option value="2">En la Tarde</option>
                    <option value="3">En la Noche</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-3 col-12-small">
        <label> Estado agendamiento </label>
        <div class="input-container">
            <i class="fas fa-car icon-input"></i>
            <select name="estado_agendamiento" required>
                <option value="0" selected>Todo</option>
                <option value="1">SIN ASISTIR</option>
                <option value="2">ASISTIO</option>
                <option value="3">NO ASISTIO</option>
                <option value="4">ANULADO</option>
                <option value="5">VENCIDO</option>
                <option value="6">REAGENDADO</option>
                <option value="7">GESTIONAR</option>
            </select>
        </div>
    </div>
    <div class="col-6 col-12-small">
        <label> Canal de mercadeo </label>
        <div class="input-container">
            <i class="fas fa-briefcase icon-input"></i>
            <div>
                <input type="text" id="form_0-canal-mercadeo-text" value="SIN_CANAL" placeholder="Canal de mercadeo" autocomplete="off" class="ui-autocomplete-input">
                <input type="hidden" name="canal" id="form_0-canal-mercadeo-select" value="1" data-default="1" required="">
            </div>
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
                <option value="150">150</option>
                <option value="200">200</option>
                <option value="255">255</option>
                <option value="10000">10.000</option>
            </select>
        </div>
    </div>
</div>