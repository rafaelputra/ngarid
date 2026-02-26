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
-- Table structure for table `status_nutrisi`
--

CREATE TABLE `status_nutrisi` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `penurunan_bb_opsi` varchar(5) NOT NULL,
  `penurunan_bb_skor` tinyint(1) NOT NULL DEFAULT 0,
  `asupan_makanan_dlo` enum('Tidak','Ya') DEFAULT NULL,
  `diagnosa_khusus` enum('DM','CKD','Infeksi Kronis','Lain-lain') NOT NULL,
  `diagnosa_khusus_lainnya` varchar(50) DEFAULT NULL,
  `asupan_makanan_og` enum('Tidak','Ya') DEFAULT NULL,
  `ada_pertambahan` enum('Tidak','Ya') DEFAULT NULL,
  `nilai_hb_hct` enum('Tidak','Ya') DEFAULT NULL,
  `kondisi_khusus` enum('Tidak','Ya') NOT NULL,
  `kondisi_khusus_ya` enum('DM','Gangguan fungsi thyroid','Infeksi kronis','TB','HIV/AIDS','Lupus','Lainnya') NOT NULL,
  `kondisi_khusus_lainnya` varchar(50) DEFAULT NULL,
  `kesimpulan_og` enum('Ya','Tidak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `status_nutrisi`
--
ALTER TABLE `status_nutrisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kunjungan_status_nutrisi` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status_nutrisi`
--
ALTER TABLE `status_nutrisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `status_nutrisi`
--
ALTER TABLE `status_nutrisi`
  ADD CONSTRAINT `FK_kunjungan_status_nutrisi` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
