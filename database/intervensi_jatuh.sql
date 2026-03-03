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

DROP TABLE IF EXISTS `intervensi_jatuh`;

--
-- Table structure for table `intervensi_jatuh`
--

CREATE TABLE `intervensi_jatuh` (
  `id_intervensi` int(11) NOT NULL,
  `id_pengkajian` int(11) NOT NULL,
  `tgl_tindakan` date NOT NULL,
  `shift` enum('P','S','M') NOT NULL,

  `rt_saran_bantuan` tinyint(1) DEFAULT 0,
  `rt_tempatkan_bel` tinyint(1) DEFAULT 0,
  `rt_posisi_tidur_roda` tinyint(1) DEFAULT 0,
  `rt_gelang_resiko` tinyint(1) DEFAULT 0,
  `rt_segitiga_kuning` tinyint(1) DEFAULT 0,
  `rt_pegangan_tangan` tinyint(1) DEFAULT 0,
  `rt_kamar_mandi_pispot` tinyint(1) DEFAULT 0,
  `rt_observasi_2_3_jam` tinyint(1) DEFAULT 0,
  `rt_orientasi_kamar` tinyint(1) DEFAULT 0,
  `rt_pantau_efek_obat` tinyint(1) DEFAULT 0,
  `rt_bantu_ambulasi` tinyint(1) DEFAULT 0,
  `rt_benda_dekat_pasien` tinyint(1) DEFAULT 0,
  `rt_lantai_bersih_kering` tinyint(1) DEFAULT 0,

  `rs_saran_bantuan` tinyint(1) DEFAULT 0,
  `rs_tempatkan_bel` tinyint(1) DEFAULT 0,
  `rs_posisi_tidur_roda` tinyint(1) DEFAULT 0,
  `rs_pegangan_tangan` tinyint(1) DEFAULT 0,
  `rs_bantu_ambulasi` tinyint(1) DEFAULT 0,
  `rs_benda_dekat_pasien` tinyint(1) DEFAULT 0,
  `rs_lantai_bersih_kering` tinyint(1) DEFAULT 0,

  `rr_monitor_tanda_vital` tinyint(1) DEFAULT 0,
  `rr_pengaman_tempat_tidur` tinyint(1) DEFAULT 0,

  `nama_perawat_shift` varchar(100) DEFAULT NULL,
  `paraf_perawat_shift` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `intervensi_jatuh`
--
ALTER TABLE `intervensi_jatuh`
  ADD PRIMARY KEY (`id_intervensi`),
  ADD KEY `fk_intervensi_pengkajian` (`id_pengkajian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `intervensi_jatuh`
--
ALTER TABLE `intervensi_jatuh`
  MODIFY `id_intervensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `intervensi_jatuh`
--
ALTER TABLE `intervensi_jatuh`
  ADD CONSTRAINT `fk_intervensi_pengkajian` FOREIGN KEY (`id_pengkajian`) REFERENCES `asesmen_resiko_jatuh_dewasa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
