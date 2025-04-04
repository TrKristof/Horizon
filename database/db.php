<?php
$host = 'localhost';
$db = 'horizon';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
