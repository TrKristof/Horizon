<?php
require "/xampp/htdocs/Horizon/views/header.php";

// Ellenőrzés: csak iskola
// if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "school") {
//     header("Location: /Horizon/pages/user/login.php");
//     exit();
// }  
?>

<div class="container mt-4">
    <h2>Új Diákok és Tanárok Feltöltése</h2>

    <!-- Gombok -->
    <div class="mb-4">
        <button class="btn btn-primary" id="addStudentBtn">Diák hozzáadása</button>
        <button class="btn btn-secondary" id="addTeacherBtn">Tanár hozzáadása</button>
    </div>

    <form action="/Horizon/controllers/uploadStudentsTeachers.php" method="POST" id="uploadForm">
        <div id="studentsSection"></div>
        <div id="teachersSection"></div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Mentés és Beküldés</button>
        </div>
    </form>
</div>

<script>
let studentCount = 0;
let teacherCount = 0;

document.getElementById('addStudentBtn').addEventListener('click', () => {
    studentCount++;
    const studentForm = `
        <div class="card mt-3 p-3">
            <h5>Diák ${studentCount}</h5>
            <div class="row">
                <div class="col">
                    <label>Név</label>
                    <input type="text" class="form-control" name="students[${studentCount}][name]" required>
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" name="students[${studentCount}][email]" required>
                </div>
                <div class="col">
                    <label>Diákigazolvány</label>
                    <input type="text" class="form-control" name="students[${studentCount}][student_card]" required>
                </div>
                <div class="col">
                    <label>Lejárati Dátum</label>
                    <input type="date" class="form-control" name="students[${studentCount}][expiration_date]" required>
                </div>
            </div>
        </div>`;
    document.getElementById('studentsSection').insertAdjacentHTML('beforeend', studentForm);
});

document.getElementById('addTeacherBtn').addEventListener('click', () => {
    teacherCount++;
    const teacherForm = `
        <div class="card mt-3 p-3">
            <h5>Tanár ${teacherCount}</h5>
            <div class="row">
                <div class="col">
                    <label>Név</label>
                    <input type="text" class="form-control" name="teachers[${teacherCount}][name]" required>
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" name="teachers[${teacherCount}][email]" required>
                </div>
                <div class="col">
                    <label>Személyi Igazolvány</label>
                    <input type="text" class="form-control" name="teachers[${teacherCount}][identity_card]" required>
                </div>
                <div class="col">
                    <label>Lejárati Dátum</label>
                    <input type="date" class="form-control" name="teachers[${teacherCount}][expiration_date]" required>
                </div>
            </div>
        </div>`;
    document.getElementById('teachersSection').insertAdjacentHTML('beforeend', teacherForm);
});
</script>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>