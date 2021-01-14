-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 01:47 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acanation`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(2) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id`, `tahun`) VALUES
(17, 2017),
(18, 2018),
(19, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id` int(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `angkatan` int(4) DEFAULT NULL,
  `kelas` varchar(30) DEFAULT NULL,
  `display` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `nama`, `email`, `alamat`, `angkatan`, `kelas`, `display`) VALUES
(12345678, 'Admin Einsta', 'aminulloh.zaqi.darojat@stmkg.ac.id', '', NULL, NULL, 'nophoto.jpg'),
(41170001, 'Abdul Baits', 'abdul.baits@stmkg.ac.id', 'Tangerang Selatan', 2017, 'Instrumentasi A', 'nophoto.jpg'),
(41170002, 'Ade Rahmawati', 'ade.rahmawati@stmkg.ac.id', 'Bukit Tinggi', 2017, 'Instrumentasi A', 'nophoto.jpg'),
(41170003, 'Agha Muhammad Ahya', 'agha.muhammad.ahya@stmkg.ac.id', 'Seribu Bambu Lampung', 2017, 'Instrumentasi A', 'nophoto.jpg'),
(41170006, 'Alif Muhammad Annabal', 'alif.muhammad.annabal@stmkg.ac.id', 'Jepara', 2017, 'Instrumentasi A', 'nophoto.jpg'),
(41170007, 'Aminulloh Zaqi Darojat', 'aminulloh.zaqi.darojat@stmkg.ac.id', 'Cilacap', 2017, 'Instrumentasi A', '5fede213bfaa3.jpg'),
(41170011, 'Ariana Rizki Utami', 'ariana.rizki.utami@stmkg.ac.id', 'Lampung', 2017, 'Instrumentasi A', 'nophoto.jpg'),
(41170028, 'Ridho Maiska Pratama', 'ridho.maiska.pratama@stmkg.ac.id', 'Jambi', 2017, 'Instrumentasi A', 'nophoto.jpg'),
(41170042, 'Gamma Syahputra', 'gamma.syahputra@stmkg.ac.id', 'Bengkulu', 2017, 'Instrumentasi B', 'nophoto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `kelas` varchar(30) NOT NULL,
  `angkatan` int(4) NOT NULL,
  `id_user` int(8) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `tanggal`, `kelas`, `angkatan`, `id_user`, `judul`, `isi`) VALUES
(1, '2020-12-30 03:25:34', 'Instrumentasi A', 2017, 41170007, 'cek', 'cek aja dulu'),
(2, '2020-12-30 05:03:03', 'Instrumentasi A', 2017, 41170006, 'cek juga', 'aku juga mau buat dong'),
(3, '2020-12-31 17:38:38', 'Instrumentasi A', 2017, 41170007, 'Coba Tampilan Terbaru', 'Cek dulu sampai larut malam hajar aja lah ayok daripada gabut boiiii......');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` varchar(3) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
('IA', 'Instrumentasi A'),
('IB', 'Instrumentasi B'),
('IC', 'Instrumentasi C'),
('ID', 'Instrumentasi D');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_forum` int(11) NOT NULL,
  `id_user` int(8) NOT NULL,
  `komentar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `tanggal`, `id_forum`, `id_user`, `komentar`) VALUES
(1, '2020-12-30 04:21:25', 1, 41170007, 'ini juga cek'),
(2, '2020-12-30 04:46:30', 1, 41170007, 'tambah ini deh'),
(4, '2020-12-30 04:50:05', 1, 41170006, 'aku ikutan dong'),
(5, '2020-12-30 05:03:21', 2, 41170006, 'aku komen dulu'),
(6, '2020-12-30 05:04:18', 2, 41170007, 'oke aku juga'),
(7, '2020-12-30 05:05:11', 1, 41170028, 'apa nih ribut ribut'),
(8, '2020-12-30 05:05:48', 2, 41170028, 'ih mantap dah'),
(10, '2020-12-31 16:36:15', 1, 41170007, 'tambah satu lagi deh'),
(11, '2020-12-31 17:40:36', 3, 41170007, 'pertamax....'),
(12, '2020-12-31 17:40:43', 3, 41170007, 'kedua'),
(13, '2021-01-01 16:15:06', 3, 41170007, 'ketiga');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` varchar(6) NOT NULL,
  `matakuliah` varchar(70) NOT NULL,
  `sks` int(2) DEFAULT NULL,
  `semester` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `matakuliah`, `sks`, `semester`) VALUES
('T10106', 'PRAKTIK FISIKA I', 1, 'S1'),
('T10110', 'PRAKTIK ELEKTRONIKA ', 1, 'S1'),
('T10203', 'BELA NEGARA', 2, 'S1'),
('T10211', 'RANGKAIAN LISTRIK', 2, 'S1'),
('T12001', 'PENDIDIKAN AGAMA', 2, 'S1'),
('T12002', 'PENDIDIKAN PANCASILA', 2, 'S1'),
('T12007', 'PENDAHULUAN METEOROLOGI', 2, 'S1'),
('T12008', 'KLIMATOLOGI UMUM', 2, 'S1'),
('T12009', 'ELEKTRONIKA I', 2, 'S1'),
('T13004', 'MATEMATIKA I', 3, 'S1'),
('T13005', 'FISIKA I', 3, 'S1'),
('T20118', 'PRAKTIK PENGUKURAN DAN ALAT UKUR', 1, 'S2'),
('T20120', 'PRAKTIK SENSOR I', 1, 'S2'),
('T20122', 'PRAKTIK TEKNIK DIGITAL', 1, 'S2'),
('T20216', 'PRAKTIK PERALATAN PENGAMATAN METEOROLOGI DAN KLIMATOLOGI', 2, 'S2'),
('T22014', 'PENDAHULUAN GEOFISIKA', 2, 'S2'),
('T22015', 'PERALATAN PENGAMATAN METEOROLOGI DAN KLIMATOLOGI', 2, 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(20) NOT NULL,
  `id_user` int(8) NOT NULL,
  `id_matkul` varchar(15) NOT NULL,
  `kehadiran` int(3) NOT NULL,
  `tugas` int(3) NOT NULL,
  `uts` int(3) NOT NULL,
  `uas` int(3) NOT NULL,
  `nilaimutu` float DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `nilai` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_user`, `id_matkul`, `kehadiran`, `tugas`, `uts`, `uas`, `nilaimutu`, `bobot`, `nilai`) VALUES
(1, 41170006, 'T13005', 100, 100, 100, 100, 4, 12, 'A'),
(2, 41170006, 'T13004', 100, 100, 90, 89, 4, 12, 'A'),
(3, 41170007, 'T13005', 100, 100, 100, 80, 4, 12, 'A'),
(4, 41170006, 'T10106', 100, 100, 100, 100, 4, 4, 'A'),
(5, 41170007, 'T10106', 100, 100, 100, 100, 4, 4, 'A'),
(7, 41170028, 'T10106', 100, 100, 100, 100, 4, 4, 'A'),
(8, 41170011, 'T10203', 100, 100, 100, 100, 4, 8, 'A'),
(9, 41170001, 'T10106', 100, 100, 100, 100, 4, 4, 'A'),
(10, 41170001, 'T10203', 100, 100, 100, 100, 4, 8, 'A'),
(11, 41170007, 'T20118', 100, 100, 80, 80, 4, 4, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `id_admin` int(8) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `judul` varchar(50) DEFAULT NULL,
  `isi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `id_admin`, `tanggal`, `judul`, `isi`) VALUES
(1, 12345678, '2020-12-30 12:24:09', 'tambah pengumuman', 'cek dulu'),
(2, 12345678, '2020-12-30 16:47:27', 'Tambahan Kedua Kalinya', 'Lorem Ipsum Dolor Sit Amet Amet Lah Pusing');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` char(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `status`) VALUES
('S1', 'Semester 1'),
('S2', 'Semester 2'),
('S3', 'Semester 3'),
('S4', 'Semester 4'),
('S5', 'Semester 5'),
('S6', 'Semester 6'),
('S7', 'Semester 7'),
('S8', 'Semester 8');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `role`) VALUES
(12345678, 'admin', 'admin'),
(41170001, '41170001', 'user'),
(41170002, '41170002', 'user'),
(41170003, '41170003', 'user'),
(41170006, '41170006', 'user'),
(41170007, '41170007', 'user'),
(41170011, '41170011', 'user'),
(41170028, '41170028', 'user'),
(41170042, '41170042', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun` (`tahun`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `angkatan` (`angkatan`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `angkatan` (`angkatan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_kelas` (`nama_kelas`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_forum` (`id_forum`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_matkul` (`id_matkul`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_user`
--
ALTER TABLE `data_user`
  ADD CONSTRAINT `data_user_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `data_user_ibfk_2` FOREIGN KEY (`angkatan`) REFERENCES `angkatan` (`tahun`),
  ADD CONSTRAINT `data_user_ibfk_3` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`nama_kelas`);

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id`),
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`angkatan`) REFERENCES `angkatan` (`tahun`),
  ADD CONSTRAINT `forum_ibfk_3` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`nama_kelas`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id`);

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`semester`) REFERENCES `semester` (`id`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id`);

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `data_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
