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
  `quyen` int(11) DEFAULT NULL,
  `Khoa` varchar(45) DEFAULT NULL,
  `ngaySinh` varchar(45) DEFAULT NULL,
  `diachi` varchar(45) DEFAULT NULL,
  `gioitinh` int(11) DEFAULT NULL,
  `updatDate` varchar(45) DEFAULT NULL,
  `chuyennganh` varchar(45) DEFAULT NULL,
  `hocphanday` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangviens`
--

LOCK TABLES `giangviens` WRITE;
/*!40000 ALTER TABLE `giangviens` DISABLE KEYS */;
/*!40000 ALTER TABLE `giangviens` ENABLE KEYS */;
UNLOCK TABLES;

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
  `mota` varchar(45) DEFAULT NULL,
  `trangthai` varchar(45) DEFAULT NULL,
  `updatDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hocphans`
--

LOCK TABLES `hocphans` WRITE;
/*!40000 ALTER TABLE `hocphans` DISABLE KEYS */;
INSERT INTO `hocphans` VALUES (2,NULL,'a','a','0','2014-10-09 22:55:34'),(3,NULL,'a','a','1','2014-10-09 23:00:25'),(4,NULL,'a','a','1','2014-10-09 23:10:04');
/*!40000 ALTER TABLE `hocphans` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khoas`
--

LOCK TABLES `khoas` WRITE;
/*!40000 ALTER TABLE `khoas` DISABLE KEYS */;
INSERT INTO `khoas` VALUES (3,NULL,'a','sssssss',NULL),(4,'a','a','sssss',NULL),(5,'Cntt','Công nghệ thông tin','cone',NULL);
/*!40000 ALTER TABLE `khoas` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `khuvucs` WRITE;
/*!40000 ALTER TABLE `khuvucs` DISABLE KEYS */;
/*!40000 ALTER TABLE `khuvucs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lichgiangday`
--

DROP TABLE IF EXISTS `lichgiangday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lichgiangday` (
  `id` int(11) NOT NULL,
  `mahocky` varchar(45) DEFAULT NULL,
  `magiangvien` varchar(45) DEFAULT NULL,
  `mahocphan` varchar(45) DEFAULT NULL,
  `maphong` varchar(45) DEFAULT NULL,
  `tutiet` varchar(45) DEFAULT NULL,
  `dentiet` varchar(45) DEFAULT NULL,
  `thu` varchar(45) DEFAULT NULL,
  `trangthai` varchar(45) DEFAULT NULL,
  `updateDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lichgiangday`
--

LOCK TABLES `lichgiangday` WRITE;
/*!40000 ALTER TABLE `lichgiangday` DISABLE KEYS */;
/*!40000 ALTER TABLE `lichgiangday` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `loaithietbis` WRITE;
/*!40000 ALTER TABLE `loaithietbis` DISABLE KEYS */;
/*!40000 ALTER TABLE `loaithietbis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lophocphans`
--

DROP TABLE IF EXISTS `lophocphans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lophocphans` (
  `Id` int(11) NOT NULL,
  `maLopHocPhan` varchar(45) DEFAULT NULL,
  `maHocPhan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lophocphans`
--

LOCK TABLES `lophocphans` WRITE;
/*!40000 ALTER TABLE `lophocphans` DISABLE KEYS */;
/*!40000 ALTER TABLE `lophocphans` ENABLE KEYS */;
UNLOCK TABLES;

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
  `thietbi` varchar(45) DEFAULT NULL,
  `trangThai` varchar(45) DEFAULT NULL,
  `ngayCapNhap` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phongs`
--

LOCK TABLES `phongs` WRITE;
/*!40000 ALTER TABLE `phongs` DISABLE KEYS */;
/*!40000 ALTER TABLE `phongs` ENABLE KEYS */;
UNLOCK TABLES;

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
  `trangThai` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thietbis`
--

LOCK TABLES `thietbis` WRITE;
/*!40000 ALTER TABLE `thietbis` DISABLE KEYS */;
/*!40000 ALTER TABLE `thietbis` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-13  8:32:31
