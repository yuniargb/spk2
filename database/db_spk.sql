-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_spk
CREATE DATABASE IF NOT EXISTS `db_spk` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_spk`;

-- Dumping structure for table db_spk.tb_admin
CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_spk.tb_alternatif
CREATE TABLE IF NOT EXISTS `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(256) DEFAULT NULL,
  `telp` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`kode_alternatif`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_spk.tb_hasil
CREATE TABLE IF NOT EXISTS `tb_hasil` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_nilai_alternatif` varchar(50) DEFAULT NULL,
  `hasil` float DEFAULT NULL,
  `periode` varchar(4) DEFAULT NULL,
  KEY `Index 1` (`id_hasil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_spk.tb_kriteria
CREATE TABLE IF NOT EXISTS `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(256) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  PRIMARY KEY (`kode_kriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_spk.tb_nilai_alternatif
CREATE TABLE IF NOT EXISTS `tb_nilai_alternatif` (
  `id_nilai_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nilai_alternatif` int(11) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_nilai_alternatif`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_spk.tb_nilai_kriteria
CREATE TABLE IF NOT EXISTS `tb_nilai_kriteria` (
  `kode_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`kode_nilai_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_spk.tb_rel_kriteria
CREATE TABLE IF NOT EXISTS `tb_rel_kriteria` (
  `kode_rel_kriteria` varchar(16) NOT NULL,
  `kode_kriteria` varchar(16) NOT NULL,
  `nilai` double DEFAULT NULL,
  `status` tinyint(1) unsigned zerofill DEFAULT '0',
  PRIMARY KEY (`kode_rel_kriteria`,`kode_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
