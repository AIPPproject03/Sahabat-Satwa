<?php
include '../../connection.php';

$sql_pawrent = "SELECT Pawrent_ID, Pawrent_Nama FROM pawrent";
$result_pawrent = $conn->query($sql_pawrent);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['Hewan_Nama'];
    $tahun_lahir = $_POST['Hewan_Tahun_Lahir'];
    $jenis = $_POST['Hewan_Jenis'];
    $pawrent_id = $_POST['Pawrent_ID'];

    $sql = "CALL insert_hewan('$nama', '$tahun_lahir', '$jenis', '$pawrent_id')";

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
    <title>Tambah Hewan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Hewan</h1>
        <?php if ($result_pawrent->num_rows > 0) { ?>
            <form method="post" action="">
                <label for="Hewan_Nama">Nama Hewan:</label>
                <input type="text" id="Hewan_Nama" name="Hewan_Nama" required>

                <label for="Hewan_Tahun_Lahir">Tahun Lahir:</label>
                <input type="number" id="Hewan_Tahun_Lahir" name="Hewan_Tahun_Lahir" required>

                <label for="Hewan_Jenis">Jenis:</label>
                <input type="text" id="Hewan_Jenis" name="Hewan_Jenis" required>

                <label for="Pawrent_ID">Pawrent:</label>
                <select id="Pawrent_ID" name="Pawrent_ID" required>
                    <?php
                    while ($row_pawrent = $result_pawrent->fetch_assoc()) {
                        echo "<option value='{$row_pawrent['Pawrent_ID']}'>{$row_pawrent['Pawrent_Nama']}</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Submit">
            </form>
        <?php } else { ?>
            <p>Tidak bisa mendaftar karena tidak ada pawrent tersedia.</p>
        <?php } ?>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>