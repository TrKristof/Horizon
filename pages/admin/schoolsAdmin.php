<?php
require "/xampp/htdocs/Horizon/database/db.php";
require "/xampp/htdocs/Horizon/views/header.php";

// pending iskolák
$sql = "SELECT * FROM schools WHERE status = 'pending'";
$result = $conn->query($sql);

$schools = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schools[] = $row;
    }
}
?>

<div class="container mt-5">
    <h1>Beérkezett iskola regisztrációk</h1>
    <?php if (empty($schools)): ?>
        <p>Nincs függőben lévő regisztráció.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Iskola neve</th>
                    <th>Email</th>
                    <th>Ország</th>
                    <th>Cím</th>
                    <th>Üzenet</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schools as $school): ?>
                    <tr>
                        <td><?= htmlspecialchars($school["Name"]) ?></td>
                        <td><?= htmlspecialchars($school["Email"]) ?></td>
                        <td><?= htmlspecialchars($school["Country"]) ?></td>
                        <td><?= htmlspecialchars($school["Address"]) ?></td>
                        <td><?= htmlspecialchars($school["message"]) ?></td>
                        <td>
                            <form action="/Horizon/controllers/schoolApprove_controller.php" method="POST" style="display:inline;">
                                <input type="hidden" name="school_id" value="<?= $school["Id"] ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Elfogad</button>
                            </form>
                            <form action="/Horizon/controllers/schoolApprove_controller.php" method="POST" style="display:inline;">
                                <input type="hidden" name="school_id" value="<?= $school["Id"] ?>">
                                <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Elutasít</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>