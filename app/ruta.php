<?php
class MyAppRutas
{


    public function __construct()
    {
    }

    public function getRoot($dir = null)
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $dir;
    }
    public function getDocumentRoot($dir = null)
    {
        return $_SERVER['DOCUMENT_ROOT'] . $dir;
    }

    // dinamic
    public function getComponent($dir = null, $_data = [])
    {
        $data = [];
        if(is_array($_data))$data = (object)$_data;
        else $data = $_data;    
        require $this->getDocumentRoot('/app/components/' . $dir . '.php');
    }


    public function getClass($dir = null)
    {
        return $this->getDocumentRoot('/app/class/' . $dir . '.class.php');
    }

    public function getDatabase($dir = null)
    {
        return $this->getDocumentRoot('/resources/database/connection.php');
    }

    public function getView($dir = null)
    {
        return $this->getDocumentRoot('/resources/view/' . $dir . 'View.php');
    }

    public function getModel($dir = null, $model = null)
    {
        return $this->getDocumentRoot('/app/models/' . $dir . '/' . $model . '.php');
    }

    public function getController($dir = null)
    {
        // return ('/app/controllers/' . $dir . '.js?v='.time());
        return ('/app/controllers/' . $dir . '.js');
    }

    public function getCSS($dir = null)
    {
        return ('<link rel="stylesheet" href="/resources/css/' . $dir . '/style.css"/>');
    }
    // template
    public function getHead($dir = null)
    {
        return $this->getDocumentRoot('/app/template/head.php');
    }
    public function getScript($dir = null)
    {
        return $this->getDocumentRoot('/app/template/script.php');
    }
    public function getScriptHelix($dir = null)
    {
        return $this->getDocumentRoot('/app/template/script.helix.php');
    }
    public function getScriptCamera($dir = null)
    {
        return $this->getDocumentRoot('/app/template/script.camera.php');
    }
    public function getFooter($dir = null)
    {
        return $this->getDocumentRoot('/app/template/footer.php');
    }
    public function getMenuPublic($dir = null)
    {
        return $this->getDocumentRoot('/app/template/menu.php');
    }
}
