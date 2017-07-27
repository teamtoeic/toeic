-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 12:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_trac_nghiem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bang_chuan_cua_diem`
--

CREATE TABLE IF NOT EXISTS `bang_chuan_cua_diem` (
  `ma_diem_chuan` int(11) NOT NULL AUTO_INCREMENT,
  `diem_chuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ma_diem_chuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bang_chuan_cua_diem`
--

INSERT INTO `bang_chuan_cua_diem` (`ma_diem_chuan`, `diem_chuan`) VALUES
(1, '0-250'),
(2, '250-500');

-- --------------------------------------------------------

--
-- Table structure for table `bang_tam`
--

CREATE TABLE IF NOT EXISTS `bang_tam` (
  `ma_cau_hoi` int(11) DEFAULT NULL,
  `ma_cau_tra_loi` int(11) DEFAULT NULL,
  `ma_nguoi_dung` int(11) DEFAULT NULL,
  `ghi_chu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bang_xu_ly`
--

CREATE TABLE IF NOT EXISTS `bang_xu_ly` (
  `ma_xu_ly` int(11) NOT NULL AUTO_INCREMENT,
  `ten_xu_ly` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `so_diem` int(11) NOT NULL,
  `note` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_xu_ly`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bang_xu_ly`
--

INSERT INTO `bang_xu_ly` (`ma_xu_ly`, `ten_xu_ly`, `min`, `max`, `so_diem`, `note`) VALUES
(1, 'Số lượng câu đề thi 100', 0, 100, 0, ''),
(2, 'Số lượng câu đề thi 200', 0, 200, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `cau_hoi`
--

CREATE TABLE IF NOT EXISTS `cau_hoi` (
  `ma_cau_hoi` int(11) NOT NULL AUTO_INCREMENT,
  `ma_loai_noi_dung` int(11) DEFAULT NULL,
  `ma_do_kho` int(11) DEFAULT NULL,
  `ma_chu_de` int(11) DEFAULT NULL,
  `noi_dung_cau_hoi` varchar(2000) DEFAULT NULL,
  `ngay_tao` date DEFAULT NULL,
  PRIMARY KEY (`ma_cau_hoi`),
  KEY `ma_loai_noi_dung` (`ma_loai_noi_dung`),
  KEY `ma_do_kho` (`ma_do_kho`),
  KEY `ma_chu_de` (`ma_chu_de`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cau_hoi`
--

INSERT INTO `cau_hoi` (`ma_cau_hoi`, `ma_loai_noi_dung`, `ma_do_kho`, `ma_chu_de`, `noi_dung_cau_hoi`, `ngay_tao`) VALUES
(1, 1, 1, 2, 'what is Candy Crush ?', '2017-05-25'),
(2, 1, 1, 2, 'kkk', '2017-05-25'),
(3, 2, 1, NULL, 'zzzzzzzzzzzz', '2017-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `cau_tra_loi`
--

CREATE TABLE IF NOT EXISTS `cau_tra_loi` (
  `ma_cau_tra_loi` int(11) NOT NULL AUTO_INCREMENT,
  `ma_cau_hoi` int(11) DEFAULT NULL,
  `dap_an_tra_loi` varchar(2000) DEFAULT NULL,
  `ket_qua` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_cau_tra_loi`),
  KEY `ma_cau_hoi` (`ma_cau_hoi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cau_tra_loi`
--

INSERT INTO `cau_tra_loi` (`ma_cau_tra_loi`, `ma_cau_hoi`, `dap_an_tra_loi`, `ket_qua`) VALUES
(1, 1, 'toy', 0),
(2, 1, 'game', 1),
(3, 1, 'ball', 0),
(4, 1, 'video', 0),
(5, 2, 'yes', 0),
(6, 2, 'no', 0),
(7, 2, 'not of all', 1),
(8, 3, 'q', 0),
(9, 3, 'as', 0),
(10, 3, 'z', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cau_truc_de_thi`
--

CREATE TABLE IF NOT EXISTS `cau_truc_de_thi` (
  `ma_cau_truc` int(11) NOT NULL AUTO_INCREMENT,
  `ten_cau_truc` varchar(50) DEFAULT NULL,
  `so_luong_cau_de_thi` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_cau_truc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cau_truc_de_thi`
--

INSERT INTO `cau_truc_de_thi` (`ma_cau_truc`, `ten_cau_truc`, `so_luong_cau_de_thi`) VALUES
(1, 'Đề TOEIC', 200),
(2, 'Luyện Listenning', 100),
(3, 'Đề chuẩn', 200);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_cau_truc`
--

CREATE TABLE IF NOT EXISTS `chi_tiet_cau_truc` (
  `ma_cap_do` int(11) NOT NULL AUTO_INCREMENT,
  `ma_do_kho` int(11) DEFAULT NULL,
  `ma_loai_noi_dung` int(11) DEFAULT NULL,
  `ma_diem_chuan` int(11) DEFAULT NULL,
  `so_luong_cau` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_cap_do`),
  KEY `ma_do_kho` (`ma_do_kho`),
  KEY `ma_loai_noi_dung` (`ma_loai_noi_dung`),
  KEY `ma_diem_chuan` (`ma_diem_chuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chu_de`
--

CREATE TABLE IF NOT EXISTS `chu_de` (
  `ma_chu_de` int(11) NOT NULL AUTO_INCREMENT,
  `ma_loai_noi_dung` int(11) DEFAULT NULL,
  `ten_chu_de` varchar(255) DEFAULT NULL,
  `noi_dung_chu_de` varchar(5000) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `hinh_anh` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ma_chu_de`),
  KEY `ma_loai_noi_dung` (`ma_loai_noi_dung`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `chu_de`
--

INSERT INTO `chu_de` (`ma_chu_de`, `ma_loai_noi_dung`, `ten_chu_de`, `noi_dung_chu_de`, `link`, `hinh_anh`) VALUES
(1, 1, 'Moto', '<p>the motobike....</p>\r\n', 'abc1495599515.mp3', 'IMG_3061621495599515.png'),
(2, 1, 'Candy Crush', '<p>Candy Crush is one of hot game on facebook</p>\r\n\r\n<p>This game bring feel relax</p>\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE IF NOT EXISTS `danh_gia` (
  `id_danh_gia` int(11) NOT NULL AUTO_INCREMENT,
  `ten_danh_gia` varchar(500) DEFAULT NULL,
  `tu_diem` int(11) DEFAULT NULL,
  `den_diem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_danh_gia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `danh_gia`
--

INSERT INTO `danh_gia` (`id_danh_gia`, `ten_danh_gia`, `tu_diem`, `den_diem`) VALUES
(1, 'Khá', 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `do_kho`
--

CREATE TABLE IF NOT EXISTS `do_kho` (
  `ma_do_kho` int(11) NOT NULL AUTO_INCREMENT,
  `ten_do_kho` varchar(255) NOT NULL,
  PRIMARY KEY (`ma_do_kho`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `do_kho`
--

INSERT INTO `do_kho` (`ma_do_kho`, `ten_do_kho`) VALUES
(1, 'Easy');

-- --------------------------------------------------------

--
-- Table structure for table `loai_noi_dung`
--

CREATE TABLE IF NOT EXISTS `loai_noi_dung` (
  `ma_loai_noi_dung` int(11) NOT NULL AUTO_INCREMENT,
  `ma_phan_thi` int(11) DEFAULT NULL,
  `ten_loai_noi_dung` varchar(255) DEFAULT NULL,
  `so_luong_cau_hoi` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_loai_noi_dung`),
  KEY `ma_phan_thi` (`ma_phan_thi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `loai_noi_dung`
--

INSERT INTO `loai_noi_dung` (`ma_loai_noi_dung`, `ma_phan_thi`, `ten_loai_noi_dung`, `so_luong_cau_hoi`) VALUES
(1, 1, 'Photo', 10),
(2, 1, 'Short Talk', 40);

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE IF NOT EXISTS `nguoi_dung` (
  `ma_nguoi_dung` int(11) NOT NULL AUTO_INCREMENT,
  `ten_nguoi_dung` varchar(500) DEFAULT NULL,
  `dia_chi` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `sdt` int(11) DEFAULT NULL,
  `username` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `quyen_han` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_nguoi_dung`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`ma_nguoi_dung`, `ten_nguoi_dung`, `dia_chi`, `email`, `sdt`, `username`, `password`, `quyen_han`) VALUES
(1, 'Minh', 'TP HCM', 'a@gmail.com', 909090909, 'tienminh', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phan_thi`
--

CREATE TABLE IF NOT EXISTS `phan_thi` (
  `ma_phan_thi` int(11) NOT NULL AUTO_INCREMENT,
  `ma_cau_truc` int(11) DEFAULT NULL,
  `ten_phan_thi` varchar(255) DEFAULT NULL,
  `so_luong_cau_phan_thi` int(11) DEFAULT NULL,
  `tong_diem` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_phan_thi`),
  KEY `ma_cau_truc` (`ma_cau_truc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `phan_thi`
--

INSERT INTO `phan_thi` (`ma_phan_thi`, `ma_cau_truc`, `ten_phan_thi`, `so_luong_cau_phan_thi`, `tong_diem`) VALUES
(1, 1, 'Listenning', 100, 495),
(2, 1, 'Reading', 100, 495),
(3, 2, 'Photograph', 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE IF NOT EXISTS `thong_bao` (
  `ma_thong_bao` int(11) NOT NULL AUTO_INCREMENT,
  `ma_nguoi_dung` int(11) DEFAULT NULL,
  `tieu_de` varchar(500) DEFAULT NULL,
  `noi_dung_thong_bao` varchar(5000) DEFAULT NULL,
  `hinh_anh` varchar(500) DEFAULT NULL,
  `ngay_dang` date DEFAULT NULL,
  `trang_thai` int(11) DEFAULT NULL,
  PRIMARY KEY (`ma_thong_bao`),
  KEY `ma_nguoi_dung` (`ma_nguoi_dung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD CONSTRAINT `cau_hoi_ibfk_1` FOREIGN KEY (`ma_loai_noi_dung`) REFERENCES `loai_noi_dung` (`ma_loai_noi_dung`),
  ADD CONSTRAINT `cau_hoi_ibfk_2` FOREIGN KEY (`ma_do_kho`) REFERENCES `do_kho` (`ma_do_kho`),
  ADD CONSTRAINT `cau_hoi_ibfk_3` FOREIGN KEY (`ma_chu_de`) REFERENCES `chu_de` (`ma_chu_de`);

--
-- Constraints for table `cau_tra_loi`
--
ALTER TABLE `cau_tra_loi`
  ADD CONSTRAINT `cau_tra_loi_ibfk_1` FOREIGN KEY (`ma_cau_hoi`) REFERENCES `cau_hoi` (`ma_cau_hoi`);

--
-- Constraints for table `chi_tiet_cau_truc`
--
ALTER TABLE `chi_tiet_cau_truc`
  ADD CONSTRAINT `chi_tiet_cau_truc_ibfk_1` FOREIGN KEY (`ma_do_kho`) REFERENCES `do_kho` (`ma_do_kho`),
  ADD CONSTRAINT `chi_tiet_cau_truc_ibfk_2` FOREIGN KEY (`ma_loai_noi_dung`) REFERENCES `loai_noi_dung` (`ma_loai_noi_dung`),
  ADD CONSTRAINT `chi_tiet_cau_truc_ibfk_3` FOREIGN KEY (`ma_diem_chuan`) REFERENCES `bang_chuan_cua_diem` (`ma_diem_chuan`);

--
-- Constraints for table `chu_de`
--
ALTER TABLE `chu_de`
  ADD CONSTRAINT `chu_de_ibfk_1` FOREIGN KEY (`ma_loai_noi_dung`) REFERENCES `loai_noi_dung` (`ma_loai_noi_dung`);

--
-- Constraints for table `loai_noi_dung`
--
ALTER TABLE `loai_noi_dung`
  ADD CONSTRAINT `loai_noi_dung_ibfk_1` FOREIGN KEY (`ma_phan_thi`) REFERENCES `phan_thi` (`ma_phan_thi`);

--
-- Constraints for table `phan_thi`
--
ALTER TABLE `phan_thi`
  ADD CONSTRAINT `phan_thi_ibfk_1` FOREIGN KEY (`ma_cau_truc`) REFERENCES `cau_truc_de_thi` (`ma_cau_truc`);

--
-- Constraints for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD CONSTRAINT `thong_bao_ibfk_1` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoi_dung` (`ma_nguoi_dung`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
