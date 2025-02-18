<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dokter_id = $_POST['Dokter_ID'];
    $spesialisasi = $_POST['Spesialisasi'];

    // Check if the doctor already has a specialization
    $check_sql = "SELECT * FROM spesialisasi WHERE Dokter_ID = '$dokter_id' AND Dokter_ID != '$id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error_message = "Dokter tersebut sudah memiliki spesialisasi.";
    } else {
        $sql = "CALL update_spesialisasi('$dokter_id', '$spesialisasi')";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        header("Location: index.php");
        exit();
    }
}

$sql = "SELECT * FROM spesialisasi WHERE Dokter_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Spesialisasi</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Spesialisasi</h1>
        <form method="post" action="">
            <input type="hidden" id="Dokter_ID" name="Dokter_ID" value="<?php echo $row['Dokter_ID']; ?>">

            <label for="Spesialisasi">Spesialisasi:</label>
            <input type="text" id="Spesialisasi" name="Spesialisasi" value="<?php echo $row['Spesialisasi']; ?>" required>

            <?php if (isset($error_message)) { ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php } ?>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>