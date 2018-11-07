/*
SQLyog Ultimate v11.21 (64 bit)
MySQL - 5.5.21 : Database - db_perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_perpustakaan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_perpustakaan`;

/*Table structure for table `anggota_ref` */

DROP TABLE IF EXISTS `anggota_ref`;

CREATE TABLE `anggota_ref` (
  `anggotaId` int(11) NOT NULL AUTO_INCREMENT,
  `anggotaKode` varchar(20) NOT NULL,
  `anggotaNama` varchar(100) NOT NULL,
  `anggotaTanggalLahir` date DEFAULT NULL,
  `anggotaJenisKelamin` enum('L','P') DEFAULT NULL,
  `anggotaHP` varchar(20) DEFAULT NULL,
  `anggotaPekerjaan` varchar(50) DEFAULT NULL,
  `anggotaAlamat` text,
  `anggotaTanggalInput` datetime DEFAULT NULL,
  `anggotaTanggalUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`anggotaId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `anggota_ref` */

insert  into `anggota_ref`(`anggotaId`,`anggotaKode`,`anggotaNama`,`anggotaTanggalLahir`,`anggotaJenisKelamin`,`anggotaHP`,`anggotaPekerjaan`,`anggotaAlamat`,`anggotaTanggalInput`,`anggotaTanggalUpdate`) values (4,'AG-001','Rochmad Widianto','2000-09-01','L','087993345652','Dev','Klaten','2018-10-19 00:00:00','2018-10-19 23:02:23');

/*Table structure for table `buku_ref` */

DROP TABLE IF EXISTS `buku_ref`;

CREATE TABLE `buku_ref` (
  `bukuId` int(11) NOT NULL AUTO_INCREMENT,
  `bukuKode` varchar(20) NOT NULL,
  `bukuJudul` varchar(100) NOT NULL,
  `bukuPengarang` varchar(100) DEFAULT NULL,
  `bukuPenerbit` varchar(100) DEFAULT NULL,
  `bukuKategoriBukuId` int(11) DEFAULT NULL,
  `bukuTanggalInput` datetime DEFAULT NULL,
  `bukuTanggalUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bukuId`),
  KEY `buku_kategori` (`bukuKategoriBukuId`),
  CONSTRAINT `buku_kategori` FOREIGN KEY (`bukuKategoriBukuId`) REFERENCES `kategori_buku_ref` (`kategoriBukuId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `buku_ref` */

insert  into `buku_ref`(`bukuId`,`bukuKode`,`bukuJudul`,`bukuPengarang`,`bukuPenerbit`,`bukuKategoriBukuId`,`bukuTanggalInput`,`bukuTanggalUpdate`) values (1,'BK-001','Laskar Pelangi','Andrea Hirata','PT ABC',2,'2018-10-12 17:42:01','2018-10-12 17:42:03'),(4,'BK-001','XYZ','Andrea Hirata edit','PT ABC',3,'2018-10-12 19:18:48','2018-10-12 19:18:48');

/*Table structure for table `kategori_buku_ref` */

DROP TABLE IF EXISTS `kategori_buku_ref`;

CREATE TABLE `kategori_buku_ref` (
  `kategoriBukuId` int(11) NOT NULL AUTO_INCREMENT,
  `kategoriBukuKode` varchar(20) NOT NULL,
  `kategoriBukuNama` varchar(50) NOT NULL,
  PRIMARY KEY (`kategoriBukuId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_buku_ref` */

insert  into `kategori_buku_ref`(`kategoriBukuId`,`kategoriBukuKode`,`kategoriBukuNama`) values (2,'KT-002','Novel'),(3,'KT-003','Cerita'),(5,'KT-xxx','Surat Kabar'),(6,'AG-001','Rochmad Widianto'),(7,'','');

/*Table structure for table `tarif_ref` */

DROP TABLE IF EXISTS `tarif_ref`;

CREATE TABLE `tarif_ref` (
  `tarifId` int(11) NOT NULL AUTO_INCREMENT,
  `tarifBukuId` int(11) NOT NULL,
  `tarifPinjam` decimal(20,2) DEFAULT '0.00',
  `tarifTerlambat` decimal(20,2) DEFAULT '0.00',
  `tarifRusak` decimal(20,2) DEFAULT '0.00',
  `tarifGanti` decimal(20,2) DEFAULT '0.00',
  `tarifUserId` int(11) DEFAULT NULL,
  `tarifTanggalInput` datetime DEFAULT NULL,
  `tarifTanggalUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tarifId`),
  KEY `tarif_buku` (`tarifBukuId`),
  KEY `tarif_user` (`tarifUserId`),
  CONSTRAINT `tarif_buku` FOREIGN KEY (`tarifBukuId`) REFERENCES `buku_ref` (`bukuId`) ON UPDATE CASCADE,
  CONSTRAINT `tarif_user` FOREIGN KEY (`tarifUserId`) REFERENCES `user_login` (`userId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tarif_ref` */

insert  into `tarif_ref`(`tarifId`,`tarifBukuId`,`tarifPinjam`,`tarifTerlambat`,`tarifRusak`,`tarifGanti`,`tarifUserId`,`tarifTanggalInput`,`tarifTanggalUpdate`) values (2,1,'4000.00','2000.00','4000.00','1000.00',1,'2018-10-19 00:00:00','2018-10-19 18:58:35');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `transaksiId` int(11) NOT NULL AUTO_INCREMENT,
  `transaksiNomor` varchar(50) DEFAULT NULL,
  `transaksiAnggotaId` int(11) NOT NULL,
  `transaksiTanggalPinjam` date DEFAULT NULL,
  `transaksiTanggalKembali` date DEFAULT '0000-00-00',
  `transaksiNominalTotal` decimal(20,2) DEFAULT '0.00',
  `transaksiNominalDibayar` decimal(20,2) DEFAULT '0.00',
  `transaksiStatusDenda` enum('Ya','Tidak') DEFAULT NULL,
  `transaksiUserId` int(11) NOT NULL,
  `transaksiTanggalInput` datetime DEFAULT NULL,
  `transaksiTanggalUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaksiId`),
  KEY `transaksi_user_id` (`transaksiUserId`),
  KEY `transaksi_anggota_id` (`transaksiAnggotaId`),
  CONSTRAINT `transaksi_anggota_id` FOREIGN KEY (`transaksiAnggotaId`) REFERENCES `anggota_ref` (`anggotaId`) ON UPDATE CASCADE,
  CONSTRAINT `transaksi_user_id` FOREIGN KEY (`transaksiUserId`) REFERENCES `user_login` (`userId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_buku` */

DROP TABLE IF EXISTS `transaksi_buku`;

CREATE TABLE `transaksi_buku` (
  `transBukuId` int(11) NOT NULL AUTO_INCREMENT,
  `transBukuTransaksiId` int(11) NOT NULL,
  `transBukuTarifId` int(11) NOT NULL,
  `transBukuStatusKembali` enum('Belum','Sudah') DEFAULT NULL,
  PRIMARY KEY (`transBukuId`),
  KEY `trans_buku_transaksi_id` (`transBukuTransaksiId`),
  KEY `trans_buku_tarif_id` (`transBukuTarifId`),
  CONSTRAINT `trans_buku_tarif_id` FOREIGN KEY (`transBukuTarifId`) REFERENCES `tarif_ref` (`tarifId`) ON UPDATE CASCADE,
  CONSTRAINT `trans_buku_transaksi_id` FOREIGN KEY (`transBukuTransaksiId`) REFERENCES `transaksi` (`transaksiId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_buku` */

/*Table structure for table `transaksi_denda` */

DROP TABLE IF EXISTS `transaksi_denda`;

CREATE TABLE `transaksi_denda` (
  `transDendaId` int(11) NOT NULL AUTO_INCREMENT,
  `transDendaTransaksiId` int(11) NOT NULL,
  `transDendaTarifId` int(11) NOT NULL,
  `transDendaRefId` enum('Terlambat','Rusak','Ganti') DEFAULT NULL,
  `transDendaNominal` decimal(20,2) DEFAULT '0.00',
  PRIMARY KEY (`transDendaId`),
  KEY `trans_denda_transaksi_id` (`transDendaTransaksiId`),
  KEY `trans_denda_tarif_id` (`transDendaTarifId`),
  CONSTRAINT `trans_denda_tarif_id` FOREIGN KEY (`transDendaTarifId`) REFERENCES `tarif_ref` (`tarifId`) ON UPDATE CASCADE,
  CONSTRAINT `trans_denda_transaksi_id` FOREIGN KEY (`transDendaTransaksiId`) REFERENCES `transaksi` (`transaksiId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_denda` */

/*Table structure for table `user_level` */

DROP TABLE IF EXISTS `user_level`;

CREATE TABLE `user_level` (
  `levelId` int(11) NOT NULL AUTO_INCREMENT,
  `levelNama` varchar(50) NOT NULL,
  PRIMARY KEY (`levelId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_level` */

insert  into `user_level`(`levelId`,`levelNama`) values (1,'Administrator'),(2,'Operator'),(3,'Anggota');

/*Table structure for table `user_login` */

DROP TABLE IF EXISTS `user_login`;

CREATE TABLE `user_login` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userNama` varchar(100) NOT NULL,
  `userUsername` varchar(50) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userLevelId` int(11) NOT NULL,
  `userTanggalInput` datetime DEFAULT NULL,
  `userTanggalUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`),
  KEY `level_user` (`userLevelId`),
  CONSTRAINT `level_user` FOREIGN KEY (`userLevelId`) REFERENCES `user_level` (`levelId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user_login` */

insert  into `user_login`(`userId`,`userNama`,`userUsername`,`userPassword`,`userLevelId`,`userTanggalInput`,`userTanggalUpdate`) values (1,'Admin','admin','admin',1,'2018-09-14 18:22:42','2018-09-14 18:22:42');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
