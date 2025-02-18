<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql_dokter = "SELECT Dokter_ID, Dokter_Nama FROM dokter_hewan";
$result_dokter = $conn->query($sql_dokter);

$sql_obat = "SELECT Obat_ID, Obat_Nama FROM obat";
$result_obat = $conn->query($sql_obat);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Resep_ID'];
    $dokter_id = $_POST['Dokter_ID'];
    $obat_id = $_POST['Obat_ID'];
    $dosis = $_POST['Resep_Dosis'];
    $frekuensi_pemberian = $_POST['Resep_Frekuensi_Pemberian'];

    $sql = "CALL update_resep('$id', '$dokter_id', '$obat_id', '$dosis', '$frekuensi_pemberian')";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM resep WHERE Resep_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Resep</h1>
        <form method="post" action="">
            <input type="hidden" id="Resep_ID" name="Resep_ID" value="<?php echo $row['Resep_ID']; ?>">

            <label for="Dokter_ID">Dokter:</label>
            <select id="Dokter_ID" name="Dokter_ID" required>
                <?php
                while ($row_dokter = $result_dokter->fetch_assoc()) {
                    $selected = ($row_dokter['Dokter_ID'] == $row['Dokter_ID']) ? 'selected' : '';
                    echo "<option value='{$row_dokter['Dokter_ID']}' $selected>{$row_dokter['Dokter_Nama']}</option>";
                }
                ?>
            </select>

            <label for="Obat_ID">Obat:</label>
            <select id="Obat_ID" name="Obat_ID" required>
                <?php
                while ($row_obat = $result_obat->fetch_assoc()) {
                    $selected = ($row_obat['Obat_ID'] == $row['Obat_ID']) ? 'selected' : '';
                    echo "<option value='{$row_obat['Obat_ID']}' $selected>{$row_obat['Obat_Nama']}</option>";
                }
                ?>
            </select>

            <label for="Resep_Dosis">Dosis:</label>
            <input type="text" id="Resep_Dosis" name="Resep_Dosis" value="<?php echo $row['Resep_Dosis']; ?>" required>

            <label for="Resep_Frekuensi_Pemberian">Frekuensi Pemberian:</label>
            <input type="text" id="Resep_Frekuensi_Pemberian" name="Resep_Frekuensi_Pemberian" value="<?php echo $row['Resep_Frekuensi_Pemberian']; ?>" required>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>