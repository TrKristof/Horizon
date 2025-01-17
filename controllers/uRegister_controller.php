<?php
session_start();
require_once "/xampp/htdocs/Horizon/database/db.php";

function validatePassword($password) {
    $hasUpperCase = preg_match('/[A-Z]/', $password);
    $hasLowerCase = preg_match('/[a-z]/', $password);
    $hasNumber = preg_match('/[0-9]/', $password);
    $isProperLength = strlen($password) >= 8;

    return $hasUpperCase && $hasLowerCase && $hasNumber && $isProperLength;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $studentNumber = $_POST["studentNumber"];
    $school_id = $_POST["school"];
    $passwordConf = $_POST["passwordCheck"];

    if ($password !== $passwordConf) {
        $_SESSION["alert"] = ["type" => "danger", "message" => "Passwords do not match."];
        header("Location: /Horizon/pages/user/register.php");
        exit();
    }

    if (!validatePassword($password)) {
        $_SESSION["alert"] = ["type" => "danger", "message" => "Password must be at least 8 characters long and include uppercase, lowercase, and a number."];
        header("Location: /Horizon/pages/user/register.php");
        exit();
    }
    
    // MÉG NEM JÓ
    // Van e ilyen diák szám
    $sql = "SELECT * FROM student_numbers WHERE student_number = ? AND school_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $studentNumber, $school_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION["alert"] = ["type" => "danger", "message" => "Invalid student number or not registered with the selected school."];
        header("Location: /Horizon/pages/user/register.php");
        exit();
    }

    // Van e ilyen email
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["alert"] = ["type" => "danger", "message" => "Email is already registered."];
        header("Location: /Horizon/pages/user/register.php");
        exit();
    }

    // Jelszó hashelése és feltöltés
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO students (name, email, password, school_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $hashedPassword, $school_id);

    if ($stmt->execute()) {
        $_SESSION["alert"] = ["type" => "success", "message" => "Registration successful! Please log in."];
        header("Location: /Horizon/pages/user/login.php");
    } else {
        $_SESSION["alert"] = ["type" => "danger", "message" => "Registration failed. Please try again."];
        header("Location: /Horizon/pages/user/register.php");
    }

    $stmt->close();
}