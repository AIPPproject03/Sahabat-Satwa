<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Pawrent_ID'];
    $nama = $_POST['Pawrent_Nama'];
    $telp = $_POST['Pawrent_Telp'];

    $sql = "CALL update_pawrent('$id', '$nama', '$telp')";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM pawrent WHERE Pawrent_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pawrent</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Pawrent</h1>
        <form method="post" action="">
            <input type="hidden" id="Pawrent_ID" name="Pawrent_ID" value="<?php echo $row['Pawrent_ID']; ?>">

            <label for="Pawrent_Nama">Nama Pawrent:</label>
            <input type="text" id="Pawrent_Nama" name="Pawrent_Nama" value="<?php echo $row['Pawrent_Nama']; ?>" required>

            <label for="Pawrent_Telp">Telepon:</label>
            <input type="text" id="Pawrent_Telp" name="Pawrent_Telp" value="<?php echo $row['Pawrent_Telp']; ?>" required>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>