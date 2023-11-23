<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('callcenter', true);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title> Documentación | Belissa, CallCenter</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="<?=$_SESSION['csrf_token']?>">
    <link rel="shortcut icon" type="image/jpg" href="/images/favicon.png" />
    <link rel="stylesheet" href="/assets/css/main_<?=$_SESSION['session_user'][7]?>.css" />
    <noscript>
        <link rel="stylesheet" href="/assets/css/noscript.css" />
    </noscript>
    <style>
    .ol-mapa {
        counter-reset: item;
        margin: 0px;
    }

    .ol-mapa li {
        display: block
    }

    .ol-mapa li:before {
        content: counters(item, ".") ". ";
        counter-increment: item
    }

    .video-container {
        padding-top: 56.25%;
        height: 0px;
        position: relative;
    }

    #video-title {
        background: #335066;
        border-radius: 4px;
        margin-bottom: 4px;
        color: #FFF;
        font-weight: bold;
        text-align: center;
    }

    .video {
        border-radius: 4px;
        box-shadow: 0 0 5px #335066;
        border: 5px solid #335066;
        background: #335066;
        width: 100%;
        height: 95%;
        position: absolute;
        top: 0px;
        left: 0;
    }

    #listado-videos ul,
    #listado-videos ol {
        margin: 0px;
    }

    .li-video {
        border-bottom: 1px dotted;
        font-weight: bold;
    }

    .li-video:hover {
        background-color: #F7F7F7;
        cursor: pointer;
    }
    </style>
</head>

<body data-id="callcenter" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <header class="special container">
                <span class="icon solid fas fa-video"></span>
                <h2>Documentación</h2>
                <p><?php echo $_SESSION['session_user'][3]; ?></p>
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>
            <section class="wrapper style3 container max">
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-4 col-12-small">
                        <?php require DOCUMENT_ROOT . '/modulos/app/vista/documentacion/mapa.php';?>
                    </div>
                    <div class="col-8 col-12-small">
                        <?php require DOCUMENT_ROOT . '/modulos/app/vista/documentacion/condiciones.php';?>
                    </div>
                    <div class="col-12">
                        <?php require DOCUMENT_ROOT . '/modulos/app/vista/documentacion/video.php';?>
                    </div>
                </div>
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
    <!-- <script type="module" src="/modulos/app/controlador/callcenter/main.js"></script> -->

    <script>
    $('.li-video').on('click', function(e) {
        let temp_src = '/archivos/documentacion/' + $(this).attr('data-src') + '.mp4';

        $("#video-title").html('¡' + $(this).html() + ' !');
        $('#video-player source').attr('src', temp_src);
        $("#video-player")[0].load();

        e.preventDefault();
        return false;
    });
    </script>


</body>

</html>