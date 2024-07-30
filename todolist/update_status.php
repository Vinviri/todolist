<?php
include 'db.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'] ? 1 : 0;
    $query = "UPDATE tasks SET status=$status WHERE id=$id";
    mysqli_query($conn, $query);
    echo 'Status updated';
}
?>
