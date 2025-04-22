<?php
require_once "/xampp/htdocs/Horizon/database/db.php";

$pageStylesheet = "/xampp/htdocs/Horizon/scripts/style/adminPage.css";

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
                while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-3 school-card text-center" data-name="<?= strtolower($row["Name"]) ?>" data-id="<?= $row["Id"] ?>">
                        <div class="card h-100 shadow-sm p-3 school-card-click" style="cursor:pointer;">
                            <h5 class="card-title"><?= $row["Name"] ?></h5>
                            <p class="card-text"><?= $row["Email"] ?></p>
                            <p class="card-text"><small>Lejárat: <?= $row["ExpirationDate"] ?></small></p>
                        </div>
                    </div>
                <?php endwhile;
            endif;
            ?>
        </div>
    </div>

    <!-- Részletek -->
    <div id="schoolDetails" class="mt-5" style="display:none;">
        <h3 id="schoolName" class="mb-3"></h3>

        <h5>Tanárok</h5>
        <div class="border p-3 mb-4" style="max-height:200px; overflow-y:auto;" id="teacherList"></div>

        <h5>Diákok</h5>
        <div class="border p-3" style="max-height:200px; overflow-y:auto;" id="studentList"></div>
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
