<?php
require "/xampp/htdocs/Horizon/views/header.php";
require "/xampp/htdocs/Horizon/database/db.php";
include_once '/Horizon/views/navbar.php';
session_start();

//iskola e
/*if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "school") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}*/

$schoolId = $_SESSION["school_id"];

//Elutasított diákok/tanárok lekérése
$sql = "SELECT * FROM pending_users WHERE SchoolId = ? AND Status = 'rejected'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $schoolId);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <h2>Elutasított Kérelmek</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card mt-3">
            <div class="card-header bg-danger text-white">
                Admin üzenete: <?= htmlspecialchars($row["RejectReason"]) ?>
            </div>
            <div class="card-body">
                <form action="/Horizon/controllers/resubmitUser.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row["Id"] ?>">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name">Név</label>
                            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row["Name"]) ?>" required>
                        </div>
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row["Email"]) ?>" required>
                        </div>
                    </div>

                    <?php if ($row["UserType"] === "student"): ?>
                        <div class="mb-3">
                            <label for="student_card">Diákigazolvány</label>
                            <input type="text" class="form-control" name="student_card" value="<?= htmlspecialchars($row["StudentCard"]) ?>">
                        </div>
                    <?php endif; ?>

                    <!-- File újratöltésha akarják -->
                    <div class="mb-3">
                        <label for="file">Igazolvány feltöltése (opcionális)</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <button type="submit" class="btn btn-primary">Újraküldés</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>

</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>