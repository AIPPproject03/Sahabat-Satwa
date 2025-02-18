<?php
include '../../connection.php';

$sql = "SELECT * FROM dokter_hewan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokter Hewan</title>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Daftar Dokter Hewan</h1>
        <a href="create.php" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Dokter Hewan</a>
        <table>
            <tr>
                <th>Dokter ID</th>
                <th>Nama Dokter</th>
                <th>Telepon</th>
                <th>Tanggal Mulai Kerja</th>
                <th>Klinik ID</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['Dokter_ID']}</td>";
                    echo "<td>{$row['Dokter_Nama']}</td>";
                    echo "<td>{$row['Dokter_Telp']}</td>";
                    echo "<td>{$row['Dokter_Tgl_Mulai_Kerja']}</td>";
                    echo "<td>{$row['Klinik_ID']}</td>";
                    echo "<td>
                            <a href='update.php?id={$row['Dokter_ID']}' class='btn btn-edit'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?id={$row['Dokter_ID']}' class='btn btn-delete'><i class='fas fa-trash'></i></a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
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