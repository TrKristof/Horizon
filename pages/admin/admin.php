<?php
require_once "/xampp/htdocs/Horizon/database/db.php";
session_start();

//megnézni admin-e a felhasználó
/*if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}*/

require "/xampp/htdocs/Horizon/views/header.php";
?>

<div class="container-fluid">
    <div class="col-auto px-0">
        <div class="col-auto px-0">
            <div id="sidebar" class="show border-end">
                <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Iskola" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Keresés</button>
                </form>
                    <a class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-bootstrap"></i> <span>Item</span> </a>
                    <a class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-film"></i> <span>Item</span></a>
                </div>
            </div>
        </div>
    </div>
</div>




<?php require_once "/xampp/htdocs/Horizon/views/footer.php"; ?>