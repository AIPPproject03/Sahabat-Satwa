<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql_hewan = "SELECT Hewan_ID, Hewan_Nama FROM hewan";
$result_hewan = $conn->query($sql_hewan);

$sql_dokter = "SELECT Dokter_ID, Dokter_Nama FROM dokter_hewan";
$result_dokter = $conn->query($sql_dokter);

$sql_klinik = "SELECT Klinik_ID, Klinik_Nama FROM klinik";
$result_klinik = $conn->query($sql_klinik);

$sql_resep = "SELECT Resep_ID FROM resep";
$result_resep = $conn->query($sql_resep);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Kunjungan_ID'];
    $hewan_id = $_POST['Hewan_ID'];
    $dokter_id = $_POST['Dokter_ID'];
    $klinik_id = $_POST['Klinik_ID'];
    $tanggal = $_POST['Kunjungan_Tanggal'];
    $keterangan = $_POST['Kunjungan_Keterangan'];
    $resep_id = $_POST['Resep_ID'] !== '' ? $_POST['Resep_ID'] : NULL;

    if ($resep_id === NULL) {
        $sql = "CALL update_kunjungan('$id', '$tanggal', '$keterangan', '$hewan_id', '$dokter_id', '$klinik_id', NULL)";
    } else {
        $sql = "CALL update_kunjungan('$id', '$tanggal', '$keterangan', '$hewan_id', '$dokter_id', '$klinik_id', '$resep_id')";
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

$sql = "SELECT * FROM kunjungan WHERE Kunjungan_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kunjungan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Kunjungan</h1>
        <form method="post" action="">
            <input type="hidden" id="Kunjungan_ID" name="Kunjungan_ID" value="<?php echo $row['Kunjungan_ID']; ?>">

            <label for="Hewan_ID">Hewan:</label>
            <select id="Hewan_ID" name="Hewan_ID" required>
                <?php
                while ($row_hewan = $result_hewan->fetch_assoc()) {
                    $selected = ($row_hewan['Hewan_ID'] == $row['Hewan_ID']) ? 'selected' : '';
                    echo "<option value='{$row_hewan['Hewan_ID']}' $selected>{$row_hewan['Hewan_Nama']}</option>";
                }
                ?>
            </select>

            <label for="Dokter_ID">Dokter:</label>
            <select id="Dokter_ID" name="Dokter_ID" required>
                <?php
                while ($row_dokter = $result_dokter->fetch_assoc()) {
                    $selected = ($row_dokter['Dokter_ID'] == $row['Dokter_ID']) ? 'selected' : '';
                    echo "<option value='{$row_dokter['Dokter_ID']}' $selected>{$row_dokter['Dokter_Nama']}</option>";
                }
                ?>
            </select>

            <label for="Klinik_ID">Klinik:</label>
            <select id="Klinik_ID" name="Klinik_ID" required>
                <?php
                while ($row_klinik = $result_klinik->fetch_assoc()) {
                    $selected = ($row_klinik['Klinik_ID'] == $row['Klinik_ID']) ? 'selected' : '';
                    echo "<option value='{$row_klinik['Klinik_ID']}' $selected>{$row_klinik['Klinik_Nama']}</option>";
                }
                ?>
            </select>

            <label for="Kunjungan_Tanggal">Tanggal:</label>
            <input type="date" id="Kunjungan_Tanggal" name="Kunjungan_Tanggal" value="<?php echo $row['Kunjungan_Tgl']; ?>" required>

            <label for="Kunjungan_Keterangan">Keterangan:</label>
            <textarea id="Kunjungan_Keterangan" name="Kunjungan_Keterangan" required><?php echo $row['Kunjungan_Keterangan']; ?></textarea>

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