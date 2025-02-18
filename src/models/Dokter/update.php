<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql_klinik = "SELECT Klinik_ID, Klinik_Nama FROM klinik";
$result_klinik = $conn->query($sql_klinik);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Dokter_ID'];
    $nama = $_POST['Dokter_Nama'];
    $telp = $_POST['Dokter_Telp'];
    $tgl_mulai_kerja = $_POST['Dokter_Tgl_Mulai_Kerja'];
    $klinik_id = $_POST['Klinik_ID'];

    $sql = "CALL update_dokter_hewan('$id', '$nama', '$telp', '$tgl_mulai_kerja', '$klinik_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM dokter_hewan WHERE Dokter_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokter Hewan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Dokter Hewan</h1>
        <form method="post" action="">
            <input type="hidden" id="Dokter_ID" name="Dokter_ID" value="<?php echo $row['Dokter_ID']; ?>">

            <label for="Dokter_Nama">Nama Dokter:</label>
            <input type="text" id="Dokter_Nama" name="Dokter_Nama" value="<?php echo $row['Dokter_Nama']; ?>" required>

            <label for="Dokter_Telp">Telepon:</label>
            <input type="text" id="Dokter_Telp" name="Dokter_Telp" value="<?php echo $row['Dokter_Telp']; ?>" required>

            <label for="Dokter_Tgl_Mulai_Kerja">Tanggal Mulai Kerja:</label>
            <input type="date" id="Dokter_Tgl_Mulai_Kerja" name="Dokter_Tgl_Mulai_Kerja" value="<?php echo $row['Dokter_Tgl_Mulai_Kerja']; ?>" required>

            <label for="Klinik_ID">Klinik:</label>
            <select id="Klinik_ID" name="Klinik_ID" required>
                <?php
                while ($row_klinik = $result_klinik->fetch_assoc()) {
                    $selected = ($row_klinik['Klinik_ID'] == $row['Klinik_ID']) ? 'selected' : '';
                    echo "<option value='{$row_klinik['Klinik_ID']}' $selected>{$row_klinik['Klinik_Nama']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>