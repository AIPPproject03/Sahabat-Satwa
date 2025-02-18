<?php
include '../../connection.php';

$sql = "SELECT kunjungan.Kunjungan_ID, kunjungan.Kunjungan_Tgl, kunjungan.Kunjungan_Keterangan, hewan.Hewan_Nama, dokter_hewan.Dokter_Nama, klinik.Klinik_Nama, resep.Resep_ID
        FROM kunjungan
        JOIN hewan ON kunjungan.Hewan_ID = hewan.Hewan_ID
        JOIN dokter_hewan ON kunjungan.Dokter_ID = dokter_hewan.Dokter_ID
        JOIN klinik ON kunjungan.Klinik_ID = klinik.Klinik_ID
        LEFT JOIN resep ON kunjungan.Resep_ID = resep.Resep_ID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kunjungan</title>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function toggleLanjutan(kunjunganId) {
            var lanjutanTable = document.getElementById('lanjutan-' + kunjunganId);
            if (lanjutanTable.style.display === 'none') {
                lanjutanTable.style.display = 'table-row';
            } else {
                lanjutanTable.style.display = 'none';
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Daftar Kunjungan</h1>
        <a href="create.php" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Kunjungan</a>
        <a href="lanjutan.php" class="btn btn-add"><i class="fas fa-arrow-right"></i> Kunjungan Lanjutan</a>
        <table>
            <tr>
                <th>Kunjungan ID</th>
                <th>Hewan</th>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Klinik</th>
                <th>Resep ID</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='#' onclick='toggleLanjutan(\"{$row['Kunjungan_ID']}\")'>{$row['Kunjungan_ID']}</a></td>";
                    echo "<td>{$row['Hewan_Nama']}</td>";
                    echo "<td>{$row['Dokter_Nama']}</td>";
                    echo "<td>{$row['Kunjungan_Tgl']}</td>";
                    echo "<td>{$row['Kunjungan_Keterangan']}</td>";
                    echo "<td>{$row['Klinik_Nama']}</td>";
                    echo "<td>{$row['Resep_ID']}</td>";
                    echo "<td>
                            <a href='update.php?id={$row['Kunjungan_ID']}' class='btn btn-edit'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?id={$row['Kunjungan_ID']}' class='btn btn-delete'><i class='fas fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    $sql_lanjutan = "SELECT Kunjungan_Lanjutan_Tgl, Kunjungan_Lanjutan_Keterangan, Resep_ID
                                     FROM kunjungan_lanjutan
                                     WHERE Kunjungan_ID = '{$row['Kunjungan_ID']}'";
                    $result_lanjutan = $conn->query($sql_lanjutan);

                    echo "<tr id='lanjutan-{$row['Kunjungan_ID']}' style='display: none;'>";
                    echo "<td colspan='8'>";
                    if ($result_lanjutan->num_rows > 0) {
                        echo "<table>";
                        echo "<tr>
                                <th>Tanggal Lanjutan</th>
                                <th>Keterangan Lanjutan</th>
                                <th>Resep ID</th>
                                <th>Aksi</th>
                              </tr>";
                        while ($row_lanjutan = $result_lanjutan->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row_lanjutan['Kunjungan_Lanjutan_Tgl']}</td>";
                            echo "<td>{$row_lanjutan['Kunjungan_Lanjutan_Keterangan']}</td>";
                            echo "<td>{$row_lanjutan['Resep_ID']}</td>";
                            echo "<td>
                                    <a href='lanjutanEdit.php?id={$row['Kunjungan_ID']}&tgl={$row_lanjutan['Kunjungan_Lanjutan_Tgl']}' class='btn btn-edit'><i class='fas fa-edit'></i></a>
                                    <a href='lanjutanDelete.php?id={$row['Kunjungan_ID']}&tgl={$row_lanjutan['Kunjungan_Lanjutan_Tgl']}' class='btn btn-delete'><i class='fas fa-trash'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>Tidak ada kunjungan lanjutan</p>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
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