<?php

if (isset($dir) && isset($data)) {
    $tempHtml = '<ol class="ol-mapa">';
    foreach ($data as $key => $value) {
        if (isset($value['sub-menu'])) {
            $tempHtml .= '<li> ' . ucfirst($key) . '</li>';
            $tempHtml .= '<ol class="ol-mapa">';
            foreach ($value['sub-menu'] as $key1 => $value1) {
                $tempHtml .= '<li> <a href="' . $value1['url'] . '">' . ucfirst($value1['nombre']) . '</a></li>';
            }
            $tempHtml .= '</ol>';
        } else {
            $tempHtml .= '<li> <a href="' . $value['url'] . '">' . ucfirst($value['nombre']) . '</a></li>';
        }
    }
    $tempHtml .= '</ol> ';
    echo $tempHtml;
}
