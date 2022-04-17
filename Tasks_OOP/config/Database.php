<?php

class Database
{
    //Prisijungimo duomenys
    private $host = "localhost";
    private $dbName = "taskPlanner";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() //prisijungimas prie DB
    {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->username, $this->password);
            // echo "connected";
        } catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }

        return $this->conn;
    }
}