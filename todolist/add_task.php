<?php
include 'db.php';

if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $query = "INSERT INTO tasks (task) VALUES ('$task')";
    mysqli_query($conn, $query);
    header('Location: index.php');
}
?>
