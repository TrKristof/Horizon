<?php
session_start();
require_once "/xampp/htdocs/Horizon/database/db.php";

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($email) || empty($password)) {
    $_SESSION["alert"] = ["type" => "danger", "message" => "Hiányzó adatok!"];
    header("Location: /Horizon/pages/user/login.php");
    exit;
}

//van-e ilyen email
$tables = [
    "students" => "StudentId",
    "teachers" => "TeacherId",
    "schools"  => "SchoolId",
    "admins"   => "AdminId"
];

foreach ($tables as $table => $idField) {
    $stmt = $conn->prepare("SELECT Id, Name, Email, Password FROM $table WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($userRow = $result->fetch_assoc()) {
        //jelszó ell
        if (!password_verify($password, $userRow["Password"])) {
            $_SESSION["alert"] = ["type" => "danger", "message" => "Hibás jelszó!"];
            header("Location: /Horizon/pages/user/login.php");
            exit;
        }

        //user azonosító és típusa
        $linkedId = $userRow["Id"];
        $userType = rtrim($table, "s");

        //lekérjük a hozzá tartozó users rekordot
        $stmt2 = $conn->prepare("SELECT Id FROM users WHERE UserType = ? AND LinkedId = ?");
        $stmt2->bind_param("si", $userType, $linkedId);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($user = $result2->fetch_assoc()) {
            $_SESSION["user_id"] = $user["Id"];
            $_SESSION["user_type"] = $userType;

            //átírányitás
            switch ($userType) {
                case "admin":
                    header("Location: /Horizon/pages/admin/admin.php");
                    break;
                case "school":
                    header("Location: /Horizon/pages/school/schoolsMain.php");
                    break;
                case "teacher":
                    header("Location: /Horizon/pages/teacher/teacherMain.php");
                    break;
                case "student":
                    header("Location: /Horizon/pages/student/studentMain.php");
                    break;
                default:
                    $_SESSION["alert"] = ["type" => "danger", "message" => "Ismeretlen felhasználói típus!"];
                    header("Location: /Horizon/pages/user/login.php");
                    break;
            }

            exit;
        } else {
            $_SESSION["alert"] = ["type" => "danger", "message" => "Nem található a felhasználó a rendszerben."];
            header("Location: /Horizon/pages/user/login.php");
            exit;
        }
    }
}

//ha nem lehet találni
$_SESSION["alert"] = ["type" => "danger", "message" => "Nincs ilyen e-mail cím a rendszerben!"];
header("Location: /Horizon/pages/user/login.php");
exit;