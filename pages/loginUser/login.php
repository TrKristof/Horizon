<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/scripts/style/login.css">
    <title>Horizon</title>
</head>
<body>
    <div class="container">
        <!--A form mőgé majd a logónkat háttérképnek-->
        <img src="/assets/imgs/" alt="Háttérkép" title="Horizon" class="BackgroundLogo">
        <div class="loginSurface">
            <h1>Bejelentkezés</h1>
            <form method="POST">
            <div class="form-group">
                <label class="username">Felhasználónév:</label>
                <input type="text" id="userName" name="userName" required>
            </div>
            <div class="form-group">
                <label class="password">Jelszó:</label>
                <input type="password" id="userPassword" name="userPassword" required>
            </div>
            <div class="form-group">
                <button type="submit" class="loginBtn">Bejelentkezés</button>
                <a class="forgotP" href="/pages/loginUser/resetPassword.php">Elfelejtett jelszó?</a>
                <a class="register" href="/pages/loginUser/register.php">Regisztrálj</a>
            </div>
        </form>
        </div>
    </div>

    <script src="/scripts/src/login.js"></script>
</body>
</html>