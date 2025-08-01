/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - jadwal_gms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jadwal_gms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `jadwal_gms`;

/*Table structure for table `bagian` */

DROP TABLE IF EXISTS `bagian`;

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bagian` varchar(255) DEFAULT NULL,
  `status_bagian` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bagian` */

insert  into `bagian`(`id_bagian`,`nama_bagian`,`status_bagian`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'F.O.H',1,'2024-11-11 13:15:44','2024-11-11 13:15:44',NULL),
(2,'Monitor',1,'2024-11-11 13:15:51','2024-11-11 13:15:51',NULL),
(3,'B.C',1,'2024-11-11 13:16:30','2024-11-11 13:16:30',NULL),
(4,'Stage',1,'2024-09-30 21:23:38','2024-09-30 14:23:38',NULL),
(5,'Super Trooper',1,'2024-11-11 20:23:41','2024-11-11 13:23:41',NULL),
(6,'All star dan Little Eagle',1,'2024-11-11 20:17:07','2024-11-11 13:17:07',NULL);



/*Table structure for table `cabang` */

DROP TABLE IF EXISTS `cabang`;

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cabang` varchar(255) DEFAULT NULL,
  `status_cabang` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cabang` */

insert  into `cabang`(`id_cabang`,`nama_cabang`,`status_cabang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Timur',1,'2024-09-30 21:24:06','2024-09-30 14:24:06',NULL),
(2,'Barat',1,'2024-08-02 10:58:03','2024-08-02 03:58:03',NULL),
(3,'Selatan',1,'2024-09-30 21:24:06','2024-09-30 14:24:06',NULL);



/*Table structure for table `jadwal_d` */

DROP TABLE IF EXISTS `jadwal_d`;

CREATE TABLE `jadwal_d` (
  `id_jadwal_d` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal_h` int(11) DEFAULT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_jadwal_d` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_d`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal_d` */


/*Table structure for table `jadwal_h` */

DROP TABLE IF EXISTS `jadwal_h`;

CREATE TABLE `jadwal_h` (
  `id_jadwal_h` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(11) DEFAULT NULL,
  `id_jadwal_ibadah` int(11) DEFAULT NULL,
  `tanggal_jadwal` date DEFAULT NULL,
  `pic` int(11) DEFAULT NULL,
  `status_jadwal_h` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_h`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal_h` */

insert  into `jadwal_h`(`id_jadwal_h`,`id_cabang`,`id_jadwal_ibadah`,`tanggal_jadwal`,`pic`,`status_jadwal_h`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,'2025-01-04',10,1,'2024-11-11 13:47:57','2024-11-11 13:47:57',NULL),
(2,1,2,'2025-01-04',20,1,'2024-11-11 14:14:58','2024-11-11 14:14:58',NULL),
(3,1,3,'2025-01-05',30,1,'2024-11-11 15:57:56','2024-11-11 15:57:56',NULL),
(4,1,4,'2025-01-05',40,1,'2024-11-11 15:58:48','2024-11-11 15:58:48',NULL),
(5,1,5,'2025-01-05',50,1,'2024-11-11 15:59:53','2024-11-11 15:59:53',NULL);



/*Table structure for table `jadwal_ibadah` */

DROP TABLE IF EXISTS `jadwal_ibadah`;

CREATE TABLE `jadwal_ibadah` (
  `id_jadwal_ibadah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ibadah` varchar(255) DEFAULT NULL,
  `alias_ibadah` varchar(255) DEFAULT NULL,
  `jam_stand_by` varchar(255) DEFAULT NULL,
  `jam_mulai` varchar(255) DEFAULT NULL,
  `jam_akhir` varchar(255) DEFAULT NULL,
  `status_jadwal_ibadah` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_ibadah`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal_ibadah` */

insert  into `jadwal_ibadah`(`id_jadwal_ibadah`,`nama_ibadah`,`alias_ibadah`,`jam_stand_by`,`jam_mulai`,`jam_akhir`,`status_jadwal_ibadah`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Voltage','VOLTAGE','10:00','13:00','15:00',1,'2024-11-12 14:43:55','2024-11-11 13:21:14',NULL),
(2,'Aog Teen & Youth','AOG TEEN & YOUTH','14:00','16:00','21:00',1,'2024-11-12 14:44:25','2024-11-11 13:22:13',NULL),
(3,'Ibadah Umum 1','UM 1','05:00','07:00','10:00',1,'2024-11-12 14:43:16','2024-11-11 13:21:41',NULL),
(4,'Ibadah Umum 2 & 3','UM 2 - 3','09:00','10:00','15:00',1,'2024-11-12 14:43:41','2024-11-11 13:21:55',NULL),
(5,'Ibadah Umum 4 & 5','UM 4 - 5','15:00','16:00','21:00',1,'2024-11-12 14:52:02',NULL,NULL);



/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tag` varchar(255) DEFAULT NULL,
  `status_tag` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tag` */

insert  into `tag`(`id_tag`,`nama_tag`,`status_tag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'PIC',1,'2024-08-02 14:03:47','2024-08-02 07:03:47',NULL),
(2,'Anggota',1,'2024-08-02 07:03:37','2024-08-02 07:03:37',NULL),
(3,'Full Timer',1,'2024-08-02 07:03:37','2024-08-02 07:03:37',NULL);



/*Table structure for table `tim_pelayanan_d` */

DROP TABLE IF EXISTS `tim_pelayanan_d`;

CREATE TABLE `tim_pelayanan_d` (
  `id_pelayanan_d` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelayanan_h` int(11) DEFAULT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_tim_pelayanan_d` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pelayanan_d`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tim_pelayanan_d` */

insert  into `tim_pelayanan_d`(`id_pelayanan_d`,`id_pelayanan_h`,`id_bagian`,`id_user`,`status_tim_pelayanan_d`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,NULL,10,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(2,1,NULL,11,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(3,1,NULL,12,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(4,1,NULL,13,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(5,2,NULL,20,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(6,2,NULL,21,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(7,2,NULL,22,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(8,2,NULL,23,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(9,3,NULL,30,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(10,3,NULL,31,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(11,3,NULL,32,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(12,3,NULL,33,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(13,4,NULL,40,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(14,4,NULL,41,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(15,4,NULL,42,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(16,4,NULL,43,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(17,5,NULL,50,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(18,5,NULL,51,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(19,5,NULL,52,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(20,6,NULL,60,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(21,6,NULL,61,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(22,6,NULL,62,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(23,6,NULL,63,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(24,7,NULL,70,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(25,7,NULL,71,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(26,7,NULL,72,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(27,7,NULL,73,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(28,8,NULL,80,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(29,8,NULL,81,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(30,8,NULL,82,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(31,9,NULL,100,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(32,9,NULL,101,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(33,9,NULL,102,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(34,10,NULL,110,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(35,10,NULL,111,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(36,10,NULL,112,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(37,11,NULL,200,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(38,11,NULL,201,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(39,11,NULL,202,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(40,12,NULL,210,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(41,12,NULL,211,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(42,12,NULL,212,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL);

/*Table structure for table `tim_pelayanan_h` */

DROP TABLE IF EXISTS `tim_pelayanan_h`;

CREATE TABLE `tim_pelayanan_h` (
  `id_pelayanan_h` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tim_pelayanan_h` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  `status_tim_pelayanan_h` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pelayanan_h`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tim_pelayanan_h` */

insert  into `tim_pelayanan_h`(`id_pelayanan_h`,`nama_tim_pelayanan_h`,`id_user`,`id_cabang`,`status_tim_pelayanan_h`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'PCM 1',10,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(2,'PCM 2',20,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(3,'PCM 3',30,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL), 
(4,'PCM 4',40,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(5,'PCM 5',50,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(6,'PCM 6',60,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(7,'PCM 7',70,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(8,'PCM 8',80,1,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(9,'RT 1',100,2,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(10,'RT 2',110,2,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(11,'MCC 1',200,3,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL),
(12,'MCC 2',210,3,1,'2024-10-04 10:44:33','2024-10-04 10:44:33',NULL);



/*Table structure for table `user_tag` */

DROP TABLE IF EXISTS `user_tag`;

CREATE TABLE `user_tag` (
  `id_user_tag` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `status_user_tag` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_tag` */

insert  into `user_tag`(`id_user_tag`,`id_user`,`id_tag`,`status_user_tag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,99,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(2,98,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(3,97,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(4,10,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(5,11,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(6,12,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(7,13,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(8,20,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(9,21,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(10,22,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(11,23,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(12,30,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(13,31,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(14,32,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(15,33,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(16,40,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(17,41,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(18,42,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(19,43,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(20,50,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(21,51,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(22,52,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(23,60,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(24,61,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(25,62,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(26,63,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(27,70,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(28,71,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(29,72,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(30,73,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(31,80,3,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(32,81,3,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(33,82,3,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(34,90,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(35,91,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(36,92,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(37,93,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(38,100,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(39,101,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(40,102,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(41,110,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(42,111,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(43,112,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(44,200,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(45,201,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(46,202,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(47,210,1,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(48,211,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(49,212,2,1,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL);



/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `grade` tinyint(2) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nij` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `kesibukan` varchar(255) NOT NULL,
  `nomor_cg` varchar(255) NOT NULL,
  `posisi_cg` varchar(255) DEFAULT NULL,
  `status_user` tinyint(1) NOT NULL DEFAULT 1,
  `nama_pemimpin` varchar(255) DEFAULT NULL,
  `telp_pemimpin` varchar(255) DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama_lengkap`,`email`,`grade`,`alamat`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`nij`,`telp`,`kesibukan`,`nomor_cg`,`posisi_cg`,`status_user`,`nama_pemimpin`,`telp_pemimpin`,`role`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values 
(99,'Super Admin','super@super.com',10,NULL,0,NULL,NULL,'','','','0',NULL,1,NULL,NULL,0,NULL,'$2y$10$MFbjuLrLhokQspUhbG.Sh.G0X5DLkAU8xTdlrmT9fwe327.9/MwLS',NULL,NULL,NULL,NULL),
(98,'Hansul Santusu','a@a.com',10,'Jl. Ngagel',1,'Semarang','1999-03-12','12380971203','+6276128312','Kuliah','12312312','Pemimpin',1,'Tokek','+6276128312',1,NULL,'$2y$10$rLHyqP6L03fcE82ofQtSo.juluP0bI6LW6KKRu/ifGc.gGdeEQkeG',NULL,'2024-07-06 09:05:34','2024-08-02 03:01:06',NULL),
(97,'Tokek 123','b@b.com',10,'oaisjdoasdj',0,NULL,'2024-04-23','198273102370','01283192381238','Bekerja','99','Anggota',1,'LEad a','08231928312',1,NULL,'$2y$10$z4sLIFFYk3.bJtPi5ASHe.RMgWE0fX6byKYfqu6a1fBhejp5Hbq8S',NULL,'2024-08-04 03:57:51','2024-08-04 03:57:51',NULL),
(10,'Lawrence','Lawrence@gmail.com',7,'Some Address',1,'Jakarta','1990-01-01','123','8123456789','Student','1','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$0XPpVRoYWQEU7lpdqaTEaOffEHa9wf6kPBMJtmdY.gftpr2nlYDH2',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(11,'Gilbert Wahyudi','Gilbert@gmail.com',7,'Another Addr',1,'Surabaya','1995-05-05','124','8987654321','Freelancer','2','Member',1,'John Smith',NULL,1,NULL,'$2y$10$HRbvby79XyQ9X.dT5YA3zuD/nWD64NKwgmvUotUE/2RK2TO39P4SC',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(12,'David Marciano','David@gmail.com',3,'Another Addr',1,'Surabaya','1995-07-05','126','10716049385','Freelancer','4','Member',1,'John Smith',NULL,1,NULL,'$2y$10$fYglbL9dDl.wH1ZiAtaxM.xU26nDS0WDAaUEtZTrSpJGDiTYuNGpG',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(13,'Novendra Imanuel','Novendra@gmail.com',5,'Some Address',1,'Jakarta','1997-02-05','145','27135802493','Student','23','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$9RzpWd7AIbitCw79XTgDS.osGl6xliQZhVTdWwSfwSn..2JknKATa',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(20,'Hansel Santoso','Hansel@gmail.com',7,'Some Address',1,'Jakarta','1996-08-05','139','21950617301','Student','17','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$6ox59KYV8IHdBm2a6tA8r.rsaYBPpZH5mwy2uDjkHllCb0uJpgF/a',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(21,'Verdian','Verdian@gmail.com',5,'Another Addr',1,'Surabaya','1995-09-05','128','12444444449','Freelancer','6','Member',1,'John Smith',NULL,1,NULL,'$2y$10$9PHBzu7APiWMHWgyqxA2eep7qBzWZ9h3Og1ttEu6rheVyTOD1qmfm',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(22,'Clifford','Clifford@gmail.com',3,'Some Address',1,'Jakarta','1995-10-05','129','13308641981','Student','7','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$Ig0shMBX9hk93Hvjcstol.Ani.vrXE7H8jrIc4ICkYh9da2ke11Te',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(23,'Denny I.P','Denny@gmail.com',3,'Another Addr',1,'Surabaya','1995-11-05','130','14172839513','Freelancer','8','Member',1,'John Smith',NULL,1,NULL,'$2y$10$dM/fpBnV4sFDtF0FyR1mCOCJxEZr5JTzEX3vWDt44FQfEjVLs27oG',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(30,'Yoel','Yoel@gmail.com',7,'Some Address',1,'Jakarta','1995-12-05','131','15037037045','Student','9','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$oVlfaCC4NRXJtahOjNbUB.gb6bB6tXhSj6ZfGYr5Nb1RfkbDHE7ee',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(31,'Michael','Michael@gmail.com',3,'Another Addr',1,'Surabaya','1996-01-05','132','15901234577','Freelancer','10','Member',1,'John Smith',NULL,1,NULL,'$2y$10$W/92of02NU3eeLsjG6oGhOaU1jNNmp7nUyD868Uxnw0P.hewIh6QK',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(32,'Jane Vani','Jane@gmail.com',2,'Some Address',0,'Jakarta','1996-10-05','141','23679012365','Student','19','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$HcZdStg69WCh.Jqa6jTozOuw76THsC.6qxW8TTBlFGN/m2fHQi87.',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(33,'Diio Rivaldo','Diio@gmail.com',2,'Another Addr',1,'Surabaya','1995-02-06','152','33185185217','Freelancer','30','Member',1,'John Smith',NULL,1,NULL,'$2y$10$2Hhr.rymCvJu4W9XpTxb/OEO84AGdUWyR1EeMO9DHqJ67rCc4J40e',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(40,'Calvin','Calvin@gmail.com',7,'Some Address',1,'Jakarta','1996-04-05','135','18493827173','Student','13','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$v8u/g6Gd4f2RXgCuN/bPwOd1aG4UQwj6wRYGgS63od1SqbwtaO3Fy',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(41,'Mike','Mike@gmail.com',5,'Another Addr',1,'Surabaya','1996-05-05','136','19358024705','Freelancer','14','Member',1,'John Smith',NULL,1,NULL,'$2y$10$iSI66MfxUhS8d0B/OS/rR.0WJtsdfEx6jh0D14SkUQu66qEDdLilC',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(42,'Rusli Sarjimin','Rusli@gmail.com',7,'Some Address',1,'Jakarta','1996-06-05','137','20222222237','Student','15','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$1n0TTyWi8InRTsyqFhqroelNt.vIXvMz.jt4JUsFzAF5rUezXz60G',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(43,'Marvin L','Marvin@gmail.com',3,'Another Addr',1,'Surabaya','1996-07-05','138','21086419769','Freelancer','16','Member',1,'John Smith',NULL,1,NULL,'$2y$10$H4zG16CFO/5bayEKfePX9.PnyU9zDIapb86Ys9tlyPkU4TVj3AJfi',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(50,'Joshua','Joshua@gmail.com',7,'Some Address',1,'Jakarta','1995-08-05','127','11580246917','Student','5','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$5xDXCdYUtk/IahfqD1VvKO7pYAkZoi4DG1vny4zgztk0OFCprm5U.',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(51,'Freddy','Freddy@gmail.com',3,'Some Address',1,'Jakarta','1996-02-05','133','16765432109','Student','11','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$OTM2vMtrnOJ.pV0XN5FhsOXmLIeTpBGM.bskoEYrB4xFwHIk7c9aa',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(52,'Juan Satria','Juan@gmail.com',3,'Another Addr',1,'Surabaya','1996-11-05','142','24543209897','Freelancer','20','Member',1,'John Smith',NULL,1,NULL,'$2y$10$.IFoWEx1DnLXjKGt/Md2s.0g3aQVyz58tKOTdOEs4zfD1IZV.lZ5m',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(60,'Andreas','Andreas@gmail.com',7,'Another Addr',1,'Surabaya','1997-01-05','144','26271604961','Freelancer','22','Member',1,'John Smith',NULL,1,NULL,'$2y$10$KOFCVZLUybm1hzPWYKK6vezAq6zugn4s1J8txUn3UnXLlZSCUYv3.',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(61,'Cin Hwe','Cin@gmail.com',5,'Another Addr',1,'Surabaya','1997-03-05','146','28000000025','Freelancer','24','Member',1,'John Smith',NULL,1,NULL,'$2y$10$OrlWbXA3C87EDRwqr.b8ielzwPwsVxH7nUvDcKYMlgPR0d6IiI13a',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(62,'Jason Daniel','Jason@gmail.com',3,'Another Addr',1,'Surabaya','1997-05-05','148','29728395089','Freelancer','26','Member',1,'John Smith',NULL,1,NULL,'$2y$10$bjLhSbsCeqlhv3XoqhF4veCyuoa3k6KMvU4utisB0lfGy9gmHopka',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(63,'Nistel','Nistel@gmail.com',5,'Another Addr',1,'Surabaya','1996-03-05','134','17629629641','Freelancer','12','Member',1,'John Smith',NULL,1,NULL,'$2y$10$WqvMtHVdb9xmEXtaGDw84ub0RB24Ms55pc1eCWIG1t8z3II9RTPBy',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(70,'Max Budi','Max@gmail.com',7,'Some Address',1,'Jakarta','1997-06-05','149','30592592621','Student','27','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ry2nEaEUTeJZWtHGoEieW.yFLdVgI9hMy6lDtE6tckIZN5vVxe0m.',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(71,'Joseph Kurniawan','JosephK@gmail.com',7,'Another Addr',1,'Surabaya','1997-07-05','150','31456790153','Freelancer','28','Member',1,'John Smith',NULL,1,NULL,'$2y$10$j8B66PJvzQTBpUHN6hl1de2awxkBnNH/mWcc79180WDlrQE86JEHm',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(72,'Jason Nathaniel','Jason2@gmail.com',3,'Some Address',1,'Jakarta','1995-01-06','151','32320987685','Student','29','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$MQWQm40VdItQhrpbCqYANu1IOw8YfZlJNUeeHyMn1DI6AG5dfv55a',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(73,'Henry Kristanto','Henry@gmail.com',2,'Some Address',1,'Jakarta','1995-03-06','153','34049382749','Student','31','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$YCtnWZOqOv2iLDoTnHeTHuPddBltTz0OKY.UWLH7NMy/hhyZYsofO',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(80,'Selvy','Selvy@gmail.com',10,'Another Addr',0,'Surabaya','1995-04-06','154','34913580281','Freelancer','32','Member',1,'John Smith',NULL,1,NULL,'$2y$10$zHiCPZNjRn2lFVbhlAg/ZO.asjPYcPHhtQASuNwwasicZCt7Jh9B.',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(81,'Taufan','Taufan@gmail.com',10,'Some Address',1,'Jakarta','1995-05-06','155','35777777813','Student','33','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$e68mZG0RHiLWeHjmSOQqqu03eLWtrFNmYtgw3LokpX8opkW/W8g2q',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(82,'Tri','Tri@gmail.com',10,'Another Addr',1,'Surabaya','1995-06-06','156','36641975345','Freelancer','34','Member',1,'John Smith',NULL,1,NULL,'$2y$10$x4NEFHJzlcdKuy1Z.OeU7ulVjkr7tf907mdD8omsSQNDTo2S1KFk6',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(90,'Yuwono ','Yuwono@gmail.com',7,'Another Addr',1,'Surabaya','1996-09-05','140','22814814833','Freelancer','18','Member',1,'John Smith',NULL,1,NULL,'$2y$10$L1RP.El89DxAXtOUxPs7qeBfJvMl1Z224r7DbrFOU5pkJNt6Y19z6',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(91,'Dinda','Dinda@gmail.com',3,'Some Address',0,'Jakarta','1995-06-05','125','9851851853','Student','3','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$s6dGP367eisVvdbbWmERveAjIwaCkxNof9FeeqvaMlDRO/GtGaw7S',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(92,'Belinda Nathania','Belinda@gmail.com',3,'Some Address',0,'Jakarta','1996-12-05','143','25407407429','Student','21','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$isLp6I052L1v73cza2IrX.pSZn3vszJiZ8HiJItiSb49wJBxF5gKa',NULL,'2024-11-11 13:15:04','2024-11-11 13:15:04',NULL),
(93,'Joseph Dylan','Joseph@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(100,'Volunteer Barat 1','VB1@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(101,'Volunteer Barat 2','VB2@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(102,'Volunteer Barat 3','VB3@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(110,'Volunteer Barat 4','VB4@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(111,'Volunteer Barat 5','VB5@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(112,'Volunteer Barat 6','VB6@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(200,'Volunteer Selatan 1','VS1@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(201,'Volunteer Selatan 2','VS2@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(202,'Volunteer Selatan 3','VS3@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(210,'Volunteer Selatan 4','VS4@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(211,'Volunteer Selatan 5','VS5@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL),
(212,'Volunteer Selatan 6','VS6@gmail.com',3,'Some Address',1,'Jakarta','1997-04-05','147','28864197557','Student','25','Leader',1,'Jane Doe',NULL,1,NULL,'$2y$10$ZhnZNQP3MgSldHaQKl7x2u2K6FBlTfN0c8uQlL0l4DHeTs..lv9pu',NULL,'2024-11-11 13:15:05','2024-11-11 13:15:05',NULL);
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
