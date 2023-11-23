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