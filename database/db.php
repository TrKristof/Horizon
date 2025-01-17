<?php
$host = 'localhost';
$db = 'horizon_management';
$user = 'root';
$password = '';

$connection = new mysqli($host, $user, $password, $db);

if ($connection->connect_error) {
    die("Kapcsolódási hiba: " . $connection->connect_error);
}
