<?php
include "../config.php";
session_start();

// Proses Registrasi
if (isset($_POST['registrasi'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert Tabel Profil
    $sql_profil = mysqli_query($koneksi, "INSERT INTO profil VALUES(Null, '$nama', '$alamat')");

    // // Mengambil id profil terbaru
    $id_profil = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_profil FROM profil ORDER BY id_profil DESC LIMIT 1"));
    $id_profil = $id_profil['id_profil']; // result

    // Insert Tabel Login
    $sql_login = mysqli_query($koneksi, "INSERT INTO login VALUES(Null, '$id_profil', '$username', '$password')");

    if ($sql_login && $sql_profil) {
        $_SESSION["registrasi"] = "Registrasi Berhasil !";
        header("Location: ../login.php");
    } else {
        $_SESSION["registrasi"] = "Registrasi Gagal !";
        header("Location: ../registrasi.php");
    }
}

// Insert Matriks Alternatif
if (isset($_POST['matriks-alternatif'])) {
    $nama_velg = $_POST['nama_velg'];
    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];
    $c4 = $_POST['c4'];

    // Insert Tabel Alternatif
    $sql= mysqli_query($koneksi, "INSERT INTO alternatif VALUES(Null, '$nama_velg', '$c1', '$c2', '$c3', '$c4')");

    header("Location: ../matriks-alternatif.php");
}
