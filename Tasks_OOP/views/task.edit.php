<section class="container">
<div class="p-3 mb-2 bg-success text-white">
<?php

$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR: no task ID");
$title = "Task Edit";
include "../index.php";
include "../layout/header.php";
require "../config/Database.php";
require "../app/Controller/Task.php";

$database = new Database;
$db = $database->getConnection();

$task = new Task($db);
$task->id = $id;
$task->getOne();

if($_POST){
    $task->name = $_POST['name'];
    $task->description = $_POST['description'];
    $task->deadline = $_POST['deadline'];

    if($task->update()){
        header("Location: http://localhost/OOP/Tasks_OOP/views/task.create.php ");
    } else {
        echo "Update failed";
    }
}


?>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}");?>" method="POST">

<h1>Update task</h1>


<div class="input-group input-group-lg">
  <span class="input-group-text" id="inputGroup-sizing-lg"value="<?php echo $task->name; ?>">Update task </span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="name">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-text" id="inputGroup-sizing-lg" value="<?php echo $task->description; ?>">Update description</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="description">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-text" id="inputGroup-sizing-lg"value="<?php echo $task->deadline; ?>">Updated deadline</span>
  <input type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="deadline">
</div>
<button type="submit" class="btn btn-primary" value="Update task">Submit</button>
<button type="submit" class="btn btn-primary">Back <a href="task.create.php"></a> </button>

</form>
</div>



<?php 
include "../layout/footer.php";
?>
</div>
</section>
