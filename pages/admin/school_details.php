<?php
require_once "/xampp/htdocs/Horizon/database/db.php";
include_once '/Horizon/views/navbar.php';

//admin e
/*if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "admin") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}*/

require "/xampp/htdocs/Horizon/views/header.php";

if (!isset($_GET['id'])) {
    header("Location: /Horizon/pages/admin/admin.php");
    exit;
}

$schoolId = (int)$_GET['id'];

// Iskola adatok
$schoolSql = "SELECT * FROM schools WHERE Id = ?";
$stmt = $conn->prepare($schoolSql);
$stmt->bind_param("i", $schoolId);
$stmt->execute();
$school = $stmt->get_result()->fetch_assoc();

if (!$school) {
    echo "Iskola nem található!";
    exit;
}

// Diákok
$studentsSql = "SELECT * FROM students WHERE SchoolId = ?";
$stmt = $conn->prepare($studentsSql);
$stmt->bind_param("i", $schoolId);
$stmt->execute();
$students = $stmt->get_result();

// Tanárok
$teachersSql = "SELECT * FROM teachers WHERE SchoolId = ?";
$stmt = $conn->prepare($teachersSql);
$stmt->bind_param("i", $schoolId);
$stmt->execute();
$teachers = $stmt->get_result();
?>

<div class="container my-5">
    <h2><?= htmlspecialchars($school['Name']) ?> - Részletek</h2>
    <p>Email: <?= htmlspecialchars($school['Email']) ?></p>
    <p>Lejárat: <?= htmlspecialchars($school['ExpirationDate']) ?></p>

    <hr>

    <h3>Diákok</h3>
    <div class="list-group" id="studentList">
        <?php while ($student = $students->fetch_assoc()): ?>
            <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#student<?= $student['Id'] ?>" role="button" aria-expanded="false" aria-controls="student<?= $student['Id'] ?>">
                <?= htmlspecialchars($student['Name']) ?>
            </a>
            <div class="collapse" id="student<?= $student['Id'] ?>">
                <div class="card card-body">
                    <p>Email: <?= htmlspecialchars($student['Email']) ?></p>
                    <p>Szül. dátum: <?= htmlspecialchars($student['BirthDate']) ?></p>
                    <p>Telefon: <?= htmlspecialchars($student['Phone']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <h3 class="mt-5">Tanárok</h3>
    <div class="list-group" id="teacherList">
        <?php while ($teacher = $teachers->fetch_assoc()): ?>
            <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#teacher<?= $teacher['Id'] ?>" role="button" aria-expanded="false" aria-controls="teacher<?= $teacher['Id'] ?>">
                <?= htmlspecialchars($teacher['Name']) ?>
            </a>
            <div class="collapse" id="teacher<?= $teacher['Id'] ?>">
                <div class="card card-body">
                    <p>Email: <?= htmlspecialchars($teacher['Email']) ?></p>
                    <p>Telefonszám: <?= htmlspecialchars($teacher['Phone']) ?></p>
                    <p>Beosztás: <?= htmlspecialchars($teacher['Position']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>