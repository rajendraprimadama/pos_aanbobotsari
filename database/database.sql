/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 5.7.24 : Database - dev_kasir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dev_kasir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dev_kasir`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `authority_level` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`nama`,`foto`,`authority_level`) values 
(1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','profil11.jpg','KASIR'),
(5,'NANANG','38a96b68040b114e0665be56fe0e7e26','NANANG',NULL,'KASIR');

/*Table structure for table `data_barang` */

DROP TABLE IF EXISTS `data_barang`;

CREATE TABLE `data_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_brg` varchar(50) NOT NULL COMMENT 'prefix 3 karakter pertama + lima digit generate',
  `barcode_brg` varchar(50) DEFAULT NULL COMMENT 'barcode di barang',
  `nama_brg` varchar(40) NOT NULL,
  `kategori` varchar(40) NOT NULL,
  `hrg_beli_pcs` int(10) DEFAULT '0',
  `hrg_beli_pax` int(10) DEFAULT '0',
  `hrg_beli_dus` int(10) DEFAULT '0',
  `pcs_hrgjual_retail` int(10) DEFAULT '0',
  `pax_hrgjual_retail` int(10) DEFAULT '0',
  `dus_hrgjual_retail` int(10) DEFAULT '0',
  `pcs_hrgjual_grosir` int(10) DEFAULT '0',
  `pax_hrgjual_grosir` int(10) DEFAULT '0',
  `dus_hrgjual_grosir` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `data_barang` */

insert  into `data_barang`(`id`,`id_brg`,`barcode_brg`,`nama_brg`,`kategori`,`hrg_beli_pcs`,`hrg_beli_pax`,`hrg_beli_dus`,`pcs_hrgjual_retail`,`pax_hrgjual_retail`,`dus_hrgjual_retail`,`pcs_hrgjual_grosir`,`pax_hrgjual_grosir`,`dus_hrgjual_grosir`) values 
(7,'COB00001','11111','COBA','5',1000,10000,100000,1200,12000,120000,1100,11000,111000),
(14,'GGS00001','8998989300155','GG SIGNATURE','6',14000,140000,1400000,17000,170000,1700000,16000,160000,1600000),
(15,'GIV00001','8998866888622','GIV PINK','5',2000,200000,2000000,3000,300000,3000000,2500,250000,2500000),
(16,'SOK00001','8998866608237','SO KLIN LANTAI HIJAU 80 ML','5',800,80000,800000,1000,100000,1000000,900,90000,900000);

/*Table structure for table `data_detail_jual` */

DROP TABLE IF EXISTS `data_detail_jual`;

CREATE TABLE `data_detail_jual` (
  `d_jual_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_jual_nofak` varchar(15) DEFAULT NULL,
  `d_jual_barang_id` varchar(15) DEFAULT NULL,
  `d_jual_barang_nama` varchar(150) DEFAULT NULL,
  `d_jual_barang_satuan` varchar(30) DEFAULT NULL,
  `d_jual_barang_harpok` double DEFAULT NULL,
  `d_jual_barang_harjul` double DEFAULT NULL,
  `d_jual_qty` int(11) DEFAULT NULL,
  `d_jual_diskon` double DEFAULT NULL,
  `d_jual_total` double DEFAULT NULL,
  PRIMARY KEY (`d_jual_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `data_detail_jual` */

insert  into `data_detail_jual`(`d_jual_id`,`d_jual_nofak`,`d_jual_barang_id`,`d_jual_barang_nama`,`d_jual_barang_satuan`,`d_jual_barang_harpok`,`d_jual_barang_harjul`,`d_jual_qty`,`d_jual_diskon`,`d_jual_total`) values 
(1,'120520000001','COB00001','COBA','PCS',1000,1200,5,0,6000),
(2,'120520000001','COB00001','COBA','PAX',10000,12000,5,0,60000),
(3,'120520000002','COB00001','COBA','PCS',1000,1200,2,0,2400),
(4,'120520000002','COB00001','COBA','PAX',10000,12000,3,0,36000);

/*Table structure for table `data_jual` */

DROP TABLE IF EXISTS `data_jual`;

CREATE TABLE `data_jual` (
  `jual_nofak` varchar(15) NOT NULL,
  `jual_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jum_modal` double DEFAULT NULL,
  `jual_total` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jum_keuntungan` double DEFAULT NULL,
  `jual_user_id` varchar(200) DEFAULT NULL,
  `jual_keterangan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`jual_nofak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `data_jual` */

insert  into `data_jual`(`jual_nofak`,`jual_tanggal`,`jum_modal`,`jual_total`,`jual_jml_uang`,`jual_kembalian`,`jum_keuntungan`,`jual_user_id`,`jual_keterangan`) values 
('120520000001','2020-05-12 10:59:05',32000,66000,66000,0,6400,'admin','retail'),
('120520000002','2020-05-12 19:56:26',32000,38400,50000,11600,6400,'admin','retail');

/*Table structure for table `data_karyawan` */

DROP TABLE IF EXISTS `data_karyawan`;

CREATE TABLE `data_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `data_karyawan` */

/*Table structure for table `data_kategori` */

DROP TABLE IF EXISTS `data_kategori`;

CREATE TABLE `data_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `data_kategori` */

insert  into `data_kategori`(`id`,`kategori`) values 
(1,'ALAT TULIS'),
(2,'BAHAN ROTI'),
(3,'BEDAK'),
(4,'ALAT POTONG'),
(5,'SABUN'),
(6,'ROKOK');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
