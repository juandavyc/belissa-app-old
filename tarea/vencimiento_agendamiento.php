<?php 

require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';

$database = new databaseConnection();
if ($database->estadoConexion()) {
    $pdo = $database->getPDO();

    $statement  = $pdo->prepare("CALL vencer_agendamiento_proc (@response)");
    $statement ->execute();

    $fecha = date('m-d-Y h:i:s a', time()); 

    $var = $pdo->query("SELECT @response")->fetch();
    print ("El procedimiento respondio: " . $var[0]." y se ejecuto en la fecha y hora ".$fecha ); 

}