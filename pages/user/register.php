<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

$pageStylesheet = "/Horizon/scripts/style/login.css";

// Iskolák listájának lekérése az adatbázisból
$sql = "SELECT Id, Name FROM schools WHERE IsActive = 1";
$result = $conn->query($sql);
$schools = $result->fetch_all(MYSQLI_ASSOC);

// Hibák/siker/form mezők betöltése session-ből
$errors = $_SESSION["register_errors"] ?? [];
$success = $_SESSION["register_success"] ?? "";
$formData = $_SESSION["register_form"] ?? ["name" => "", "email" => "", "studentNumber" => "", "school" => ""];

// ujratöltés után ne maradjanak ott
unset($_SESSION["register_errors"], $_SESSION["register_success"], $_SESSION["register_form"]);

// Fejléc megjelenítése
require "/xampp/htdocs/Horizon/views/header.php";
?>

<div class="container">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <!-- Regisztrációs űrlap -->
    <img src="/Horizon/assets/imgs/Transparent_Logo_text.png" alt="Háttérkép" title="Horizon" class="backgroundLogo col-5">
    <div class="col-2"></div>
    <div class="loginSurface col-5">
        <h1>Regisztráció</h1>
        <form action="/Horizon/controllers/uRegister_controller.php" method="POST">
            <div class="form-group mb-3">
                <label>Név</label>
                <br>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($formData["name"]) ?>" required>
            </div>
            <div class="form-group mb-3">
                <label>E-mail</label>
                <br>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData["email"]) ?>" required>
            </div>
            <div class="form-group mb-3">
                <label>Jelszó</label>
                <br>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group mb-3">
                <label>Jelszó mégegyszer</label>
                <br>
                <input type="password" id="passwordCheck" name="passwordCheck" required>
            </div>
            <div class="form-group mb-3">
                <label>Diákigazolvány szám</label>
                <br>
                <input type="number" id="studentNumber" name="studentNumber" value="<?= htmlspecialchars($formData["studentNumber"]) ?>" required>
            </div>

            <!-- Iskola kiválasztása -->
            <div class="form-group mb-3">
                <label>Iskolák</label>
                <br>
                <select id="school" name="school" required>
                    <?php foreach ($schools as $school): ?>
                        <option value="<?php echo $school["Id"]; ?>"><?php echo $school["Name"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="formBtn">Regisztrálás</button>
            </div>
        </form>
    </div>
</div>

<!-- Lábjegyzet -->
<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>
