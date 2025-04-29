<?php
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

$schoolId = $_SESSION["school_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //diákok mentése
    if (isset($_POST["students"])) {
        foreach ($_POST["students"] as $student) {
            $sql = "INSERT INTO pending_users (Name, Email, StudentCard, UserType, SchoolId, Status, IsActive, ExpirationDate) 
                    VALUES (?, ?, ?, 'student', ?, 'pending', 1, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiss", $student["name"], $student["email"], $student["student_card"], $schoolId, $student["expiration_date"]);
            $stmt->execute();
        }
    }

    //tanárok mentése
    if (isset($_POST["teachers"])) {
        foreach ($_POST["teachers"] as $teacher) {
            $sql = "INSERT INTO pending_users (Name, Email, UserType, SchoolId, Status, IsActive, ExpirationDate) 
                    VALUES (?, ?, 'teacher', ?, 'pending', 1, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiss", $teacher["name"], $teacher["email"], $schoolId, $teacher["expiration_date"]);
            $stmt->execute();
        }
    }

    $_SESSION["alert"] = ["type" => "success", "message" => "Adatok sikeresen beküldve az admin jóváhagyására!"];
    header("Location: /Horizon/pages/schools/uploadStudentsTeachers.php");
    exit();
}