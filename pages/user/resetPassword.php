<?php
require_once "/xampp/htdocs/Horizon/views/header.php"; // Fejléc megjelenítése
include_once '/Horizon/views/navbar.php';
session_start();
?>

<div class="container mt-5">
    <h1>Elfelejtett jelszó</h1>
    <p>Adja meg az e-mail címét, hogy jelszó-visszaállítási linket küldhessünk!</p>

    <form action="/Horizon/controllers/uResetPassword_controller.php" method="POST">
        <div class="form-group mb-3">
            <label for="email">E-mail cím:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required>
        </div>
        <button type="submit" class="btn btn-primary">Jelszó visszaállítása</button>
    </form>
</div>

<?php require_once "/xampp/htdocs/Horizon/views/footer.php"; // Lábjegyzet megjelenítése ?>
