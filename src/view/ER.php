<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagram Alur Database</title>
    <link rel="stylesheet" href="../style/style.css">
    <script type="module">
        import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
        mermaid.initialize({
            startOnLoad: true
        });
    </script>
    <style>
        .mermaid {
            max-width: 100%;
            overflow-x: auto;
        }

        .container {
            margin-top: 200px;
            text-align: center;

        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Diagram Alur Database</h1>
        <div class="mermaid">
            classDiagram
            class Pawrent {
            +VARCHAR(10) Pawrent_ID
            +VARCHAR(100) Pawrent_Nama
            +VARCHAR(20) Pawrent_Telp
            }
            class Hewan {
            +VARCHAR(10) Hewan_ID
            +VARCHAR(100) Hewan_Nama
            +INT Hewan_Tahun_Lahir
            +VARCHAR(50) Hewan_Jenis
            +VARCHAR(10) Pawrent_ID
            }
            class Kunjungan {
            +VARCHAR(10) Kunjungan_ID
            +DATE Kunjungan_Tgl
            +TEXT Kunjungan_Keterangan
            +VARCHAR(10) Hewan_ID
            +VARCHAR(10) Dokter_ID
            +VARCHAR(10) Klinik_ID
            +VARCHAR(10) Resep_ID
            }
            class Dokter_Hewan {
            +VARCHAR(10) Dokter_ID
            +VARCHAR(100) Dokter_Nama
            +VARCHAR(20) Dokter_Telp
            +DATE Dokter_Tgl_Mulai_Kerja
            +VARCHAR(10) Klinik_ID
            }
            class Klinik {
            +VARCHAR(10) Klinik_ID
            +VARCHAR(100) Klinik_Nama
            +VARCHAR(100) Klinik_Alamat
            }
            class Resep {
            +VARCHAR(10) Resep_ID
            +VARCHAR(10) Dokter_ID
            +VARCHAR(10) Obat_ID
            +VARCHAR(100) Resep_Dosis
            +VARCHAR(100) Resep_Frekuensi_Pemberian
            }
            class Kunjungan_Lanjutan {
            +VARCHAR(10) Kunjungan_ID
            +DATE Kunjungan_Lanjutan_Tgl
            +TEXT Kunjungan_Lanjutan_Keterangan
            +VARCHAR(10) Resep_ID
            }
            class Spesialisasi {
            +VARCHAR(10) Dokter_ID
            +VARCHAR(50) Spesialisasi_Nama
            }
            class Obat {
            +VARCHAR(10) Obat_ID
            +VARCHAR(100) Obat_Nama
            +TEXT Obat_Deskripsi
            }

            Pawrent "1..1" --> "*..1" Hewan : memiliki
            Hewan "1..1" --> "0..1" Kunjungan : mengunjungi
            Kunjungan "0..*" --> "1..1" Dokter_Hewan : dilayani oleh
            Kunjungan "0..*" --> "1..1" Klinik : berlokasi di
            Kunjungan "0..*" --> "0..1" Resep : dapat memiliki
            Kunjungan "1..1" --> "0..*" Kunjungan_Lanjutan : dapat memiliki
            Kunjungan_Lanjutan "0..*" --> "0..1" Resep : dapat memiliki
            Dokter_Hewan "1..*" --> "1..*" Klinik : bekerja di
            Dokter_Hewan "0..*" --> "0..1" Spesialisasi : memiliki
            Resep "1..*" --> "1..1" Obat : menggunakan
        </div>
        <a href="../app.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
    </div>
</body>

</html>