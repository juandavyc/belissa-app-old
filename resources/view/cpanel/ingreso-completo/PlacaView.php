<div id="container-placa">
    <form id="form-tipo-servicio-placa">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12">
                <h3 class="icon solid fa-arrow-right h3-orange"> Nuevo Ingreso </h3>
            </div>
            <div class="col-12 align-center">
                <i class="fa-solid fa-ticket-simple fa-3x"></i>
                <h3><b> Bienvenido al ingreso de vehículos </b></h3>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-6 col-12-small align-center">
                <div class="ingreso-input-mod">
                    <input type="text" name="placa" id="ingreso-placa" class="ingreso-placa-primero" placeholder="ABC123" value="" autocomplete="off">
                </div>
            </div>
            <div class="col-12 align-center">
                <b id="ingreso-placa-instruccion"> Escriba la placa <b>(Al finalizar pulse ENTER)</b> </b>
            </div>
            <div class="col-3 col-12-small"></div>
            <div class="col-12 align-center">
                <label>Acciones</label>
            </div>
            <div class="col-6">
                <button type="reset" class="button primary small fit icon solid fa-undo" id="tipo-servicio-placa-reset">
                    Reintentar
                </button>
            </div>
            <div class="col-6">
                <button type="submit" class="button primary small fit icon solid fa-arrow-right" id="btn-ingreso-submit" disabled>
                    SIGUIENTE
                </button>
            </div>
            <div class="col-12 align-center">
                <p>Los Datos acá almacenados serán responsabilidad de : <br> <b>( <?= htmlspecialchars($_SESSION['session_user'][3]); ?>)</b></p>
            </div>
        </div>
    </form>
    <!-- otras opciones -->
    <br><br>
    <!-- <form id="form-reimprimir-placa" hidden>
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12">
                <h3 class="icon solid fa-arrow-right h3-orange"> Reimprimir Placa </h3>
            </div>
            <div class="col-12">
                <div class="container small align-center">
                    <div class="input-container">
                        <div>
                            <div class="ingreso-input-documento">
                                <input type="text" placeholder="Placa" id="ingreso-placa-reimprimir" name="placa" value="" autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="button primary small" style="border-radius: 15px; width: 120px;"> Buscar </button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
</div>