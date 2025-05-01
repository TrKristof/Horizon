<?php
session_start();
require "/xampp/htdocs/Horizon/db/connection.php";

$errors = [];
$formData = [
    "name" => trim($_POST["name"] ?? ""),
    "country" => trim($_POST["country"] ?? ""),
    "address" => trim($_POST["address"] ?? ""),
    "email" => trim($_POST["email"] ?? ""),
    "message" => trim($_POST["message"] ?? "")
];

// Ellenőrzések
if ($formData["name"] === "") {
    $errors[] = "Az iskola neve kötelező.";
}

if ($formData["country"] === "") {
    $errors[] = "Az ország megadása kötelező.";
}

if ($formData["address"] === "") {
    $errors[] = "A cím megadása kötelező.";
}

if ($formData["email"] === "") {
    $errors[] = "Az email cím kötelező.";
} elseif (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Érvénytelen email formátum.";
}

if (strlen($formData["message"]) > 250) {
    $errors[] = "Az üzenet legfeljebb 250 karakter lehet.";
}

// Hiba esetén vissza
if (!empty($errors)) {
    $_SESSION["school_register_errors"] = $errors;
    $_SESSION["school_register_form"] = $formData;
    header("Location: /Horizon/views/schoolRegister.php");
    exit;
}

// Ellenőrizzük, létezik-e már ilyen email
$stmt = $pdo->prepare("SELECT id FROM schools WHERE email = ?");
$stmt->execute([$formData["email"]]);
if ($stmt->fetch()) {
    $_SESSION["school_register_errors"] = ["Ez az email cím már regisztrálva van."];
    $_SESSION["school_register_form"] = $formData;
    header("Location: /Horizon/views/schoolRegister.php");
    exit;
}

// Mentés adatbázisba, pending státusszal
$stmt = $pdo->prepare("INSERT INTO schools (name, country, address, email, message, status) VALUES (?, ?, ?, ?, ?, 'pending')");
$stmt->execute([
    $formData["name"],
    $formData["country"],
    $formData["address"],
    $formData["email"],
    $formData["message"]
]);

$_SESSION["school_register_success"] = "Sikeres regisztráció! Az admin hamarosan átnézi az adatokat.";
header("Location: /Horizon/views/schoolRegister.php");
exit;