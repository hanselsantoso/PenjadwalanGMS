/*
SQLyog Ultimate
MySQL - 10.4.28-MariaDB : Database - jadwal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `users` */

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama_lengkap`,`email`,`alamat`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`nij`,`telp`,`kesibukan`,`nomor_cg`,`posisi_cg`,`status_user`,`nama_pemimpin`,`telp_pemimpin`,`role`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Super Admin','super@super.com',NULL,0,NULL,NULL,'','','','0',NULL,1,NULL,NULL,0,NULL,'$2y$10$MFbjuLrLhokQspUhbG.Sh.G0X5DLkAU8xTdlrmT9fwe327.9/MwLS',NULL,NULL,NULL),
(6,'Hansul Santusu','a@a.com','Jl. Ngagel',1,'Semarang','1999-03-12','12380971203','+6276128312','Pekerja','12312312','T.L',1,'Tokek','+6276128312',1,NULL,'$2y$10$rLHyqP6L03fcE82ofQtSo.juluP0bI6LW6KKRu/ifGc.gGdeEQkeG',NULL,'2024-07-06 09:05:34','2024-07-06 10:45:51');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
