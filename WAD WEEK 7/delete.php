<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_delete"])) {
    $id_delete = $_POST["id_delete"];

    
    $query_delete = "DELETE FROM contacts WHERE id = $id_delete";
    $result_delete = mysqli_query($koneksi, $query_delete);

    if ($result_delete) {
        echo "Kontak berhasil dihapus!";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid Request";
}
?>
