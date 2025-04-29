<?php
session_start();

// Ha nincs belépve
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: /Horizon/pages/user/login.php");
    exit;
}

// jogosult e az oldalhoz
function requireRole($roles) {
    session_start();
    if (!isset($_SESSION['user_type']) || !in_array($_SESSION['user_type'], $roles)) {
        header("Location: /Horizon/pages/user/login.php");
        exit();
    }
}