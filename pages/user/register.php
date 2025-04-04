<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

// Iskolák listájának lekérése az adatbázisból
$sql = "SELECT id, name FROM school WHERE isValid = 1";
$result = $connection->query($sql);
$schools = $result->fetch_all(MYSQLI_ASSOC);

// Fejléc megjelenítése
require "/xampp/htdocs/Horizon/views/header.php";
?>

<!-- Regisztrációs űrlap -->
<img src="/Horizon/assets/imgs/Logo_Text_svg" alt="Háttérkép" title="Horizon" class="backgroundLogo col-5">
<div class="loginSurface col-5">
    <h1>Regisztráció</h1>
    <form action="/Horizon/controllers/uRegister_controller.php" method="POST">
        <!-- Név mező -->
        <div class="form-group mb-3">
            <label>Név</label>
            <br>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- E-mail mező -->
        <div class="form-group mb-3">
            <label>E-mail</label>
            <br>
            <input type="email" id="email" name="email" required>
        </div>

        <!-- Jelszó mező -->
        <div class="form-group mb-3">
            <label>Jelszó</label>
            <br>
            <input type="password" id="password" name="password" required>
        </div>

        <!-- Jelszó megerősítés mező -->
        <div class="form-group mb-3">
            <label>Jelszó mégegyszer</label>
            <br>
            <input type="password" id="passwordCheck" name="passwordCheck" required>
        </div>

        <!-- Diákigazolvány szám mező -->
        <div class="form-group mb-3">
            <label>Diákigazolvány szám</label>
            <br>
            <input type="number" id="studentNumber" name="studentNumber" required>
        </div>

        <!-- Iskola kiválasztása -->
        <div class="form-group mb-3">
            <label>Iskolák</label>
            <br>
            <select id="school" name="school" required>
                <?php foreach ($schools as $school): ?>
                    <option value="<?php echo $school["id"]; ?>"><?php echo $school["name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Regisztráció gomb -->
        <div class="form-group mb-3">
            <button type="submit" class="formBtn">Regisztrálás</button>
        </div>
    </form>
</div>

<!-- Lábjegyzet -->
<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>
