<?php
class Database
{
    //DB params
    private $dbHost = 'localhost';
    private $dbName = 'phprestapi_db';
    private $dbUser = 'phprestapi_usr';
    private $dbPassword = 'Geheim1';
    private $conn;

    //DB connect
    public function connect()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName
                , $this->dbUser
                , $this->dbPassword);
            //1st parameter: 'localhost;phprestapi_db'
            //2nd parameter: 'phprestapi_usr'
            //3rd parameter: 'Geheim1'
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOEXCEPTION $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
