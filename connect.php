<?php
$server = 'localhost';
$username = 'root'; // Change if using a different user
$password = ''; // Add password if set
$dbname = 'attendance_system';

$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>