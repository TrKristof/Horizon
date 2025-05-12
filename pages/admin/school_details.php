<?php
require_once "/xampp/htdocs/Horizon/database/db.php";
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

<div class="container my-5" style="max-width: 1200px;">
    <h2 class="mb-4 text-primary fw-bold"><?= htmlspecialchars($school['Name']) ?> - Részletek</h2>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-secondary fw-bold">Iskola adatai</h5>
            <p class="card-text mb-2"><strong>Email:</strong> <?= htmlspecialchars($school['Email']) ?></p>
            <p class="card-text"><strong>Lejárat:</strong> <?= htmlspecialchars($school['ExpirationDate']) ?></p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Tanárok -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">
                    Tanárok
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($teachers->num_rows > 0): ?>
                        <?php while ($teacher = $teachers->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <h6 class="fw-bold"><?= htmlspecialchars($teacher['Name']) ?></h6>
                                <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($teacher['Email']) ?></p>
                                <p class="mb-1"><strong>Személyi igazolvány:</strong> <?= htmlspecialchars($teacher['IdentityCard'] ?? 'N/A') ?></p>
                                <p class="mb-0"><strong>Lejárat:</strong> <?= htmlspecialchars($teacher['ExpirationDate'] ?? 'N/A') ?></p>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li class="list-group-item">Nincs tanár.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Diákok -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">
                    Diákok
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($students->num_rows > 0): ?>
                        <?php while ($student = $students->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <h6 class="fw-bold"><?= htmlspecialchars($student['Name']) ?></h6>
                                <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($student['Email']) ?></p>
                                <p class="mb-1"><strong>Diákkártya:</strong> <?= htmlspecialchars($student['StudentCard'] ?? 'N/A') ?></p>
                                <p class="mb-0"><strong>Lejárat:</strong> <?= htmlspecialchars($student['ExpirationDate'] ?? 'N/A') ?></p>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li class="list-group-item">Nincs diák.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>