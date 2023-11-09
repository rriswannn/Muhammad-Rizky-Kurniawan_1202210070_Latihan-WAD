<?php
$host = "localhost:3308";
$user = "root";
$pass = ""; 
$db = "manajemen_kontak";
$port = 3308;

$koneksi = mysqli_connect("localhost:3308","root","","manajemen_kontak");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
