<?php


$fichero = $_SERVER["DOCUMENT_ROOT"]. $_GET['ruta'];

if (file_exists($fichero)){ 

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($fichero));
readfile($fichero);

}  {
echo 'El archivo no existe.' ;
}