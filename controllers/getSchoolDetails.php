<?php
require "/xampp/htdocs/Horizon/database/db.php";

$id = intval($_GET['id']);

$school = $conn->query("SELECT * FROM schools WHERE Id = $id")->fetch_assoc();
$teachers = $conn->query("SELECT Name FROM teachers WHERE School_Id = $id")->fetch_all(MYSQLI_ASSOC);
$students = $conn->query("SELECT Name FROM students WHERE SchoolId = $id")->fetch_all(MYSQLI_ASSOC);

echo json_encode([
  'school' => $school,
  'teachers' => $teachers,
  'students' => $students
]);
