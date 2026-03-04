-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2026 at 03:03 AM
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
-- Table structure for table `tingkat_penilaian_nyeri_cpot`
--

CREATE TABLE `tingkat_penilaian_nyeri_cpot` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) DEFAULT NULL,
  `ekspresi_wajah` tinyint(1) DEFAULT NULL COMMENT '0:Santai, 1:Tegang, 2:Menyeringai',
  `gerakan_tubuh` tinyint(1) DEFAULT NULL COMMENT '0:Tenang, 1:Melindungi, 2:Gelisah',
  `ketegangan_otot` tinyint(1) DEFAULT NULL COMMENT '0:Rileks, 1:Agak Kaku, 2:Sangat Kaku',
  `penerimaan_ventilator` tinyint(1) DEFAULT NULL COMMENT '0:Toleran, 1:Sering Batuk, 2:Melawan',
  `tanpa_ventilator` tinyint(1) DEFAULT NULL COMMENT '0:Nada Bicara, 1:Merintih, 2:Mengerang',
  `total_skor` tinyint(2) DEFAULT NULL,
  `kategori_resiko` enum('Tidak Nyeri','Nyeri Ringan','Nyeri Sedang','Nyeri Berat','Nyeri Berat Sekali') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tingkat_penilaian_nyeri_cpot`
--
ALTER TABLE `tingkat_penilaian_nyeri_cpot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kunjungan_cpot` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tingkat_penilaian_nyeri_cpot`
--
ALTER TABLE `tingkat_penilaian_nyeri_cpot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tingkat_penilaian_nyeri_cpot`
--
ALTER TABLE `tingkat_penilaian_nyeri_cpot`
  ADD CONSTRAINT `FK_kunjungan_cpot` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
