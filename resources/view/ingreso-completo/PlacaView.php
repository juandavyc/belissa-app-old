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
                <hr>
            </div>
            <div class="col-12 align-center">
                <button class="primary" id="btn-qr-generator" style="max-width: 308px;"> <i class="fa-solid fa-qrcode fa-3x"></i> <br> Generar QR</button>
            </div>
        </div>
    </form>
    <!-- otras opciones -->
    <br><br>
    <div id="container-qr-create">
        <div id="modal-qr" class="my-modal">
            <div class="my-modal-container">
                <div class="my-modal-content">
                    <div class="align-center">
                        <div class="align-center">
                            <h2> Escanea el código QR</h2>
                            <div id="qr-code-resultado" class="qr-align-center"></div>
                            <br>
                            <a id="qr-code-url" href="" target="_blank"></a>
                            <br> <br>
                            <p id="qr-code-vigente"></p>                            
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-12">
                                    <label for="qr-whatsapp">Whatsapp</label>
                                </div>
                                <div class="col-10">
                                    <div class="input-container">
                                        <i class="fas fa-phone icon-input"></i>
                                        <input type="text" id="qr-whatsapp" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button id="btn-qr-whatsapp" class="button primary small icon brands fa-whatsapp"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>