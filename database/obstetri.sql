-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2026 at 06:05 AM
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
-- Table structure for table `obstetri`
--

CREATE TABLE `obstetri` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `is_hamil` enum('Tidak','Ya') DEFAULT NULL,
  `hpht` date DEFAULT NULL,
  `hpl` date DEFAULT NULL,
  `usia_hamil` int(11) DEFAULT NULL,
  `status_g` varchar(100) DEFAULT NULL,
  `status_p` varchar(100) DEFAULT NULL,
  `status_a` varchar(100) DEFAULT NULL,
  `penyulit_kehamilan` enum('Tidak Ada','Ada') DEFAULT NULL,
  `detail_penyulit` text DEFAULT NULL,
  `riwayat_mens` enum('Teratur','Tidak Teratur','Monopause','Dismenorea') DEFAULT NULL,
  `post_partum` enum('Tidak','Ya') DEFAULT NULL,
  `post_partum_hari` int(11) DEFAULT NULL,
  `riwayat_persalinan` enum('Partus Spontan','Sectio Caesaria','Partus Spontan dengan Penyulit','Partus dengan tindakan lainnya') DEFAULT NULL,
  `partus_spontan_jelaskan` varchar(50) DEFAULT NULL,
  `partus_tindakan_jelaskan` varchar(50) DEFAULT NULL,
  `lochea` varchar(50) DEFAULT NULL,
  `lochea_jumlah` varchar(50) DEFAULT NULL,
  `payudara` varchar(50) DEFAULT NULL,
  `pengeluaran_asi` varchar(50) DEFAULT NULL,
  `kontraksi` varchar(50) DEFAULT NULL,
  `riwayat_papsmear` enum('Tidak Pernah','Pernah') DEFAULT NULL,
  `papsmear_tanggal` date DEFAULT NULL,
  `papsmear_hasil` varchar(50) DEFAULT NULL,
  `mammografi` enum('Tidak Pernah','Pernah') DEFAULT NULL,
  `mammografi_tanggal` date DEFAULT NULL,
  `mammografi_hasil` varchar(50) DEFAULT NULL,
  `sadari` enum('Tidak Pernah','Pernah') DEFAULT NULL,
  `sadari_tanggal` date DEFAULT NULL,
  `sadari_hasil` varchar(50) DEFAULT NULL,
  `informasi_tambahan` enum('Tidak Ada','Ada') DEFAULT NULL,
  `informasi_tambahan_ada` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obstetri`
--
ALTER TABLE `obstetri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_obstetri_kunjungan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obstetri`
--
ALTER TABLE `obstetri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `obstetri`
--
ALTER TABLE `obstetri`
  ADD CONSTRAINT `fk_obstetri_kunjungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
