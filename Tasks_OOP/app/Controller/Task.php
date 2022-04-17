<?php

class Task
{
    //DB info
    private static $conn;
    private static $table = "tasks";

    //objekto savybes
    public $id;
    public $name;
    public $description;
    public $deadline;

    public function __construct($db)
    {
        self::$conn = $db;
    }

    // create function
    public function create()
    {
        $sql = "INSERT INTO ".self::$table." SET name=:name, description=:description, deadline=:deadline";
        $query = self::$conn->prepare($sql);

        //bind values
        $query->bindParam(":name", $this->name);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":deadline", $this->deadline);

        if($query->execute()){
            return true;
        } else {
            return false;
        }

    }

    // read function
    public static function index($db){
        //prisidedame prijungima prie DB (static, nes naujo objekto nekursime)
        self::$conn = $db;

        //duomenu istraukimas
        $sql = "SELECT * FROM ".self::$table;
        $query = self::$conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        //graziname duomenu masyva
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE ".self::$table." SET
                name = :name,
                description = :description,
                deadline = :deadline
                WHERE id = :id";
        
        $query = self::$conn->prepare($sql);

        $query->bindParam(":name", $this->name);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":deadline", $this->deadline);
        $query->bindParam(":id", $this->id);

        if($query->execute()){
            return true;
        } else {
            return false;
        }


    }

    public function getOne()
    {
        //gauname vieno iraso duomenis pagal id
        $sql = "SELECT * FROM ".self::$table." WHERE id = ".$this->id;
        $query = self::$conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();

        //priskiriame duomenis savybems
        $this->name = $result['name'];
        $this->description = $result['description'];
        $this->deadline = $result['deadline'];
    }

    public function delete()
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ".$this->id;

        $query = self::$conn->prepare($sql);
        
        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }


}