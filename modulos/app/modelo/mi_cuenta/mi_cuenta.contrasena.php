<?php 

if (
    isset($_POST["form_1_antigua_contrasena"]) &&
    isset($_POST["form_1_nueva_contrasena"]) &&
    isset($_POST["form_1_confirmar_contrasena"]) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {
    


            $id = $_SESSION['session_user'][1];

            $contra_vieja = htmlspecialchars($_POST['form_1_antigua_contrasena']);
            $contra_nueva = htmlspecialchars($_POST['form_1_nueva_contrasena']);
            $contra_confirmada = htmlspecialchars($_POST['form_1_confirmar_contrasena']);

            if (strcmp($contra_nueva, $contra_confirmada) == 0) {

            $micuentaClass = new MiCuentaClass($this->pdo);
            $this->arrayResponse = $micuentaClass->setCambioContrasena(
                $contra_vieja,
                $contra_nueva,
                $id               
                    
            );
        } else {
            echo ("Las contraseñas no son identicas (Nueva y Confirmar)");
        }

            $this->pdo = null;
        } else if (!isset($_config)) {
            if (!isset($_POST['status'])) {
                echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
                exit;
            } else { 
                echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario incompleto'), JSON_FORCE_OBJECT);
                exit;
            }
        }