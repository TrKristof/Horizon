<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

$pageStylesheet = "/Horizon/scripts/style/adminPage.css";

include_once '/Horizon/views/navbar.php';

//admin e
/*if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "admin") {
    header("Location: /Horizon/pages/user/login.php");
    exit();
}*/

require "/xampp/htdocs/Horizon/views/header.php";
?>

<div class="container my-5">
    <h1 class="mb-3">Iskolák kezelése</h1>

    <!-- Keresőmező -->
    <input type="text" id="searchInput" class="form-control mb-4" placeholder="Iskola keresése...">

    <!-- Kártyák görgethető részen -->
    <div id="scrollableCards">
        <div class="row gy-4 justify-content-center" id="schoolCards">
            <?php
            $sql = "SELECT Id, Name, Email, ExpirationDate FROM schools";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()): 
                    $schoolId = $row["Id"];

                    // Diákok
                    $studentCountResult = $conn->query("SELECT COUNT(*) AS count FROM students WHERE SchoolId = $schoolId");
                    $studentCount = ($studentCountResult && $studentCountResult->num_rows > 0) ? $studentCountResult->fetch_assoc()['count'] : 0;

                    // Tanárok
                    $teacherCountResult = $conn->query("SELECT COUNT(*) AS count FROM teachers WHERE SchoolId = $schoolId");
                    $teacherCount = ($teacherCountResult && $teacherCountResult->num_rows > 0) ? $teacherCountResult->fetch_assoc()['count'] : 0;
                    
                    // Szín logika
                    $expirationDate = new DateTime($row["ExpirationDate"]);
                    $now = new DateTime();
                    $interval = $now->diff($expirationDate);
                    $daysLeft = (int)$interval->format('%r%a');

                    if ($daysLeft <= 365) {
                        $expirationColor = "text-danger";
                    } elseif ($daysLeft <= 1095) {
                        $expirationColor = "text-warning"; 
                    } else {
                        $expirationColor = "text-success";
                    }
                ?>
                    <div class="col-md-3 school-card text-center" data-name="<?= strtolower($row["Name"]) ?>" data-id="<?= $row["Id"] ?>">
                        <a href="school_details.php?id=<?= $row["Id"] ?>" style="text-decoration: none; color: inherit;">
                            <div class="card h-100 shadow-sm p-3 school-card-click" style="cursor:pointer;">
                                <h5 class="card-title"><?= $row["Name"] ?></h5>
                                <p class="card-text"><?= $row["Email"] ?></p>
                                <p class="card-text">
                                    Tanárok: <?= $teacherCount ?> <br>
                                    Diákok: <?= $studentCount ?>
                                </p>
                                <p class="card-text <?= $expirationColor ?>"><small>Lejárat: <?= $row["ExpirationDate"] ?></small></p>
                            </div>
                        </a>
                    </div>
                <?php endwhile;
            endif;
            ?>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.school-card-click').forEach(card => {
    card.addEventListener('click', function () {
        const parent = this.closest('.school-card');
        const schoolId = parent.dataset.id;
        const schoolName = parent.querySelector('.card-title').textContent;

        fetch(`/Horizon/controllers/getSchoolDetails.php?id=${schoolId}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('schoolName').textContent = schoolName;

                // Tanárok
                const teachers = data.teachers.map(t => `<div>${t.Name}</div>`).join('');
                document.getElementById('teacherList').innerHTML = teachers;

                // Diákok
                const students = data.students.map(s => `<div>${s.Name}</div>`).join('');
                document.getElementById('studentList').innerHTML = students;

                document.getElementById('schoolDetails').style.display = 'block';
                window.scrollTo({ top: document.getElementById('schoolDetails').offsetTop, behavior: 'smooth' });
            })
            .catch(err => console.error('Hiba a fetch során:', err));
    });
});

// Keresés
document.getElementById('searchInput').addEventListener('input', function () {
    const val = this.value.toLowerCase();
    document.querySelectorAll('.school-card').forEach(card => {
        const name = card.dataset.name;
        card.style.display = name.includes(val) ? 'block' : 'none';
    });
});
</script>

<?php require_once "/xampp/htdocs/Horizon/views/footer.php"; ?>
