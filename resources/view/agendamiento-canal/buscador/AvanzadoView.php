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