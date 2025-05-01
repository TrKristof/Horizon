<?php
session_start();
require "/xampp/htdocs/Horizon/database/db.php";

$schoolId = $_POST["school_id"] ?? null;
$action = $_POST["action"] ?? "";

if (!$schoolId || !in_array($action, ["accept", "reject"])) {
    header("Location: /Horizon/views/schoolsAdmin.php");
    exit;
}

//elfogadás/elutasítás
if ($action === "accept") {
    $stmt = $pdo->prepare("UPDATE schools SET status = 'accepted' WHERE id = ?");
    $stmt->execute([$schoolId]);
} elseif ($action === "reject") {
    $stmt = $pdo->prepare("UPDATE schools SET status = 'rejected' WHERE id = ?");
    $stmt->execute([$schoolId]);
}

header("Location: /Horizon/views/schoolsAdmin.php");
exit;