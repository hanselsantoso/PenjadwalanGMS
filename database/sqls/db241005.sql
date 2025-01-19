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

/*Table structure for table `detail_dok_renstra` */

DROP TABLE IF EXISTS `detail_dok_renstra`;

CREATE TABLE `detail_dok_renstra` (
  `id_detail_dokumen_renstra` int(11) NOT NULL AUTO_INCREMENT,
  `id_dokumen_renstra` int(11) DEFAULT NULL,
  `visi_universitas` text DEFAULT NULL,
  `misi_universitas` text DEFAULT NULL,
  `nilai_keutamaan_universitas` text DEFAULT NULL,
  `tujuan_universitas` text DEFAULT NULL,
  `makna_nilai_keutamaan` text DEFAULT NULL,
  `arah_target` text DEFAULT NULL,
  `evaluasi_diri` text DEFAULT NULL,
  `isu_strategis` text DEFAULT NULL,
  `tujuan_utama` text DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `fungsi` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_detail_dokumen_renstra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_dok_renstra` */

/*Table structure for table `detail_dok_renstra_indikator` */

DROP TABLE IF EXISTS `detail_dok_renstra_indikator`;

CREATE TABLE `detail_dok_renstra_indikator` (
  `id_detail_dokumen_renstra_indikator` int(11) DEFAULT NULL,
  `id_detail_dokumen_renstra` int(11) DEFAULT NULL,
  `id_sasaran` int(11) DEFAULT NULL,
  `id_indikator` varchar(255) DEFAULT NULL,
  `periode_mulai` varchar(20) DEFAULT NULL,
  `periode_akhir` varchar(20) DEFAULT NULL,
  `file_sk` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_dok_renstra_indikator` */

/*Table structure for table `detail_dok_renstra_rencana_kegiatan` */

DROP TABLE IF EXISTS `detail_dok_renstra_rencana_kegiatan`;

CREATE TABLE `detail_dok_renstra_rencana_kegiatan` (
  `id_detail_dokumen_renstra_rencana_kegiatan` int(11) DEFAULT NULL,
  `id_detail_dokumen_renstra` int(11) DEFAULT NULL,
  `id_indikator` int(11) DEFAULT NULL,
  `id_sasaran` int(11) DEFAULT NULL,
  `id_strategi` int(11) DEFAULT NULL,
  `kode_rencana_kegiatan` varchar(20) DEFAULT NULL,
  `rencana_kegiatan` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_dok_renstra_rencana_kegiatan` */

/*Table structure for table `detail_dok_renstra_sk` */

DROP TABLE IF EXISTS `detail_dok_renstra_sk`;

CREATE TABLE `detail_dok_renstra_sk` (
  `id_detail_dokumen_renstra_sk` int(11) DEFAULT NULL,
  `id_detail_dokumen_renstra` int(11) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `sk_renstra` varchar(255) DEFAULT NULL,
  `periode_mulai` varchar(20) DEFAULT NULL,
  `periode_akhir` varchar(20) DEFAULT NULL,
  `file_sk` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_dok_renstra_sk` */

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

/*Table structure for table `komp_indikator` */

DROP TABLE IF EXISTS `komp_indikator`;

CREATE TABLE `komp_indikator` (
  `id_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria_mutu` int(11) DEFAULT NULL,
  `id_sasaran` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `kode_indikator` varchar(10) DEFAULT NULL,
  `cb_universitas` tinyint(1) DEFAULT NULL,
  `cb_unit_kerja` tinyint(1) DEFAULT NULL,
  `cb_fakultas` tinyint(1) DEFAULT NULL,
  `cb_prodi` tinyint(1) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kriteria` int(2) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `satuan` tinyint(2) DEFAULT NULL,
  `kategori` tinyint(1) DEFAULT NULL,
  `status_indikator` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_indikator`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `komp_indikator` */

insert  into `komp_indikator`(`id_indikator`,`id_kriteria_mutu`,`id_sasaran`,`id_periode`,`kode_indikator`,`cb_universitas`,`cb_unit_kerja`,`cb_fakultas`,`cb_prodi`,`nama`,`kriteria`,`periode`,`satuan`,`kategori`,`status_indikator`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,1,'kode 1',1,1,1,1,'Indikator 1',1,'1',1,0,1,1,'2024-03-23 15:54:27','2024-05-17 07:50:15',NULL),
(2,1,1,2,'91283128-1',0,1,0,0,'Tokek',5,'2',2,1,1,1,'2024-05-17 07:50:38','2024-05-17 08:18:48',NULL),
(3,1,2,1,'asd1',0,0,1,0,'ssdasdasd',2,'1',13,0,1,1,'2024-05-17 08:15:12','2024-05-17 08:15:12',NULL),
(4,1,1,2,'91283128-1',0,1,0,0,'Tokek',5,'2',2,1,1,1,'2024-05-17 09:21:01','2024-05-17 09:21:01',NULL),
(5,1,1,1,'kode 1',1,1,1,1,'Indikator 1',1,'1',1,0,1,1,'2024-05-17 09:21:16','2024-05-17 09:21:16',NULL),
(6,1,2,1,'123123',0,0,1,0,'Indikator',9,'1',1,1,1,1,'2024-05-25 15:32:00','2024-05-25 15:32:00',NULL),
(7,1,2,2,'1.A.1',0,0,0,1,'Lala',1,'2',12,1,1,1,'2024-05-25 15:35:47','2024-05-25 15:35:47',NULL),
(8,1,2,2,'1.A.1',0,0,0,1,'Lala',1,'2',12,1,1,1,'2024-05-25 15:35:56','2024-05-25 15:35:56',NULL);

/*Table structure for table `komp_kriteria_mutu` */

DROP TABLE IF EXISTS `komp_kriteria_mutu`;

CREATE TABLE `komp_kriteria_mutu` (
  `id_kriteria_mutu` int(11) NOT NULL,
  `kriteria_mutu` varchar(255) DEFAULT NULL,
  `status_kriteria_mutu` tinyint(1) DEFAULT 1,
  `created_by` int(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `komp_kriteria_mutu` */

insert  into `komp_kriteria_mutu`(`id_kriteria_mutu`,`kriteria_mutu`,`status_kriteria_mutu`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Mutu terbaik',1,1,'2024-02-24 10:50:51','2024-03-23 16:07:50',NULL);

/*Table structure for table `komp_sasaran` */

DROP TABLE IF EXISTS `komp_sasaran`;

CREATE TABLE `komp_sasaran` (
  `id_sasaran` int(11) NOT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `kode_sasaran` varchar(255) DEFAULT NULL,
  `sasaran` varchar(255) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `status_sasaran` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `komp_sasaran` */

insert  into `komp_sasaran`(`id_sasaran`,`id_periode`,`kode_sasaran`,`sasaran`,`periode`,`status_sasaran`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'1823129038','mencoba sasaran 2','2019',1,1,'2023-12-08 09:50:58','2024-03-07 14:51:09',NULL),
(2,2,'12837120937','sasaran','2',1,1,'2024-03-07 14:40:14','2024-03-23 16:08:17',NULL);

/*Table structure for table `komp_strategi` */

DROP TABLE IF EXISTS `komp_strategi`;

CREATE TABLE `komp_strategi` (
  `id_strategi` int(11) NOT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `kode_strategi` varchar(255) DEFAULT NULL,
  `strategi` varchar(255) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `status_strategi` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `komp_strategi` */

insert  into `komp_strategi`(`id_strategi`,`id_periode`,`kode_strategi`,`strategi`,`periode`,`status_strategi`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'kode 1','asdasdasd','1',1,1,'2024-03-23 15:22:07','2024-03-23 15:22:07',NULL),
(2,2,'kode 2','123123123123','2',1,1,'2024-03-23 15:24:21','2024-03-23 16:06:27',NULL),
(3,2,'kode 3','asdasdasd','2',1,1,'2024-03-23 15:25:31','2024-03-23 15:25:31',NULL);

/*Table structure for table `komp_tujuan_utama` */

DROP TABLE IF EXISTS `komp_tujuan_utama`;

CREATE TABLE `komp_tujuan_utama` (
  `id_tujuan_utama` int(11) NOT NULL AUTO_INCREMENT,
  `id_periode` int(11) DEFAULT NULL,
  `tujuan_utama` varchar(255) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `status_tujuan_utama` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tujuan_utama`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `komp_tujuan_utama` */

insert  into `komp_tujuan_utama`(`id_tujuan_utama`,`id_periode`,`tujuan_utama`,`periode`,`status_tujuan_utama`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Mengheningkan Cipta','1',1,1,'2024-02-24 11:17:05','2024-02-24 11:42:53',NULL);

/*Table structure for table `mapping_user_role` */

DROP TABLE IF EXISTS `mapping_user_role`;

CREATE TABLE `mapping_user_role` (
  `id_mapping` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `status_mapping` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mapping`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `mapping_user_role` */

insert  into `mapping_user_role`(`id_mapping`,`id_user`,`id_role`,`status_mapping`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,1,1,NULL,NULL,NULL),
(3,4,1,1,1,'2024-04-19 14:52:32','2024-04-19 14:52:32',NULL),
(6,5,1,1,3,'2024-04-19 15:04:03','2024-04-19 15:04:03',NULL),
(7,3,1,1,1,'2024-04-24 14:58:16','2024-04-24 14:58:16',NULL),
(8,3,3,1,1,'2024-04-24 14:58:16','2024-04-24 14:58:16',NULL),
(9,3,5,1,1,'2024-04-24 14:58:16','2024-04-24 14:58:16',NULL);

/*Table structure for table `periode` */

DROP TABLE IF EXISTS `periode`;

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `nama_periode` varchar(255) DEFAULT NULL,
  `awal_periode` varchar(255) DEFAULT NULL,
  `akhir_periode` varchar(255) DEFAULT NULL,
  `status_periode` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `periode` */

insert  into `periode`(`id_periode`,`nama_periode`,`awal_periode`,`akhir_periode`,`status_periode`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'2010 - 2015','2010','2015',1,1,'2024-02-24 09:45:56','2024-04-26 09:29:18',NULL),
(2,'2020 - 2025','2020','2025',1,1,'2024-02-24 09:50:12','2024-02-24 09:50:12',NULL);

/*Table structure for table `renop_dok` */

DROP TABLE IF EXISTS `renop_dok`;

CREATE TABLE `renop_dok` (
  `id_dokumen_renop` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `sk_renop` varchar(255) DEFAULT NULL,
  `periode_mulai` varchar(20) DEFAULT NULL,
  `periode_akhir` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `file_sk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_renop`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renop_dok` */

insert  into `renop_dok`(`id_dokumen_renop`,`id_unit_kerja`,`id_periode`,`sk_renop`,`periode_mulai`,`periode_akhir`,`created_by`,`created_at`,`updated_at`,`deleted_at`,`file_sk`) values 
(14,1,1,'1.1',NULL,NULL,1,'2024-04-12 14:11:34','2024-04-14 15:17:12',NULL,''),
(15,1,1,'1.2',NULL,NULL,1,'2024-04-13 05:04:33','2024-04-13 05:04:33',NULL,''),
(16,1,1,'1.3',NULL,NULL,1,'2024-04-13 05:10:23','2024-04-13 05:10:23',NULL,''),
(17,1,1,'1.4',NULL,NULL,1,'2024-04-13 06:19:18','2024-04-13 06:19:18',NULL,''),
(18,1,1,'1.5',NULL,NULL,1,'2024-04-13 13:26:25','2024-04-13 13:26:25',NULL,''),
(19,1,1,'1.6',NULL,NULL,1,'2024-04-13 15:21:59','2024-04-14 13:01:16',NULL,''),
(20,1,1,'11111',NULL,NULL,1,'2024-05-25 12:34:25','2024-05-25 12:34:25',NULL,''),
(21,1,1,'9999',NULL,NULL,1,'2024-05-25 14:06:13','2024-05-25 14:06:13',NULL,''),
(22,1,1,'77777',NULL,NULL,1,'2024-05-25 15:03:22','2024-05-25 15:03:22',NULL,''),
(23,10,1,'6666',NULL,NULL,1,'2024-05-25 15:34:33','2024-05-25 15:34:33',NULL,''),
(24,1,1,'1111122222',NULL,NULL,1,'2024-05-25 16:06:40','2024-05-25 16:06:40',NULL,''),
(25,1,1,'121212',NULL,NULL,1,'2024-05-25 16:07:31','2024-05-25 16:07:31',NULL,''),
(26,1,1,'232323',NULL,NULL,1,'2024-05-25 16:07:56','2024-05-25 16:07:56',NULL,''),
(27,1,1,'4545',NULL,NULL,1,'2024-05-25 16:09:31','2024-05-25 16:09:31',NULL,''),
(28,1,1,'5656',NULL,NULL,1,'2024-05-25 16:10:47','2024-05-25 16:10:47',NULL,''),
(29,1,1,'4646',NULL,NULL,1,'2024-05-25 16:11:20','2024-05-25 16:11:20',NULL,''),
(30,1,1,'56565',NULL,NULL,1,'2024-05-25 16:12:02','2024-05-25 16:12:02',NULL,''),
(31,1,1,'7676',NULL,NULL,1,'2024-05-25 16:12:36','2024-05-25 16:12:36',NULL,''),
(32,1,1,'8989',NULL,NULL,1,'2024-05-25 16:14:08','2024-05-25 16:14:08',NULL,''),
(33,1,1,'8787',NULL,NULL,1,'2024-05-25 16:15:34','2024-05-25 16:15:34',NULL,''),
(34,1,1,'1.2.3',NULL,NULL,1,'2024-06-17 08:12:49','2024-06-17 08:12:49',NULL,''),
(35,1,1,'2.3.4',NULL,NULL,1,'2024-06-17 08:13:23','2024-06-17 08:13:23',NULL,''),
(36,1,1,'3.3.3.3',NULL,NULL,1,'2024-06-17 08:45:55','2024-06-17 08:45:55',NULL,''),
(37,1,1,'4.4.4.4',NULL,NULL,1,'2024-06-17 08:46:43','2024-06-17 08:46:43',NULL,''),
(38,1,1,'4.4.5.5.',NULL,NULL,1,'2024-06-17 08:49:57','2024-06-17 08:49:57',NULL,''),
(39,1,1,'1937',NULL,NULL,1,'2024-06-17 08:50:58','2024-06-17 08:50:58',NULL,''),
(40,1,1,'5567',NULL,NULL,1,'2024-06-17 08:54:51','2024-06-17 08:54:51',NULL,''),
(41,1,1,'99999',NULL,NULL,1,'2024-06-17 08:56:16','2024-06-17 08:56:16',NULL,''),
(42,1,1,'789',NULL,NULL,1,'2024-06-17 08:58:25','2024-06-17 08:58:25',NULL,''),
(43,1,1,'8888',NULL,NULL,1,'2024-06-17 09:28:51','2024-06-17 09:28:51',NULL,''),
(44,1,1,'2323',NULL,NULL,1,'2024-06-17 09:30:49','2024-06-17 09:30:49',NULL,''),
(45,1,1,'0000',NULL,NULL,1,'2024-06-17 09:37:55','2024-06-17 09:37:55',NULL,''),
(46,1,1,'3344',NULL,NULL,1,'2024-06-17 09:41:05','2024-06-17 09:41:05',NULL,''),
(47,1,1,'2456',NULL,NULL,1,'2024-06-17 09:41:44','2024-06-17 09:41:44',NULL,''),
(48,1,1,'23456',NULL,NULL,1,'2024-06-17 09:43:02','2024-06-17 09:43:02',NULL,''),
(49,1,1,'234567',NULL,NULL,1,'2024-06-17 12:03:51','2024-06-17 12:03:51',NULL,''),
(50,1,1,'000099',NULL,NULL,1,'2024-06-19 14:03:42','2024-06-19 14:03:42',NULL,''),
(51,1,1,'9900',NULL,NULL,1,'2024-06-19 14:09:11','2024-06-19 14:09:11',NULL,''),
(52,1,1,'9988',NULL,NULL,1,'2024-06-19 14:09:40','2024-06-19 14:09:40',NULL,''),
(53,1,1,'3730',NULL,NULL,1,'2024-06-19 14:09:59','2024-06-19 14:09:59',NULL,''),
(54,1,1,'4444',NULL,NULL,1,'2024-06-19 14:10:32','2024-06-19 14:10:32',NULL,''),
(55,1,1,'787878',NULL,NULL,1,'2024-06-19 14:10:51','2024-06-19 14:10:51',NULL,''),
(56,1,1,'0909',NULL,NULL,1,'2024-06-19 14:11:52','2024-06-19 14:11:52',NULL,''),
(57,1,1,'09090',NULL,NULL,1,'2024-06-19 14:17:14','2024-06-19 14:17:14',NULL,''),
(58,1,1,'222222222',NULL,NULL,1,'2024-06-19 14:19:01','2024-06-19 14:19:01',NULL,''),
(59,1,1,'009988',NULL,NULL,1,'2024-06-19 14:19:19','2024-06-19 14:19:19',NULL,''),
(60,1,1,'9977',NULL,NULL,1,'2024-06-19 14:37:28','2024-06-19 14:37:28',NULL,''),
(61,1,1,'67676',NULL,NULL,1,'2024-06-27 13:41:54','2024-06-27 13:41:54',NULL,''),
(62,1,1,NULL,NULL,NULL,1,'2024-06-27 13:47:02','2024-06-27 13:47:02',NULL,''),
(63,1,2,'090900',NULL,NULL,1,'2024-06-27 14:20:02','2024-06-27 14:20:02',NULL,''),
(64,1,1,'090000',NULL,NULL,1,'2024-06-27 14:20:39','2024-06-27 14:20:39',NULL,''),
(65,1,3,'78789',NULL,NULL,1,'2024-06-27 14:21:09','2024-06-27 14:21:09',NULL,''),
(66,11,3,'78786',NULL,NULL,1,'2024-06-27 14:24:25','2024-06-27 14:24:25',NULL,''),
(67,1,3,'000009',NULL,NULL,1,'2024-06-27 14:40:33','2024-06-27 15:22:47',NULL,'public/67/sk_renop.pdf');

/*Table structure for table `renop_dok_detail` */

DROP TABLE IF EXISTS `renop_dok_detail`;

CREATE TABLE `renop_dok_detail` (
  `id_dokumen_renop` int(11) NOT NULL,
  `sk_renop` varchar(255) DEFAULT NULL,
  `visi_universitas` text DEFAULT NULL,
  `misi_universitas` text DEFAULT NULL,
  `nilai_keutamaan_universitas` text DEFAULT NULL,
  `tujuan_universitas` text DEFAULT NULL,
  `makna_nilai_keutamaan` text DEFAULT NULL,
  `arah_target_pengembangan` text DEFAULT NULL,
  `evaluasi_diri` text DEFAULT NULL,
  `isu_strategis` text DEFAULT NULL,
  `tujuan_utama` text DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `fungsi_rencana` text DEFAULT NULL,
  `status_dokumen_renop` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_renop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renop_dok_detail` */

insert  into `renop_dok_detail`(`id_dokumen_renop`,`sk_renop`,`visi_universitas`,`misi_universitas`,`nilai_keutamaan_universitas`,`tujuan_universitas`,`makna_nilai_keutamaan`,`arah_target_pengembangan`,`evaluasi_diri`,`isu_strategis`,`tujuan_utama`,`faktor`,`fungsi_rencana`,`status_dokumen_renop`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(33,'8787','<p>asdf</p>','<p>asdf</p>',NULL,NULL,NULL,NULL,NULL,NULL,'<ol><li style=\"margin: 0cm 129.9pt 0.0001pt 36pt; text-indent: -18pt; line-height: normal;\"><font color=\"#000000\"><span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;</span><!--[endif]-->Peningkatan Kapasitas\nManajemen Perguruan Tinggi<o:p></o:p></font></li><li style=\"margin: 0cm 129.9pt 0.0001pt 36pt; text-indent: -18pt; line-height: normal;\"><font color=\"#000000\">Peningkatan Kapabilitas\nKompetensi Sumber Daya Manusia<o:p></o:p></font></li><li style=\"margin: 0cm 129.9pt 0.0001pt 36pt; text-indent: -18pt; line-height: normal;\"><font color=\"#000000\">Peningkatan Produktivitas dan\nKeunggulan dalam&nbsp; Pendidikan dan Pengajaran<o:p></o:p></font></li><li style=\"margin: 0cm 129.9pt 0.0001pt 36pt; text-indent: -18pt; line-height: normal;\"><font color=\"#000000\">Peningkatan\n&nbsp;Produktivitas dan Keunggulan dalam Penelitian dan Pengabdian kepada\nMasyarakat<o:p></o:p></font></li><li style=\"margin: 0cm 129.9pt 0.0001pt 36pt; text-indent: -18pt; line-height: normal;\"><font color=\"#000000\">Peningkatan Kualitas Layanan\nmelalui Pengembangan Sarana dan Prasarana</font></li><li style=\"margin: 0cm 129.9pt 0.0001pt 36pt; text-indent: -18pt; line-height: normal;\"><span style=\"text-indent: -18pt; font-size: 1rem;\"><font color=\"#000000\">Peningkatan Diversifikasi\nSumber Pendanaan secara Profesional</font></span></li></ol>',NULL,NULL,1,NULL,'2024-05-25 16:15:34','2024-05-27 15:27:28',NULL);

/*Table structure for table `renop_rencana_strategis` */

DROP TABLE IF EXISTS `renop_rencana_strategis`;

CREATE TABLE `renop_rencana_strategis` (
  `id_renop_rencana_strategis` int(11) NOT NULL AUTO_INCREMENT,
  `kode_rencana_kegiatan` varchar(255) DEFAULT NULL,
  `id_dokumen_renop` int(11) DEFAULT NULL,
  `id_sasaran` int(11) DEFAULT NULL,
  `id_indikator` int(11) DEFAULT NULL,
  `id_strategi` int(11) DEFAULT NULL,
  `alokasi_waktu` varchar(255) DEFAULT NULL,
  `rencana_kegiatan` varchar(255) DEFAULT NULL,
  `is_priority` tinyint(1) DEFAULT 1,
  `jenis_indikator_kegiatan` varchar(255) DEFAULT NULL,
  `target_indikator_kegiatan` int(11) DEFAULT NULL,
  `status_renop_rencana_strategis` tinyint(1) DEFAULT 1,
  `baseline` varchar(10) DEFAULT NULL,
  `target` varchar(10) DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_renop_rencana_strategis`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renop_rencana_strategis` */

insert  into `renop_rencana_strategis`(`id_renop_rencana_strategis`,`kode_rencana_kegiatan`,`id_dokumen_renop`,`id_sasaran`,`id_indikator`,`id_strategi`,`alokasi_waktu`,`rencana_kegiatan`,`is_priority`,`jenis_indikator_kegiatan`,`target_indikator_kegiatan`,`status_renop_rencana_strategis`,`baseline`,`target`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'1.1.1',NULL,1,1,1,'[\"3\"]','asdf',1,NULL,NULL,1,'','',1,'2024-04-13 13:57:02','2024-04-13 13:57:02',NULL),
(2,'1.1.2',NULL,1,1,1,'[\"3\"]','asdf',1,'asdf',10,1,'','',1,'2024-04-13 14:03:50','2024-04-13 14:03:50',NULL),
(3,'1.1',18,1,1,1,'[\"1\",\"11\",\"12\"]','asdf',1,'asdf',12,1,'1.1','1.2',1,'2024-04-13 14:05:08','2024-04-14 15:02:35',NULL),
(4,'1.2.1',18,1,1,1,'[\"6\",\"7\",\"8\"]','Memainkan',1,'asdf',10,1,NULL,NULL,1,'2024-04-13 14:18:55','2024-04-14 15:01:48',NULL),
(5,'1.2.3',20,1,1,1,'[\"4\"]','asdf',1,'asdf',1,1,NULL,NULL,1,'2024-05-25 12:40:35','2024-05-25 12:40:35',NULL),
(6,'1.1',14,1,1,1,'[\"10\",\"11\",\"12\"]','asdf',1,'asdf',1,1,NULL,NULL,1,'2024-05-25 14:22:24','2024-05-25 14:22:24',NULL),
(7,'1.1.1',33,1,1,1,'[\"7\",\"8\",\"9\"]','memainkan',1,'instrumen',7,1,'10','80',1,'2024-05-27 15:02:41','2024-05-27 15:04:43',NULL);

/*Table structure for table `renstra_dok` */

DROP TABLE IF EXISTS `renstra_dok`;

CREATE TABLE `renstra_dok` (
  `id_dokumen_renstra` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `sk_renstra` varchar(255) DEFAULT NULL,
  `file_sk` text DEFAULT NULL,
  `periode_mulai` varchar(20) DEFAULT NULL,
  `periode_akhir` varchar(20) DEFAULT NULL,
  `visi_universitas` text DEFAULT NULL,
  `misi_universitas` text DEFAULT NULL,
  `nilai_keutamaan_universitas` text DEFAULT NULL,
  `tujuan_universitas` text DEFAULT NULL,
  `makna_nilai_keutamaan` text DEFAULT NULL,
  `arah_target_pengembangan` text DEFAULT NULL,
  `evaluasi_diri` text DEFAULT NULL,
  `isu_strategis` text DEFAULT NULL,
  `tujuan_utama` text DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `fungsi_rencana` text DEFAULT NULL,
  `status_dokumen_renstra` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_renstra`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renstra_dok` */

insert  into `renstra_dok`(`id_dokumen_renstra`,`id_unit_kerja`,`id_periode`,`sk_renstra`,`file_sk`,`periode_mulai`,`periode_akhir`,`visi_universitas`,`misi_universitas`,`nilai_keutamaan_universitas`,`tujuan_universitas`,`makna_nilai_keutamaan`,`arah_target_pengembangan`,`evaluasi_diri`,`isu_strategis`,`tujuan_utama`,`faktor`,`fungsi_rencana`,`status_dokumen_renstra`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,'ASDA123123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,'2024-05-17 17:21:30',NULL),
(2,1,1,'ffasa1231',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL),
(3,1,2,'lkaslnlasd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL);

/*Table structure for table `renstra_dok_detail` */

DROP TABLE IF EXISTS `renstra_dok_detail`;

CREATE TABLE `renstra_dok_detail` (
  `id_dokumen_renstra_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_dokumen_renstra` int(11) DEFAULT NULL,
  `id_renstra_komponen` int(11) DEFAULT NULL,
  `isi` longtext DEFAULT NULL,
  `status_dokumen_renstra_detail` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_renstra_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renstra_dok_detail` */

insert  into `renstra_dok_detail`(`id_dokumen_renstra_detail`,`id_dokumen_renstra`,`id_renstra_komponen`,`isi`,`status_dokumen_renstra_detail`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,2,'<p class=\"MsoNormal\" style=\"line-height:normal\">Terbentuknya komunitas akademik\r\nyang reflektif, kreatif dan berdampak positif bagi peningkatan kehidupan\r\nsesama, serta dilandasi oleh nilai-nilai Pancasila dan prinsip-prinsip Katolik<o:p></o:p></p>',1,1,'2024-05-17 17:21:41','2024-05-19 15:21:42',NULL),
(2,2,3,'<p class=\"MsoNormal\" style=\"line-height:normal\">Menyelenggarakan Pendidikan dan\r\nPengajaran, Penelitian, Pengembangan Ilmu yang terintegrasi dengan pengabdian\r\nkepada masyarakat dalam upaya menghasilkan lulusan yang profesional, menguasai\r\nilmu pengetahuan, teknologi, seni dan budaya, bermoral terbuka terhadap\r\nperubahan dan perkembangan serta memiliki solidaritas yang tinggi dengan\r\nmemperhatikan pelayanan dan pengabdian kepada golongan yang lemah.<o:p></o:p></p>',1,1,'2024-05-17 17:21:41','2024-05-19 15:21:42',NULL),
(3,2,4,'<p class=\"MsoListParagraph\" style=\"margin-left:18.0pt;mso-add-space:auto;\r\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level1 lfo1\"><!--[if !supportLists]--><b>1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></b><!--[endif]--><b>Makna\r\nNilai Keutamaan<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\">Makna dari setiap nilai keutamaan\r\nUniversitas Katolik Widya Mandala Surabaya (UKWMS) dapat dijelaskan sebagai berikut:<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><b>Peduli,</b> merupakan sikap yang menunjukkan perhatian yang besar\r\nterhadap sesama warga di lingkungan UKWMS dan para pemangku kepentingan,\r\nmengindahkan segala tata peraturan dan kebijakan yang ditetapkan oleh lembaga,\r\nserta aktif ikut bagian dalam setiap kegiatan yang dilaksanakan, baik di\r\nlingkup internal maupun eksternal. Adapun dimensi sikap dan perilaku dari nilai\r\n‘Peduli’ yang harus dimiliki dan ditunjukkan adalah: saling menghormati satu\r\nsama lain; saling menghargai keadaan/kondisi masing-masing; saling menyapa\r\ndengan tulus hati bila bertemu; saling meringankan beban bila ada yang\r\nberkesusahan; saling memberikan pertolongan bila diperlukan; ramah terhadap\r\npara tamu, sopan terhadap mereka, dan memberikan pelayanan yang terbaik; ikut\r\nambil bagian dalam setiap kegiatan yang diadakan; menjaga nama baik lembaga;\r\ntidak mementingkan diri sendiri, alih-alih, lebih memperjuangkan kepentingan\r\norang lain (cf. pro bono publico), lembaga, para pemangku kepentingan, dan\r\nsebagainya; berpihak kepada yang lemah, berkekurangan, dan sebagainya (option\r\nfor the poor); menghargai keberhasilan seseorang; saling asah, asih, dan asuh;\r\nsaling menjaga nama baik rekan sekerja atau teman sejawat; memberikan bimbingan\r\nyang optimal kepada mahasiswa yang lemah secara akademis sehingga mereka dapat\r\nberhasil dalam studinya.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><b>&nbsp;</b></p><p class=\"MsoNormal\" style=\"line-height:normal\"><b>Komit,</b> merupakan kesediaan untuk berbuat sesuai dengan amanah,\r\ntuntutan lembaga atau pun kewajiban sebagai warga UKWMS. Ini merupakan sikap\r\nyang minimal atau pun normatif. Diharapkan para warga UKWMS memiliki sikap\r\nkomit yang afektif, yang sejauh mungkin … “beyond the call of duty”. Adapun\r\ndimensi sikap dan perilaku dari nilai ‘Komit’ yang harus dimiliki dan\r\nditunjukkan adalah: mengutamakan kepentingan lembaga; kecintaan terhadap\r\ninstitusi; tidak bersikap transaksional (pertimbangan untung rugi) dalam melaksanakan\r\ntugas kelembagaan, baik pejabat struktural, dosen maupun tenaga kependidikan;\r\nsenantiasa mempertimbangkan efisiensi dan efektivitas penggunaan sarana dan\r\nprasarana yang disediakan oleh lembaga; jujur dan adil dalam memberikan\r\npenilaian sesuai dengan pedoman penilaian yang ditetapkan oleh lembaga;\r\nmenyelesaikan semua permasalahan dengan sikap saling menghormati, dan\r\nsenantiasa berikhtiar untuk tercapainya ‘win-win solution’; menjalankan tugas\r\ndan kewajibannya sesuai dengan ketentuan yang ditetapkan oleh lembaga;\r\nmengutamakan dialog dalam menyelesaikan setiap konflik yang terjadi dengan\r\nsikap saling menghormati; memegang teguh rahasia jabatan; menepati janji yang\r\ntelah disepakati bersama; menyelesaikan setiap tugas yang dibebankan dengan\r\npenuh tanggungjawab dan tepat waktu; kerelaan untuk berbagi pengetahuan dan\r\npengalaman; menepati setiap kesepakatan dan/atau perjanjian tertulis dan/atau\r\ntidak tertulis.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><b>Antusias,</b> merupakan sikap amat bergairah, sangat berminat, dan\r\nbersemangat berapi-api dalam setiap tugas dan kegiatan yang diemban atau pun\r\ndilaksanakan; tidak ada rasa keterpaksaan, bahkan (serasa) selalu ingin\r\nmelaksanakannya; sikap yang menimbulkan gairah positif, dan meningkatkan\r\nkualitas hubungan dengan orang-orang lain, serta terbuka terhadap ide-ide atau\r\npun peluang baru. Adapun dimensi sikap dan perilaku dari nilai ‘Antusias’ yang\r\nharus dimiliki dan ditunjukkan adalah: belajar sepanjang hayat; bersemangat\r\ndalam melaksanakan panggilan tugas; jujur dalam pelaksanaan setiap tugas;\r\nmenjadi agen perubahan; mengikuti berbagai kegiatan pelatihan atau\r\nkegiatan-kegiatan serupa dengan berpartisipasi secara aktif; memberikan tanggapan\r\natas setiap usulan yang diajukan oleh teman sekerja dalam pertemuan atau rapat\r\ndengan tetap memegang teguh tata krama; berani untuk mengemukakan pendapat,\r\napalagi jika pendapatnya berguna bagi setiap lembaga.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\">&nbsp;<o:p></o:p></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-left:18.0pt;mso-add-space:\r\nauto;text-indent:-18.0pt;line-height:normal;mso-list:l2 level1 lfo2\"><!--[if !supportLists]--><b>2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></b><!--[endif]--><b>Makna\r\nVisi<o:p></o:p></b></p><p class=\"MsoListParagraphCxSpLast\" style=\"margin-left:18.0pt;mso-add-space:auto;\r\nline-height:normal\"><b>&nbsp;</b></p><p class=\"MsoNormal\" style=\"line-height:normal\">Visi ini dapat dijelaskan sebagai\r\nberikut:<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\">Komunitas akademik adalah\r\nkumpulan insan akademik yang terdiri dari dosen, mahasiswa, dan alumni yang\r\nsemakin hari semakin meningkat, baik dalam jumlah maupun mutunya, serta mampu\r\nmemberikan kontribusi kepada masyarakat.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\">Reflektif dimaksudkan bahwa\r\nkomunitas tersebut senantiasa secara sadar:<o:p></o:p></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent:-18.0pt;line-height:normal;\r\nmso-list:l0 level1 lfo3\"><!--[if !supportLists]-->a.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span><!--[endif]-->melakukan evaluasi terhadap ketercapaian tujuan,\r\nprogram, pelaksanaan dan hasil kegiatan Tri Dharma Perguruan Tinggi;<o:p></o:p></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent:-18.0pt;line-height:\r\nnormal;mso-list:l0 level1 lfo3\"><!--[if !supportLists]-->b.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span><!--[endif]-->melakukan evaluasi terhadap kesesuaian\r\npelaksanaan program dan hasil kegiatan Tri Dharma Perguruan Tinggi dengan\r\nnilai-nilai yang menjadi landasan (nilai-nilai Pancasila dan prinsip-prinsip\r\nagama Katolik);<o:p></o:p></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent:-18.0pt;line-height:normal;\r\nmso-list:l0 level1 lfo3\"><!--[if !supportLists]-->c.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span><!--[endif]-->meningkatkan kepekaan terhadap perkembangan\r\nzaman dan menanggapi tantangan zaman.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\">Kreatif dimaksudkan bahwa\r\nkomunitas tersebut senantiasa mencari solusi terbaik dan berinovasi dalam\r\nmemecahkan masalah maupun memanfaatkan kekuatan dan peluang demi kesejahteraan\r\nmasyarakat.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\">Berlandaskan nilai-nilai\r\nPancasila maksudnya bahwa UKWMS sebagai salah satu Perguruan Tinggi Indonesia\r\nmenjunjung tinggi Pancasila sebagai dasar Negara Kesatuan Republik Indonesia\r\ndan nilai-nilai yang terkandung di dalamnya.<o:p></o:p></p><p class=\"MsoNormal\" style=\"line-height:normal\"><o:p>&nbsp;</o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"line-height:normal\">Prinsip-prinsip Katolik adalah\r\npelaksanaan hukum Kasih dan Perutusan sebagai garam dan terang dunia\r\nsebagaimana tertuang dalam Kitab Suci Alkitab.<o:p></o:p></p>',1,1,'2024-05-17 17:21:41','2024-05-19 15:21:42',NULL),
(4,2,5,'<p class=\"MsoNormal\" style=\"line-height:normal\"><strong>Faktor Internal<o:p></o:p></strong></p><p class=\"MsoNormal\" style=\"line-height:normal\"><strong>&nbsp;</strong></p><p>\r\n\r\n\r\n\r\n</p><table class=\"MsoNormalTable\" border=\"0\" cellpadding=\"0\">\r\n <tbody><tr>\r\n  <td style=\"padding:.75pt .75pt .75pt .75pt\">\r\n  <p style=\"margin:0cm;line-height:115%\"><a name=\"_Hlk97036007\">Untuk\r\n  menentukan strategi yang tepat, perlu dilakukan evaluasi diri secara\r\n  komprehensif. &nbsp;Evaluasi dilakukan terhadap faktor internal dan eksternal\r\n  dengan menggunakan berbagai sumber data dan informasi.&nbsp; Data-data\r\n  internal antara lain diperoleh dari hasil audit mutu internal, umpan balik\r\n  dari asesor akreditasi dan berbagai hasil kuesioner internal.&nbsp; &nbsp;Evaluasi\r\n  untuk faktor internal menggunakan acuan standar akreditasi BAN-PT sedangkan\r\n  untuk evaluasi faktor eksternal dilakukan terhadap empat faktor lingkungan\r\n  yang mempengaruhi institusi yaitu faktor politik, ekonomi, sosial dan\r\n  teknologi (PEST). Hasil evaluasi kemudian dipetakan menggunakan matriks SWOT\r\n  yang terdiri dari komponen kekuatan (<em>Strengths</em>) dan kelemahan (<em>Weaknesses</em>)\r\n  dari faktor internal institusi, serta peluang (<em>Opportunities</em>) dan\r\n  tantangan &nbsp;(<em>Threats</em>) yang berasal dari faktor lingkungan\r\n  eksternal.<o:p></o:p></a></p>\r\n  <p style=\"margin:0cm;line-height:115%\">&nbsp;<o:p></o:p></p>\r\n  <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n  <p style=\"margin:0cm;line-height:115%\"><strong>FAKTOR INTERNAL<o:p></o:p></strong></p>\r\n  <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n  <table class=\"MsoTableGrid\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"border: none;\">\r\n   <tbody><tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p align=\"center\" style=\"margin:0cm;text-align:center;line-height:115%\"><b><span lang=\"IN\">No<o:p></o:p></span></b></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p align=\"center\" style=\"margin:0cm;text-align:center;line-height:115%\"><b><span lang=\"IN\">Standar<o:p></o:p></span></b></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p align=\"center\" style=\"margin:0cm;text-align:center;line-height:115%\"><b><span lang=\"IN\">No<o:p></o:p></span></b></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p align=\"center\" style=\"margin:0cm;text-align:center;line-height:115%\"><b><span lang=\"IN\">Strength<o:p></o:p></span></b></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p align=\"center\" style=\"margin:0cm;text-align:center;line-height:115%\"><b><span lang=\"IN\">No<o:p></o:p></span></b></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p align=\"center\" style=\"margin:0cm;text-align:center;line-height:115%\"><b><span lang=\"IN\">Weakness<o:p></o:p></span></b></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">1<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Visi Misi Tujuan Strategi<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.1.1<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.1.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.1.2<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.1.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">2<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Tata Kelola, Tata Pamong, dan Kerjasama<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.2.1<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.2.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.2.2<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.2.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">3<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Mahasiswa <o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.3.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.3.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.3.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.3.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">4<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Sumber Daya Manusia<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.4.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.4.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.4.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.4.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">5<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Keuangan, Sarana da Prasarana<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.5.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.5.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.5.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.5.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">6<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Pendidikan<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.6.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.6.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.6.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.6.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">7<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Penelitian<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.7.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.7.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.7.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.7.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">8<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Pengabdian Kepada Masyarakat<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.8.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.8.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.8.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.8.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">9<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">Luaran dan Capaian Tridharma<o:p></o:p></span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.9.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.9.1</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"44\" valign=\"top\" style=\"width:32.7pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"239\" valign=\"top\" style=\"width:178.9pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">&nbsp;</span></p>\r\n    </td>\r\n    <td width=\"47\" valign=\"top\" style=\"width:35.5pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">S.9.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"238\" valign=\"top\" style=\"width:178.65pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><span lang=\"IN\">W.9.2</span><o:p></o:p></p>\r\n    </td>\r\n    <td width=\"229\" valign=\"top\" style=\"width:171.55pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n    </td>\r\n   </tr>\r\n  </tbody></table>\r\n  <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n  <p style=\"margin:0cm;line-height:115%\">&nbsp;<o:p></o:p></p>\r\n  <p style=\"margin:0cm;line-height:115%\"><o:p>&nbsp;</o:p></p>\r\n  <p style=\"margin:0cm;line-height:115%\"><strong>FAKTOR EKSTERNAL<o:p></o:p></strong></p>\r\n  <table class=\"MsoTableGrid\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"border: none;\">\r\n   <tbody><tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Faktor<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">No<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Opportunity<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">No<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border:solid windowtext 1.0pt;\r\n    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Threat<o:p></o:p></span></strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Politik<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\">.</span></strong><strong><span lang=\"IN\">P.1<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\">.</span></strong><strong><span lang=\"IN\">P.1</span><o:p></o:p></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.P.2<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.P.2</span><o:p></o:p></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Ekonomi<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.E.1<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.E.1</span><o:p></o:p></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.E.2<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.E.2</span><o:p></o:p></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Sosial</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\"><o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.S.1</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\"><o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span style=\"font-size:10.0pt;\r\n    line-height:115%\">&nbsp;</span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.S.1</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\"><o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span style=\"font-size:10.0pt;\r\n    line-height:115%\">&nbsp;</span></strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\">&nbsp;</span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.S.2</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\"><o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span style=\"font-size:10.0pt;\r\n    line-height:115%\">&nbsp;</span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.S.2</span></strong><strong><span lang=\"IN\" style=\"font-size:10.0pt;line-height:115%;mso-ansi-language:IN\"><o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span style=\"font-size:10.0pt;\r\n    line-height:115%\">&nbsp;</span></strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">Teknologi<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.T.1<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.T.1</span><o:p></o:p></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n   </tr>\r\n   <tr>\r\n    <td width=\"170\" valign=\"top\" style=\"width:127.4pt;border:solid windowtext 1.0pt;\r\n    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:\r\n    solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">O.T.2<o:p></o:p></span></strong></p>\r\n    </td>\r\n    <td width=\"287\" valign=\"top\" style=\"width:214.95pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n    <td width=\"54\" valign=\"top\" style=\"width:40.15pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong><span lang=\"IN\">T.T.2</span><o:p></o:p></strong></p>\r\n    </td>\r\n    <td width=\"286\" valign=\"top\" style=\"width:214.8pt;border-top:none;border-left:\r\n    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n    mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt\">\r\n    <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n    </td>\r\n   </tr>\r\n  </tbody></table>\r\n  <p style=\"margin:0cm;line-height:115%\"><strong>&nbsp;</strong></p>\r\n  </td>\r\n </tr>\r\n</tbody></table>',1,1,'2024-05-17 17:21:41','2024-05-19 15:23:31',NULL),
(5,2,6,'<ol style=\"margin-top:0cm\" start=\"1\" type=\"1\">\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Budaya kerja tim dan\r\n     pengelolaan Universitas Katolik<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Dosen, tenaga\r\n     kependidikan, dan mahasiswa yang profesional<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Kebanggaan dan rasa\r\n     memiliki almamater<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Manajemen internal yang\r\n     baik<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Teknologi Informasi dan\r\n     Komunikasi<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Komunikasi internal dan\r\n     eksternal yang unggul<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"margin-right:129.6pt;text-align:left;line-height:\r\n     normal;mso-list:l0 level1 lfo1;tab-stops:list 36.0pt\">Sistem remunerasi\r\n     berbasis kinerja<o:p></o:p></li>\r\n</ol>',1,1,'2024-05-17 17:21:41','2024-05-19 15:23:57',NULL),
(6,3,2,'<p>tokek</p>',1,1,'2024-05-17 18:19:19','2024-05-17 18:19:36',NULL),
(7,3,3,'<p>makan</p>',1,1,'2024-05-17 18:19:19','2024-05-17 18:19:36',NULL),
(8,3,4,'<p>ayam</p>',1,1,'2024-05-17 18:19:19','2024-05-17 18:19:36',NULL),
(9,3,5,'<p>adasd</p>',1,1,'2024-05-17 18:19:19','2024-05-17 18:19:36',NULL),
(10,3,6,'<p>ccc</p>',1,1,'2024-05-17 18:19:19','2024-05-17 18:19:36',NULL);

/*Table structure for table `renstra_komponen` */

DROP TABLE IF EXISTS `renstra_komponen`;

CREATE TABLE `renstra_komponen` (
  `id_renstra_komponen` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_unit_kerja` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `kode_komponen_renstra` varchar(100) DEFAULT NULL,
  `judul_komponen_renstra` varchar(255) DEFAULT NULL,
  `isi_komponen_renstra` varchar(255) DEFAULT NULL,
  `status_renstra_komponen` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_renstra_komponen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renstra_komponen` */

insert  into `renstra_komponen`(`id_renstra_komponen`,`jenis_unit_kerja`,`id_periode`,`kode_komponen_renstra`,`judul_komponen_renstra`,`isi_komponen_renstra`,`status_renstra_komponen`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,2,'A','Ini komponen pertama','asdasdasdasd',1,1,NULL,'2024-05-17 07:25:29',NULL),
(2,1,NULL,'A','Komponen A',NULL,1,1,'2024-05-17 17:16:27','2024-05-17 17:16:27',NULL),
(3,1,NULL,'B','Komponen B',NULL,1,1,'2024-05-17 17:19:21','2024-05-17 17:19:33',NULL),
(4,1,NULL,'C','Komponen C',NULL,1,1,'2024-05-17 17:19:38','2024-05-17 17:19:46',NULL),
(5,1,NULL,'D','Komponen D',NULL,1,1,'2024-05-17 17:19:53','2024-05-17 17:20:01',NULL),
(6,1,NULL,'E','Komponen E',NULL,1,1,'2024-05-17 17:20:06','2024-05-17 17:20:16',NULL);

/*Table structure for table `renstra_rencana_strategis` */

DROP TABLE IF EXISTS `renstra_rencana_strategis`;

CREATE TABLE `renstra_rencana_strategis` (
  `id_renstra_rencana_strategis` int(11) NOT NULL AUTO_INCREMENT,
  `kode_rencana_kegiatan` varchar(255) DEFAULT NULL,
  `id_dokumen_renstra` int(11) DEFAULT NULL,
  `id_sasaran` int(11) DEFAULT NULL,
  `id_indikator` int(11) DEFAULT NULL,
  `id_strategi` int(11) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `rencana_kegiatan` varchar(255) DEFAULT NULL,
  `periode_1` varchar(255) DEFAULT '0',
  `periode_2` varchar(255) DEFAULT '0',
  `periode_3` varchar(255) DEFAULT '0',
  `periode_4` varchar(255) DEFAULT '0',
  `periode_5` varchar(255) DEFAULT '0',
  `baseline` varchar(255) DEFAULT '0',
  `target` varchar(255) DEFAULT '0',
  `status_renstra_rencana_strategis` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_renstra_rencana_strategis`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `renstra_rencana_strategis` */

insert  into `renstra_rencana_strategis`(`id_renstra_rencana_strategis`,`kode_rencana_kegiatan`,`id_dokumen_renstra`,`id_sasaran`,`id_indikator`,`id_strategi`,`id_unit_kerja`,`id_periode`,`rencana_kegiatan`,`periode_1`,`periode_2`,`periode_3`,`periode_4`,`periode_5`,`baseline`,`target`,`status_renstra_rencana_strategis`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'1',2,1,1,1,NULL,1,'asdasdasdas','23','44','33','22','12','10','1111',1,1,'2024-05-19 15:44:38','2024-05-19 16:19:09',NULL),
(2,'2',2,1,1,1,NULL,1,'asdasdasdasd','5','87','4','1','33','3','333',1,1,'2024-05-19 15:45:02','2024-05-19 16:19:09',NULL),
(3,'asdasd',2,1,1,1,NULL,1,'3','6','5','2','231','213','4','344',1,1,'2024-05-19 16:01:23','2024-05-19 16:19:09',NULL);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) DEFAULT NULL,
  `kode_unit_kerja` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `hk_user_read` tinyint(1) DEFAULT 0,
  `hk_user_create` tinyint(1) DEFAULT 0,
  `hk_user_update` tinyint(1) DEFAULT 0,
  `hk_user_delete` tinyint(1) DEFAULT 0,
  `hk_role_read` tinyint(1) DEFAULT 0,
  `hk_role_create` tinyint(1) DEFAULT 0,
  `hk_role_update` tinyint(1) DEFAULT 0,
  `hk_role_delete` tinyint(1) DEFAULT 0,
  `hk_renstra_read` tinyint(1) DEFAULT 0,
  `hk_renstra_create` tinyint(1) DEFAULT 0,
  `hk_renstra_update` tinyint(1) DEFAULT 0,
  `hk_renstra_delete` tinyint(1) DEFAULT 0,
  `hk_renop_read` tinyint(1) DEFAULT 0,
  `hk_renop_create` tinyint(1) DEFAULT 0,
  `hk_renop_update` tinyint(1) DEFAULT 0,
  `hk_renop_delete` tinyint(1) DEFAULT 0,
  `hk_tblrenstra_read` tinyint(1) DEFAULT 0,
  `hk_tblrenstra_create` tinyint(1) DEFAULT 0,
  `hk_tblrenstra_update` tinyint(1) DEFAULT 0,
  `hk_komrenstra_read` tinyint(1) DEFAULT 0,
  `hk_komrenstra_create` tinyint(1) DEFAULT 0,
  `hk_komrenstra_update` tinyint(1) DEFAULT 0,
  `hk_uk_read` tinyint(1) DEFAULT 0,
  `hk_uk_create` tinyint(1) DEFAULT 0,
  `hk_uk_update` tinyint(1) DEFAULT 0,
  `hk_periode_read` tinyint(1) DEFAULT 0,
  `hk_periode_create` tinyint(1) DEFAULT 0,
  `hk_periode_update` tinyint(1) DEFAULT 0,
  `hk_periode_delete` tinyint(1) DEFAULT 0,
  `status_role` tinyint(1) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`id_role`,`nama_role`,`kode_unit_kerja`,`keterangan`,`hk_user_read`,`hk_user_create`,`hk_user_update`,`hk_user_delete`,`hk_role_read`,`hk_role_create`,`hk_role_update`,`hk_role_delete`,`hk_renstra_read`,`hk_renstra_create`,`hk_renstra_update`,`hk_renstra_delete`,`hk_renop_read`,`hk_renop_create`,`hk_renop_update`,`hk_renop_delete`,`hk_tblrenstra_read`,`hk_tblrenstra_create`,`hk_tblrenstra_update`,`hk_komrenstra_read`,`hk_komrenstra_create`,`hk_komrenstra_update`,`hk_uk_read`,`hk_uk_create`,`hk_uk_update`,`hk_periode_read`,`hk_periode_create`,`hk_periode_update`,`hk_periode_delete`,`status_role`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Admin',1,'Administrator Role',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,NULL,NULL,'2024-04-26 07:01:21',NULL),
(3,'Read only',1,NULL,1,0,0,0,1,0,0,0,1,1,0,0,1,0,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,0,1,'2024-04-19 10:13:07','2024-04-26 07:49:06',NULL),
(4,'Asdf',1,NULL,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,'2024-04-24 14:46:04','2024-04-24 14:46:04',NULL),
(5,'PeriodeOnly',2,NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,'2024-04-24 14:57:43','2024-04-24 14:57:43',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tim_pelayanan_d` */

insert  into `tim_pelayanan_d`(`id_pelayanan_d`,`id_pelayanan_h`,`id_bagian`,`id_user`,`status_tim_pelayanan_d`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,NULL,13,1,'2024-10-04 10:44:33','2024-10-04 17:23:07','2024-10-04 17:23:07'),
(3,1,NULL,10,1,'2024-10-05 01:45:31','2024-10-05 01:46:24','2024-10-05 01:46:24'),
(4,2,NULL,10,1,'2024-10-05 11:16:31','2024-10-05 11:16:31',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tim_pelayanan_h` */

insert  into `tim_pelayanan_h`(`id_pelayanan_h`,`nama_tim_pelayanan_h`,`id_user`,`id_cabang`,`status_tim_pelayanan_h`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'PCM 2',6,1,1,'2024-10-04 10:44:33','2024-10-04 16:22:57',NULL),
(2,'PCM 1',13,1,1,'2024-10-05 11:16:31','2024-10-05 11:16:31',NULL);

/*Table structure for table `unit_kerja` */

DROP TABLE IF EXISTS `unit_kerja`;

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL AUTO_INCREMENT,
  `kode_unit_kerja` varchar(255) DEFAULT NULL,
  `jenis_unit_kerja` tinyint(1) DEFAULT NULL,
  `nama_unit_kerja` varchar(255) DEFAULT NULL,
  `unit_kerja_atasan` int(11) DEFAULT NULL,
  `nama_unit_kerja_atasan` varchar(255) DEFAULT NULL,
  `status_atasan` tinyint(4) DEFAULT NULL,
  `status_unit_kerja` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_unit_kerja`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `unit_kerja` */

insert  into `unit_kerja`(`id_unit_kerja`,`kode_unit_kerja`,`jenis_unit_kerja`,`nama_unit_kerja`,`unit_kerja_atasan`,`nama_unit_kerja_atasan`,`status_atasan`,`status_unit_kerja`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'1',1,'TOKEK',NULL,NULL,0,0,NULL,'2022-09-11 09:55:55','2023-04-09 10:26:37',NULL),
(2,'11',1,'TOKEK MAKAN AYAM',1,'TOKEK',1,1,NULL,'2022-09-11 09:56:10','2023-04-09 10:10:05',NULL),
(3,'111',4,'TOKEK MAKIN AYAM 22',11,'TOKEK MAKAN AYAM',1,0,NULL,'2022-09-11 09:56:26','2023-04-09 10:10:56',NULL),
(4,'112',1,'TOKEK MAKIN AYAN 2',11,'TOKEK MAKAN AYAM',1,1,NULL,'2022-09-11 09:56:42','2022-09-11 09:56:42',NULL),
(5,'2',2,'MAKAN AYAM',NULL,NULL,0,1,NULL,'2022-09-11 09:56:57','2022-09-11 09:56:57',NULL),
(6,'3',4,'Super Admin',NULL,NULL,0,1,NULL,'2023-01-11 12:16:40','2023-01-11 12:16:40',NULL),
(7,'4',4,'Rektor',NULL,NULL,0,1,NULL,'2023-01-11 12:19:29','2023-01-11 12:19:29',NULL),
(9,'42',4,'Dekan',4,'Rektor',1,1,NULL,'2023-01-11 12:20:19','2023-01-11 12:20:19',NULL),
(10,'421',2,'Kepala Departemen',42,'Dekan',1,1,NULL,'2023-01-11 12:20:51','2023-01-11 12:20:51',NULL),
(11,'4211',2,'Kepala Jurusan',421,'Kepala Departemen',1,1,NULL,'2023-01-11 12:21:18','2023-01-11 12:21:18',NULL),
(12,'21',3,'asdasd',2,'MAKAN AYAM',1,0,NULL,'2023-04-05 06:38:45','2023-04-05 06:38:45',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap_user` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `role` tinyint(1) DEFAULT 1,
  `status_user` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama_lengkap_user`,`username`,`password`,`keterangan`,`role`,`status_user`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'SOEPER ADMIN','admin','$2y$10$.A1zSMZ9BqUSrso9CDmqWuUQMJIWYTCDTE4ZvZT0a4tKs4XZjdNXG','tokek makan ayam',1,0,NULL,'2023-01-11 13:51:41','2023-01-11 13:51:41',NULL),
(2,'tokekTokek','tokekAyam','$2y$10$RRy3bJbSn45ESHFcyViK0.5sv0w4ZwBxEKPSWrndKalArN3aisLSa','asdasdasd',1,1,1,'2023-03-13 07:10:54','2023-03-13 07:10:54',NULL);

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
  `grade` tinyint(2) DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama_lengkap`,`email`,`alamat`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`nij`,`telp`,`kesibukan`,`nomor_cg`,`posisi_cg`,`status_user`,`nama_pemimpin`,`telp_pemimpin`,`role`,`grade`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Super Admin','super@super.com',NULL,0,NULL,NULL,'','','','0',NULL,1,NULL,NULL,0,1,NULL,'$2y$10$MFbjuLrLhokQspUhbG.Sh.G0X5DLkAU8xTdlrmT9fwe327.9/MwLS',NULL,NULL,NULL,NULL),
(6,'Hansul Santusu','a@a.com','Jl. Ngagel',1,'Semarang','1999-03-12','12380971203','+6276128312','Kuliah','12312312','Pemimpin',1,'Tokek','+6276128312',2,9,NULL,'$2y$10$rLHyqP6L03fcE82ofQtSo.juluP0bI6LW6KKRu/ifGc.gGdeEQkeG',NULL,'2024-07-06 09:05:34','2024-10-05 02:11:02',NULL),
(10,'Tokek 123','b@b.com','oaisjdoasdj',0,NULL,'2024-04-23','198273102370','01283192381238','Bekerja','99','Anggota',1,'LEad a','08231928312',3,4,NULL,'$2y$10$z4sLIFFYk3.bJtPi5ASHe.RMgWE0fX6byKYfqu6a1fBhejp5Hbq8S',NULL,'2024-08-04 03:57:51','2024-10-05 11:18:17',NULL),
(13,'Subjek 123','c@c.com','oaisjdoasdj',0,NULL,'2024-04-23','198273102370','01283192381238','Bekerja','99','Anggota',1,'LEad a','08231928312',2,1,NULL,'$2y$10$z4sLIFFYk3.bJtPi5ASHe.RMgWE0fX6byKYfqu6a1fBhejp5Hbq8S',NULL,'2024-08-04 03:57:51','2024-10-05 11:16:31',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
