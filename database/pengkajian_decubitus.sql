-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2026 at 07:34 AM
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
-- Table structure for table `pengkajian_decubitus`
--

CREATE TABLE `pengkajian_decubitus` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) DEFAULT NULL,
  `persepsi_sensori` tinyint(1) NOT NULL COMMENT '1=Sama sekali terbatas, 2=Sangat terbatas, 3=Sedikit terbatas, 4=Tidak terganggu',
  `kelembaban` tinyint(1) NOT NULL COMMENT '1=Lembab terus, 2=Sering lembab, 3=Kadang lembab, 4=Jarang lembab',
  `aktifitas` tinyint(1) NOT NULL COMMENT '1=Baring Total, 2=Duduk di kursi, 3=Kadang jalan-jalan, 4=Sering berjalan',
  `mobilitas` tinyint(1) NOT NULL COMMENT '1=Immobilitas, 2=Sangat terbatas, 3=Sedikit terbatas, 4=Tidak terbatas',
  `nutrisi` tinyint(1) NOT NULL COMMENT '1=Sangat buruk, 2=Tidak adekuat, 3=Adekuat, 4=Sangat baik',
  `gesekan` tinyint(1) NOT NULL COMMENT '1=Bermasalah, 2=Potensial bermasalah, 3=Tidak bermasalah',
  `total_skor` tinyint(2) DEFAULT NULL,
  `kategori_resiko` enum('Resiko Rendah','Resiko Sedang','Resiko Tinggi','Tidak Ada Resiko') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengkajian_decubitus`
--
ALTER TABLE `pengkajian_decubitus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_decubitus_kunjungan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengkajian_decubitus`
--
ALTER TABLE `pengkajian_decubitus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengkajian_decubitus`
--
ALTER TABLE `pengkajian_decubitus`
  ADD CONSTRAINT `fk_decubitus_kunjungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;