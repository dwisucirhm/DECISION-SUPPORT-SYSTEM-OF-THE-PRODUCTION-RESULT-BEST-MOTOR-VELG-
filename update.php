<?php
include "../config.php";

// Matriks kriteria
if(isset($_POST['matriks-kriteria'])) {
	$id = $_GET['id'];
	$kriteria = $_POST['kriteria'];
	$atribut = $_POST['atribut'];
	$bobot = $_POST['bobot'];

	$sql = mysqli_query($koneksi, "UPDATE kriteria SET kriteria = '$kriteria', atribut = '$atribut', bobot = '$bobot' WHERE id_kriteria = '$id'");

	header("Location: ../matriks-kriteria.php");
}

// Matriks Alternatif
if(isset($_POST['matriks-alternatif'])) {
	$id = $_GET['id'];
	$nama_velg = $_POST['nama_velg'];
	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];
	$c3 = $_POST['c3'];
	$c4 = $_POST['c4'];

	$sql = mysqli_query($koneksi, "UPDATE alternatif SET nama_velg = '$nama_velg', c1 = '$c1', c2 = '$c2', c3 = '$c3', c4 = '$c4' WHERE id_alternatif = '$id'");

	header("Location: ../matriks-alternatif.php");
}