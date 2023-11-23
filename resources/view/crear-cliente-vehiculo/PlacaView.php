<form id="form-tipo-servicio-placa">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12">
            <h3 class="icon solid fa-arrow-right h3-orange"> DATOS CLAVE </h3>
        </div>
        <div class="col-12 align-center">
            <i class="fa-solid fa-car fa-3x"></i>
            <i class="fa-solid fa-motorcycle fa-3x"></i>
            <h3> Bienvenido al ingreso de vehículos </h3>
        </div>
        <div class="col-3 col-12-small"></div>
        <div class="col-6 col-12-small align-center ingreso-placa-mod">
            <label class="label-datos-alt label-orange"> Placa del vehículo </label>
            <div class="input-container">
                <i class="fab fa-cc-jcb icon-input"></i>
                <div>
                    <input type="text" name="placa" id="ingreso-placa" class="ingreso-placa-primero"
                        placeholder="ABC123" value=""  maxlength="6"  autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12 align-center">
            <b id="ingreso-placa-instruccion"> Escriba la placa <b>(Al finalizar pulse ENTER)</b> </b>
        </div>
        <div class="col-3 col-12-small"></div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-6 col-12-mobilep">
            <button type="reset" class="button primary small fit icon solid fa-undo" id="tipo-servicio-placa-reset">
                Limpiar
            </button>
        </div>
        <div class="col-6 col-12-mobilep">
            <button type="submit" class="button primary fit icon solid fa-arrow-right" id="btn-ingreso-submit" disabled>
                SIGUIENTE
            </button>
        </div>
    </div>
</form>
