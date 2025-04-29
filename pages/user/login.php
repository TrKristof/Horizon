<?php
// Fejléc betöltése
$pageStylesheet = "/Horizon/scripts/style/login.css";
require "/xampp/htdocs/Horizon/views/header.php";

// Hibaüzenetek megjelenítése (ha van)
if (isset($_SESSION["alert"])): ?>
    <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
        <?php echo $_SESSION["alert"]["message"]; ?>
    </div>
    <?php unset($_SESSION["alert"]); ?>
<?php endif; ?>

<div class="container">
    <!-- Bejelentkezési űrlap -->
    <img src="/Horizon/assets/imgs/Transparent_Logo_text.png" alt="Háttérkép" title="Horizon" class="backgroundLogo col-5">
    <div class="col-2"></div>
    <div class="loginSurface col-5">
        <h1>Bejelentkezés</h1>
        <form action="/Horizon/controllers/uLogin_controller.php" method="POST">
            <div class="form-group mb-2">
                <label>E-mail:</label>
                <br>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group mb-3">
                <label>Jelszó:</label>
                <br>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group mb-4">
                <button type="submit" class="formBtn">Bejelentkezés</button>
            </div>
        </form>
        <div class="mb-3">
            <a class="register" href="/Horizon/pages/user/register.php">Regisztrálj</a>
            <br>
            <a class="forgotP" href="/Horizon/pages/user/resetPassword.php">Elfelejtetted a jelszót?</a>
        </div>
    </div>
</div>

<!-- Lábjegyzet -->
<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>
