<div class="container">
<div class="p-1 mb-1 bg-info text-dark">
<?php 
$title = "Task Create";
include "../index.php";
include "../layout/header.php";
require "../config/Database.php";
require "../app/Controller/Task.php";

$database = new Database;
$db = $database->getConnection();

$tasksConnect = new task($db);

if ($_POST) {
    $tasksConnect->name = $_POST['name'];
    $tasksConnect->description = $_POST['description'];
    $tasksConnect->deadline = $_POST['deadline'];

    if($tasksConnect->create()) {
        // echo "task created";
    } else {
        echo "Something went wrong";
    }

}
?>
<div class="container">
   
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<h1>Tasks</h1>

<div class="input-group input-group-lg">
  <span class="input-group-text" id="inputGroup-sizing-lg">Task</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="name">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-text" id="inputGroup-sizing-lg">Description</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="description">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-text" id="inputGroup-sizing-lg">Deadline</span>
  <input type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="deadline">
</div>
<button type="submit" class="btn btn-primary me-2">Submit</button>


</form>
</div>
<?php
$database = new Database;
$db = $database->getConnection();

$tasks = Task::index($db);

?>
<div class="container">
<table class="table table-light table-hover">


    <tr>
        <th>#</th>
        <th>Task</th>
        <th>Description</th>
        <th>Deadline</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>
    <?php
    foreach($tasks as $task){
        echo "<tr>
        <td>".$task['id']."</td>
        <td>".$task['name']."</td>
        <td>".$task['description']."</td>
        <td>".$task['deadline']."</td> 
        <td>".$task['time_created']."</td> 
        <td>".$task['time_modified']."</td>      
        
         <td>
         <button type=button' class='btn btn-outline-secondary'>
         <a href='task.edit.php/?id=".$task['id']."'>Update</a>
         </button>
         <button type='button' class='btn btn-outline-danger'>
         <a href='../app/Controller/Task.delete.php/?id=".$task['id']."'>Delete</a>
         </button>

         </td>
        </tr>";
    }
    ?>
</table>
</div>


<?php 
include "../layout/footer.php";
?>
</div>
</div>

