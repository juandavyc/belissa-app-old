<div class="row gtr-25 gtr-uniform">

    <div class="col-3 col-12-small">
        <label> Buscar por</label>
        <div class="input-container">
            <i class="fas fa-list icon-input"></i>
            <select id="form_0_filtro" name="filtro" required>
                <option value="0">Todo</option>
                <option value="1">Titulo</option>

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
    <div class="col-3 col-12-small">
        <label> Tipo </label>
        <div class="input-container">
            <i class="fas fa-car icon-input"></i>
            <select id="form_0_tipo" name="form_0_tipo" required>
                <option value="0" selected>Todo</option>
                <option value="1">CREAR</option>
                <option value="2">BUSCAR</option>
                <option value="3">ACTUALIZAR</option>
                <option value="4">ELIMINAR</option>
                <option value="5">LLAMAR</option>
                <option value="6">SMS</option>
                <option value="7">WHATSAPP</option>
            </select>
        </div>
    </div>
    <div class="col-3 col-12-small">
        <label> Modulo </label>
        <div class="input-container">
            <i class="fas fa-car icon-input"></i>
            <select id="form_0_tipo" name="modulo" required>
                <option value="0" selected>Todo</option>
                <option value="1">AGENDAMIENTO</option>
                <option value="2">INGRESO</option>
                <option value="3">CALLCENTER</option>
                <option value="4">CLIENTE</option>
                <option value="7">VEHICULO</option>
                <option value="8">USUARIO</option>
                <option value="9">CANAL</option>
                <option value="10">NOTA CONDUCTOR</option>
                <option value="11">NOTA PROPIETARIO</option>
                <option value="12">NOTA VEHICULO</option>
            </select>
        </div>
    </div>
</div>