<div id="container-seleccionar-placa">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-12">
            <h4>Placa a cargar el video</h4>
        </div>
        <div class="col-8 col-12-small">
            <div class="input-container">
                <i class="fa-solid fa-ticket-simple icon-input"></i>
                <div>
                    <input type="text" id="placa-text" value="" placeholder="ABC123" autocomplete="off" maxlength="6">
                    <input type="hidden" name="placa" id="placa-select" value="">
                </div>
            </div>
        </div>
        <div class="col-4 col-12-small">
            <button class="primary fit icon solid fa-arrow-right" id="btn-siguiente-placa"> Siguiente</button>
        </div>
    </div>
</div>
<br>
<div id="container-cargar-video" hidden>
    <div class="row gtr-50 gtr-uniform">
        <div class="col-12">
            <h4>Proceso de carga del video</h4>
        </div>
        <div class="col-12">
            <div class="row gtr-25 gtr-uniform">
                <div class="col-12 align-center">
                    <span class="vh-placa" id="container-placa"></span>
                    <input type="hidden" name="placa" id="placa" value="0" required="">
                    <br><br>
                </div>
                <div class="col-8 col-12-small" hidden>
                    <div class="input-container">
                        <i class="fas fa-camera icon-input"></i>
                        <div>
                            <select id="devices-list"></select>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-12-small">
                    <div class="align-center">
                        <video id="video-rtc" controls="" autoplay=""></video>
                    </div>
                </div>
                <div class="col-4 col-12-small">
                    <div class="row gtr-25 gtr-uniform">
                        <div class="col-12 col-3-small">
                            <button id="btn-start-recording" class="button primary fit icon solid fa-play" style="background:#2EA933;">START </button>
                        </div>
                        <div class="col-12 col-3-small">
                            <button id="btn-pause-recording" class="button primary fit icon solid fa-pause" style="background:#D1C20B;" disabled>PAUSE</button>
                        </div>
                        <div class="col-12 col-3-small">
                            <button id="btn-stop-recording" class="button primary fit icon solid fa-stop" style="background:#E56317;" disabled>STOP</button>
                        </div>
                        <div class="col-12 col-3-small">
                            <button id="btn-close-recording" class="button primary fit icon solid fa-times" style="background:#009ED2;">SALIR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <h2>Resultado</h2>
        </div>
        <div class="col-4 align-right">
            <button class="primary small " id="btn-recargar-video"> Recargar</button>
        </div>
        <div class="col-8 col-12-small">
            <div class="align-center">
                <video id="reproductor-video" controls="">
                    <source src="" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="col-4 col-12-small">
            <ul id="container-resultado">

            </ul>
        </div>

    </div>
</div>