<header class="special container">
    <span class="<?= $app->menu->current['icon'] ?>"></span>
    <h2>
        <?= $app->menu->current['name'] ?>
    </h2>
    <p>
        <?= htmlspecialchars($_SESSION['session_user'][3]); ?>
    </p>
</header>

<nav class="breadcrumbs" id="breadcrumbs_global"></nav>
<section class="wrapper style3 container max">
    <div class="row gtr-50 gtr-uniform" id="dash-general">
        <div class="col-12 align-center">
            <h2>Gestión del software</h2>
            <hr>
        </div>
        <?php

        $tempHtml = '';
        $tempCount = 1;

        foreach ($app->menu->getMenuArray()['cpanel']['sub-menu'] as $key => $value) {

            $tempHtml .= '<div class="col-4 col-12-small"> ';
            $tempHtml .= '<div class="dashboard-servicio privilegios-alt"> ';
            $tempHtml .= '<div class="row"> ';
            $tempHtml .= '<div class="col-8 col-12-mobilep"> ';
            $tempHtml .= '<h4>' . $value['nombre'] . '</h4>';
            $tempHtml .= '<a href="' . $value['url'] . '" class="button primary small icon solid fa-arrow-right button-limit"> Ir</a>';
            $tempHtml .= '</div>';
            $tempHtml .= '<div class="col-4 col-12-mobilep align-right"> ';
            $tempHtml .= '<i class="' . $value['icono'] . ' fa-3x icon-status color-758"></i>';
            $tempHtml .= '</div>';
            $tempHtml .= '</div>';
            $tempHtml .= '</div>';
            $tempHtml .= '</div>';

            $tempCount++;
        }
        echo $tempHtml;


        ?>
    </div>
</section>