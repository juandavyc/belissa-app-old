<div class="col-9 col-12-small">
    <div id="container-callcenter-error-resultado"></div>
    <div id="container-callcenter-bien-resultado" class="call-center-dashboard" hidden>
        <div class="row gtr-25 gtr-uniform">
            <div class="col-8 col-12-mobilep">
                <h2 class="h2-placa" id="datos-vehiculo-placa-html"></h2>
                <label class="label-id" id="datos-vehiculo-top-id-html"></label>
            </div>
            <div class="col-4 col-12-mobilep align-right">
                <br>
                <button class="primary small icon solid fa-check" id="btn-vehiculo-revisado"></button>
            </div>
            <div class="col-6 col-12-small">
                <?php require $app->ruta->getView('callcenter/Dashboard/Propietario') ?>
            </div>
            <div class="col-6 col-12-small">
                <?php require $app->ruta->getView('callcenter/Dashboard/Conductor') ?>
            </div>
            <div class="col-12">
                <?php require $app->ruta->getView('callcenter/Dashboard/Vehiculo') ?>
            </div>
            <div class="col-12">
                <div id="tab-servicio" style="margin:0;">
                    <ul>
                        <li><a href="#tabs-servicio" class="icon solid fa-house"> Inicio </a></li>
                        <li><a href="#tabs-rtm" class="icon solid fa-car"> RTM </a></li>
                        <li><a href="#tabs-soat" class="icon solid fa-shield"> SOAT </a></li>
                        <!--<li><a href="#tabs-preventiva" class="icon solid fa-circle-check"> Preventiva </a></li>-->
                    </ul>
                    <div id="tabs-servicio"></div>
                    <div id="tabs-rtm">
                        <?php require $app->ruta->getView('callcenter/Servicio/Rtm') ?>
                    </div>
                    <div id="tabs-soat">
                        <?php require $app->ruta->getView('callcenter/Servicio/Soat') ?>
                    </div>
                    <!--<div id="tabs-preventiva"> Money money money</div>-->
                </div>
            </div>
            <div class="col-12">
                <div id="tab-modulo" style="margin:0;">
                    <ul>
                        <li><a href="#tabs-modulo" class="icon solid fa-home"> Inicio</a></li>
                        <li><a href="#tabs-notas" class="icon solid fa-comment"> Notas</a></li>
                        <li><a href="#tabs-sms" class="icon solid fa-comment-sms"> SMS</a></li>
                        <li><a href="#tabs-whatsapp" class="icon brands fa-whatsapp"> WhatsApp</a></li>
                        <li><a href="#tabs-ingreso" class="icon solid fa-server"> Ingresos </a></li>
                        <li><a href="#tabs-agendamiento" class="icon solid fa-server"> Agendamientos </a>
                        </li>
                    </ul>
                    <div id="tabs-modulo"></div>
                    <div id="tabs-notas">
                        <?php require $app->ruta->getView('callcenter/Modulo/Notas') ?>
                    </div>
                    <div id="tabs-sms">
                        <?php require $app->ruta->getView('callcenter/Modulo/Sms') ?>
                    </div>
                    <div id="tabs-whatsapp">
                        <div class="align-right">
                            <button class="primary small icon solid fa-rotate btn-editar-actualizar" id="btn-whatsapp-numero-recargar"> Recargar</button>
                        </div>
                        <div id="container-whatsapp-numeros"></div>
                    </div>
                    <div id="tabs-ingreso">
                        <?php require $app->ruta->getView('callcenter/Modulo/Ingreso') ?>
                    </div>
                    <div id="tabs-agendamiento">
                        <?php require $app->ruta->getView('callcenter/Modulo/Agendamiento') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>