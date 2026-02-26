-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2026 at 03:22 AM
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
-- Table structure for table `penilaian_fisik`
--

CREATE TABLE `penilaian_fisik` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `kunjungan_umum_gcs` varchar(50) DEFAULT NULL,
  `kunjungan_umum_e` varchar(50) DEFAULT NULL,
  `kunjungan_umum_v` varchar(50) DEFAULT NULL,
  `kunjungan_umum_m` varchar(50) DEFAULT NULL,
  `kunjungan_umum_total` varchar(50) DEFAULT NULL,
  `tekanan_darah_sistolik` int(11) DEFAULT NULL,
  `tekanan_darah_diastolik` int(11) DEFAULT NULL,
  `nadi` int(11) DEFAULT NULL,
  `spo2` varchar(50) DEFAULT NULL,
  `suhu_tubuh` int(11) DEFAULT NULL,
  `respirasi` int(11) DEFAULT NULL,
  `gds` varchar(50) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `informasi_tambahan` tinyint(1) NOT NULL DEFAULT 0,
  `informasi_tambahan_jelaskan` varchar(255) DEFAULT NULL,
  `pernafasan` enum('Normal','Batuk','Sesak','Lain-lain') NOT NULL DEFAULT 'Normal',
  `pernafasan_lainnya` varchar(255) DEFAULT NULL,
  `penglihatan` enum('Baik','Rusak','Alat Bantu') NOT NULL DEFAULT 'Baik',
  `penglihatan_alat_bantu` varchar(255) DEFAULT NULL,
  `pendengaran` enum('Baik','Rusak','Alat Bantu') NOT NULL DEFAULT 'Baik',
  `pendengaran_alat_bantu` varchar(255) DEFAULT NULL,
  `mulut` enum('Bersih','Kotor','Lain-lain') NOT NULL DEFAULT 'Bersih',
  `mulut_lainnya` varchar(255) DEFAULT NULL,
  `reflek` enum('Normal','Sulit','Rusak') NOT NULL DEFAULT 'Normal',
  `menelan` enum('Normal','Gangguan') NOT NULL DEFAULT 'Normal',
  `bicara` enum('Normal','Gangguan') NOT NULL DEFAULT 'Normal',
  `luka` tinyint(1) NOT NULL DEFAULT 0,
  `luka_detail` text DEFAULT NULL,
  `defekasi` enum('Normal','Konstipasi','Inkontinensia alvi') NOT NULL DEFAULT 'Normal',
  `milksi` enum('Normal','Retensio','Inkontinensia uri') NOT NULL DEFAULT 'Normal',
  `gastrointestinal` enum('Normal','Refluks','Nausea','Muntah') NOT NULL DEFAULT 'Normal',
  `pola_tidur` tinyint(1) NOT NULL DEFAULT 0,
  `pola_tidur_masalah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penilaian_fisik`
--
ALTER TABLE `penilaian_fisik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_rawat` (`no_rawat`);

ALTER TABLE `penilaian_fisik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian_fisik`
--
ALTER TABLE `penilaian_fisik`
  ADD CONSTRAINT `fk_penilaian_kunjungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
