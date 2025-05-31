<?php
include("conn.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete ="DELETE FROM patient WHERE id = ?";
    $stmt = $conn -> prepare($delete);
    $stmt -> execute([$id]);
    header("Location:select.php");
}
?>