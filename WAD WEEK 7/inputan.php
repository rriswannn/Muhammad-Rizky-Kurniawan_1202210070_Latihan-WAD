<?php

$koneksi = mysqli_connect("localhost:3308", "root", " ", "contacts");


if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


$nama = $_POST['nama'];
$email = $_POST['email'];
$nomor_telepon = $_POST['nomor_telepon'];


$query = "INSERT INTO contacts (nama, email, nomor_telepon) VALUES ('$nama', '$email', '$nomor_telepon')";


if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil disimpan.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}


mysqli_close($koneksi);
?>
