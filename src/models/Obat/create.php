<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['Obat_Nama'];
    $instruction = $_POST['Obat_Instruction'];

    $sql = "CALL insert_obat('$nama', '$instruction')";

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
    <title>Tambah Obat</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Obat</h1>
        <form method="post" action="">
            <label for="Obat_Nama">Nama Obat:</label>
            <input type="text" id="Obat_Nama" name="Obat_Nama" required>

            <label for="Obat_Instruction">Instruksi:</label>
            <textarea id="Obat_Instruction" name="Obat_Instruction" required></textarea>

            <input type="submit" value="Submit">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>