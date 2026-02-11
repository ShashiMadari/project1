<?php
$conn = new mysqli("localhost", "root", "", "data_router");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
