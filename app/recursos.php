<?php

function getEncriptado($value)
{
    $secret_key = '1110563467';
    $secret_iv = 'Mz4d1Hz15$$Lc';
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return base64_encode(openssl_encrypt($value, $encrypt_method, $key, 0, $iv));
}
function getDesencriptado($value)
{
    $secret_key = '1110563467';
    $secret_iv = 'Mz4d1Hz15$$Lc';

    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
}

function clean_file_name($string)
{
    $string = preg_replace("/[^a-z0-9\_\-\.]/i", '_', $string);
    return $string;
}

function getsafearray($array, $content, $value)
{
    $php_arrayreturn = key($array);
    foreach ($array as $clave => $valor) {
        if (strcasecmp($clave, $content) == 0) {
            if ($value == 1) {
                $php_arrayreturn = $clave;
            } else if ($value == 2) {
                $php_arrayreturn = $valor;
            }
            break;
        }
    }
    return $php_arrayreturn;
}

function getsafenumber($page, $totalpages)
{
    $php_return = 1;
    if (is_numeric($page)) {
        if ($page >= $totalpages) {
            $php_return = $totalpages;
        } else if ($page <= 0) {
            $php_return = 1;
        } else {
            $php_return = $page;
        }
    }
    return $php_return;
}

function getSRCImage64($image_base64, $folder, $name)
{

    $php_imagen = $image_base64;
    $php_placa = $name;


    $php_carpeta = date("d-m-Y");

    $response_src = "";
    $php_imagen = str_replace('data:image/png;base64,', '', $php_imagen);
    $php_imagen = str_replace(' ', '+', $php_imagen);
    $php_data = base64_decode($php_imagen);
    $php_nombre = $php_placa;
   
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $folder . '/' .$php_carpeta)) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . $folder . '/' .$php_carpeta, 0777, true);
    }
    $php_archivo = $_SERVER['DOCUMENT_ROOT'] . $folder . '/' . $php_carpeta . '/' . $php_nombre . '.png';

    $php_success = file_put_contents($php_archivo, $php_data);

    if ($php_success) {
        $response_src = $folder.'/' .$php_carpeta. '/' . $php_nombre . '.png';
    } else {
        $response_src = '/images/image_error.png';
    }
    return $response_src;
}
//  2022-01-31 para la base de datos
function getSpecialDateDatabase($_fecha)
{
    return date('Y-m-d', strtotime(str_replace('/', '-', trim($_fecha))));
}
//  31/01/2022 para los input
function getSpecialDate($_fecha)
{
    return date('d/m/Y', strtotime(str_replace('-', '/', trim($_fecha))));
}

function getSpecialDateTime($_fecha)
{
    return date('d/m/Y H:i:s', strtotime(str_replace('-', '/', trim($_fecha))));
}
function adddaysdate($_fecha, $_dias)
{
    return date('Y-m-d', strtotime($_fecha . ' + ' . $_dias . ' days'));
}

function puntos_smart($p1, $max, $num)
{ //

    $lngth = strlen($p1);
    $a = "";
    if ($lngth > $max) {
        $a = substr($p1, 0, $num) . '...';
    } else {
        $a = $p1;
    }
    return $a;
}
function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}
