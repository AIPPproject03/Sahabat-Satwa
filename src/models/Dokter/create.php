<?php
include '../../connection.php';

$sql_klinik = "SELECT Klinik_ID, Klinik_Nama FROM klinik";
$result_klinik = $conn->query($sql_klinik);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['Dokter_Nama'];
    $telp = $_POST['Dokter_Telp'];
    $tgl_mulai_kerja = $_POST['Dokter_Tgl_Mulai_Kerja'];
    $klinik_id = $_POST['Klinik_ID'];

    $sql = "CALL insert_dokter_hewan('$nama', '$telp', '$tgl_mulai_kerja', '$klinik_id')";

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
    <title>Tambah Dokter Hewan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Dokter Hewan</h1>
        <?php if ($result_klinik->num_rows > 0) { ?>
            <form method="post" action="">
                <label for="Dokter_Nama">Nama Dokter:</label>
                <input type="text" id="Dokter_Nama" name="Dokter_Nama" required>

                <label for="Dokter_Telp">Telepon:</label>
                <input type="text" id="Dokter_Telp" name="Dokter_Telp" required>

                <label for="Dokter_Tgl_Mulai_Kerja">Tanggal Mulai Kerja:</label>
                <input type="date" id="Dokter_Tgl_Mulai_Kerja" name="Dokter_Tgl_Mulai_Kerja" required>

                <label for="Klinik_ID">Klinik:</label>
                <select id="Klinik_ID" name="Klinik_ID" required>
                    <?php
                    while ($row_klinik = $result_klinik->fetch_assoc()) {
                        echo "<option value='{$row_klinik['Klinik_ID']}'>{$row_klinik['Klinik_Nama']}</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Submit">
            </form>
        <?php } else { ?>
            <p>Tidak bisa mendaftar karena tidak ada klinik tersedia.</p>
        <?php } ?>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>