-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 09:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesis_umroh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(256) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `keterangan`) VALUES
('A01', 'Paket Umroh Desember Ruby Jejak Imani', '-'),
('A02', 'Paket Umroh Promo Thaif 10 Hari Hemat', '-\r\n'),
('A03', 'Paket Umroh Reguler Mei 9 Hari Rahmah', ''),
('A04', 'Paket Umroh Reguler Mei 9 Hari Uhud', '-'),
('A05', 'Paket Umroh Syawal Plus Turki', '-'),
('A06', 'Paket Umroh Reguler Syawal 9 Hari', '-'),
('A07', 'Paket Umroh Berkah Laut Merah', '-'),
('A08', 'Paket Umroh Reguler Berkah Plus', '-'),
('A09', 'Paket Umroh Berkah 9 Hari September', ''),
('A10', 'Paket Umroh Reguler Berkah Solusi Tour', ''),
('A11', 'Paket Umroh Reguler Berkah 1 Solusi Tour', ''),
('A12', 'Paket Umroh Berkah Plus Turki', ''),
('A13', 'Paket Umroh Berkah Plus Aqso', ''),
('A14', 'Paket Arrayan Umroh Gebyar Milad Ekonomis', ''),
('A15', 'Paket Umroh Lebaran Madinah Syawal Mekkah', ''),
('A16', 'Paket Umroh Full Ramadhan Cici Marthan', ''),
('A17', 'Paket Umroh Akhir Ramadhan Cici Marthan', ''),
('A18', 'Paket Umroh Akhir Ramadhan 16 Hari', ''),
('A19', 'Paket Umroh Reguler Sambut Ramadhan', ''),
('A20', 'Paket Umroh Plus Turki Hemat Oktober', ''),
('A21', 'Paket Umroh Plus Turki Nyaman Oktober', ''),
('A22', 'Paket Umroh Plus Turki Hemat November', ''),
('A23', 'Paket Umroh Plus Turki Nyaman November', ''),
('A24', 'Paket Umroh Plus Turki Hemat September', ''),
('A25', 'Paket Umroh Plus Turki Nyaman September', ''),
('A26', 'Paket Umroh Syawal Hemat Juni', ''),
('A27', 'Paket Umroh Reguler Syawal Nyaman', ''),
('A28', 'Paket Umroh Reguler Lailatul Qadar 15 Hari VIP', ''),
('A29', 'Paket Umroh Reguler Lailatul Qadar 12 Hari VIP', ''),
('A30', 'Paket Umroh Reguler Awal Ramadhan 15 Hari VIP', ''),
('A31', 'Paket Umroh Reguler Awal Ramadhan 12 Hari VIP', ''),
('A32', 'Paket Umroh Reguler Awal Ramadhan 9 Hari VIP', ''),
('A33', 'Paket Umroh Reguler Awal Ramadhan 9 Hari VIP April', ''),
('A34', 'Paket Umroh Akhir Ramadhan 15 Hari Gold', ''),
('A35', 'Paket Umroh Reguler Awal Ramadhan 15 Hari Gold', ''),
('A36', 'Paket Umroh Reguler Awal Ramadhan 12 Hari Gold', ''),
('A37', 'Paket Umroh Reguler Awal Ramadhan 9 Hari Gold', ''),
('A38', 'Paket Umroh Full Ramadhan Silver 30 Hari', ''),
('A39', 'Paket Umroh Akhir Ramadhan 15 Hari Silver', ''),
('A40', 'Paket Umroh Reguler Lailatul Qadar 12 Hari Silver', ''),
('A41', 'Paket Umroh Reguler Awal Ramadhan 15 Hari Silver', ''),
('A42', 'Paket Umroh Super Hemat Syawal Juni', '-'),
('A43', 'Paket Umroh Super Hemat November', '-'),
('A44', 'Paket Umroh Reguler Awal Ramadhan 12 Hari Silver', ''),
('A45', 'Paket Umroh Reguler Awal Ramadhan April Silver', ''),
('A46', 'Paket Saphire Umroh Plus Turki Desember', ''),
('A47', 'Paket Umroh Plus Thaif Nyaman Jejak Imani', ''),
('A48', 'Paket Umroh Promo Al Malik', ''),
('A49', 'Paket Umroh Nyaman Parenting Islami dan Liburan', ''),
('A50', 'Paket Umroh Hemat Parenting Islami dan Liburan', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(256) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `atribut`, `bobot`) VALUES
('C01', 'Harga', 'cost', 0.072128764590874),
('C02', 'Fasilitas', 'benefit', 0.063965044471657),
('C03', 'Jarak Tempuh', 'cost', 0.16693081006087),
('C04', 'Kelas Hotel', 'benefit', 0.10903352649564),
('C05', 'Durasi Perjalanan', 'benefit', 0.059884811315477),
('C06', 'Travel Umroh', 'benefit', 0.31003191275886),
('C07', 'Down Payment (DP)', 'cost', 0.21802513030663);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_kriteria`
--

CREATE TABLE `tb_nilai_kriteria` (
  `kode_nilai_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_kriteria`
--

INSERT INTO `tb_nilai_kriteria` (`kode_nilai_kriteria`, `kode_kriteria`, `keterangan`, `nilai`) VALUES
(1, 'C01', '18jt – 20jt', 40),
(2, 'C01', '21jt – 25jt', 60),
(3, 'C01', '26jt - 30jt', 80),
(4, 'C01', '> 30jt', 100),
(5, 'C02', 'Biasa', 60),
(6, 'C02', 'Mewah', 80),
(7, 'C02', 'Sangat Mewah', 100),
(8, 'C03', 'Sangat Jauh', 100),
(9, 'C03', 'Jauh', 80),
(10, 'C03', 'Dekat', 60),
(11, 'C03', 'Sangat Dekat', 40),
(12, 'C04', '3', 60),
(13, 'C04', '4', 80),
(14, 'C04', '5', 100),
(15, 'C05', '8 Hari', 40),
(16, 'C05', '9 <= 11 Hari', 60),
(17, 'C05', '12 <= 29 Hari', 80),
(18, 'C05', '30 Hari ', 100),
(19, 'C06', 'T01', 20),
(20, 'C06', 'T02', 40),
(21, 'C06', 'T03', 60),
(22, 'C06', 'T04', 80),
(23, 'C06', 'T05', 100),
(25, 'C07', 'Tidak Ringan', 100),
(26, 'C07', 'Sangat Ringan', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_alternatif`
--

CREATE TABLE `tb_rel_alternatif` (
  `kode_rel_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `kode_nilai_kriteria` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rel_alternatif`
--

INSERT INTO `tb_rel_alternatif` (`kode_rel_alternatif`, `kode_alternatif`, `kode_kriteria`, `kode_nilai_kriteria`) VALUES
(1, 'A01', 'C01', 3),
(2, 'A01', 'C02', 5),
(3, 'A01', 'C03', 8),
(4, 'A01', 'C04', 12),
(5, 'A01', 'C05', 16),
(6, 'A01', 'C06', 22),
(7, 'A01', 'C07', 26),
(8, 'A02', 'C01', 2),
(9, 'A02', 'C02', 5),
(10, 'A02', 'C03', 8),
(11, 'A02', 'C04', 13),
(12, 'A02', 'C05', 16),
(13, 'A02', 'C06', 22),
(14, 'A02', 'C07', 26),
(15, 'A03', 'C01', 4),
(16, 'A03', 'C02', 5),
(17, 'A03', 'C03', 11),
(18, 'A03', 'C04', 14),
(19, 'A03', 'C05', 16),
(20, 'A03', 'C06', 22),
(21, 'A03', 'C07', 26),
(22, 'A04', 'C01', 2),
(23, 'A04', 'C02', 5),
(24, 'A04', 'C03', 10),
(25, 'A04', 'C04', 13),
(26, 'A04', 'C05', 16),
(27, 'A04', 'C06', 22),
(28, 'A04', 'C07', 26),
(29, 'A05', 'C01', 4),
(30, 'A05', 'C02', 5),
(31, 'A05', 'C03', 10),
(32, 'A05', 'C04', 13),
(33, 'A05', 'C05', 17),
(34, 'A05', 'C06', 22),
(35, 'A05', 'C07', 25),
(36, 'A06', 'C01', 4),
(37, 'A06', 'C02', 5),
(38, 'A06', 'C03', 10),
(39, 'A06', 'C04', 13),
(40, 'A06', 'C05', 16),
(41, 'A06', 'C06', 22),
(42, 'A06', 'C07', 26),
(43, 'A07', 'C01', 4),
(44, 'A07', 'C02', 5),
(45, 'A07', 'C03', 8),
(46, 'A07', 'C04', 14),
(47, 'A07', 'C05', 16),
(48, 'A07', 'C06', 22),
(49, 'A07', 'C07', 25),
(50, 'A08', 'C01', 3),
(51, 'A08', 'C02', 5),
(52, 'A08', 'C03', 10),
(53, 'A08', 'C04', 12),
(54, 'A08', 'C05', 16),
(55, 'A08', 'C06', 22),
(56, 'A08', 'C07', 26),
(57, 'A09', 'C01', 2),
(58, 'A09', 'C02', 5),
(59, 'A09', 'C03', 10),
(60, 'A09', 'C04', 12),
(61, 'A09', 'C05', 16),
(62, 'A09', 'C06', 22),
(63, 'A09', 'C07', 26),
(64, 'A10', 'C01', 3),
(65, 'A10', 'C02', 5),
(66, 'A10', 'C03', 10),
(67, 'A10', 'C04', 13),
(68, 'A10', 'C05', 16),
(69, 'A10', 'C06', 22),
(70, 'A10', 'C07', 26),
(71, 'A11', 'C01', 2),
(72, 'A11', 'C02', 5),
(73, 'A11', 'C03', 10),
(74, 'A11', 'C04', 14),
(75, 'A11', 'C05', 16),
(76, 'A11', 'C06', 22),
(77, 'A11', 'C07', 26),
(78, 'A12', 'C01', 4),
(79, 'A12', 'C02', 6),
(80, 'A12', 'C03', 10),
(81, 'A12', 'C04', 14),
(82, 'A12', 'C05', 17),
(83, 'A12', 'C06', 22),
(84, 'A12', 'C07', 25),
(85, 'A13', 'C01', 4),
(86, 'A13', 'C02', 6),
(87, 'A13', 'C03', 10),
(88, 'A13', 'C04', 14),
(89, 'A13', 'C05', 17),
(90, 'A13', 'C06', 22),
(91, 'A13', 'C07', 25),
(92, 'A14', 'C01', 1),
(93, 'A14', 'C02', 5),
(94, 'A14', 'C03', 10),
(95, 'A14', 'C04', 12),
(96, 'A14', 'C05', 16),
(97, 'A14', 'C06', 22),
(98, 'A14', 'C07', 26),
(99, 'A15', 'C01', 3),
(100, 'A15', 'C02', 5),
(101, 'A15', 'C03', 8),
(102, 'A15', 'C04', 13),
(103, 'A15', 'C05', 16),
(104, 'A15', 'C06', 22),
(105, 'A15', 'C07', 26),
(106, 'A16', 'C01', 4),
(107, 'A16', 'C02', 6),
(108, 'A16', 'C03', 10),
(109, 'A16', 'C04', 13),
(110, 'A16', 'C05', 18),
(111, 'A16', 'C06', 22),
(112, 'A16', 'C07', 25),
(113, 'A17', 'C01', 4),
(114, 'A17', 'C02', 7),
(115, 'A17', 'C03', 8),
(116, 'A17', 'C04', 14),
(117, 'A17', 'C05', 17),
(118, 'A17', 'C06', 22),
(119, 'A17', 'C07', 25),
(120, 'A18', 'C01', 4),
(121, 'A18', 'C02', 6),
(122, 'A18', 'C03', 10),
(123, 'A18', 'C04', 13),
(124, 'A18', 'C05', 17),
(125, 'A18', 'C06', 22),
(126, 'A18', 'C07', 25),
(127, 'A19', 'C01', 2),
(128, 'A19', 'C02', 5),
(129, 'A19', 'C03', 8),
(130, 'A19', 'C04', 13),
(131, 'A19', 'C05', 16),
(132, 'A19', 'C06', 22),
(133, 'A19', 'C07', 26),
(134, 'A20', 'C01', 4),
(135, 'A20', 'C02', 6),
(136, 'A20', 'C03', 10),
(137, 'A20', 'C04', 13),
(138, 'A20', 'C05', 17),
(139, 'A20', 'C06', 22),
(140, 'A20', 'C07', 26),
(141, 'A21', 'C01', 4),
(142, 'A21', 'C02', 6),
(143, 'A21', 'C03', 8),
(144, 'A21', 'C04', 14),
(145, 'A21', 'C05', 17),
(146, 'A21', 'C06', 22),
(147, 'A21', 'C07', 26),
(148, 'A22', 'C01', 4),
(149, 'A22', 'C02', 6),
(150, 'A22', 'C03', 8),
(151, 'A22', 'C04', 14),
(152, 'A22', 'C05', 17),
(153, 'A22', 'C06', 22),
(154, 'A22', 'C07', 26),
(155, 'A23', 'C01', 4),
(156, 'A23', 'C02', 6),
(157, 'A23', 'C03', 10),
(158, 'A23', 'C04', 13),
(159, 'A23', 'C05', 17),
(160, 'A23', 'C06', 22),
(161, 'A23', 'C07', 26),
(162, 'A24', 'C01', 4),
(163, 'A24', 'C02', 6),
(164, 'A24', 'C03', 10),
(165, 'A24', 'C04', 13),
(166, 'A24', 'C05', 17),
(167, 'A24', 'C06', 22),
(168, 'A24', 'C07', 26),
(169, 'A25', 'C01', 4),
(170, 'A25', 'C02', 6),
(171, 'A25', 'C03', 8),
(172, 'A25', 'C04', 14),
(173, 'A25', 'C05', 17),
(174, 'A25', 'C06', 22),
(175, 'A25', 'C07', 26),
(176, 'A26', 'C01', 2),
(177, 'A26', 'C02', 5),
(178, 'A26', 'C03', 10),
(179, 'A26', 'C04', 13),
(180, 'A26', 'C05', 16),
(181, 'A26', 'C06', 22),
(182, 'A26', 'C07', 26),
(183, 'A27', 'C01', 4),
(184, 'A27', 'C02', 6),
(185, 'A27', 'C03', 10),
(186, 'A27', 'C04', 13),
(187, 'A27', 'C05', 16),
(188, 'A27', 'C06', 22),
(189, 'A27', 'C07', 26),
(190, 'A28', 'C01', 4),
(191, 'A28', 'C02', 7),
(192, 'A28', 'C03', 8),
(193, 'A28', 'C04', 14),
(194, 'A28', 'C05', 17),
(195, 'A28', 'C06', 22),
(196, 'A28', 'C07', 25),
(197, 'A29', 'C01', 4),
(198, 'A29', 'C02', 7),
(199, 'A29', 'C03', 8),
(200, 'A29', 'C04', 14),
(201, 'A29', 'C05', 17),
(202, 'A29', 'C06', 22),
(203, 'A29', 'C07', 25),
(204, 'A30', 'C01', 4),
(205, 'A30', 'C02', 7),
(206, 'A30', 'C03', 8),
(207, 'A30', 'C04', 14),
(208, 'A30', 'C05', 17),
(209, 'A30', 'C06', 22),
(210, 'A30', 'C07', 25),
(211, 'A31', 'C01', 4),
(212, 'A31', 'C02', 7),
(213, 'A31', 'C03', 8),
(214, 'A31', 'C04', 14),
(215, 'A31', 'C05', 17),
(216, 'A31', 'C06', 22),
(217, 'A31', 'C07', 25),
(218, 'A32', 'C01', 4),
(219, 'A32', 'C02', 6),
(220, 'A32', 'C03', 8),
(221, 'A32', 'C04', 14),
(222, 'A32', 'C05', 16),
(223, 'A32', 'C06', 22),
(224, 'A32', 'C07', 25),
(225, 'A33', 'C01', 4),
(226, 'A33', 'C02', 6),
(227, 'A33', 'C03', 8),
(228, 'A33', 'C04', 14),
(229, 'A33', 'C05', 16),
(230, 'A33', 'C06', 22),
(231, 'A33', 'C07', 25),
(232, 'A34', 'C01', 4),
(233, 'A34', 'C02', 7),
(234, 'A34', 'C03', 8),
(235, 'A34', 'C04', 14),
(236, 'A34', 'C05', 16),
(237, 'A34', 'C06', 22),
(238, 'A34', 'C07', 25),
(239, 'A35', 'C01', 4),
(240, 'A35', 'C02', 7),
(241, 'A35', 'C03', 8),
(242, 'A35', 'C04', 14),
(243, 'A35', 'C05', 17),
(244, 'A35', 'C06', 22),
(245, 'A35', 'C07', 25),
(246, 'A36', 'C01', 4),
(247, 'A36', 'C02', 6),
(248, 'A36', 'C03', 8),
(249, 'A36', 'C04', 14),
(250, 'A36', 'C05', 17),
(251, 'A36', 'C06', 22),
(252, 'A36', 'C07', 25),
(253, 'A37', 'C01', 4),
(254, 'A37', 'C02', 6),
(255, 'A37', 'C03', 8),
(256, 'A37', 'C04', 14),
(257, 'A37', 'C05', 16),
(258, 'A37', 'C06', 22),
(259, 'A37', 'C07', 25),
(260, 'A38', 'C01', 4),
(261, 'A38', 'C02', 5),
(262, 'A38', 'C03', 8),
(263, 'A38', 'C04', 12),
(264, 'A38', 'C05', 18),
(265, 'A38', 'C06', 22),
(266, 'A38', 'C07', 25),
(267, 'A39', 'C01', 4),
(268, 'A39', 'C02', 5),
(269, 'A39', 'C03', 8),
(270, 'A39', 'C04', 12),
(271, 'A39', 'C05', 17),
(272, 'A39', 'C06', 22),
(273, 'A39', 'C07', 25),
(274, 'A40', 'C01', 4),
(275, 'A40', 'C02', 5),
(276, 'A40', 'C03', 8),
(277, 'A40', 'C04', 12),
(278, 'A40', 'C05', 17),
(279, 'A40', 'C06', 22),
(280, 'A40', 'C07', 25),
(281, 'A41', 'C01', 4),
(282, 'A41', 'C02', 5),
(283, 'A41', 'C03', 8),
(284, 'A41', 'C04', 12),
(285, 'A41', 'C05', 17),
(286, 'A41', 'C06', 22),
(287, 'A41', 'C07', 25),
(302, 'A44', 'C01', 4),
(303, 'A44', 'C02', 5),
(304, 'A44', 'C03', 8),
(305, 'A44', 'C04', 12),
(306, 'A44', 'C05', 17),
(307, 'A44', 'C06', 22),
(308, 'A44', 'C07', 26),
(309, 'A45', 'C01', 3),
(310, 'A45', 'C02', 5),
(311, 'A45', 'C03', 8),
(312, 'A45', 'C04', 12),
(313, 'A45', 'C05', 16),
(314, 'A45', 'C06', 22),
(315, 'A45', 'C07', 26),
(316, 'A46', 'C01', 4),
(317, 'A46', 'C02', 6),
(318, 'A46', 'C03', 8),
(319, 'A46', 'C04', 13),
(320, 'A46', 'C05', 17),
(321, 'A46', 'C06', 22),
(322, 'A46', 'C07', 25),
(323, 'A47', 'C01', 4),
(324, 'A47', 'C02', 6),
(325, 'A47', 'C03', 8),
(326, 'A47', 'C04', 14),
(327, 'A47', 'C05', 16),
(328, 'A47', 'C06', 22),
(329, 'A47', 'C07', 25),
(330, 'A48', 'C01', 2),
(331, 'A48', 'C02', 5),
(332, 'A48', 'C03', 8),
(333, 'A48', 'C04', 13),
(334, 'A48', 'C05', 16),
(335, 'A48', 'C06', 22),
(336, 'A48', 'C07', 26),
(337, 'A49', 'C01', 4),
(338, 'A49', 'C02', 6),
(339, 'A49', 'C03', 8),
(340, 'A49', 'C04', 14),
(341, 'A49', 'C05', 16),
(342, 'A49', 'C06', 22),
(343, 'A49', 'C07', 25),
(344, 'A50', 'C01', 4),
(345, 'A50', 'C02', 6),
(346, 'A50', 'C03', 8),
(347, 'A50', 'C04', 14),
(348, 'A50', 'C05', 16),
(349, 'A50', 'C06', 22),
(350, 'A50', 'C07', 26),
(378, 'A42', 'C07', 26),
(377, 'A42', 'C06', 22),
(376, 'A42', 'C05', 16),
(375, 'A42', 'C04', 12),
(374, 'A42', 'C03', 8),
(373, 'A42', 'C02', 5),
(372, 'A42', 'C01', 2),
(383, 'A43', 'C05', 16),
(382, 'A43', 'C04', 12),
(381, 'A43', 'C03', 8),
(380, 'A43', 'C02', 5),
(379, 'A43', 'C01', 2),
(384, 'A43', 'C06', 22),
(385, 'A43', 'C07', 26);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_kriteria`
--

CREATE TABLE `tb_rel_kriteria` (
  `kode_rel_kriteria` varchar(16) NOT NULL,
  `kode_kriteria` varchar(16) NOT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rel_kriteria`
--

INSERT INTO `tb_rel_kriteria` (`kode_rel_kriteria`, `kode_kriteria`, `nilai`) VALUES
('C01', 'C01', 1),
('C01', 'C02', 1),
('C01', 'C03', 0.3333),
('C01', 'C04', 1),
('C01', 'C05', 1),
('C01', 'C06', 0.3333),
('C01', 'C07', 0.3333),
('C02', 'C01', 1),
('C02', 'C02', 1),
('C02', 'C03', 0.3333),
('C02', 'C04', 0.3333),
('C02', 'C05', 1),
('C02', 'C06', 0.3333),
('C02', 'C07', 0.3333),
('C03', 'C01', 3),
('C03', 'C02', 3),
('C03', 'C03', 1),
('C03', 'C04', 3),
('C03', 'C05', 3),
('C03', 'C06', 0.3333),
('C03', 'C07', 0.3333),
('C04', 'C01', 1),
('C04', 'C02', 3),
('C04', 'C03', 0.3333),
('C04', 'C04', 1),
('C04', 'C05', 3),
('C04', 'C06', 0.3333),
('C04', 'C07', 0.3333),
('C05', 'C01', 1),
('C05', 'C02', 1),
('C05', 'C03', 0.3333),
('C05', 'C04', 0.3333),
('C05', 'C05', 1),
('C05', 'C06', 0.25),
('C05', 'C07', 0.3333),
('C06', 'C01', 3),
('C06', 'C02', 3),
('C06', 'C03', 3),
('C06', 'C04', 3),
('C06', 'C05', 4),
('C06', 'C06', 1),
('C06', 'C07', 3),
('C07', 'C01', 3),
('C07', 'C02', 3),
('C07', 'C03', 3),
('C07', 'C04', 3),
('C07', 'C05', 3),
('C07', 'C06', 0.3333),
('C07', 'C07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_nilai_kriteria`
--
ALTER TABLE `tb_nilai_kriteria`
  ADD PRIMARY KEY (`kode_nilai_kriteria`);

--
-- Indexes for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  ADD PRIMARY KEY (`kode_rel_alternatif`);

--
-- Indexes for table `tb_rel_kriteria`
--
ALTER TABLE `tb_rel_kriteria`
  ADD PRIMARY KEY (`kode_rel_kriteria`,`kode_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_nilai_kriteria`
--
ALTER TABLE `tb_nilai_kriteria`
  MODIFY `kode_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  MODIFY `kode_rel_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
