<?php
//var_dump($_POST);
if (
    isset($_POST['id_certificar']) &&
    isset($_POST['fecha_certificado']) &&
    isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {



    $certificado = new IngresoClass($this->pdo);
    $this->arrayResponse = $certificado->createCertificado(
        htmlspecialchars($_POST['id_certificar']),
        getSpecialDateDatabase($_POST['fecha_certificado']),     
        $_SESSION['session_user'][1]
    );
    
    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}