<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['Pawrent_Nama'];
    $telp = $_POST['Pawrent_Telp'];

    $sql = "CALL insert_pawrent('$nama', '$telp')";

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
    <title>Tambah Pawrent</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Pawrent</h1>
        <form method="post" action="">
            <label for="Pawrent_Nama">Nama Pawrent:</label>
            <input type="text" id="Pawrent_Nama" name="Pawrent_Nama" required>

            <label for="Pawrent_Telp">Telepon:</label>
            <input type="text" id="Pawrent_Telp" name="Pawrent_Telp" required>

            <input type="submit" value="Submit">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>