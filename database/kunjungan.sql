-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2026 at 03:05 PM
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
-- Database: `ci3_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `no_rawat` varchar(17) NOT NULL,
  `tgl_registrasi` date DEFAULT NULL,
  `jam_reg` time DEFAULT NULL,
  `kd_dokter` varchar(20) DEFAULT NULL,
  `no_rkm_medis` varchar(15) DEFAULT NULL,
  `nm_pasien` varchar(100) NOT NULL,
  `jk` enum('-','L','P','') NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `kd_poli` char(5) DEFAULT NULL,
  `stts` enum('Belum','Sudah','Batal','Berkas Diterima','Dirujuk','Meninggal','Dirawat','Pulang Paksa','Rujuk Balik') DEFAULT NULL,
  `status_lanjut` enum('Ralan','Ranap') NOT NULL,
  `umurdaftar` int(11) DEFAULT NULL,
  `status_bayar` enum('Sudah Bayar','Belum Bayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`no_rawat`, `tgl_registrasi`, `jam_reg`, `kd_dokter`, `no_rkm_medis`, `nm_pasien`, `jk`, `tmp_lahir`, `tgl_lahir`, `alamat`, `kd_poli`, `stts`, `status_lanjut`, `umurdaftar`, `status_bayar`) VALUES
('RW2024020001', '2024-02-01', '08:10:00', 'DOK001', 'RM00001', 'Michael Anderson', 'L', 'New York', '1989-05-12', 'New York, USA', 'INT01', 'Belum', 'Ralan', 34, 'Belum Bayar'),
('RW2024020002', '2024-02-01', '08:25:00', 'DOK002', 'RM00002', 'Sarah Johnson', 'P', 'Los Angeles', '1994-09-21', 'Los Angeles, USA', 'OBG01', 'Sudah', 'Ralan', 29, 'Sudah Bayar'),
('RW2024020003', '2024-02-01', '08:50:00', 'DOK003', 'RM00003', 'David Miller', 'L', 'Chicago', '1982-01-17', 'Chicago, USA', 'INT01', 'Belum', 'Ralan', 42, 'Belum Bayar'),
('RW2024020004', '2024-02-01', '09:15:00', 'DOK004', 'RM00004', 'Emily Wilson', 'P', 'Houston', '2023-12-10', 'Houston, USA', 'ANA01', 'Berkas Diterima', 'Ranap', 1, 'Sudah Bayar'),
('RW2024020005', '2024-02-01', '09:40:00', 'DOK005', 'RM00005', 'James Brown', 'L', 'Phoenix', '1965-07-03', 'Phoenix, USA', 'BED01', 'Sudah', 'Ralan', 58, 'Sudah Bayar'),
('RW2024020006', '2024-02-01', '10:05:00', 'DOK001', 'RM00006', 'Olivia Taylor', 'P', 'Philadelphia', '2000-03-14', 'Philadelphia, USA', 'INT01', 'Belum', 'Ralan', 23, 'Belum Bayar'),
('RW2024020007', '2024-02-01', '10:30:00', 'DOK002', 'RM00007', 'Daniel Moore', 'L', 'San Diego', '2024-01-29', 'San Diego, USA', 'SAR01', 'Sudah', 'Ranap', 0, 'Sudah Bayar'),
('RW2024020008', '2024-02-01', '11:00:00', 'DOK003', 'RM00008', 'Sophia Martinez', 'P', 'Dallas', '1992-11-08', 'Dallas, USA', 'OBG01', 'Belum', 'Ralan', 31, 'Belum Bayar'),
('RW2024020009', '2024-02-01', '11:25:00', 'DOK004', 'RM00009', 'Christopher Lee', 'L', 'San Jose', '1976-04-25', 'San Jose, USA', 'INT01', 'Batal', 'Ralan', 47, 'Belum Bayar'),
('RW2024020010', '2024-02-01', '11:55:00', 'DOK005', 'RM00010', 'Amanda Clark', 'P', 'Austin', '2022-06-18', 'Austin, USA', 'ANA01', 'Sudah', 'Ranap', 2, 'Sudah Bayar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`no_rawat`),
  ADD KEY `no_rkm_medis` (`no_rkm_medis`),
  ADD KEY `kd_poli` (`kd_poli`),
  ADD KEY `status_lanjut` (`status_lanjut`),
  ADD KEY `kd_dokter` (`kd_dokter`),
  ADD KEY `status_bayar` (`status_bayar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
