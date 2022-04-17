<?php 

$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR: no Task ID");

require_once "../../config/Database.php";
require "Task.php";

$database = new Database;
$db = $database->getConnection();

$task = new Task($db);
$task->id = $id;

if ($task->delete()){
    header ("Location: http://localhost/OOP/Tasks_OOP/views/task.create.php");
} else {
    echo "delete failed";
}