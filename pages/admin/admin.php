<?php
session_start();
require_once "/xampp/htdocs/Horizon/database/db.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require "/xampp/htdocs/Horizon/views/header.php";
?>

    <div id="sidebar">
        <h3>Admin Panel</h3>
        <button class="btn btn-light" onclick="loadContent('schools')">Iskolák</button>
        <button class="btn btn-light" onclick="loadContent('teachers')">Tanárok</button>
        <button class="btn btn-light" onclick="loadContent('students')">Diákok</button>
    </div>

    <!--Itt jelennek meg az adatok-->
    <div id="content">
        <img id="logo" src="/Horizon/assets/imgs/Logo.svg">

    </div>

    <script>
        function loadContent(type) {
            $.ajax({
                url: "admin_controller.php",
                type: "GET",
                data: { type: type },
                success: function(response) {
                    $("#content").html(response);
                }
            });
        }
    </script>

<?php require_once "/xampp/htdocs/Horizon/views/footer.php";?>
