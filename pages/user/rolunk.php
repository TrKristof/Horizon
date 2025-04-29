<?php
$pageStylesheet = '../style/styles.css';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rólunk – Horizon</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($pageStylesheet); ?>">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <h1>Horizon</h1>
            <nav>
                <a href="../index.html"><button>Főoldal</button></a>
                <a href="rolunk.php"><button>Rólunk</button></a>
                <a href="kapcsolat.php"><button>Kapcsolat</button></a>
            </nav>
        </div>
    </header>

    <main>
        <section class="content-box" style="max-width: 800px; background-color: rgb(0,32,69); border-radius: 15px; padding: 30px;">
            <h2>Rólunk</h2>
            <p>
                A <strong>Horizon</strong> célja, hogy a digitális oktatás élményét modern, átlátható és hatékony módon tegye elérhetővé minden tanuló és tanár számára.
                Platformunk lehetőséget ad az osztályok kezelésére, feladatok kiosztására, és a tanulói adatok nyomon követésére, mindezt egy felhasználóbarát felületen keresztül.
            </p>
            <p>
                Hiszünk benne, hogy az oktatásnak követnie kell a technológiai fejlődést – a Horizon ebben nyújt segítséget. A rendszerünk mögött egy elhivatott csapat áll, akik elkötelezettek a tanulás jövője iránt.
            </p>
            <p>
                Köszönjük, hogy minket választottál!
            </p>
        </section>
    </main>

    <footer>
        &copy; <?php echo date('Y'); ?> Horizon – Minden jog fenntartva.
    </footer>
</body>
</html>
