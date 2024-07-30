<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "todolist";
$port = 3307; // Port MySQL

$conn = mysqli_connect($server, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection successful!";
}
?>
