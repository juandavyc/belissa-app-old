<div>
    <h3><i class="fa-solid fa-location-dot"></i> Mapa del sitio</h3>
    <hr>
</div>
<?php

$tempHtml = '';
$tempCount = 1;

$tempHtml .= '<ol class="ol-mapa">';
foreach ($app->menu->getMenuArray() as $key => $value) {
    if (in_array($key, (array)$app->verificar->getModulos())) {

        if (isset($value['sub-menu'])) {
            $tempHtml .= '<li> ' . ucfirst($key) . '</li>';
            $tempHtml .= '<ol class="ol-mapa">';
            foreach ($value['sub-menu'] as $key1 => $value1) {
                $tempHtml .= '<li> <a href="' . $value1['url'] . '">' . ucfirst($value1['nombre']) . '</a></li>';
            }
            $tempHtml .= '</ol>';
        } else {
            $tempHtml .= '<li> <a href="' . $value['url'] . '">' . ucfirst($key) . '</a></li>';
        }
    }
}
$tempHtml .= '</ol> ';
echo $tempHtml;
