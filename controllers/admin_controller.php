<?php
require "/xampp/htdocs/Horizon/database/db.php";

$id = intval($_GET['id']);

$school = $conn->query("SELECT * FROM School WHERE Id = $id")->fetch_assoc();
$teachers = $conn->query("SELECT Name FROM Teachers WHERE School_Id = $id")->fetch_all(MYSQLI_ASSOC);
$students = $conn->query("SELECT Name FROM Students WHERE School_Id = $id")->fetch_all(MYSQLI_ASSOC);

echo json_encode([
  'school' => $school,
  'teachers' => $teachers,
  'students' => $students
]);