# Host: localhost  (Version 5.5.5-10.4.11-MariaDB)
# Date: 2020-10-25 18:50:12
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "paket"
#

CREATE TABLE `paket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "paket"
#

INSERT INTO `paket` VALUES (1,'Intensif'),(2,'Full Time'),(3,'Part Time');

#
# Structure for table "sekolah"
#

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

#
# Data for table "sekolah"
#

INSERT INTO `sekolah` VALUES (1,'SMK Multistudi Highschool','batam','batam','batam','batam'),(2,'SMK Maitreyawira','Batam','Batam','Batam','Batam'),(4,'smk negeri 1 tembilahan','jl. BJ','tembilahan','tembilahan','indragiri hilir');

#
# Structure for table "siswa"
#

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_induk` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_siswa_sekolah` (`id_sekolah`),
  KEY `FK_siswa_paket` (`id_paket`),
  CONSTRAINT `FK_siswa_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id`),
  CONSTRAINT `FK_siswa_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# Data for table "siswa"
#

INSERT INTO `siswa` VALUES (1,123,'andry duck','L','','2000-01-01','2000-01-01','taman kota mas','ahong',1,1),(2,12312,'ted','L','','2000-01-01','2000-01-01','tamkot','a',1,1),(3,12123,'tesss','L','','2000-01-01','1999-10-10','tamkott','a',1,1);
