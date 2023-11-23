<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->menu->setModulo(
    array(
        'nombre' => 'Pre Ingreso',
        'icono' => 'icon solid fa-folder-open',
    )
);
// $authIngreso = array('statusText' => 'error', 'message' => 'sin iniciar');
// if (isset($_GET['auth'])) {

//     require $app->ruta->getDatabase();
//     require $app->ruta->getClass('ingreso-qr/ingreso.qr');

//     $database = new MyDatabase();
//     if ($database->getEstado()['status']) {
//         $ingreso = new IngresoQr($database->getPDO());
//         $authIngreso = $ingreso->isVigenteQR(getDesencriptado($_GET['auth']));
//     } else {
//         $authIngreso =  array('statusText' => 'error', 'message' => 'Error del servidor, intente más tarde');
//     }
//     $database->close();
// } else {
//     $authIngreso = array('statusText' => 'error', 'message' => 'Este módulo requiere una autorización, solicítela');
// }
$authIngreso = array('statusText' => 'error', 'message' => 'Este módulo requiere una autorización, solicítela');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        .basico-input-select-placa input,
        .basico-input-select-placa select,
        .basico-input-select-placa i {
            font-size: 22px;
        }

        .datos-banner {
            color: #1774CE;
            font-weight: bold;
            border-radius: 10px;
            padding: 0.2em 1em;
        }

        .datos-banner b {
            color: #DB4B4B
        }
    </style>
</head>

<body data-id="pre-ingreso" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <header class="special container">
                <span class="<?= $app->menu->current['icon'] ?>"></span>
                <h2>
                    <?= $app->menu->current['name'] ?>
                </h2>
                <p>
                    CENTRO DE DIAGNÓSTICO AUTOMOTOR
                    <br>
                    <b>CDA AUTOMOTOS S.A.S</b>
                </p>
            </header>
            <nav class="breadcrumbs" id="main-breadcrumbs"></nav>
            <?php $app->ruta->getComponent('FileChooserCamera') ?>
            <?php require $app->ruta->getView('pre-ingreso/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?php require $app->ruta->getMenuPublic() ?>
    <?php require $app->ruta->getScript() ?>

    <?php
    if ($authIngreso['statusText'] === "bien") {
       ?>
        <script src="/assets/js/helix/modal.js"></script>
        <script src="/assets/js/helix/filechooser.camera.js"></script>
        <script src="controller/main.js" type="module"></script>
        <?php
    }
    ?>

</body>

</html>