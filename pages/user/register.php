<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

$sql = "SELECT id, name FROM schools WHERE isValid = 1";
$result = $connection->query($sql);
$schools = $result->fetch_all(MYSQLI_ASSOC);

require "/xampp/htdocs/Horizon/views/header.php";
?>

            <img src="/Horizon/assets/imgs/logo1-test.webp" alt="Háttérkép" title="Horizon" class="backgroundLogo col-5">
            <div class="loginSurface col-5">
                <h1>Bejelentkezés</h1>
                <form action="/Horizon/controllers/uRegister_controller.php" method="POST">
                    <div class="form-group mb-3">
                        <label>Név</label>
                        <br>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>E-mail</label>
                        <br>
                        <input type="email" id="email" name="email" required>
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
                        <input type="number" id="studentNumber" name="studentNumber" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Iskolák</label>
                        <br>
                        <select id="school" name="school" required>
                            <?php foreach ($schools as $school): ?>
                                <option value="<?php echo $school["id"]; ?>"><?php echo $school["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="formBtn">Regisztrálás</button>
                    </div>
                </form>
            </div>

<?php require "/xampp/htdocs/Horizon/views/footer.php" ?>