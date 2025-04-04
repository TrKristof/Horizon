<?php
require_once "db.php";

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type == "schools") {
        $query = "SELECT * FROM School";
    } elseif ($type == "teachers") {
        $query = "SELECT * FROM Teachers";
    } elseif ($type == "students") {
        $query = "SELECT * FROM Students";
    } else {
        echo "<p>Invalid request.</p>";
        exit();
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>" . ucfirst($type) . "</h2>";
        echo "<table class='table table-bordered'><tr>";

        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            echo "<th>{$field->name}</th>";
        }
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }
}