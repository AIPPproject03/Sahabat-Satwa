<?php
include '../../connection.php';

$sql_kunjungan = "SELECT Kunjungan_ID FROM kunjungan";
$result_kunjungan = $conn->query($sql_kunjungan);

$sql_resep = "SELECT Resep_ID FROM resep";
$result_resep = $conn->query($sql_resep);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kunjungan_id = $_POST['Kunjungan_ID'];
    $tanggal = $_POST['Kunjungan_Lanjutan_Tanggal'];
    $keterangan = $_POST['Kunjungan_Lanjutan_Keterangan'];
    $resep_id = $_POST['Resep_ID'] !== 'NULL' ? $_POST['Resep_ID'] : NULL;

    if ($resep_id === NULL) {
        $sql = "CALL insert_kunjungan_lanjutan('$kunjungan_id', '$tanggal', '$keterangan', NULL)";
    } else {
        $sql = "CALL insert_kunjungan_lanjutan('$kunjungan_id', '$tanggal', '$keterangan', '$resep_id')";
    }

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
    <title>Tambah Kunjungan Lanjutan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Kunjungan Lanjutan</h1>
        <form method="post" action="">
            <label for="Kunjungan_ID">Kunjungan ID:</label>
            <select id="Kunjungan_ID" name="Kunjungan_ID" required>
                <?php
                while ($row_kunjungan = $result_kunjungan->fetch_assoc()) {
                    echo "<option value='{$row_kunjungan['Kunjungan_ID']}'>{$row_kunjungan['Kunjungan_ID']}</option>";
                }
                ?>
            </select>

            <label for="Kunjungan_Lanjutan_Tanggal">Tanggal:</label>
            <input type="date" id="Kunjungan_Lanjutan_Tanggal" name="Kunjungan_Lanjutan_Tanggal" required>

            <label for="Kunjungan_Lanjutan_Keterangan">Keterangan:</label>
            <textarea id="Kunjungan_Lanjutan_Keterangan" name="Kunjungan_Lanjutan_Keterangan" required></textarea>

            <label for="Resep_ID">Resep ID (Optional):</label>
            <select id="Resep_ID" name="Resep_ID">
                <option value="NULL">None</option>
                <?php
                while ($row_resep = $result_resep->fetch_assoc()) {
                    echo "<option value='{$row_resep['Resep_ID']}'>{$row_resep['Resep_ID']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Submit">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>