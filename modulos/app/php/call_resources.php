<?php
require "call.php";
function encrypt($value, $type)
{
    $secret_key = skeyy;
    $secret_iv = pkey;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $hashnum = "";
    if ($type == 1) {
        $hashnum = base64_encode(openssl_encrypt($value, $encrypt_method, $key, 0, $iv));}
    if ($type == 2) {
        $hashnum = openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);}
    return $hashnum;
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
    $php_carpeta = $folder;
    $php_placa = $name;

    $json_image_src = "";
    //Elimina data:image/png;base64
    $php_imagen = str_replace('data:image/png;base64,', '', $php_imagen);
    //Remplaza los espacios por un +
    $php_imagen = str_replace(' ', '+', $php_imagen);
    //Decodifica el base64
    $php_data = base64_decode($php_imagen);
    // Donde va a guardar el archivo
    $php_nombre = $php_placa;
    // Ruta y nombre
    $php_archivo = DOCUMENT_ROOT . $folder . '/' . $php_nombre . '.png';
    // Subir la foto
    $php_success = file_put_contents($php_archivo, $php_data);
    // La imagen subio al seridor
    if ($php_success) {
        $json_image_src = $folder . '/' . $php_nombre . '.png';
    }
    // La imagen NO subio al seridor
    else {
        $json_image_src = '/images/image_error.png';
    }
    return $json_image_src;
}
//  2022-01-31 para la base de datos
function getSpecialDateDatabase($_fecha)
{
    return date('Y-m-d', strtotime(str_replace('/', '-', $_fecha)));
}
//  31/01/2022 para los input
function getSpecialDate($_fecha)
{
    return date('d/m/Y', strtotime(str_replace('-', '/', $_fecha)));
}

function getSpecialDateTime($_fecha)
{
    return date('d/m/Y H:i:s', strtotime(str_replace('-', '/', $_fecha)));
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

// function getHttpText($httpStatus)
// {

//     $text = "Codigo http desconocido";
//     if ($httpStatus !== NULL) {
//         switch ($httpStatus) {
//             case 100:
//                 $text = 'Continue';
//                 break;
//             case 101:
//                 $text = 'Switching Protocols';
//                 break;
//             case 200:
//                 $text = 'OK';
//                 break;
//             case 201:
//                 $text = 'Created';
//                 break;
//             case 202:
//                 $text = 'Accepted';
//                 break;
//             case 203:
//                 $text = 'Non-Authoritative Information';
//                 break;
//             case 204:
//                 $text = 'No Content';
//                 break;
//             case 205:
//                 $text = 'Reset Content';
//                 break;
//             case 206:
//                 $text = 'Partial Content';
//                 break;
//             case 300:
//                 $text = 'Multiple Choices';
//                 break;
//             case 301:
//                 $text = 'Moved Permanently';
//                 break;
//             case 302:
//                 $text = 'Moved Temporarily';
//                 break;
//             case 303:
//                 $text = 'See Other';
//                 break;
//             case 304:
//                 $text = 'Not Modified';
//                 break;
//             case 305:
//                 $text = 'Use Proxy';
//                 break;
//             case 400:
//                 $text = 'Bad Request';
//                 break;
//             case 401:
//                 $text = 'Unauthorized';
//                 break;
//             case 402:
//                 $text = 'Payment Required';
//                 break;
//             case 403:
//                 $text = 'Forbidden';
//                 break;
//             case 404:
//                 $text = 'Not Found';
//                 break;
//             case 405:
//                 $text = 'Method Not Allowed';
//                 break;
//             case 406:
//                 $text = 'Not Acceptable';
//                 break;
//             case 407:
//                 $text = 'Proxy Authentication Required';
//                 break;
//             case 408:
//                 $text = 'Request Time-out';
//                 break;
//             case 409:
//                 $text = 'Conflict';
//                 break;
//             case 410:
//                 $text = 'Gone';
//                 break;
//             case 411:
//                 $text = 'Length Required';
//                 break;
//             case 412:
//                 $text = 'Precondition Failed';
//                 break;
//             case 413:
//                 $text = 'Request Entity Too Large';
//                 break;
//             case 414:
//                 $text = 'Request-URI Too Large';
//                 break;
//             case 415:
//                 $text = 'Unsupported Media Type';
//                 break;
//             case 500:
//                 $text = 'Internal Server Error';
//                 break;
//             case 501:
//                 $text = 'Not Implemented';
//                 break;
//             case 502:
//                 $text = 'Bad Gateway';
//                 break;
//             case 503:
//                 $text = 'Service Unavailable';
//                 break;
//             case 504:
//                 $text = 'Gateway Time-out';
//                 break;
//             case 505:
//                 $text = 'HTTP Version not supported';
//                 break;
//             default:
//                 $text = 'http status code unrecognized';
//                 // exit('Unknown http status code "' . htmlentities($_http_status) . '"');
//                 break;
//         }
//     }

//     return $text;
// }