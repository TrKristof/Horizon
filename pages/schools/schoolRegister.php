<?php
$pageStylesheet = "/Horizon/scripts/style/login.css";
require "/xampp/htdocs/Horizon/views/header.php";

// Hibák/siker/form mezők betöltése session-ből
$errors = $_SESSION["school_register_errors"] ?? [];
$success = $_SESSION["school_register_success"] ?? "";
$formData = $_SESSION["school_register_form"] ?? ["name" => "", "country" => "", "address" => "", "email" => "", "message" => ""];

unset($_SESSION["school_register_errors"], $_SESSION["school_register_success"], $_SESSION["school_register_form"]);

// Lista 50 nagyobb országgal
$countries = ["United States", "Canada", "United Kingdom", "Germany", "France", "Italy", "Spain", "Australia", "Brazil", "China",
    "India", "Japan", "Mexico", "Netherlands", "Russia", "South Korea", "Sweden", "Switzerland", "Turkey", "Argentina",
    "Belgium", "Chile", "Colombia", "Czech Republic", "Denmark", "Egypt", "Finland", "Greece", "Hungary", "Indonesia",
    "Ireland", "Israel", "Malaysia", "New Zealand", "Norway", "Peru", "Philippines", "Poland", "Portugal", "Romania",
    "Saudi Arabia", "Singapore", "South Africa", "Thailand", "Ukraine", "United Arab Emirates", "Vietnam", "Austria", "Croatia", "Slovakia"];
?>

<style>
body {
    background-color: #2c3e50;
    min-height: 100vh;
    overflow-x: hidden;
}

.fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 1s forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-wrapper {
    width: 100%;
    background-color: #1c2833;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    color: white;
    transition: max-width 0.3s ease;
}

@media (min-width: 768px) {
    .login-wrapper {
        max-width: 600px;
    }
}

@media (max-width: 767px) {
    .login-wrapper {
        max-width: 90%;
    }
}

.login-wrapper h1 {
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.form-control, .form-select, textarea {
    background-color: #34495e;
    color: white;
    border: none;
    font-size: 1rem;
}

.form-control:focus, .form-select:focus, textarea:focus {
    background-color: #3e5870;
    color: white;
    border: none;
    box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
}

.formBtn {
    background-color: #28a745;
    color: white;
    border: none;
    width: 100%;
    padding: 0.75rem;
    font-size: 1.1rem;
    border-radius: 8px;
}

.formBtn:hover {
    background-color: #218838;
}

.backgroundLogo {
    max-width: 200px;
    margin-bottom: 2rem;
    transition: max-width 0.3s ease;
}

.formBtn {
    background-color: #28a745;
    color: white;
    border: none;
    width: 100%;
    padding: 0.75rem;
    font-size: 1.1rem;
    border-radius: 8px;
    transition: transform 0.1s ease, box-shadow 0.1s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.formBtn:hover {
    background-color: #218838;
}

.formBtn:active {
    transform: scale(0.96);
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

@media (min-width: 768px) {
    .backgroundLogo {
        max-width: 250px;
    }
}
</style>

<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger w-100 mb-3" style="max-width: 600px;">
            <ul class="mb-0">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success w-100 mb-3" style="max-width: 600px;">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <img src="/Horizon/assets/imgs/Transparent_Logo_text.png" alt="Horizon Logo" class="backgroundLogo fade-in">

    <div class="login-wrapper fade-in">
        <h1>Iskola regisztrálás</h1>
        <form action="/Horizon/controllers/schoolRegister_controller.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Iskola neve</label>
                <input type="text" name="name" value="<?= htmlspecialchars($formData["name"]) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ország</label>
                <select name="country" class="form-select" required>
                    <option value="">Válassz országot...</option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?= $country ?>" <?= ($formData["country"] == $country ? "selected" : "") ?>>
                            <?= $country ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Cím</label>
                <input type="text" name="address" value="<?= htmlspecialchars($formData["address"]) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" value="<?= htmlspecialchars($formData["email"]) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mellékelt üzenet (max. 250)</label>
                <textarea name="message" maxlength="250" class="form-control" style="resize: none; height: 100px;"><?= htmlspecialchars($formData["message"]) ?></textarea>
            </div>
            <button type="submit" class="btn formBtn">Regisztráció beküldése</button>
        </form>
    </div>
</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>