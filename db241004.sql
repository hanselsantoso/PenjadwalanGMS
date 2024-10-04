/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - jadwal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jadwal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `jadwal`;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bagian` */

insert  into `bagian`(`id_bagian`,`nama_bagian`,`status_bagian`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Stage',1,'2024-09-30 21:23:38','2024-09-30 14:23:38',NULL),
(2,'E.K',1,'2024-08-03 08:53:20','2024-08-03 08:53:20',NULL);

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
(2,'Rooftop',0,'2024-08-02 10:58:03','2024-08-02 03:58:03',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal_d` */

insert  into `jadwal_d`(`id_jadwal_d`,`id_jadwal_h`,`id_bagian`,`id_user`,`status_jadwal_d`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,2,6,1,'2024-08-04 11:02:54','2024-08-04 04:02:54',NULL),
(2,1,2,10,1,'2024-08-04 11:01:09','2024-08-04 04:01:09',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal_h` */

insert  into `jadwal_h`(`id_jadwal_h`,`id_cabang`,`id_jadwal_ibadah`,`tanggal_jadwal`,`pic`,`status_jadwal_h`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,'2024-08-15',6,1,'2024-08-03 17:18:55','2024-08-03 17:18:55',NULL);

/*Table structure for table `jadwal_ibadah` */

DROP TABLE IF EXISTS `jadwal_ibadah`;

CREATE TABLE `jadwal_ibadah` (
  `id_jadwal_ibadah` int(11) NOT NULL AUTO_INCREMENT,
  `jam_stand_by` varchar(255) DEFAULT NULL,
  `jam_mulai` varchar(255) DEFAULT NULL,
  `jam_akhir` varchar(255) DEFAULT NULL,
  `status_jadwal_ibadah` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_ibadah`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal_ibadah` */

insert  into `jadwal_ibadah`(`id_jadwal_ibadah`,`jam_stand_by`,`jam_mulai`,`jam_akhir`,`status_jadwal_ibadah`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'05:00','06:00','08:00',1,'2024-08-04 00:36:05','2024-08-03 17:36:05',NULL);

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
(1,'PIc',1,'2024-08-02 14:03:47','2024-08-02 07:03:47',NULL),
(2,'Anggota',1,'2024-08-02 07:03:37','2024-08-02 07:03:37',NULL);

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

/*Table structure for table `tim_pelayanan_h` */

DROP TABLE IF EXISTS `tim_pelayanan_h`;

CREATE TABLE `tim_pelayanan_h` (
  `id_pelayanan_h` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tim_pelayanan_h` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_tim_pelayanan_h` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pelayanan_h`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tim_pelayanan_h` */

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
(1,6,1,0,'2024-09-30 21:23:25','2024-09-30 14:23:25',NULL),
(2,6,2,1,'2024-08-02 16:45:27','2024-08-02 09:45:27',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama_lengkap`,`email`,`alamat`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`nij`,`telp`,`kesibukan`,`nomor_cg`,`posisi_cg`,`status_user`,`nama_pemimpin`,`telp_pemimpin`,`role`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Super Admin','super@super.com',NULL,0,NULL,NULL,'','','','0',NULL,1,NULL,NULL,0,NULL,'$2y$10$MFbjuLrLhokQspUhbG.Sh.G0X5DLkAU8xTdlrmT9fwe327.9/MwLS',NULL,NULL,NULL,NULL),
(6,'Hansul Santusu','a@a.com','Jl. Ngagel',1,'Semarang','1999-03-12','12380971203','+6276128312','Kuliah','12312312','Pemimpin',1,'Tokek','+6276128312',1,NULL,'$2y$10$rLHyqP6L03fcE82ofQtSo.juluP0bI6LW6KKRu/ifGc.gGdeEQkeG',NULL,'2024-07-06 09:05:34','2024-08-02 03:01:06',NULL),
(10,'Tokek 123','b@b.com','oaisjdoasdj',0,NULL,'2024-04-23','198273102370','01283192381238','Bekerja','99','Anggota',1,'LEad a','08231928312',1,NULL,'$2y$10$z4sLIFFYk3.bJtPi5ASHe.RMgWE0fX6byKYfqu6a1fBhejp5Hbq8S',NULL,'2024-08-04 03:57:51','2024-08-04 03:57:51',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
