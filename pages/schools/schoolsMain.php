<?php
require "/xampp/htdocs/Horizon/views/header.php";

//Iskola e
/*if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "school") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}*/

require "/xampp/htdocs/Horizon/database/db.php";

// Iskola 
$schoolId = 1; //$_SESSION["school_id"]; school ID-je a sessionben van

// Diákok
$students_sql = "SELECT Id, Name, Email, StudentCard, Date, IsActive, ExpirationDate FROM students WHERE SchoolId = ?";
$students_stmt = $conn->prepare($students_sql);
$students_stmt->bind_param("i", $schoolId);
$students_stmt->execute();
$students_result = $students_stmt->get_result();

// Tanárok
$teachers_sql = "SELECT Id, Name, Email, Date, IsActive, ExpirationDate FROM teachers WHERE SchoolId = ?";
$teachers_stmt = $conn->prepare($teachers_sql);
$teachers_stmt->bind_param("i", $schoolId);
$teachers_stmt->execute();
$teachers_result = $teachers_stmt->get_result();
?>

<div class="container mt-4">
    <h2 class="mb-4">Iskola Kezelőfelület</h2>

    <div class="mb-5">
        <h3>Diákok</h3>
        <div class="table-responsive" style="max-height:400px; overflow-y:auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Név</th>
                        <th>Email</th>
                        <th>Diákigazolvány</th>
                        <th>Regisztráció Dátuma</th>
                        <th>Aktív</th>
                        <th>Lejárat</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($student = $students_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($student["Name"]) ?></td>
                            <td><?= htmlspecialchars($student["Email"]) ?></td>
                            <td><?= htmlspecialchars($student["StudentCard"]) ?></td>
                            <td><?= htmlspecialchars($student["Date"]) ?></td>
                            <td><?= $student["IsActive"] ? "Igen" : "Nem" ?></td>
                            <td><?= htmlspecialchars($student["ExpirationDate"]) ?></td>
                            <td>
                                <a href="/Horizon/pages/schools/editStudent.php?id=<?= $student["Id"] ?>" class="btn btn-sm btn-primary">Szerkesztés</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-5">
        <h3>Tanárok</h3>
        <div class="table-responsive" style="max-height:400px; overflow-y:auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Név</th>
                        <th>Email</th>
                        <th>Regisztráció Dátuma</th>
                        <th>Aktív</th>
                        <th>Lejárat</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($teacher = $teachers_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($teacher["Name"]) ?></td>
                            <td><?= htmlspecialchars($teacher["Email"]) ?></td>
                            <td><?= htmlspecialchars($teacher["Date"]) ?></td>
                            <td><?= $teacher["IsActive"] ? "Igen" : "Nem" ?></td>
                            <td><?= htmlspecialchars($teacher["ExpirationDate"]) ?></td>
                            <td>
                                <a href="/Horizon/pages/schools/editTeacher.php?id=<?= $teacher["Id"] ?>" class="btn btn-sm btn-primary">Szerkesztés</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-5">
        <h3>Új Diákok/Tanárok Feltöltése</h3>
        <form action="/Horizon/controllers/uploadStudentsTeachers.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="uploadFile" class="form-label">CSV Fájl feltöltése</label>
                <input type="file" name="uploadFile" id="uploadFile" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Feltöltés</button>
        </form>
        <p class="mt-2 text-muted">Csak .csv fájl formátumban (Név, Email, [StudentCard opcionális], Aktív, Lejárat dátuma)</p>
    </div>
</div>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>