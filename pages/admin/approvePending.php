<?php
require "/xampp/htdocs/Horizon/views/header.php";
require "/xampp/htdocs/Horizon/database/db.php";
session_start();

//admin e
/*if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "admin") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}*/

//függő diákok és tanárok lekérése
$sql = "SELECT * FROM pending_users";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h2>Függő Diákok és Tanárok Jóváhagyása</h2>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Név</th>
                <th>Email</th>
                <th>Típus</th>
                <th>Diákigazolvány</th>
                <th>Aktív</th>
                <th>Lejárat</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["Name"]) ?></td>
                    <td><?= htmlspecialchars($row["Email"]) ?></td>
                    <td><?= htmlspecialchars($row["UserType"]) ?></td>
                    <td><?= htmlspecialchars($row["StudentCard"]) ?></td>
                    <td><?= $row["IsActive"] ? "Igen" : "Nem" ?></td>
                    <td><?= htmlspecialchars($row["ExpirationDate"]) ?></td>
                    <td>
                        <a href="/Horizon/controllers/approveUser.php?id=<?= $row["Id"] ?>" class="btn btn-success btn-sm">Elfogadás</a>
                        <a href="/Horizon/controllers/rejectUser.php?id=<?= $row["Id"] ?>" class="btn btn-danger btn-sm">Elutasítás</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>