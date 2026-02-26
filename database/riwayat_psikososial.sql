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
-- Table structure for table `riwayat_psikososial`
--

CREATE TABLE `riwayat_psikososial` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `ditemukan_kondisi` set('Tidak Semangat','Rasa Tertekan','Sulit Tidur','Cepat Lelah','Sulit Berbicara','Merasa Bersalah','Sedih / Murung','Cemas','Sulit Konsentrasi') DEFAULT NULL,
  `riwayat_gangguan_jiwa` tinyint(1) NOT NULL DEFAULT 0,
  `detail_gangguan_jiwa` varchar(255) DEFAULT NULL,
  `riwayat_keluarga_gangguan_jiwa` tinyint(1) NOT NULL DEFAULT 0,
  `siapa_keluarga_gangguan_jiwa` varchar(255) DEFAULT NULL,
  `adanya_perilaku` set('Perilaku Kekerasan','Waham','Halusinasi','Gangguan Interaksi Sosial','Gangguan Persepsi Diri','Gangguan Mood','Gangguan Afektif','Gangguan Tingkat Konsentrasi dan Berhitung','Gangguan Memori','Gangguan Proses Pikir','Gangguan Tingkat Kesadaran') DEFAULT NULL,
  `status_pernikahan` enum('Menikah','Belum Menikah','Duda','Janda') NOT NULL DEFAULT 'Menikah',
  `tinggal_dengan` enum('Orang Tua','Suami / Istri','Sendiri') NOT NULL DEFAULT 'Orang Tua',
  `keluarga_terdekat` varchar(100) DEFAULT NULL,
  `hubungan_keluarga` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `curiga_penganiayaan_penelantaran` enum('Ya','Tidak') DEFAULT 'Tidak',
  `kegiatan_ibadah` varchar(255) DEFAULT NULL,
  `nilai_bertentangan_kesehatan` varchar(255) DEFAULT NULL,
  `jenis_pembayaran` enum('Umum','BPJS Non PBI','BPJS PBI','Lain-lain') NOT NULL DEFAULT 'Umum',
  `pembayaran_lain_lain` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riwayat_psikososial`
--
ALTER TABLE `riwayat_psikososial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_kujungan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riwayat_psikososial`
--
ALTER TABLE `riwayat_psikososial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `riwayat_psikososial`
--
ALTER TABLE `riwayat_psikososial`
  ADD CONSTRAINT `fk_riwayat_kujungan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
