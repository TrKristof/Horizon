<?php
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

//Ha nincs SESSION-be iskolának id-je akkor ne tudjon felölteni
/*if (!isset($_SESSION["school_id"])) {
    die("Nincs bejelentkezve iskola!");
}*/

$schoolId = 1; //$_SESSION["school_id"]; Egyenlőre nem a SESSION-ből szedi ki az id-t

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Diákok mentése
    if (isset($_POST["students"])) {
        foreach ($_POST["students"] as $student) {
            $sql = "INSERT INTO pending_users (Name, Email, StudentCard, UserType, SchoolId, IsActive, ExpirationDate) 
                    VALUES (?, ?, ?, 'student', ?, 1, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Hiba a diák prepare()-ben: " . $conn->error);
            }
            $stmt->bind_param("sssis", $student["name"], $student["email"], $student["student_card"], $schoolId, $student["expiration_date"]);
            if (!$stmt->execute()) {
                die("Hiba diák beszúrásakor: " . $stmt->error);
            }
        }
    }

    // Tanárok mentése
    if (isset($_POST["teachers"])) {
        foreach ($_POST["teachers"] as $teacher) {
            $sql = "INSERT INTO pending_users (Name, Email, IdentityCard, UserType, SchoolId, IsActive, ExpirationDate) 
                    VALUES (?, ?, ?, 'teacher', ?, 1, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Hiba a tanár prepare()-ben: " . $conn->error);
            }
            $stmt->bind_param("sssis", $teacher["name"], $teacher["email"], $teacher["identity_card"], $schoolId, $teacher["expiration_date"]);
            if (!$stmt->execute()) {
                die("Hiba tanár beszúrásakor: " . $stmt->error);
            }
        }
    }

    $_SESSION["alert"] = ["type" => "success", "message" => "Adatok sikeresen beküldve az admin jóváhagyására!"];
    header("Location: /Horizon/pages/schools/uploadST.php");
    exit();
}
?>