<?php
include '../../connection.php';

$sql = "SELECT resep.Resep_ID, resep.Dokter_ID, dokter_hewan.Dokter_Nama, resep.Obat_ID, obat.Obat_Nama, resep.Resep_Dosis, resep.Resep_Frekuensi_Pemberian 
        FROM resep 
        JOIN dokter_hewan ON resep.Dokter_ID = dokter_hewan.Dokter_ID 
        JOIN obat ON resep.Obat_ID = obat.Obat_ID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep</title>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Daftar Resep</h1>
        <a href="create.php" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Resep</a>
        <table>
            <tr>
                <th>Resep ID</th>
                <th>Dokter</th>
                <th>Obat</th>
                <th>Dosis</th>
                <th>Frekuensi Pemberian</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['Resep_ID']}</td>";
                    echo "<td>{$row['Dokter_Nama']}</td>";
                    echo "<td>{$row['Obat_Nama']}</td>";
                    echo "<td>{$row['Resep_Dosis']}</td>";
                    echo "<td>{$row['Resep_Frekuensi_Pemberian']}</td>";
                    echo "<td>
                            <a href='update.php?id={$row['Resep_ID']}' class='btn btn-edit'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?id={$row['Resep_ID']}' class='btn btn-delete'><i class='fas fa-trash'></i></a>
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