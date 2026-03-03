-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2026 at 07:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngarid`
--

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_barthel`
--

CREATE TABLE `penilaian_barthel` (
  `id_penilaian` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `tgl_pengkajian` date NOT NULL COMMENT 'Tanggal pengujian dilakukan (Tgl-Bln-Thn)',
  `periode` enum('Sebelum Sakit','Saat Masuk RS','Minggu I','Minggu II','Saat Pulang') NOT NULL,
  `skor_defekasi` tinyint(1) DEFAULT NULL COMMENT '0: Inkontinen/Tak teratur, 1: Kadang tak terkendali (1x seminggu), 2: Mandiri' CHECK (`skor_defekasi` between 0 and 2),
  `skor_berkemih` tinyint(1) DEFAULT NULL COMMENT '0: Inkontinen & pakai kateter, 1: Kadang tak terkendali (maks 1x24jam), 2: Mandiri' CHECK (`skor_berkemih` between 0 and 2),
  `skor_bersih_diri` tinyint(1) DEFAULT NULL COMMENT '0: Butuh pertolongan orang lain, 1: Mandiri' CHECK (`skor_bersih_diri` between 0 and 1),
  `skor_toilet` tinyint(1) DEFAULT NULL COMMENT '0: Tergantung orang lain, 1: Perlu pertolongan bbrp aktifitas, 2: Mandiri' CHECK (`skor_toilet` between 0 and 2),
  `skor_makan` tinyint(1) DEFAULT NULL COMMENT '0: Tidak mampu, 1: Perlu bantuan memotong makanan, 2: Mandiri' CHECK (`skor_makan` between 0 and 2),
  `skor_pindah_tempat` tinyint(1) DEFAULT NULL COMMENT '0: Tidak mampu, 1: Perlu banyak bantuan (2 org), 2: Bantuan minimal (1 org), 3: Mandiri' CHECK (`skor_pindah_tempat` between 0 and 3),
  `skor_mobilisasi` tinyint(1) DEFAULT NULL COMMENT '0: Tidak mampu, 1: Kursi roda, 2: Bantuan 1 orang/walker, 3: Mandiri' CHECK (`skor_mobilisasi` between 0 and 3),
  `skor_berpakaian` tinyint(1) DEFAULT NULL COMMENT '0: Tergantung orang lain, 1: Sebagian dibantu, 2: Mandiri' CHECK (`skor_berpakaian` between 0 and 2),
  `skor_tangga` tinyint(1) DEFAULT NULL COMMENT '0: Tidak mampu, 1: Butuh pertolongan, 2: Mandiri' CHECK (`skor_tangga` between 0 and 2),
  `skor_mandi` tinyint(1) DEFAULT NULL COMMENT '0: Tergantung orang lain, 1: Mandiri' CHECK (`skor_mandi` between 0 and 1),
  `total_skor` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penilaian_barthel`
--
ALTER TABLE `penilaian_barthel`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `fk_penilaian_kujungan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penilaian_barthel`
--
ALTER TABLE `penilaian_barthel`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian_barthel`
--
ALTER TABLE `penilaian_barthel`
  ADD CONSTRAINT `fk_penilaian_kujungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
