<div>
    <h3><i class="fa-solid fa-location-dot"></i> Mapa del sitio</h3>
    <hr>
</div>
<?php

$tempHtml = '';
$tempCount = 1;

$tempHtml .= '<ol class="ol-mapa">';
foreach ($recursosApp::MODULOS_APP as $key => $value) {
    if (in_array($key, (json_decode($_SESSION['session_user'][$recursosApp::MODULOS_SESSION_POS], true)))) {

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
        // $tempCount++;
    }

}
$tempHtml .= '</ol> ';
echo $tempHtml;