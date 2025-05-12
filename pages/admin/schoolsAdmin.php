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
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schools as $school): ?>
                    <tr data-id="<?= $school['Id'] ?>">
                        <td><?= htmlspecialchars($school["Name"]) ?></td>
                        <td><?= htmlspecialchars($school["Email"]) ?></td>
                        <td><?= htmlspecialchars($school["Country"]) ?></td>
                        <td><?= htmlspecialchars($school["Address"]) ?></td>
                        <td>
                            <button class="btn btn-success btn-sm action-button" data-action="accept" data-id="<?= $school["Id"] ?>">Elfogad</button>
                            <button class="btn btn-danger btn-sm action-button" data-action="reject" data-id="<?= $school["Id"] ?>">Elutasít</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultModalLabel">Visszajelzés</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
      </div>
      <div class="modal-body" id="resultModalBody">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".action-button").click(function(){
        var schoolId = $(this).data("id");
        var action = $(this).data("action");

        $.post("/Horizon/controllers/schoolApprove_ajax.php", 
        { school_id: schoolId, action: action }, 
        function(response){
            $("#resultModalBody").text(response.message);
            $("#resultModal").modal("show");
        }, "json")
        .fail(function(){
            $("#resultModalBody").text("Hiba történt a kérés feldolgozásakor.");
            $("#resultModal").modal("show");
        });
    });
});
</script>

<?php require "/xampp/htdocs/Horizon/views/footer.php"; ?>