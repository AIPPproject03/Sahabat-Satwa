<?php
include '../../connection.php';

$sql_dokter = "SELECT Dokter_ID, Dokter_Nama FROM dokter_hewan";
$result_dokter = $conn->query($sql_dokter);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dokter_id = $_POST['Dokter_ID'];
    $spesialisasi = $_POST['Spesialisasi'];

    // Check if the doctor already has a specialization
    $check_sql = "SELECT * FROM spesialisasi WHERE Dokter_ID = '$dokter_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error_message = "Dokter tersebut sudah memiliki spesialisasi.";
    } else {
        $sql = "CALL insert_spesialisasi('$dokter_id', '$spesialisasi')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Spesialisasi</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Spesialisasi</h1>
        <?php if ($result_dokter->num_rows > 0) { ?>
            <form method="post" action="">
                <label for="Dokter_ID">Dokter:</label>
                <select id="Dokter_ID" name="Dokter_ID" required>
                    <?php
                    while ($row_dokter = $result_dokter->fetch_assoc()) {
                        echo "<option value='{$row_dokter['Dokter_ID']}'>{$row_dokter['Dokter_Nama']}</option>";
                    }
                    ?>
                </select>

                <label for="Spesialisasi">Spesialisasi:</label>
                <input type="text" id="Spesialisasi" name="Spesialisasi" required>

                <?php if (isset($error_message)) { ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php } ?>

                <input type="submit" value="Submit">
            </form>
        <?php } else { ?>
            <p>Tidak bisa mendaftar karena tidak ada dokter tersedia.</p>
        <?php } ?>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>