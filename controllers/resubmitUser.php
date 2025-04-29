<?php
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "school") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $studentCard = isset($_POST["student_card"]) ? trim($_POST["student_card"]) : null;

    $fileName = null;
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], "/xampp/htdocs/Horizon/uploads/" . $fileName);
    }

    $sql = "UPDATE pending_users SET 
                Name = ?, 
                Email = ?, 
                StudentCard = ?, 
                File = IFNULL(?, File),
                Status = 'pending',
                RejectReason = NULL
            WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $studentCard, $fileName, $id);
    $stmt->execute();

    $_SESSION["alert"] = ["type" => "success", "message" => "Sikeresen újraküldve az adminnak ellenőrzésre!"];
    header("Location: /Horizon/pages/schools/requests.php");
    exit();
}