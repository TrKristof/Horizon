<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

// Ellenőrizzük, hogy van-e POST kérés
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    
    // Ellenőrizzük, hogy az email szerepel-e a felhasználók között
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Felhasználó megtalálva, token generálása
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50)); // Generáljunk egy random token-t

        // Tároljuk a token-t az adatbázisban
        $expiry_time = date("Y-m-d H:i:s", strtotime("+1 hour")); // A token 1 órán belül lejár
        $sql = "INSERT INTO password_resets (email, token, expiry_time) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $email, $token, $expiry_time);
        $stmt->execute();

        // Jelszó-visszaállító link generálása
        $reset_link = "http://localhost/Horizon/pages/user/resetPasswordForm.php?token=" . $token;

        // E-mail küldése
        $subject = "Jelszó visszaállítása";
        $message = "Kedves felhasználó!\n\nA jelszavad visszaállításához kattints az alábbi linkre:\n" . $reset_link . "\n\nA link 1 órán belül érvényes.";
        $headers = "From: no-reply@horizon.com";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION["alert"] = [
                "type" => "success",
                "message" => "A jelszó-visszaállítási linket elküldtük a megadott e-mail címre."
            ];
        } else {
            $_SESSION["alert"] = [
                "type" => "danger",
                "message" => "Hiba történt az e-mail küldésekor."
            ];
        }
    } else {
        // Ha nem található a felhasználó
        $_SESSION["alert"] = [
            "type" => "danger",
            "message" => "Az e-mail cím nem található."
        ];
    }

    // Átirányítás a reset jelszó oldalra
    header("Location: /Horizon/pages/user/resetPassword.php");
    exit();
}
?>
