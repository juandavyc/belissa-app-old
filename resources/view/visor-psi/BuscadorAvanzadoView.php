<div class="row gtr-25 gtr-uniform">
    <div class="col-3 col-12-small">
        <label> Buscar por</label>
        <div class="input-container">
            <i class="fas fa-list icon-input"></i>
            <select id="form_0_filtro" name="filtro" required>
                <option value="0">Todo</option>
                <option value="1">Placa</option>

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
        <label> Tipo vehiculo </label>
        <div class="input-container">
            <i class="fas fa-car icon-input"></i>
            <select id="form_0_tipo" name="form_0_tipo" required>
                <option value="0" selected>Todo</option>
                <option value="1">SIN TIPO</option>
                <option value="2">LIVIANO</option>
                <option value="3">4X4</option>
                <option value="4">MOTO</option>
                <option value="5">REMOLQUE</option>
                <option value="6">TAXI</option>
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
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="255">255</option>
            </select>
        </div>
    </div>
</div>