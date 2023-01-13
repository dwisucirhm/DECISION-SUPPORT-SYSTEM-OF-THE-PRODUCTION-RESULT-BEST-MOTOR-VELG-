<?php
    $server_db="localhost";
    $user_db="root";
    $pass_db="";
    $nama_db="spk_velg";

    $koneksi = mysqli_connect($server_db, $user_db, $pass_db, $nama_db) or die(mysqli_error($koneksi));
?>