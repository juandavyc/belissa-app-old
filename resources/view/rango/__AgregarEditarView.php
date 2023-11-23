<fieldset>
    <legend>
        Datos basicos
    </legend>
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12" hidden>
            <input type="text" name="id" value="0" id="id" required="" autocomplete="off">
        </div>
        <div class="col-2 col-12-small">
            <label class="label-datos label-important"> Nombre </label>
        </div>
        <div class="col-4 col-12-small">
            <div class="input-container">
                <i class="fas fa-align-left icon-input"></i>
                <div>
                    <input type="text" placeholder="Administrador supremo" name="nombre" value="" id="nombre" autocomplete="off" required="">
                </div>
            </div>
        </div>
        <div class="col-2 col-12-small">
            <label class="label-datos label-important"> Tipo de conexión </label>
        </div>
        <div class="col-4 col-12-small">
            <div class="input-container">
                <i class="fas fa-align-left icon-input"></i>
                <div>
                    <select name="tipo_conexion" id='tipo_conexion'>
                        <option value="1">TIPO I ( C.R.U.D )</option>
                        <option value="2">TIPO II ( C.R.U )</option>
                        <option value="3">TIPO III ( C.R )</option>
                        <option value="4">TIPO IV ( R )</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 align-center">
            <p id="tipo_conexion_html">
                Este rango puede: <b>Crear, Leer, actualizar y eliminar</b> (CRUD).
            </p>
        </div>
    </div>
</fieldset>