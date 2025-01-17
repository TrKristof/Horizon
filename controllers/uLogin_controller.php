<?php
session_start();
require_once "../database/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // van e ilyen felhasználó az adatbázisban
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: /Horizon/pages/user/dashboard.php");
        } else {
            $_SESSION["alert"] = ["type" => "danger", "message" => "Invalid password."];
            header("Location: /Horizon/pages/user/login.php");
        }
    } else {
        $_SESSION["alert"] = ["type" => "danger", "message" => "No user found with that email."];
        header("Location: /Horizon/pages/user/login.php");
    }
    $stmt->close();
}