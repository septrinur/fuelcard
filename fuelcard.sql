-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 07:28 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuelcard`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_qr`
--

CREATE TABLE `data_qr` (
  `id_qr` int(11) NOT NULL,
  `nama_pemilik` varchar(150) NOT NULL,
  `no_pol` varchar(20) NOT NULL,
  `kuota_bbm` int(11) NOT NULL,
  `jenis_kendaraan` varchar(100) NOT NULL,
  `no_kartu` varchar(16) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `status_approve` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_created` int(11) NOT NULL,
  `date_approved` datetime DEFAULT NULL,
  `user_approved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_qr`
--

INSERT INTO `data_qr` (`id_qr`, `nama_pemilik`, `no_pol`, `kuota_bbm`, `jenis_kendaraan`, `no_kartu`, `dokumen`, `qr_image`, `status_approve`, `date_created`, `user_created`, `date_approved`, `user_approved`) VALUES
(3, 'Septri', 'B1157WZK', 140, 'Mobil', '1234', '', '/assets/images/qr/de22dde9b9014385aef709e35bad4a389fb7fff2a3b1aaaa4dcb710fbc6807f742afca1a9329c7d60443c27e6201d54d69c5670df5b08f838d70ea79dbdb9694nSD57kXEkrIoQP6o5veC4XYWyqzGW3YFSmQmL4qld5Y~.png', 1, '2020-11-02 13:06:47', 1, '2020-11-02 13:27:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `spbu`
--

CREATE TABLE `spbu` (
  `id_spbu` int(11) NOT NULL,
  `no_spbu` varchar(50) NOT NULL,
  `nama_spbu` varchar(100) NOT NULL,
  `wilayah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spbu`
--

INSERT INTO `spbu` (`id_spbu`, `no_spbu`, `nama_spbu`, `wilayah`) VALUES
(2, '123', 'SPBU A', 'Jakarta Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `spbu_id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `token` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `login_attempt` tinyint(4) NOT NULL DEFAULT 0,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `name`, `instansi`, `jabatan`, `no_hp`, `email`, `spbu_id`, `level`, `status`, `token`, `last_login`, `login_attempt`, `user_created`, `date_created`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', NULL, NULL, NULL, NULL, 0, 1, 1, '12312312312312', '2020-11-02 08:27:30', 0, 0, '2020-10-29 13:18:34'),
(9, 'adminqr', '1f1a7bcd1b09244b46f566fd71912c6f', 'Admin QR', 'BRI', 'manager', '0928292891', 'admin@amin', 0, 2, 1, 'b24fe12272e49b274c5d047a110b441c851401fa', NULL, 0, 1, '2020-11-02 10:26:44'),
(10, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'User 1', NULL, NULL, '0123123123123', NULL, 2, 5, 1, '96de7c7c23c5f8967b6d8d4233cf1f8ae7ab8fcc', NULL, 0, 1, '2020-11-02 12:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_spbu`
--

CREATE TABLE `user_spbu` (
  `id_user_spbu` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_petugas` varchar(50) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `spbu_id` int(11) NOT NULL,
  `no_hp_petugas` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int(11) NOT NULL,
  `no_kartu` varchar(16) NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `trx_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `reason_failed` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `no_kartu`, `no_polisi`, `foto`, `status`, `trx_date`, `user_id`, `reason_failed`) VALUES
(1, '1', '123', NULL, 0, '2020-10-29 10:11:50', 1, 'No Polisi dan No Kartu Tidak Sama'),
(2, '123', '123', 'uploads/lake.jpg', 1, '2020-10-29 10:23:16', 1, NULL),
(3, '123', '123', 'uploads/scaled_f8001778-eafa-47dc-a43f-a1d20e724b107975921784991833041.jpg', 1, '2020-10-29 10:24:12', 1, NULL),
(4, '123', '123', 'uploads/scaled_f4c8ad8b-e35c-4af1-9939-d3e20a8a6d0d7057634827498166343.jpg', 1, '2020-10-29 10:25:06', 1, NULL),
(5, '123', '123', 'uploads/scaled_7d1841c7-5bb1-4a3f-a3cf-f24e34ec2ab83467821019317122562.jpg', 1, '2020-10-29 10:42:14', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_qr`
--
ALTER TABLE `data_qr`
  ADD PRIMARY KEY (`id_qr`);

--
-- Indexes for table `spbu`
--
ALTER TABLE `spbu`
  ADD PRIMARY KEY (`id_spbu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_spbu`
--
ALTER TABLE `user_spbu`
  ADD PRIMARY KEY (`id_user_spbu`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_qr`
--
ALTER TABLE `data_qr`
  MODIFY `id_qr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spbu`
--
ALTER TABLE `spbu`
  MODIFY `id_spbu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_spbu`
--
ALTER TABLE `user_spbu`
  MODIFY `id_user_spbu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
