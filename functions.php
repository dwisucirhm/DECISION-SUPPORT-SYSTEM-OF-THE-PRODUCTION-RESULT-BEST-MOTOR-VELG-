<?php
include "config.php";
session_start();

// fungsi login
function login($data) {
    $koneksi = $GLOBALS['koneksi'];
    $username = $data['username'];
    $password = $data['password'];

    // cek login
    $login = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_profil FROM login WHERE username = '$username' AND password = '$password'"));
    if($login != NULL) {
        $id_profil = $login['id_profil'];
        $profil = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM profil WHERE id_profil = '$id_profil'"));
        $_SESSION['nama'] = $profil['nama'];
        $_SESSION['alamat'] = $profil['alamat'];
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    } else {
        $_SESSION['login'] = "Login Gagal !";
    }
}


// fungsi konversi SQL Result ke Array --> Alternatif
function queryAlternatifArray($query) {
    if(mysqli_num_rows($query) > 0 ){
        $response = array();
        while($x = mysqli_fetch_array($query)){
            $h['nama_velg'] = $x["nama_velg"];
            $h[1] = $x["c1"];
            $h[2] = $x["c2"];
            $h[3] = $x["c3"];
            $h[4] = $x["c4"];
            array_push($response, $h);
        }
        return $response;
    }else {
        $response["message"]="tidak ada data";
        return $response;
    }
}


// fungsi konversi SQL Result ke Array --> Kriteria 
function queryKriteriaArray($query) {
    if(mysqli_num_rows($query) > 0 ){
        $response = array();
        while($x = mysqli_fetch_array($query)){
            $h['kode'] = $x["kode"];
            $h['kriteria'] = $x["kriteria"];
            $h['atribut'] = $x["atribut"];
            $h['bobot'] = $x["bobot"];
            array_push($response, $h);
        }
        return $response;
    }else {
        $response["message"]="tidak ada data";
        return $response;
    }
}


// fungsi solusi ideal positif dan negatif
function solusiIdeal($data, $x, $atribut) {
    if ($x == 0 and $atribut == "Benefit" or $x == 1 and $atribut == "Cost") {
        return max($data);
    } else {
        return min($data);
    }
}