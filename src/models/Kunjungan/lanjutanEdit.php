<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$tgl = isset($_GET['tgl']) ? $_GET['tgl'] : '';

$sql_resep = "SELECT Resep_ID FROM resep";
$result_resep = $conn->query($sql_resep);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kunjungan_id = $_POST['Kunjungan_ID'];
    $tanggal = $_POST['Kunjungan_Lanjutan_Tanggal'];
    $keterangan = $_POST['Kunjungan_Lanjutan_Keterangan'];
    $resep_id = $_POST['Resep_ID'] !== '' ? $_POST['Resep_ID'] : NULL;

    if ($resep_id === NULL) {
        $sql = "CALL update_kunjungan_lanjutan('$kunjungan_id', '$tanggal', '$keterangan', NULL)";
    } else {
        $sql = "CALL update_kunjungan_lanjutan('$kunjungan_id', '$tanggal', '$keterangan', '$resep_id')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM kunjungan_lanjutan WHERE Kunjungan_ID = '$id' AND Kunjungan_Lanjutan_Tgl = '$tgl'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kunjungan Lanjutan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Kunjungan Lanjutan</h1>
        <form method="post" action="">
            <input type="hidden" id="Kunjungan_ID" name="Kunjungan_ID" value="<?php echo $row['Kunjungan_ID']; ?>">

            <label for="Kunjungan_Lanjutan_Tanggal">Tanggal:</label>
            <input type="date" id="Kunjungan_Lanjutan_Tanggal" name="Kunjungan_Lanjutan_Tanggal" value="<?php echo $row['Kunjungan_Lanjutan_Tgl']; ?>" required>

            <label for="Kunjungan_Lanjutan_Keterangan">Keterangan:</label>
            <textarea id="Kunjungan_Lanjutan_Keterangan" name="Kunjungan_Lanjutan_Keterangan" required><?php echo $row['Kunjungan_Lanjutan_Keterangan']; ?></textarea>

            <label for="Resep_ID">Resep ID (Optional):</label>
            <select id="Resep_ID" name="Resep_ID">
                <option value="">None</option>
                <?php
                while ($row_resep = $result_resep->fetch_assoc()) {
                    $selected = ($row_resep['Resep_ID'] == $row['Resep_ID']) ? 'selected' : '';
                    echo "<option value='{$row_resep['Resep_ID']}' $selected>{$row_resep['Resep_ID']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>