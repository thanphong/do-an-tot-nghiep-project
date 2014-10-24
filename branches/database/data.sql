CREATE DATABASE  IF NOT EXISTS `doan` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `doan`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: doan
-- ------------------------------------------------------
-- Server version	5.6.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `giangvienhocphans`
--

DROP TABLE IF EXISTS `giangvienhocphans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giangvienhocphans` (
  `id` int(11) NOT NULL,
  `maGiangvien` int(11) DEFAULT NULL,
  `maHocphan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_giangvien_idx` (`maGiangvien`),
  KEY `fk_hocphan_idx` (`maHocphan`),
  CONSTRAINT `fk_giangvien` FOREIGN KEY (`maGiangvien`) REFERENCES `giangviens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hocphan` FOREIGN KEY (`maHocphan`) REFERENCES `hocphans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangvienhocphans`
--

/*!40000 ALTER TABLE `giangvienhocphans` DISABLE KEYS */;
/*!40000 ALTER TABLE `giangvienhocphans` ENABLE KEYS */;

--
-- Table structure for table `giangvienkhoas`
--

DROP TABLE IF EXISTS `giangvienkhoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giangvienkhoas` (
  `magiangvien` int(11) DEFAULT NULL,
  `makhoa` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_giangvien_idx` (`magiangvien`),
  KEY `fk_khoa_idx` (`makhoa`),
  CONSTRAINT `fk_giangvien_khoa` FOREIGN KEY (`magiangvien`) REFERENCES `giangviens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_khoa` FOREIGN KEY (`makhoa`) REFERENCES `khoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangvienkhoas`
--

/*!40000 ALTER TABLE `giangvienkhoas` DISABLE KEYS */;
/*!40000 ALTER TABLE `giangvienkhoas` ENABLE KEYS */;

--
-- Table structure for table `giangviens`
--

DROP TABLE IF EXISTS `giangviens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giangviens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maGiangvien` varchar(45) DEFAULT NULL,
  `ten` varchar(45) DEFAULT NULL,
  `MatKhau` varchar(45) DEFAULT NULL,
  `ngaySinh` varchar(45) DEFAULT NULL,
  `diachi` varchar(45) DEFAULT NULL,
  `gioitinh` int(11) DEFAULT NULL,
  `chuyennganh` varchar(45) DEFAULT NULL,
  `updatDate` varchar(45) DEFAULT NULL,
  `hocvi` varchar(45) DEFAULT NULL,
  `hocham` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangviens`
--

/*!40000 ALTER TABLE `giangviens` DISABLE KEYS */;
/*!40000 ALTER TABLE `giangviens` ENABLE KEYS */;

--
-- Table structure for table `hockys`
--

DROP TABLE IF EXISTS `hockys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hockys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahocky` varchar(45) DEFAULT NULL,
  `batdau` datetime DEFAULT NULL,
  `kethuc` datetime DEFAULT NULL,
  `updateDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hockys`
--

/*!40000 ALTER TABLE `hockys` DISABLE KEYS */;
/*!40000 ALTER TABLE `hockys` ENABLE KEYS */;

--
-- Table structure for table `hocphans`
--

DROP TABLE IF EXISTS `hocphans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hocphans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maHocPhan` varchar(45) DEFAULT NULL,
  `tenhocphan` varchar(45) DEFAULT NULL,
  `sotinchi` int(11) DEFAULT NULL,
  `khoa` int(11) DEFAULT NULL,
  `mota` varchar(45) DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `updatDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_hocphan_khoa_idx` (`khoa`),
  CONSTRAINT `fk_hocphan_khoa` FOREIGN KEY (`khoa`) REFERENCES `khoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hocphans`
--

/*!40000 ALTER TABLE `hocphans` DISABLE KEYS */;
INSERT INTO `hocphans` VALUES (2,NULL,'a',NULL,NULL,'a',0,'2014-10-09 22:55:34'),(3,NULL,'a',NULL,NULL,'a',1,'2014-10-09 23:00:25'),(4,NULL,'a',NULL,NULL,'a',1,'2014-10-09 23:10:04');
/*!40000 ALTER TABLE `hocphans` ENABLE KEYS */;

--
-- Table structure for table `khoas`
--

DROP TABLE IF EXISTS `khoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `khoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maKhoa` varchar(45) DEFAULT NULL,
  `tenKhoa` varchar(45) DEFAULT NULL,
  `mota` varchar(45) DEFAULT NULL,
  `ngayCapNhap` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khoas`
--

/*!40000 ALTER TABLE `khoas` DISABLE KEYS */;
INSERT INTO `khoas` VALUES (3,NULL,'a','sssssss',NULL),(4,'a','a','sssss',NULL),(5,'Cntt','Công nghệ thông tin','cone',NULL);
/*!40000 ALTER TABLE `khoas` ENABLE KEYS */;

--
-- Table structure for table `khuvucs`
--

DROP TABLE IF EXISTS `khuvucs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `khuvucs` (
  `id` int(11) NOT NULL,
  `tenKhuVuc` varchar(45) DEFAULT NULL,
  `mota` text,
  `ngayCapNhap` datetime DEFAULT NULL,
  `khuvuccol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khuvucs`
--

/*!40000 ALTER TABLE `khuvucs` DISABLE KEYS */;
/*!40000 ALTER TABLE `khuvucs` ENABLE KEYS */;

--
-- Table structure for table `lichgiangdays`
--

DROP TABLE IF EXISTS `lichgiangdays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lichgiangdays` (
  `id` int(11) NOT NULL,
  `mahocky` int(11) DEFAULT NULL,
  `magiangvien` int(11) DEFAULT NULL,
  `malophocphan` int(11) DEFAULT NULL,
  `maphong` int(11) DEFAULT NULL,
  `tutiet` int(11) DEFAULT NULL,
  `dentiet` int(11) DEFAULT NULL,
  `thu` int(11) DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `updateDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngaybat dau` date DEFAULT NULL,
  `ngayketthuc` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hocky_idx` (`mahocky`),
  KEY `fk_lich_giangvien_idx` (`magiangvien`),
  KEY `fk_lich_phong_idx` (`maphong`),
  KEY `fk_lich_lhp_idx` (`malophocphan`),
  CONSTRAINT `fk_hocky` FOREIGN KEY (`mahocky`) REFERENCES `hockys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lich_giangvien` FOREIGN KEY (`magiangvien`) REFERENCES `giangviens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lich_lhp` FOREIGN KEY (`malophocphan`) REFERENCES `lophocphans` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lich_phong` FOREIGN KEY (`maphong`) REFERENCES `phongs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lichgiangdays`
--

/*!40000 ALTER TABLE `lichgiangdays` DISABLE KEYS */;
/*!40000 ALTER TABLE `lichgiangdays` ENABLE KEYS */;

--
-- Table structure for table `loaithietbis`
--

DROP TABLE IF EXISTS `loaithietbis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loaithietbis` (
  `id` int(11) NOT NULL,
  `tenLoai` varchar(45) DEFAULT NULL,
  `ngayCapNhap` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loaithietbis`
--

/*!40000 ALTER TABLE `loaithietbis` DISABLE KEYS */;
/*!40000 ALTER TABLE `loaithietbis` ENABLE KEYS */;

--
-- Table structure for table `lophocphans`
--

DROP TABLE IF EXISTS `lophocphans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lophocphans` (
  `Id` int(11) NOT NULL,
  `maLopHocPhan` varchar(45) DEFAULT NULL,
  `tenLopHocPhan` varchar(45) DEFAULT NULL,
  `maHocPhan` int(11) DEFAULT NULL,
  `soLuong` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_lhp_hp_idx` (`maHocPhan`),
  CONSTRAINT `fk_lhp_hp` FOREIGN KEY (`maHocPhan`) REFERENCES `hocphans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lophocphans`
--

/*!40000 ALTER TABLE `lophocphans` DISABLE KEYS */;
/*!40000 ALTER TABLE `lophocphans` ENABLE KEYS */;

--
-- Table structure for table `phongs`
--

DROP TABLE IF EXISTS `phongs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phongs` (
  `id` int(11) NOT NULL,
  `maPhong` varchar(45) DEFAULT NULL,
  `tenPhong` varchar(45) DEFAULT NULL,
  `khuVuc` int(11) DEFAULT NULL,
  `soLuongGhe` int(11) DEFAULT NULL,
  `trangThai` varchar(45) DEFAULT NULL,
  `ngayCapNhap` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_phong_khuvuc_idx` (`khuVuc`),
  CONSTRAINT `fk_phong_khuvuc` FOREIGN KEY (`khuVuc`) REFERENCES `khuvucs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phongs`
--

/*!40000 ALTER TABLE `phongs` DISABLE KEYS */;
/*!40000 ALTER TABLE `phongs` ENABLE KEYS */;

--
-- Table structure for table `phongthietbis`
--

DROP TABLE IF EXISTS `phongthietbis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phongthietbis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maphong` int(11) DEFAULT NULL,
  `mathietbi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_phong_thietbi_idx` (`mathietbi`),
  KEY `fk_phong_phong_idx` (`maphong`),
  CONSTRAINT `fk_phong_phong` FOREIGN KEY (`maphong`) REFERENCES `phongs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_phong_thietbi` FOREIGN KEY (`mathietbi`) REFERENCES `thietbis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phongthietbis`
--

/*!40000 ALTER TABLE `phongthietbis` DISABLE KEYS */;
/*!40000 ALTER TABLE `phongthietbis` ENABLE KEYS */;

--
-- Table structure for table `quyengiangviens`
--

DROP TABLE IF EXISTS `quyengiangviens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quyengiangviens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maquyen` int(11) DEFAULT NULL,
  `magiangvien` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quyen_giangvien_idx` (`magiangvien`),
  KEY `fk_quyen_quyen_idx` (`maquyen`),
  CONSTRAINT `fk_quyen_giangvien` FOREIGN KEY (`magiangvien`) REFERENCES `giangviens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quyen_quyen` FOREIGN KEY (`maquyen`) REFERENCES `quyens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quyengiangviens`
--

/*!40000 ALTER TABLE `quyengiangviens` DISABLE KEYS */;
/*!40000 ALTER TABLE `quyengiangviens` ENABLE KEYS */;

--
-- Table structure for table `quyens`
--

DROP TABLE IF EXISTS `quyens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quyens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maquyen` varchar(45) DEFAULT NULL,
  `mota` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quyens`
--

/*!40000 ALTER TABLE `quyens` DISABLE KEYS */;
/*!40000 ALTER TABLE `quyens` ENABLE KEYS */;

--
-- Table structure for table `thietbis`
--

DROP TABLE IF EXISTS `thietbis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thietbis` (
  `id` int(11) NOT NULL,
  `mathietbi` varchar(45) DEFAULT NULL,
  `tenThietbi` varchar(45) DEFAULT NULL,
  `loaiThietbi` int(11) DEFAULT NULL,
  `ngayCapNhap` datetime DEFAULT NULL,
  `trangThai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_thietbi_loai_idx` (`loaiThietbi`),
  CONSTRAINT `fk_thietbi_loai` FOREIGN KEY (`loaiThietbi`) REFERENCES `loaithietbis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thietbis`
--

/*!40000 ALTER TABLE `thietbis` DISABLE KEYS */;
/*!40000 ALTER TABLE `thietbis` ENABLE KEYS */;

--
-- Table structure for table `thongbaos`
--

DROP TABLE IF EXISTS `thongbaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thongbaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(45) DEFAULT NULL,
  `noidung` varchar(45) DEFAULT NULL,
  `nguoidang` int(11) DEFAULT NULL,
  `ngaydang` datetime DEFAULT NULL,
  `ngayCapnhap` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_thongbao_giangvien_idx` (`nguoidang`),
  CONSTRAINT `fk_thongbao_giangvien` FOREIGN KEY (`nguoidang`) REFERENCES `giangviens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thongbaos`
--

/*!40000 ALTER TABLE `thongbaos` DISABLE KEYS */;
/*!40000 ALTER TABLE `thongbaos` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-24 10:58:40
