<?php
include 'connection.php';

$tables = [
    'dokter' => 'Dokter Hewan',
    'hewan' => 'Hewan',
    'klinik' => 'Klinik',
    'kunjungan' => 'Kunjungan',
    'obat' => 'Obat',
    'pawrent' => 'Pawrent',
    'resep' => 'Resep',
    'spesialisasi' => 'Spesialisasi'
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahabat Satwa - CRUD Menu</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="container">
        <h1>Selamat Datang di Sahabat Satwa</h1>
        <h2>Pilih Tabel untuk Operasi CRUD</h2>
        <ul class="table-list">
            <?php
            foreach ($tables as $key => $value) {
                echo "<li><a href='models/$key/index.php'>$value</a></li>";
            }
            ?>
        </ul>
    </div>
</body>

</html>