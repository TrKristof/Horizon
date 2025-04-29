<?php
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "admin") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $reason = trim($_POST["reason"]);

    // Frissítjük a státuszt elutasítottra, megadva az okot
    $sql = "UPDATE pending_users SET Status = 'rejected', RejectReason = ? WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reason, $id);
    $stmt->execute();

    $_SESSION["alert"] = ["type" => "success", "message" => "Felhasználó elutasítva üzenettel."];
    header("Location: /Horizon/pages/admin/approvePending.php");
    exit();
}