<?php

class databaseConnection
{

    private $responseDatabase = array();

    private $conn;
    private $stmt;

    public function __construct($_rol = '')
    {
        try {
            //

            $servername = "localhost";            
            $username = "u258192092_user_call";
            $password = "+1BK@q8Cm2";
            $dbname = "u258192091_call_center";

            $initArr = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '-05:00'");
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, $initArr);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $this->responseDatabase = array('status' => true, 'message' => 'Conexion establecida', 'statusText' => 'bien');

        } catch (Exception $e) {
            $this->responseDatabase = array('status' => false, 'message' => 'Error al al conectar : ' . $e->getMessage(), 'statusText' => 'exception');

        }      
        return $this->conn;
    }
    public function estadoConexion()
    {
        return $this->responseDatabase;
    }

    public function getPDO()
    {
        if ($this->conn instanceof PDO) {
            return $this->conn;
        }
    }
    public function close()
    {
        $this->conn = null;
    }

}