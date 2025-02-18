<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Klinik_ID'];
    $nama = $_POST['Klinik_Nama'];
    $alamat = $_POST['Klinik_Alamat'];
    $telp = $_POST['Klinik_Telp'];

    $sql = "CALL update_klinik('$id', '$nama', '$alamat', '$telp')";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM klinik WHERE Klinik_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Klinik</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Klinik</h1>
        <form method="post" action="">
            <input type="hidden" id="Klinik_ID" name="Klinik_ID" value="<?php echo $row['Klinik_ID']; ?>">
            <label for="Klinik_Nama">Nama Klinik:</label><br>
            <input type="text" id="Klinik_Nama" name="Klinik_Nama" value="<?php echo $row['Klinik_Nama']; ?>" required><br>
            <label for="Klinik_Alamat">Alamat Klinik:</label><br>
            <textarea id="Klinik_Alamat" name="Klinik_Alamat" required><?php echo $row['Klinik_Alamat']; ?></textarea><br>
            <label for="Klinik_Telp">Telepon Klinik:</label><br>
            <input type="text" id="Klinik_Telp" name="Klinik_Telp" value="<?php echo $row['Klinik_Telp']; ?>" required><br>
            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>