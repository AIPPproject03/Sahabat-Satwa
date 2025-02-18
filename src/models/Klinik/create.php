<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['Klinik_Nama'];
    $alamat = $_POST['Klinik_Alamat'];
    $telp = $_POST['Klinik_Telp'];

    $sql = "CALL insert_klinik('$nama', '$alamat', '$telp')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Klinik</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Klinik</h1>
        <form method="post" action="">
            <label for="Klinik_Nama">Nama Klinik:</label><br>
            <input type="text" id="Klinik_Nama" name="Klinik_Nama" required><br>
            <label for="Klinik_Alamat">Alamat Klinik:</label><br>
            <textarea id="Klinik_Alamat" name="Klinik_Alamat" required></textarea><br>
            <label for="Klinik_Telp">Telepon Klinik:</label><br>
            <input type="text" id="Klinik_Telp" name="Klinik_Telp" required><br>
            <input type="submit" value="Submit">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>