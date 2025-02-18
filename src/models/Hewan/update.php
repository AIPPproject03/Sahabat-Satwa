<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql_pawrent = "SELECT Pawrent_ID, Pawrent_Nama FROM pawrent";
$result_pawrent = $conn->query($sql_pawrent);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Hewan_ID'];
    $nama = $_POST['Hewan_Nama'];
    $tahun_lahir = $_POST['Hewan_Tahun_Lahir'];
    $jenis = $_POST['Hewan_Jenis'];
    $pawrent_id = $_POST['Pawrent_ID'];

    $sql = "CALL update_hewan('$id', '$nama', '$tahun_lahir', '$jenis', '$pawrent_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM hewan WHERE Hewan_ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hewan</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Hewan</h1>
        <form method="post" action="">
            <input type="hidden" id="Hewan_ID" name="Hewan_ID" value="<?php echo $row['Hewan_ID']; ?>">

            <label for="Hewan_Nama">Nama Hewan:</label>
            <input type="text" id="Hewan_Nama" name="Hewan_Nama" value="<?php echo $row['Hewan_Nama']; ?>" required>

            <label for="Hewan_Tahun_Lahir">Tahun Lahir:</label>
            <input type="number" id="Hewan_Tahun_Lahir" name="Hewan_Tahun_Lahir" value="<?php echo $row['Hewan_Tahun_Lahir']; ?>" required>

            <label for="Hewan_Jenis">Jenis:</label>
            <input type="text" id="Hewan_Jenis" name="Hewan_Jenis" value="<?php echo $row['Hewan_Jenis']; ?>" required>

            <label for="Pawrent_ID">Pawrent:</label>
            <select id="Pawrent_ID" name="Pawrent_ID" required>
                <?php
                while ($row_pawrent = $result_pawrent->fetch_assoc()) {
                    $selected = ($row_pawrent['Pawrent_ID'] == $row['Pawrent_ID']) ? 'selected' : '';
                    echo "<option value='{$row_pawrent['Pawrent_ID']}' $selected>{$row_pawrent['Pawrent_Nama']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Update">
        </form>
        <a href="index.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>

</html>