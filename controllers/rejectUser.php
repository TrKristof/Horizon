<?php
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    // Frissítjük a Status mezőt rejected-re
    $sql = "UPDATE pending_users SET Status = 'rejected' WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $_SESSION["alert"] = ["type" => "warning", "message" => "Felhasználó elutasítva."];
} else {
    $_SESSION["alert"] = ["type" => "danger", "message" => "Hiányzó ID paraméter."];
}

header("Location: /Horizon/pages/admin/approvePending.php");
exit();