<?php
include '../../connection.php';

$sql = "SELECT spesialisasi.Dokter_ID, spesialisasi.Spesialisasi, dokter_hewan.Dokter_Nama FROM spesialisasi JOIN dokter_hewan ON spesialisasi.Dokter_ID = dokter_hewan.Dokter_ID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Spesialisasi</title>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Daftar Spesialisasi</h1>
        <a href="create.php" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Spesialisasi</a>
        <table>
            <tr>
                <th>Dokter ID</th>
                <th>Nama Dokter</th>
                <th>Spesialisasi</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['Dokter_ID']}</td>";
                    echo "<td>{$row['Dokter_Nama']}</td>";
                    echo "<td>{$row['Spesialisasi']}</td>";
                    echo "<td>
                            <a href='update.php?id={$row['Dokter_ID']}' class='btn btn-edit'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?id={$row['Dokter_ID']}' class='btn btn-delete'><i class='fas fa-trash'></i></a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }
            ?>
        </table>
        <a href="../../app.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
    </div>
</body>

</html>

<?php
$conn->close();
?>