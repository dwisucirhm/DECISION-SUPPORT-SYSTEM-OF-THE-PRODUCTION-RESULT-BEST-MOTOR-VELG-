<?php
include "../config.php";

// Matriks Alternatif
if ($_GET['page'] == "matriks-alternatif") {
    $id = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM alternatif WHERE id_alternatif = '$id'");
    header('Location: ../matriks-alternatif.php');
}