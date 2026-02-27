-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2026 at 05:10 AM
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
-- Table structure for table `kebutuhan_komunikasi_edukasi`
--

CREATE TABLE `kebutuhan_komunikasi_edukasi` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `edukasi_diberikan` set('Proses Penyakit','Rehab Medis','Psikologis','Pengobatan/Tindakan','Penanganan Nyeri','Nutrisi','Terapi/Obat','Perawatan di Rumah','Perawatan di RS','Lain-lain') NOT NULL,
  `edukasi_diberikan_rs` varchar(100) DEFAULT NULL,
  `edukasi_diberikan_lain_lain` varchar(100) DEFAULT NULL,
  `keyakinan_penyakit` enum('Yakin Sembuh','Pasrah','Lain-lain') NOT NULL,
  `keyakinan_penyakit_lainnya` varchar(100) NOT NULL,
  `bicara` enum('Normal','Gangguan Bicara') NOT NULL,
  `gangguan_bicara_sejak` varchar(100) DEFAULT NULL,
  `bahasa_sehari` enum('Indonesia','Inggris','Daerah','Lain-lain') NOT NULL,
  `indonesia_ap` enum('aktif','pasif') NOT NULL,
  `inggris_ap` enum('aktif','pasif') NOT NULL,
  `daerah_jelaskan` varchar(30) NOT NULL,
  `lain_jelaskan` varchar(30) NOT NULL,
  `perlu_penerjemah` enum('Tidak','Ya','Bahasa Isyarat') NOT NULL,
  `ya_bahasa` varchar(20) NOT NULL,
  `bs_ya_tidak` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kebutuhan_komunikasi_edukasi`
--
ALTER TABLE `kebutuhan_komunikasi_edukasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kebutuhan_komunikasi_kunjungan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kebutuhan_komunikasi_edukasi`
--
ALTER TABLE `kebutuhan_komunikasi_edukasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kebutuhan_komunikasi_edukasi`
--
ALTER TABLE `kebutuhan_komunikasi_edukasi`
  ADD CONSTRAINT `fk_kebutuhan_komunikasi_kunjungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
