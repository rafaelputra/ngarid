-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2026 at 03:37 AM
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
USE `ngarid`;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `asesmen_resiko_jatuh_dewasa`;

--
-- Table structure for table `asesmen_resiko_jatuh_dewasa`
--

CREATE TABLE `asesmen_resiko_jatuh_dewasa` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `no_rkm_medis` varchar(15) NOT NULL,
  `tanggal_asesmen` datetime DEFAULT current_timestamp(),

  `tgl_1` date DEFAULT NULL,
  `skor1_riwayat_jatuh` tinyint(4) DEFAULT 0,
  `skor1_diagnosa_sekunder` tinyint(4) DEFAULT 0,
  `skor1_alat_bantu` tinyint(4) DEFAULT 0,
  `skor1_terpasang_infus` tinyint(4) DEFAULT 0,
  `skor1_cara_berjalan` tinyint(4) DEFAULT 0,
  `skor1_status_mental` tinyint(4) DEFAULT 0,
  `skor1_total` tinyint(4) DEFAULT 0,
  `skor1_kategori` varchar(2) DEFAULT NULL,

  `tgl_2` date DEFAULT NULL,
  `skor2_riwayat_jatuh` tinyint(4) DEFAULT NULL,
  `skor2_diagnosa_sekunder` tinyint(4) DEFAULT NULL,
  `skor2_alat_bantu` tinyint(4) DEFAULT NULL,
  `skor2_terpasang_infus` tinyint(4) DEFAULT NULL,
  `skor2_cara_berjalan` tinyint(4) DEFAULT NULL,
  `skor2_status_mental` tinyint(4) DEFAULT NULL,
  `skor2_total` tinyint(4) DEFAULT NULL,
  `skor2_kategori` varchar(2) DEFAULT NULL,

  `tgl_3` date DEFAULT NULL,
  `skor3_riwayat_jatuh` tinyint(4) DEFAULT NULL,
  `skor3_diagnosa_sekunder` tinyint(4) DEFAULT NULL,
  `skor3_alat_bantu` tinyint(4) DEFAULT NULL,
  `skor3_terpasang_infus` tinyint(4) DEFAULT NULL,
  `skor3_cara_berjalan` tinyint(4) DEFAULT NULL,
  `skor3_status_mental` tinyint(4) DEFAULT NULL,
  `skor3_total` tinyint(4) DEFAULT NULL,
  `skor3_kategori` varchar(2) DEFAULT NULL,

  `pilih_setelah_1` varchar(2) DEFAULT NULL,
  `pilih_setelah_2` varchar(2) DEFAULT NULL,
  `pilih_setelah_3` varchar(2) DEFAULT NULL,

  `perawat_penilai` varchar(100) DEFAULT NULL,
  `paraf_perawat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asesmen_resiko_jatuh_dewasa`
--
ALTER TABLE `asesmen_resiko_jatuh_dewasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jatuh_kunjungan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asesmen_resiko_jatuh_dewasa`
--
ALTER TABLE `asesmen_resiko_jatuh_dewasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asesmen_resiko_jatuh_dewasa`
--
ALTER TABLE `asesmen_resiko_jatuh_dewasa`
  ADD CONSTRAINT `fk_jatuh_kunjungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
