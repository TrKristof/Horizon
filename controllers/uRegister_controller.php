<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

function validatePassword($password) {
    $hasUpperCase = preg_match('/[A-Z]/', $password);
    $hasLowerCase = preg_match('/[a-z]/', $password);
    $hasNumber = preg_match('/[0-9]/', $password);
    $isProperLength = strlen($password) >= 8;

    return $hasUpperCase && $hasLowerCase && $hasNumber && $isProperLength;
}

$errors = [];
$success = "";
$formData = [
    "name" => $_POST["name"] ?? "",
    "email" => $_POST["email"] ?? "",
    "studentNumber" => $_POST["studentNumber"] ?? "",
    "school" => $_POST["school"] ?? ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $studentNumber = $_POST["studentNumber"];
    $passwordConf = $_POST["passwordCheck"];
    $school_id = $_POST["school"];

    if ($password !== $passwordConf) {
        $errors[] = "Nem egyeznek a jelszavak.";
    }

    if (!validatePassword($password)) {
        $errors[] = "A jelszónak legalább 8 karakternek kell lennie, tartalmaznia kell egy kis és nagy betűt és egy számot.";
    }

    // Van e ilyen diák szám
    $sql = "SELECT * FROM students WHERE StudentCard = ? AND SchoolId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $studentNumber, $school_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $errors[] = "Nem jó diákigazolvány szám vagy rossz iskolát választottál.";
    }

    //Regisztráltak e már = van e már adat a diákszámnál
    $student = $result->fetch_assoc();
    if (!empty($student["Email"])) {
        $errors[] = "Ez a diákigazolvány szám már regisztrálva van.";
    }

    // Van e ilyen email
    $sql = "SELECT * FROM students WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Van már ilyen email cím.";
    }

    if (empty($errors)) {
        // Jelszó hashelése és feltöltés
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $now = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("UPDATE students SET Name = ?, Email = ?, Password = ?, IsActive = 1, Date = ? WHERE StudentCard = ? AND SchoolId = ?");
        $stmt->bind_param("sssiii", $name, $email, $hashedPassword, $now, $studentNumber, $school_id);

        if ($stmt->execute()) {
            $success = "Sikeres regisztráció! Jelentkezz be.";
            $formData = [];
        } else {
            $errors[] = "Hiba történt a regisztráció során. Próbáld újra.";
        }
    }
    

    $_SESSION["register_errors"] = $errors;
    $_SESSION["register_success"] = $success;
    $_SESSION["register_form"] = $formData;

    // Visszairányítás az űrlapra (ahelyett, hogy ott lenne a logika)
    header("Location: /Horizon/pages/user/register.php");
    exit();
}