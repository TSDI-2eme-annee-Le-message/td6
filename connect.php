<?php
$host = 'localhost';
$dbname = 'app';
$username = 'root';
$password = 'Toor@1234';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>