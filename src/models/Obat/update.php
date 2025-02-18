<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Obat_ID'];
    $nama = $_POST['Obat_Nama'];
    $instruction = $_POST['Obat_Instruction'];

    $sql = "CALL update_obat('$id', '$nama', '$instruction')";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM obat WHERE Obat_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Obat</h1>
        <form method="post" action="">
            <input type="hidden" id="Obat_ID" name="Obat_ID" value="<?php echo $row['Obat_ID']; ?>">

            <label for="Obat_Nama">Nama Obat:</label>
            <input type="text" id="Obat_Nama" name="Obat_Nama" value="<?php echo $row['Obat_Nama']; ?>" required>

            <label for="Obat_Instruction">Instruksi:</label>
            <textarea id="Obat_Instruction" name="Obat_Instruction" required><?php echo $row['Obat_Instruction']; ?></textarea>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>