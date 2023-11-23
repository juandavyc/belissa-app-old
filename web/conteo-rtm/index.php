<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('conteo-rtm', true);
$app->menu->setModulo($app->menu->getMenuArray()['conteo-rtm']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        table th:first-child {
            width: auto;
        }

        table.alt thead tr th {
            text-align: center;
        }

        table td {
            text-align: right;
            padding: .5em 1em;
        }
    </style>
</head>

<body data-id="conteo-rtm" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>

            <section class="wrapper style3 container max">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <fieldset>
                            <legend> <i class="fa-solid fa-chart-pie"></i> Conteo RTMyEC </legend>
                            <form id="form_conteo_rtm">
                                <div class="row gtr-25 gtr-uniform">
                                    <div class="col-4 col-12-small">
                                        <label> Fecha inicial</label>
                                        <div class="input-container">
                                            <i class="fas fa-calendar icon-input"></i>
                                            <input type="text" name="fecha_inicial" id="form_0_fecha_inicial" class="input_date_listener" value="" autocomplete="off" required="">
                                        </div>
                                    </div>
                                    <div class="col-4 col-12-small">
                                        <label> Fecha final</label>
                                        <div class="input-container">
                                            <i class="fas fa-calendar icon-input"></i>
                                            <input type="text" name="fecha_final" id="form_0_fecha_final" class="input_date_listener" value="" autocomplete="off" required="">
                                        </div>
                                    </div>
                                    <div class="col-4 col-12-small">
                                        <label>Buscar</label>
                                        <button type="submit" class="button primary small fit icon solid fa-chart-line">
                                            Calcular
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
                <div class="col-12">
                    <br>
                    <label for="">Reporte RTMyEC </label>
                    <div class="row gtr-25 gtr-uniform">
                        <div class="col-3 col-12-small"></div>
                        <div class="col-6 col-12-small">
                            <table class="alt">
                                <thead>
                                    <tr>
                                        <th> Elemento</th>
                                        <th> Total</th>
                                        <th> Porcentaje</th>
                                    </tr>
                                </thead>
                                <tbody>                        
                                    <tr style="background: #c1ffcb;">
                                        <td data-label="elemento">
                                            Aprobada(s)
                                        </td>
                                        <td data-label="total">
                                            <b id="aprobada-numero">0</b>
                                        </td>
                                        <td data-label="porcentaje" style="background: #c1ffcb;">
                                            <b id="aprobada-porcentaje">0</b> %
                                        </td>
                                    </tr>
                                    <tr style="background: #ffd0d0;">
                                        <td data-label="elemento">
                                            Rechazada(s)
                                        </td>
                                        <td data-label="total">
                                            <b id="rechazada-numero">0</b>
                                        </td>
                                        <td data-label="porcentaje" style="background: #ffd0d0;">
                                            <b id="rechazada-porcentaje">0</b> %
                                        </td>
                                    </tr>
                                    <tr style="background: #c6edff;">
                                        <td data-label="elemento">
                                            Sin estado(s)
                                        </td>
                                        <td data-label="total">
                                            <b id="sin-numero">0</b>
                                        </td>
                                        <td data-label="porcentaje" style="background: #c6edff;">
                                            <b id="sin-porcentaje">0</b> %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="elemento">
                                            <b>Total RTMyEC</b>
                                        </td>
                                        <td data-label="total">
                                            <b id="total-numero" style="color: #1f93ca;">0</b>
                                        </td>
                                        <td data-label="porcentaje">
                                            <b id="total-porcentaje" style="color: #1f93ca;">0</b> %
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-3 col-12-small"></div>
                        <!-- <div class="col-12">
                            <label for="reporte-placas">Listado de Placas</label>
                            <textarea id="reporte-placas" rows="5" placeholder="Listado de placas"></textarea>
                        </div> -->
                    </div>
                </div>
            </section>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>

    <script>
        const formulario = document.getElementById('form_conteo_rtm');

        const totalNumero = document.getElementById('total-numero');
        const totalPorcentaje = document.getElementById('total-porcentaje');

        const aprobadaNumero = document.getElementById('aprobada-numero');
        const aprobadaPorcentaje = document.getElementById('aprobada-porcentaje');

        const rechazadaNumero = document.getElementById('rechazada-numero');
        const rechazadaPorcentaje = document.getElementById('rechazada-porcentaje');

        const sinNumero = document.getElementById('sin-numero');
        const sinPorcentaje = document.getElementById('sin-porcentaje');

        let total = 0;


        formulario.addEventListener('submit', (e) => {
            e.preventDefault();
            tablaReset();
            formularioSubmit();
        })

        const tablaReset = () => {
            total = 0;
            totalNumero.innerHTML = 0;
            totalPorcentaje.innerHTML = 0;
            aprobadaNumero.innerHTML = 0;
            aprobadaPorcentaje.innerHTML = 0;
            rechazadaNumero.innerHTML = 0;
            rechazadaPorcentaje.innerHTML = 0;
            sinNumero.innerHTML = 0;
            sinPorcentaje.innerHTML = 0;
        }

        const formularioSubmit = () => {
            statusEditar = false;
            let self = $.confirm({
                content: function() {
                    return $.ajax(
                        getRequestConfig({
                            processData: false,
                            url: getMyAppModel('conteo-rtm/Conteo', 'Listado'),
                            formData: new FormData(formulario),
                            datatype: 'json'
                        })
                    ).done(function(response) {
                        if (response.statusText === 'bien') {
                            self.setTitle(response.statusText);
                            self.setContent(response.message);

                            $.each(response.message, function(_key, _value) {
                                // aprobado
                                if (_value.estado === 1) {
                                    aprobadaNumero.innerHTML = formatearNumero(_value.total)
                                }
                                // rechazado
                                else if (_value.estado === 2) {
                                    rechazadaNumero.innerHTML = formatearNumero(_value.total)
                                } else {
                                    sinNumero.innerHTML = formatearNumero(_value.total)
                                }
                                total += _value.total;
                            });
                            // total 
                            totalNumero.innerHTML = formatearNumero(total);
                            totalPorcentaje.innerHTML = 100;

                            // porcentaje
                            $.each(response.message, function(_key, _value) {
                                // aprobado
                                if (_value.estado === 1) {
                                    aprobadaPorcentaje.innerHTML = reglaDeTres(total, _value.total)
                                }
                                // rechazado
                                else if (_value.estado === 2) {
                                    rechazadaPorcentaje.innerHTML = reglaDeTres(total, _value.total)
                                } else {
                                    sinPorcentaje.innerHTML = reglaDeTres(total, _value.total)
                                }
                            });


                            self.close();
                        } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                            self.close();
                            call_recuperar_session(function(k) {
                                formularioSubmit()
                            });
                        } else {
                            self.setTitle(response.statusText);
                            self.setContent(response.message);
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        self.setTitle('Error fatal');
                        self.setContent(JSON.stringify(errorThrown));
                        console.log(errorThrown);
                    });
                },
                buttons: {
                    aceptar: function() {},
                },
            });
        }

        const formatearNumero = (numero) => numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')

        const reglaDeTres = (total, valor) => ((valor / total) * 100).toFixed(2);
       
    </script>
</body>

</html>