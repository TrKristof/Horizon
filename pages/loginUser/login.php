<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../scripts/style/login.css">
    <title>Horizon</title>
</head>
<body>
    <div class="container col-12">
        <!--A form mőgé majd a logónkat háttérképnek-->
        <img src="../../assets/imgs/logo1-test.webp" alt="Háttérkép" title="Horizon" class="backgroundLogo col-5">
        <div class="loginSurface col-5">
            <h1>Bejelentkezés</h1>
            <form method="POST">
                <div class="form-group">
                    <label class="username">Felhasználónév:</label>
                    <br>
                    <input type="text" id="userName" name="userName" required>
                </div>
                <div class="form-group">
                    <label class="password">Jelszó:</label>
                    <br>
                    <input type="password" id="userPassword" name="userPassword" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="loginBtn">Bejelentkezés</button>
                    <br>
                    <button class="register" href="/pages/loginUser/register.php">Regisztrálj</button>
                    <br>
                    <a class="forgotP" href="/pages/loginUser/resetPassword.php">Elfelejtett jelszó?</a>
                </div>
            </form>
        </div>
    </div>

    <script src="/scripts/src/login.js"></script>
</body>
</html>