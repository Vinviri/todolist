<?php
include 'db.php';

if (isset($_POST['id']) && isset($_POST['task'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $query = "UPDATE tasks SET task='$task' WHERE id=$id";
    mysqli_query($conn, $query);
    header('Location: index.php');
}
?>
