<?php

class MyAppModelo
{
    public function __construct()
    {
    }

    public function ejecutarTarea($__model = null, $__pdo = null, $__configuracionApp = null, $__method = null)
    {
        // empty
        $__modelResponseApp = array();
        $_POST += array('status' => true);
        require $__configuracionApp->ruta->getModel($__model, $__method);
        // if (!empty($__modelResponseApp)) {
            $__configuracionApp->mensaje->petResponse($__modelResponseApp);
        // }
        // else{
        //     $__configuracionApp->mensaje->petResponse($__configuracionApp->mensaje->getSinPermisos());
        // }
    }
}
