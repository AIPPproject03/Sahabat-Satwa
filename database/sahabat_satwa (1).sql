-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2025 pada 17.29
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sahabat_satwa`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_dokter_hewan` (IN `v_dokter_id` VARCHAR(10))   BEGIN
    DELETE FROM Dokter_Hewan WHERE Dokter_ID = v_dokter_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_hewan` (IN `v_hewan_id` VARCHAR(10))   BEGIN
    DELETE FROM Hewan WHERE Hewan_ID = v_hewan_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_klinik` (IN `v_klinik_id` VARCHAR(10))   BEGIN
    DELETE FROM Klinik WHERE Klinik_ID = v_klinik_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_kunjungan` (IN `v_kunjungan_id` VARCHAR(10))   BEGIN
    DELETE FROM Kunjungan WHERE Kunjungan_ID = v_kunjungan_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_kunjungan_lanjutan` (IN `v_kunjungan_id` VARCHAR(10), IN `v_kunjungan_lanjutan_tgl` DATE)   BEGIN
    DELETE FROM Kunjungan_Lanjutan WHERE Kunjungan_ID = v_kunjungan_id AND Kunjungan_Lanjutan_Tgl = v_kunjungan_lanjutan_tgl;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_obat` (IN `v_obat_id` VARCHAR(10))   BEGIN
    DELETE FROM Obat WHERE Obat_ID = v_obat_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pawrent` (IN `v_pawrent_id` VARCHAR(10))   BEGIN
    DELETE FROM Pawrent WHERE Pawrent_ID = v_pawrent_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_resep` (IN `v_resep_id` VARCHAR(10))   BEGIN
    DELETE FROM Resep WHERE Resep_ID = v_resep_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_spesialisasi` (IN `v_dokter_id` VARCHAR(10))   BEGIN
    DELETE FROM Spesialisasi WHERE Dokter_ID = v_dokter_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_dokter_hewan` (IN `v_dokter_nama` VARCHAR(100), IN `v_dokter_telp` VARCHAR(20), IN `v_dokter_tgl_mulai_kerja` DATE, IN `v_klinik_id` VARCHAR(10))   BEGIN
    INSERT INTO Dokter_Hewan(Dokter_Nama, Dokter_Telp, Dokter_Tgl_Mulai_Kerja, Klinik_ID) VALUES(v_dokter_nama, v_dokter_telp, v_dokter_tgl_mulai_kerja, v_klinik_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_hewan` (IN `v_hewan_nama` VARCHAR(100), IN `v_hewan_tahun_lahir` INT, IN `v_hewan_jenis` VARCHAR(50), IN `v_pawrent_id` VARCHAR(10))   BEGIN
    INSERT INTO Hewan(Hewan_Nama, Hewan_Tahun_Lahir, Hewan_Jenis, Pawrent_ID) VALUES(v_hewan_nama, v_hewan_tahun_lahir, v_hewan_jenis, v_pawrent_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_klinik` (IN `v_klinik_nama` VARCHAR(100), IN `v_klinik_alamat` TEXT, IN `v_klinik_telp` VARCHAR(20))   BEGIN
    INSERT INTO Klinik(Klinik_Nama, Klinik_Alamat, Klinik_Telp) VALUES(v_klinik_nama, v_klinik_alamat, v_klinik_telp);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_kunjungan` (IN `v_kunjungan_tgl` DATE, IN `v_kunjungan_keterangan` TEXT, IN `v_hewan_id` VARCHAR(10), IN `v_dokter_id` VARCHAR(10), IN `v_klinik_id` VARCHAR(10), IN `v_resep_id` VARCHAR(10))   BEGIN
    INSERT INTO Kunjungan(Kunjungan_Tgl, Kunjungan_Keterangan, Hewan_ID, Dokter_ID, Klinik_ID, Resep_ID) VALUES(v_kunjungan_tgl, v_kunjungan_keterangan, v_hewan_id, v_dokter_id, v_klinik_id, v_resep_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_kunjungan_lanjutan` (IN `v_kunjungan_id` VARCHAR(10), IN `v_kunjungan_lanjutan_tgl` DATE, IN `v_kunjungan_lanjutan_keterangan` TEXT, IN `v_resep_id` VARCHAR(10))   BEGIN
    INSERT INTO Kunjungan_Lanjutan(Kunjungan_ID, Kunjungan_Lanjutan_Tgl, Kunjungan_Lanjutan_Keterangan, Resep_ID) VALUES(v_kunjungan_id, v_kunjungan_lanjutan_tgl, v_kunjungan_lanjutan_keterangan, v_resep_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_obat` (IN `v_obat_nama` VARCHAR(100), IN `v_obat_instruction` TEXT)   BEGIN
    INSERT INTO Obat(Obat_Nama, Obat_Instruction) VALUES(v_obat_nama, v_obat_instruction);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_pawrent` (IN `v_pawrent_nama` VARCHAR(100), IN `v_pawrent_telp` VARCHAR(20))   BEGIN
    INSERT INTO Pawrent(Pawrent_Nama, Pawrent_Telp) VALUES(v_pawrent_nama, v_pawrent_telp);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_resep` (IN `v_dokter_id` VARCHAR(10), IN `v_obat_id` VARCHAR(10), IN `v_resep_dosis` TEXT, IN `v_resep_frekuensi_pemberian` TEXT)   BEGIN
    INSERT INTO Resep(Dokter_ID, Obat_ID, Resep_Dosis, Resep_Frekuensi_Pemberian) VALUES(v_dokter_id, v_obat_id, v_resep_dosis, v_resep_frekuensi_pemberian);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_spesialisasi` (IN `v_dokter_id` VARCHAR(10), IN `v_spesialisasi` VARCHAR(100))   BEGIN
    INSERT INTO Spesialisasi(Dokter_ID, Spesialisasi) VALUES(v_dokter_id, v_spesialisasi);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_kunjungan_detail` (IN `v_kunjungan_id` VARCHAR(10))   BEGIN
    SELECT Kunjungan.Kunjungan_ID, Kunjungan.Kunjungan_Tgl, Kunjungan.Kunjungan_Keterangan, Hewan.Hewan_Nama, Hewan.Hewan_Jenis, Pawrent.Pawrent_Nama, Dokter_Hewan.Dokter_Nama, Klinik.Klinik_Nama
    FROM Kunjungan
    JOIN Hewan ON Kunjungan.Hewan_ID = Hewan.Hewan_ID
    JOIN Pawrent ON Hewan.Pawrent_ID = Pawrent.Pawrent_ID
    JOIN Dokter_Hewan ON Kunjungan.Dokter_ID = Dokter_Hewan.Dokter_ID
    JOIN Klinik ON Kunjungan.Klinik_ID = Klinik.Klinik_ID
    WHERE Kunjungan.Kunjungan_ID = v_kunjungan_id;

    SELECT Kunjungan_Lanjutan.Kunjungan_Lanjutan_Tgl, Kunjungan_Lanjutan.Kunjungan_Lanjutan_Keterangan
    FROM Kunjungan_Lanjutan
    WHERE Kunjungan_Lanjutan.Kunjungan_ID = v_kunjungan_id;

    SELECT Obat.Obat_Nama, Resep.Resep_Dosis, Resep.Resep_Frekuensi_Pemberian
    FROM Resep
    JOIN Obat ON Resep.Obat_ID = Obat.Obat_ID
    WHERE Resep.Kunjungan_ID = v_kunjungan_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_dokter_hewan` (IN `v_dokter_id` VARCHAR(10), IN `v_dokter_nama` VARCHAR(100), IN `v_dokter_telp` VARCHAR(20), IN `v_dokter_tgl_mulai_kerja` DATE, IN `v_klinik_id` VARCHAR(10))   BEGIN
    UPDATE Dokter_Hewan SET Dokter_Nama = v_dokter_nama, Dokter_Telp = v_dokter_telp, Dokter_Tgl_Mulai_Kerja = v_dokter_tgl_mulai_kerja, Klinik_ID = v_klinik_id WHERE Dokter_ID = v_dokter_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_hewan` (IN `v_hewan_id` VARCHAR(10), IN `v_hewan_nama` VARCHAR(100), IN `v_hewan_tahun_lahir` INT, IN `v_hewan_jenis` VARCHAR(50), IN `v_pawrent_id` VARCHAR(10))   BEGIN
    UPDATE Hewan SET Hewan_Nama = v_hewan_nama, Hewan_Tahun_Lahir = v_hewan_tahun_lahir, Hewan_Jenis = v_hewan_jenis, Pawrent_ID = v_pawrent_id WHERE Hewan_ID = v_hewan_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_klinik` (IN `v_klinik_id` VARCHAR(10), IN `v_klinik_nama` VARCHAR(100), IN `v_klinik_alamat` TEXT, IN `v_klinik_telp` VARCHAR(20))   BEGIN
    UPDATE Klinik SET Klinik_Nama = v_klinik_nama, Klinik_Alamat = v_klinik_alamat, Klinik_Telp = v_klinik_telp WHERE Klinik_ID = v_klinik_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_kunjungan` (IN `v_kunjungan_id` VARCHAR(10), IN `v_kunjungan_tgl` DATE, IN `v_kunjungan_keterangan` TEXT, IN `v_hewan_id` VARCHAR(10), IN `v_dokter_id` VARCHAR(10), IN `v_klinik_id` VARCHAR(10), IN `v_resep_id` VARCHAR(10))   BEGIN
    UPDATE Kunjungan SET Kunjungan_Tgl = v_kunjungan_tgl, Kunjungan_Keterangan = v_kunjungan_keterangan, Hewan_ID = v_hewan_id, Dokter_ID = v_dokter_id, Klinik_ID = v_klinik_id, Resep_ID = v_resep_id WHERE Kunjungan_ID = v_kunjungan_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_kunjungan_lanjutan` (IN `v_kunjungan_id` VARCHAR(10), IN `v_kunjungan_lanjutan_tgl` DATE, IN `v_kunjungan_lanjutan_keterangan` TEXT, IN `v_resep_id` VARCHAR(10))   BEGIN
    UPDATE Kunjungan_Lanjutan SET Kunjungan_Lanjutan_Keterangan = v_kunjungan_lanjutan_keterangan, Resep_ID = v_resep_id WHERE Kunjungan_ID = v_kunjungan_id AND Kunjungan_Lanjutan_Tgl = v_kunjungan_lanjutan_tgl;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_obat` (IN `v_obat_id` VARCHAR(10), IN `v_obat_nama` VARCHAR(100), IN `v_obat_instruction` TEXT)   BEGIN
    UPDATE Obat SET Obat_Nama = v_obat_nama, Obat_Instruction = v_obat_instruction WHERE Obat_ID = v_obat_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pawrent` (IN `v_pawrent_id` VARCHAR(10), IN `v_pawrent_nama` VARCHAR(100), IN `v_pawrent_telp` VARCHAR(20))   BEGIN
    UPDATE Pawrent SET Pawrent_Nama = v_pawrent_nama, Pawrent_Telp = v_pawrent_telp WHERE Pawrent_ID = v_pawrent_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_resep` (IN `v_resep_id` VARCHAR(10), IN `v_dokter_id` VARCHAR(10), IN `v_obat_id` VARCHAR(10), IN `v_resep_dosis` TEXT, IN `v_resep_frekuensi_pemberian` TEXT)   BEGIN
    UPDATE Resep SET Dokter_ID = v_dokter_id, Obat_ID = v_obat_id, Resep_Dosis = v_resep_dosis, Resep_Frekuensi_Pemberian = v_resep_frekuensi_pemberian WHERE Resep_ID = v_resep_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_spesialisasi` (IN `v_dokter_id` VARCHAR(10), IN `v_spesialisasi` VARCHAR(100))   BEGIN
    UPDATE Spesialisasi SET Spesialisasi = v_spesialisasi WHERE Dokter_ID = v_dokter_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter_hewan`
--

CREATE TABLE `dokter_hewan` (
  `Dokter_ID` varchar(10) NOT NULL,
  `Dokter_Nama` varchar(100) DEFAULT NULL,
  `Dokter_Telp` varchar(20) DEFAULT NULL,
  `Dokter_Tgl_Mulai_Kerja` date DEFAULT NULL,
  `Klinik_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter_hewan`
--

INSERT INTO `dokter_hewan` (`Dokter_ID`, `Dokter_Nama`, `Dokter_Telp`, `Dokter_Tgl_Mulai_Kerja`, `Klinik_ID`) VALUES
('DH-001', 'Drh. Irwin', '081234567890', '2021-01-01', 'K-001'),
('DH-002', 'Drh. Ebi', '081234567891', '2021-01-01', 'K-002'),
('DH-003', 'Drh. Yoshi', '081234567892', '2021-01-01', 'K-001');

--
-- Trigger `dokter_hewan`
--
DELIMITER $$
CREATE TRIGGER `auto_id_dokter_hewan` BEFORE INSERT ON `dokter_hewan` FOR EACH ROW BEGIN
        DECLARE v_id_dokter VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Dokter_Hewan);
        SET v_id_dokter = CONCAT('DH-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Dokter_ID = v_id_dokter;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hewan`
--

CREATE TABLE `hewan` (
  `Hewan_ID` varchar(10) NOT NULL,
  `Hewan_Nama` varchar(100) DEFAULT NULL,
  `Hewan_Tahun_Lahir` int(11) DEFAULT NULL,
  `Hewan_Jenis` varchar(50) DEFAULT NULL,
  `Pawrent_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hewan`
--

INSERT INTO `hewan` (`Hewan_ID`, `Hewan_Nama`, `Hewan_Tahun_Lahir`, `Hewan_Jenis`, `Pawrent_ID`) VALUES
('H-001', 'Yokoso', 2002, 'Anjing', 'P-001'),
('H-002', 'Kebab', 2015, 'Kucing', 'P-002');

--
-- Trigger `hewan`
--
DELIMITER $$
CREATE TRIGGER `auto_id_hewan` BEFORE INSERT ON `hewan` FOR EACH ROW BEGIN
        DECLARE v_id_hewan VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Hewan);
        SET v_id_hewan = CONCAT('H-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Hewan_ID = v_id_hewan;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `klinik`
--

CREATE TABLE `klinik` (
  `Klinik_ID` varchar(10) NOT NULL,
  `Klinik_Nama` varchar(100) DEFAULT NULL,
  `Klinik_Alamat` text DEFAULT NULL,
  `Klinik_Telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `klinik`
--

INSERT INTO `klinik` (`Klinik_ID`, `Klinik_Nama`, `Klinik_Alamat`, `Klinik_Telp`) VALUES
('K-001', 'Klinik Hewan Sejahtera', 'Jl. Raya Kebayoran Lama No. 12, Jakarta Selatan', '081-12345678'),
('K-002', 'Klinik Hewan Bahagia', 'Jl. Raya Kebayoran Baru No. 34, Jakarta Selatan', '021-87654321');

--
-- Trigger `klinik`
--
DELIMITER $$
CREATE TRIGGER `auto_id_klinik` BEFORE INSERT ON `klinik` FOR EACH ROW BEGIN
        DECLARE v_id_klinik VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Klinik);
        SET v_id_klinik = CONCAT('K-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Klinik_ID = v_id_klinik;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `Kunjungan_ID` varchar(10) NOT NULL,
  `Kunjungan_Tgl` date DEFAULT NULL,
  `Kunjungan_Keterangan` text DEFAULT NULL,
  `Hewan_ID` varchar(10) DEFAULT NULL,
  `Dokter_ID` varchar(10) DEFAULT NULL,
  `Klinik_ID` varchar(10) DEFAULT NULL,
  `Resep_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan`
--

INSERT INTO `kunjungan` (`Kunjungan_ID`, `Kunjungan_Tgl`, `Kunjungan_Keterangan`, `Hewan_ID`, `Dokter_ID`, `Klinik_ID`, `Resep_ID`) VALUES
('KJ-001', '2025-02-18', 'Periksa Kutu', 'H-001', 'DH-001', 'K-001', NULL),
('KJ-002', '2025-02-18', 'Periksa kesehatan', 'H-002', 'DH-002', 'K-002', NULL);

--
-- Trigger `kunjungan`
--
DELIMITER $$
CREATE TRIGGER `auto_id_kunjungan` BEFORE INSERT ON `kunjungan` FOR EACH ROW BEGIN
        DECLARE v_id_kunjungan VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Kunjungan);
        SET v_id_kunjungan = CONCAT('KJ-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Kunjungan_ID = v_id_kunjungan;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_lanjutan`
--

CREATE TABLE `kunjungan_lanjutan` (
  `Kunjungan_ID` varchar(10) DEFAULT NULL,
  `Resep_ID` varchar(10) DEFAULT NULL,
  `Kunjungan_Lanjutan_Tgl` date DEFAULT NULL,
  `Kunjungan_Lanjutan_Keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan_lanjutan`
--

INSERT INTO `kunjungan_lanjutan` (`Kunjungan_ID`, `Resep_ID`, `Kunjungan_Lanjutan_Tgl`, `Kunjungan_Lanjutan_Keterangan`) VALUES
('KJ-001', 'R-001', '2025-02-20', 'Awokawok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `Obat_ID` varchar(10) NOT NULL,
  `Obat_Nama` varchar(100) DEFAULT NULL,
  `Obat_Instruction` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`Obat_ID`, `Obat_Nama`, `Obat_Instruction`) VALUES
('O-001', 'Obat Cacing', 'Diberikan 1x sehari setelah makan'),
('O-002', 'Obat Kutu', 'Diberikan 1x sehari sebelum makan');

--
-- Trigger `obat`
--
DELIMITER $$
CREATE TRIGGER `auto_id_obat` BEFORE INSERT ON `obat` FOR EACH ROW BEGIN
        DECLARE v_id_obat VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Obat);
        SET v_id_obat = CONCAT('O-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Obat_ID = v_id_obat;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pawrent`
--

CREATE TABLE `pawrent` (
  `Pawrent_ID` varchar(10) NOT NULL,
  `Pawrent_Nama` varchar(100) DEFAULT NULL,
  `Pawrent_Telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pawrent`
--

INSERT INTO `pawrent` (`Pawrent_ID`, `Pawrent_Nama`, `Pawrent_Telp`) VALUES
('P-001', 'Budi', '08545344234'),
('P-002', 'Anin', '081234567891');

--
-- Trigger `pawrent`
--
DELIMITER $$
CREATE TRIGGER `auto_id_pawrent` BEFORE INSERT ON `pawrent` FOR EACH ROW BEGIN
        DECLARE v_id_pawrent VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Pawrent);
        SET v_id_pawrent = CONCAT('P-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Pawrent_ID = v_id_pawrent;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `Resep_ID` varchar(10) NOT NULL,
  `Dokter_ID` varchar(10) DEFAULT NULL,
  `Obat_ID` varchar(10) DEFAULT NULL,
  `Resep_Dosis` text DEFAULT NULL,
  `Resep_Frekuensi_Pemberian` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`Resep_ID`, `Dokter_ID`, `Obat_ID`, `Resep_Dosis`, `Resep_Frekuensi_Pemberian`) VALUES
('R-001', 'DH-001', 'O-002', '12', '3 x sehari'),
('R-002', 'DH-001', 'O-001', '3', '5 x sehari');

--
-- Trigger `resep`
--
DELIMITER $$
CREATE TRIGGER `auto_id_resep` BEFORE INSERT ON `resep` FOR EACH ROW BEGIN
        DECLARE v_id_resep VARCHAR(10);
        DECLARE v_counter INT;
        SET v_counter = (SELECT COUNT(*) FROM Resep);
        SET v_id_resep = CONCAT('R-', LPAD(v_counter + 1, 3, '0'));
        SET NEW.Resep_ID = v_id_resep;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spesialisasi`
--

CREATE TABLE `spesialisasi` (
  `Dokter_ID` varchar(10) NOT NULL,
  `Spesialisasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `spesialisasi`
--

INSERT INTO `spesialisasi` (`Dokter_ID`, `Spesialisasi`) VALUES
('DH-001', 'Onkologi'),
('DH-002', 'Kardiologi'),
('DH-003', 'Kucing');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter_hewan`
--
ALTER TABLE `dokter_hewan`
  ADD PRIMARY KEY (`Dokter_ID`),
  ADD KEY `Klinik_ID` (`Klinik_ID`);

--
-- Indeks untuk tabel `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`Hewan_ID`),
  ADD KEY `Pawrent_ID` (`Pawrent_ID`);

--
-- Indeks untuk tabel `klinik`
--
ALTER TABLE `klinik`
  ADD PRIMARY KEY (`Klinik_ID`);

--
-- Indeks untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`Kunjungan_ID`),
  ADD KEY `Hewan_ID` (`Hewan_ID`),
  ADD KEY `Klinik_ID` (`Klinik_ID`),
  ADD KEY `Dokter_ID` (`Dokter_ID`),
  ADD KEY `Resep_ID` (`Resep_ID`);

--
-- Indeks untuk tabel `kunjungan_lanjutan`
--
ALTER TABLE `kunjungan_lanjutan`
  ADD KEY `Kunjungan_ID` (`Kunjungan_ID`),
  ADD KEY `kunjungan_lanjutan_ibfk_2` (`Resep_ID`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`Obat_ID`);

--
-- Indeks untuk tabel `pawrent`
--
ALTER TABLE `pawrent`
  ADD PRIMARY KEY (`Pawrent_ID`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`Resep_ID`),
  ADD KEY `Dokter_ID` (`Dokter_ID`),
  ADD KEY `Obat_ID` (`Obat_ID`);

--
-- Indeks untuk tabel `spesialisasi`
--
ALTER TABLE `spesialisasi`
  ADD PRIMARY KEY (`Dokter_ID`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokter_hewan`
--
ALTER TABLE `dokter_hewan`
  ADD CONSTRAINT `dokter_hewan_ibfk_1` FOREIGN KEY (`Klinik_ID`) REFERENCES `klinik` (`Klinik_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hewan`
--
ALTER TABLE `hewan`
  ADD CONSTRAINT `hewan_ibfk_1` FOREIGN KEY (`Pawrent_ID`) REFERENCES `pawrent` (`Pawrent_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`Hewan_ID`) REFERENCES `hewan` (`Hewan_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`Klinik_ID`) REFERENCES `klinik` (`Klinik_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunjungan_ibfk_3` FOREIGN KEY (`Dokter_ID`) REFERENCES `dokter_hewan` (`Dokter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunjungan_ibfk_4` FOREIGN KEY (`Resep_ID`) REFERENCES `resep` (`Resep_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kunjungan_lanjutan`
--
ALTER TABLE `kunjungan_lanjutan`
  ADD CONSTRAINT `kunjungan_lanjutan_ibfk_1` FOREIGN KEY (`Kunjungan_ID`) REFERENCES `kunjungan` (`Kunjungan_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunjungan_lanjutan_ibfk_2` FOREIGN KEY (`Resep_ID`) REFERENCES `resep` (`Resep_ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`Dokter_ID`) REFERENCES `dokter_hewan` (`Dokter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`Obat_ID`) REFERENCES `obat` (`Obat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `spesialisasi`
--
ALTER TABLE `spesialisasi`
  ADD CONSTRAINT `spesialisasi_ibfk_1` FOREIGN KEY (`Dokter_ID`) REFERENCES `dokter_hewan` (`Dokter_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
