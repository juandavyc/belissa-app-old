<?php
class MyAppMensaje
{
    public function __construct()
    {
    }

    function getFormularioIcompleto($array = null)
    {
        return array(
            'statusCode' => 400,
            'status' => false,
            'statusText' => 'incompleto',
            'message' => 'Formulario incompleto'
        );
    }
    function getSinPermisos($array = null)
    {
        return array(
            'statusCode' => 400,
            'status' => false,
            'statusText' => 'denegado',
            'message' => 'No tiene permisos para acceder'
        );
    }
    // pere
    function getResponse($array = null)
    {
        return json_encode($array, http_response_code($array["statusCode"]), JSON_FORCE_OBJECT);
    }
    function petResponse(
        $_arrayResponse
    ) {
        echo json_encode($_arrayResponse, JSON_FORCE_OBJECT);
    }
}
