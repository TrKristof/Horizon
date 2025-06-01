<?php
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    // Lekérjük a pending_users-eket
    $sql = "SELECT * FROM pending_users WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $_SESSION["alert"] = ["type" => "danger", "message" => "Felhasználó nem található."];
        header("Location: /Horizon/pages/admin/managePendingUsers.php");
        exit();
    }
    $user = $result->fetch_assoc();

    // Frissítjük a Status mezőt approved-ra
    $updateSql = "UPDATE pending_users SET Status = 'approved' WHERE Id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $id);
    $updateStmt->execute();

    // Áthelyezés a végleges táblába
    $emptyPassword = ''; // Üres jelszó egyenlőre

    if ($user["UserType"] === "student") {
        $insertSql = "INSERT INTO students (SchoolId, Name, Email, Password, StudentCard, Date, IsActive, ExpirationDate, UserType) VALUES (?, ?, ?, ?, ?, NOW(), 1, ?, 'student')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("isssis", $user["SchoolId"], $user["Name"], $user["Email"], $emptyPassword, $user["StudentCard"], $user["ExpirationDate"]);
        $insertStmt->execute();
    } elseif ($user["UserType"] === "teacher") {
        $insertSql = "INSERT INTO teachers (SchoolId, Name, Email, Password, IdentityCard, Date, IsActive, ExpirationDate, UserType) VALUES (?, ?, ?, ?, ?, NOW(), 1, ?, 'teacher')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("isssss", $user["SchoolId"], $user["Name"], $user["Email"], $emptyPassword, $user["StudentCard"], $user["ExpirationDate"]);
        $insertStmt->execute();
    }

    $_SESSION["alert"] = ["type" => "success", "message" => "Felhasználó jóváhagyva és áthelyezve."];
} else {
    $_SESSION["alert"] = ["type" => "danger", "message" => "Hiányzó ID paraméter."];
}

header("Location: /Horizon/pages/admin/approvePending.php");
exit();