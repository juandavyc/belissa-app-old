<div class="row gtr-50 gtr-uniform" id="dash-general">
    <div class="col-12 align-center">
        <hr>
        <h2 style="letter-spacing:0;">Tu usuario tiene <b>acceso</b> a los siguientes módulos</h2>
    </div>
    <?php

    $tempHtml = '';
    $tempCount = 1;

    foreach ($app->menu->getMenuArray() as $key => $value) {

        if (in_array($key, (array)$app->verificar->getModulos())) {
       
            if (!isset($value['sub-menu'])) {
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
            }

            $tempCount++;
        } 
    }
    echo $tempHtml;
    ?>
</div>