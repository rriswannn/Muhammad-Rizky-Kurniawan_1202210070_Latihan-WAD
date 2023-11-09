<?php
include 'koneksi.php';


$pesan = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "update") {
        $id_update = $_POST["id_update"];
        $nama_update = $_POST["nama_update"];
        $email_update = $_POST["email_update"];
        $nomor_telepon_update = $_POST["nomor_telepon_update"];

       
        $query_update = "UPDATE contacts SET nama='$nama_update', email='$email_update', nomor_telepon='$nomor_telepon_update' WHERE id=$id_update";
        $result_update = mysqli_query($koneksi, $query_update);

        if ($result_update) {
            $pesan = "Kontak berhasil diupdate!";
        } else {
            $pesan = "Error: " . mysqli_error($koneksi);
        }
    } elseif (isset($_POST["action"]) && $_POST["action"] == "delete") {
        $id_delete = $_POST["id_delete"];

        
        $query_delete = "DELETE FROM contacts WHERE id = $id_delete";
        $result_delete = mysqli_query($koneksi, $query_delete);

        if ($result_delete) {
            $pesan = "Kontak berhasil dihapus!";
        } else {
            $pesan = "Error: " . mysqli_error($koneksi);
        }
    } else {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $nomor_telepon = $_POST["nomor_telepon"];

        
        $query = "INSERT INTO contacts (nama, email, nomor_telepon) VALUES ('$nama', '$email', '$nomor_telepon')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $pesan = "Kontak berhasil ditambahkan!";
        } else {
            $pesan = "Error: " . mysqli_error($koneksi);
        }
    }
}


$query_select = "SELECT * FROM contacts";
$result_select = mysqli_query($koneksi, $query_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HALAMAN ADMIN</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function tampilkanNotifikasi(pesan) {
            alert(pesan);
        }

        <?php if (!empty($pesan)) : ?>
            
            window.onload = function() {
                tampilkanNotifikasi('<?php echo $pesan; ?>');
            };
        <?php endif; ?>

        
        function showUpdateForm(id, nama, email, nomorTelepon) {
            
            document.getElementById("id_update").value = id;
            document.getElementById("nama_update").value = nama;
            document.getElementById("email_update").value = email;
            document.getElementById("nomor_telepon_update").value = nomorTelepon;

            
            document.getElementById("updateForm").style.display = "block";
        }

        
        function confirmDelete(id) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus kontak ini?");
            if (konfirmasi) {
                
                var formDelete = document.createElement("form");
                formDelete.method = "post";
                formDelete.action = "";
                formDelete.style.display = "none"; 

                var inputId = document.createElement("input");
                inputId.type = "hidden";
                inputId.name = "id_delete";
                inputId.value = id;

                var inputAction = document.createElement("input");
                inputAction.type = "hidden";
                inputAction.name = "action";
                inputAction.value = "delete";

                formDelete.appendChild(inputId);
                formDelete.appendChild(inputAction);

                document.body.appendChild(formDelete);
                formDelete.submit();
            }
        }
    </script>
</head>
<body>
    <h1>Formulir Input Kontak</h1>
    <form method="post" action="">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" required><br>

        <button type="submit">Tambah Kontak</button>
    </form>

    <h2>Data Kontak</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php
        
        $no = 1;
        while ($row = mysqli_fetch_assoc($result_select)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["nomor_telepon"] . "</td>";
            echo "<td>
                    <a href='#' onclick='showUpdateForm(" . $row["id"] . ", \"" . $row["nama"] . "\", \"" . $row["email"] . "\", \"" . $row["nomor_telepon"] . "\")'>Edit</a>
                    <a href='#' onclick='confirmDelete(" . $row["id"] . ")'>Delete</a>
                </td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>


    <div id="updateForm" style="display: none;">
        <h2>Formulir Update Kontak</h2>
        <form method="post" action="">
            <input type="hidden" id="id_update" name="id_update">
            <label for="nama_update">Nama:</label>
            <input type="text" id="nama_update" name="nama_update" required><br>

            <label for="email_update">Email:</label>
            <input type="email" id="email_update" name="email_update" required><br>

            <label for="nomor_telepon_update">Nomor Telepon:</label>
            <input type="text" id="nomor_telepon_update" name="nomor_telepon_update" required><br>

            <button type="submit" name="action" value="update">Update Kontak</button>
        </form>
    </div>
</body>
</html>
