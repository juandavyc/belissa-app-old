<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('gestion', true);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Encriptar | Belissa CallCenter</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="<?=$_SESSION['csrf_token']?>">
    <link rel="shortcut icon" type="image/jpg" href="/images/favicon.png" />
    <link rel="stylesheet" href="/assets/css/main_<?=$_SESSION['session_user'][7]?>.css" />
    <noscript>
        <link rel="stylesheet" href="/assets/css/noscript.css" />
    </noscript>
    <style>

    </style>
</head>

<body data-id="gestion" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <header class="special container">
                <span class="icon solid fas fa-pager"></span>
                <h2>Encriptador de JASH SAS</h2>
                <p>Datos - numeros - etc</p>
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>
            <section class="wrapper style4 container max">
                <?php require DOCUMENT_ROOT . '/modulos/app/vista/encriptar/encriptar.php';?>
            </section>
        </article>
        <?php require DOCUMENT_ROOT . '/assets/php/call_footer.php';?>
    </div>

    <?php echo $recursosApp->generarMenu(); ?>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/browser.min.js"></script>
    <script src="/assets/js/breakpoints.min.js"></script>
    <script src="/assets/js/util.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/jquery-confirm.js"></script>
    <!-- <script src="/assets/js/vbuscador.js"></script>-->

    <!--<script type="module" src="/modulos/app/controlador/rtm/inicio/main.js?v=<?php //echo time(); ?>"></script> -->


    <script>
    $('#form_encriptar').on('submit', function(e) {

        let form_data = new FormData($('#form_encriptar')[0]);
        let self = $.confirm({
            title: false,
            content: 'Cargando, espere...',
            typeAnimated: true,
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            content: function() {
                return $.ajax({
                        url: PROTOCOL_HOST +
                            '/modulos/app/modelo/encriptar/modelo.encriptar.php',
                        type: 'POST',
                        data: form_data,
                        headers: {
                            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        timeout: 35000,
                    })
                    .done(function(response) {
                        $('#form_encriptar_2').val(response);
                        console.log(response);
                        self.close();
                    })
                    .fail(function(response) {
                        self.setTitle('Error fatal');
                        self.setContent(JSON.stringify(response));
                        console.log(response);
                    });
            },
            buttons: {
                aceptar: function() {},
            },
        });
        e.preventDefault();
        return false;
    });
    </script>
</body>

</html>