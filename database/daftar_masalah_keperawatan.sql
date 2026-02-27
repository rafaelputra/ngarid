-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2026 at 05:11 AM
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
-- Table structure for table `daftar_masalah_keperawatan`
--

CREATE TABLE `daftar_masalah_keperawatan` (
  `id` int(11) NOT NULL,
  `no_rawat` varchar(17) NOT NULL,
  `masalah_keperawatan` set('Bersihan Jalan Nafas tidak efektif','Pola Nafas tidak efektif','Gangguan Pertukaran gas','Kurang Pengetahuan','Resiko Aspirasi','Hipertermia','Ketidakseimbangan nutrisi','Defisit Volume Cairan','Kelebihan Volume Cairan','Intoleransi aktifitas','Perfusi jaringan kardiopulmonal tidak efektif','Perfusi jaringan cerebral tidak efektif','Perfusi jaringan renal tidak efektif','Manajemen regimen teraupetik tidak efektif','Penurunan curah jantung','Defisit perawatan diri','Nyeri','Kecemasan','Takut','Gangguan mobilitas fisik','Mual','Diare','Konstipasi','Retensi urin','Kerusakan integritas kulit','Resiko infeksi','Resiko Injury','Gangguan Pola Tidur','Kerusakan integritas jaringan','Gangguan Body Image','Kelelahan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_masalah_keperawatan`
--
ALTER TABLE `daftar_masalah_keperawatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kunjungan_masalah_keperawatan` (`no_rawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_masalah_keperawatan`
--
ALTER TABLE `daftar_masalah_keperawatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_masalah_keperawatan`
--
ALTER TABLE `daftar_masalah_keperawatan`
  ADD CONSTRAINT `fk_kunjungan_masalah_keperawatan` FOREIGN KEY (`no_rawat`) REFERENCES `kunjungan` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
