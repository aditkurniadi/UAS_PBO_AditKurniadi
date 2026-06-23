-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 01:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1b_aditkurniadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` int NOT NULL,
  `jenis_karyawan` enum('Kontrak','Tetap','Magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(150) DEFAULT NULL,
  `tunjangan_kesehatan` int DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` int DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
('KAR_K001', 'Yudi Darmawan', 'Operations', 24, 150000, 'Kontrak', 12, 'PT Outsourcing Maju', NULL, NULL, NULL, NULL),
('KAR_K002', 'Ayu Wandira', 'Customer Service', 22, 130000, 'Kontrak', 6, 'CV Karya Mandiri', NULL, NULL, NULL, NULL),
('KAR_K003', 'Dian Pelangi', 'Finance', 20, 160000, 'Kontrak', 24, 'PT Solusi Kerja', NULL, NULL, NULL, NULL),
('KAR_K004', 'Anton Syah', 'IT', 23, 200000, 'Kontrak', 12, 'PT Outsourcing Maju', NULL, NULL, NULL, NULL),
('KAR_K005', 'Nina Safitri', 'HR', 21, 140000, 'Kontrak', 6, 'CV Karya Mandiri', NULL, NULL, NULL, NULL),
('KAR_K006', 'Hadi Sucipto', 'Operations', 25, 150000, 'Kontrak', 12, 'PT Solusi Kerja', NULL, NULL, NULL, NULL),
('KAR_K007', 'Maya Indah', 'Customer Service', 24, 130000, 'Kontrak', 24, 'CV Karya Mandiri', NULL, NULL, NULL, NULL),
('KAR_M001', 'Achmal', 'IT', 20, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'SIB Dicoding Batch 6'),
('KAR_M002', 'Fadhel', 'IT', 22, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'Bangkit Academy 2026'),
('KAR_M003', 'Rizqi', 'IT', 21, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'SIB Dicoding Batch 6'),
('KAR_M004', 'Gilang', 'Marketing', 20, 40000, 'Magang', NULL, NULL, NULL, NULL, 1200000, 'MSIB Batch 6'),
('KAR_M005', 'Risa', 'HR', 22, 40000, 'Magang', NULL, NULL, NULL, NULL, 1200000, 'MSIB Batch 6'),
('KAR_M006', 'Sarah', 'Operations', 23, 40000, 'Magang', NULL, NULL, NULL, NULL, 1200000, 'Kampus Merdeka Mandiri'),
('KAR_T001', 'Budi Santoso', 'IT', 22, 250000, 'Tetap', NULL, NULL, 500000, 'SHM-01A', NULL, NULL),
('KAR_T002', 'Siti Aminah', 'Finance', 24, 200000, 'Tetap', NULL, NULL, 450000, 'SHM-02B', NULL, NULL),
('KAR_T003', 'Agus Prayitno', 'Marketing', 20, 180000, 'Tetap', NULL, NULL, 400000, 'SHM-03C', NULL, NULL),
('KAR_T004', 'Dewi Lestari', 'HR', 21, 190000, 'Tetap', NULL, NULL, 400000, 'SHM-04D', NULL, NULL),
('KAR_T005', 'Joko Widodo', 'Operations', 25, 170000, 'Tetap', NULL, NULL, 350000, 'SHM-05E', NULL, NULL),
('KAR_T006', 'Rina Marlina', 'IT', 23, 250000, 'Tetap', NULL, NULL, 500000, 'SHM-06F', NULL, NULL),
('KAR_T007', 'Eko Saputro', 'Marketing', 22, 180000, 'Tetap', NULL, NULL, 400000, 'SHM-07G', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
