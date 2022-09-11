-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 04:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_cofee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jk` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `jk`, `alamat`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'Laki - Laki', 'Sleman', 'Admin@gmail.com', '$2y$10$W8WQjMLk0UseMAMqyYEko.vNXzNWBXgWRqOX9s0MOr.spZWnxLUDO', 1),
(2, 'Owner', 'Laki - Laki', 'Sleman\r\n', 'Owner@gmail.com', '$2y$10$Rqkdk3UQZ77oJ2AfrPgxmet7my7iBURW6nMKNLOdQPjtGI0qmj6G.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jk` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `jk`, `alamat`, `email`, `password`) VALUES
(1, 'Customers', 'Laki - Laki', 'Sleman', 'Customer@gmail.com', '$2y$10$EUJ80CGmsjuSm0i/GPOTBOok/vCWI0wJDLQ7L6gfgsz6lHmpmab9C'),
(2, 'daus', 'Laki - Laki', 'sleman', 'daus@gmail.com', '$2y$10$hf5vjpIGIMcJkQQK04nPeesj92RfT74S3HzusnFDakUbXGjCotcea'),
(3, 'Arief', 'Laki - Laki', 'Cilacap', 'ariefsyuhada570@gmail.com', '$2y$10$2CVZ/g47LGcPZMLFUBn0I.amJM5v9XgVZKGMrWk86VrLeKlKzIefu'),
(4, 'hesti septiani', 'Wanita', 'tambun selatan', 'hestiseptiani119@gmail.com', '$2y$10$3xwaSwVzK9w08c3kR60jQuAHxOrC0YCN5xvey1cOIkntEmVJkqasu'),
(5, 'Katinka', 'Wanita', 'Cipayung datar', 'katinkayulistine@gmail.com', '$2y$10$f5tQX2e1BhTPQvbT2BcSEua.gNs6.l0p2aixDW777xSFbyRFYAhJq'),
(6, 'Mabroimam', 'Laki - Laki', 'Sumberjaya, Tambun Selatan', 'mabroimam@gmail.com', '$2y$10$dmYSXzhacepcD8F/yIJjHe9VtFsmMM/5XurNIKjC1HsjQkIgaYqVi'),
(7, 'stepen', 'Laki - Laki', 'bekasi', 'crops8710@gmail.com', '$2y$10$bRH7cCiA2yXTVTUK2zU9eeDVdEoqa.q7Nbknv0a3ydjyUGVtvo0Vi'),
(8, 'Farah', 'Wanita', 'JL Sriwibowo utara IV no 1', 'farahaosyahoktaviana@gmail.com', '$2y$10$UbpiXdJdGhF.cP.9rhp2OeACVrR/vPIUbTsd/vCz3j69m3nuBQ27y'),
(10, 'Puput', 'Wanita', 'Kost putri dinar, gg, kenary', 'putrianggraini298@gmail.com', '$2y$10$MYGh08ZB4PCaC2LqLDf/guUMvslClKXZzuqHXg7..KV/PTCg5Xhcm'),
(11, 'Jojo', 'Laki - Laki', 'Tambun Selatan', 'jojonur04@gmail.com', '$2y$10$3FQnvcqWIktli3Yy42YUc.H6QZ5sXWV/06SD9kERaHDI8Hrl3N7/y'),
(12, 'cokin', 'Laki - Laki', 'monjali', 'cokinsetia@gmail.com', '$2y$10$zYSU7ohGclnDwo9SjVA81ep4dWM6ferIYXhxwP2XrWilwJ839R3OC'),
(13, 'faiz', 'Laki - Laki', 'bekasi', 'faizrmdhn15@gmail.com', '$2y$10$XAXIXeCX65uFReGEiu9Ru.V1sRFsZg78gkbBLNEGshtY15FCizG2u'),
(14, 'Hilmy', 'Laki - Laki', 'bekasi', 'kangnaena1@gmail.com', '$2y$10$1rs3JsBYjm7cHNFhSv9amO5QbuuIyomhqqo7M9Yvdxz/96EQSQI3G');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  `atribut` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama`, `bobot`, `atribut`) VALUES
(2, 'Rasa', 2, 'Benefit'),
(3, 'Aroma', 2, 'Benefit'),
(4, 'Kekentalan', 2, 'Cost'),
(6, 'Manis', 2, 'Benefit'),
(7, 'Pahit', 2, 'Cost'),
(9, 'Asam', 2, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pencarian`
--

CREATE TABLE `laporan_pencarian` (
  `id_laporan_pencarian` varchar(10) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_sub_kriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_pencarian`
--

INSERT INTO `laporan_pencarian` (`id_laporan_pencarian`, `id_customer`, `id_sub_kriteria`) VALUES
('W2MRPPXJRX', 3, 12),
('W2MRPPXJRX', 3, 17),
('W2MRPPXJRX', 3, 24),
('W2MRPPXJRX', 3, 36),
('W2MRPPXJRX', 3, 39),
('QTB68PVNMG', 3, 12),
('QTB68PVNMG', 3, 17),
('QTB68PVNMG', 3, 24),
('QTB68PVNMG', 3, 36),
('QTB68PVNMG', 3, 39),
('QBBZ9WTPLJ', 1, 15),
('QBBZ9WTPLJ', 1, 18),
('QBBZ9WTPLJ', 1, 23),
('QBBZ9WTPLJ', 1, 35),
('QBBZ9WTPLJ', 1, 38),
('G6HX559EN5', 12, 13),
('G6HX559EN5', 12, 18),
('G6HX559EN5', 12, 22),
('G6HX559EN5', 12, 33),
('G6HX559EN5', 12, 38),
('3N13HJS86W', 1, 13),
('3N13HJS86W', 1, 19),
('3N13HJS86W', 1, 23),
('3N13HJS86W', 1, 34),
('3N13HJS86W', 1, 39),
('3N13HJS86W', 1, 44),
('ET4N5NW64G', 5, 12),
('ET4N5NW64G', 5, 19),
('ET4N5NW64G', 5, 22),
('ET4N5NW64G', 5, 32),
('ET4N5NW64G', 5, 38),
('ET4N5NW64G', 5, 42),
('37120IUPAR', 5, 12),
('37120IUPAR', 5, 19),
('37120IUPAR', 5, 22),
('37120IUPAR', 5, 32),
('37120IUPAR', 5, 38),
('37120IUPAR', 5, 42);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_produk`
--

CREATE TABLE `laporan_produk` (
  `id_laporan_produk` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_laporan_pencarian` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_produk`
--

INSERT INTO `laporan_produk` (`id_laporan_produk`, `id_produk`, `id_laporan_pencarian`) VALUES
(31, 9, 'W2MRPPXJRX'),
(32, 17, 'W2MRPPXJRX'),
(33, 16, 'W2MRPPXJRX'),
(34, 11, 'W2MRPPXJRX'),
(35, 10, 'W2MRPPXJRX'),
(36, 9, 'QTB68PVNMG'),
(37, 17, 'QTB68PVNMG'),
(38, 16, 'QTB68PVNMG'),
(39, 11, 'QTB68PVNMG'),
(40, 10, 'QTB68PVNMG'),
(41, 18, 'QBBZ9WTPLJ'),
(42, 17, 'QBBZ9WTPLJ'),
(43, 16, 'QBBZ9WTPLJ'),
(44, 9, 'QBBZ9WTPLJ'),
(45, 11, 'QBBZ9WTPLJ'),
(46, 14, 'CESBO6ODHE'),
(47, 19, 'CESBO6ODHE'),
(48, 12, 'CESBO6ODHE'),
(49, 13, 'CESBO6ODHE'),
(50, 9, 'CESBO6ODHE'),
(51, 15, 'G6HX559EN5'),
(52, 11, 'G6HX559EN5'),
(53, 10, 'G6HX559EN5'),
(54, 9, 'G6HX559EN5'),
(55, 18, 'G6HX559EN5'),
(56, 9, '3N13HJS86W'),
(57, 14, '3N13HJS86W'),
(58, 19, '3N13HJS86W'),
(59, 12, '3N13HJS86W'),
(60, 13, '3N13HJS86W'),
(61, 15, 'ET4N5NW64G'),
(62, 11, 'ET4N5NW64G'),
(63, 10, 'ET4N5NW64G'),
(64, 14, 'ET4N5NW64G'),
(65, 19, 'ET4N5NW64G'),
(66, 15, '37120IUPAR'),
(67, 11, '37120IUPAR'),
(68, 10, '37120IUPAR'),
(69, 14, '37120IUPAR'),
(70, 19, '37120IUPAR');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_sub_kriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_produk`, `id_sub_kriteria`) VALUES
(91, 17, 14),
(92, 17, 18),
(93, 17, 22),
(94, 17, 36),
(95, 17, 37),
(96, 17, 43),
(97, 19, 13),
(98, 19, 20),
(99, 19, 24),
(100, 19, 33),
(101, 19, 40),
(102, 19, 46),
(103, 18, 15),
(104, 18, 17),
(105, 18, 22),
(106, 18, 36),
(107, 18, 37),
(108, 18, 42),
(109, 12, 13),
(110, 12, 20),
(111, 12, 24),
(112, 12, 33),
(113, 12, 40),
(114, 12, 46),
(115, 13, 13),
(116, 13, 20),
(117, 13, 24),
(118, 13, 33),
(119, 13, 40),
(120, 13, 46),
(121, 11, 12),
(122, 11, 18),
(123, 11, 23),
(124, 11, 35),
(125, 11, 39),
(126, 11, 43),
(133, 16, 14),
(134, 16, 18),
(135, 16, 22),
(136, 16, 36),
(137, 16, 37),
(138, 16, 43),
(139, 14, 12),
(140, 14, 19),
(141, 14, 24),
(142, 14, 34),
(143, 14, 39),
(144, 14, 45),
(145, 9, 13),
(146, 9, 18),
(147, 9, 22),
(148, 9, 35),
(149, 9, 38),
(150, 9, 43),
(151, 10, 12),
(152, 10, 18),
(153, 10, 23),
(154, 10, 35),
(155, 10, 39),
(156, 10, 43),
(157, 15, 14),
(158, 15, 18),
(159, 15, 23),
(160, 15, 33),
(161, 15, 40),
(162, 15, 43),
(169, 26, 13),
(170, 26, 20),
(171, 26, 25),
(172, 26, 33),
(173, 26, 40),
(174, 26, 45),
(175, 23, 14),
(176, 23, 20),
(177, 23, 25),
(178, 23, 34),
(179, 23, 40),
(180, 23, 43),
(181, 25, 13),
(182, 25, 20),
(183, 25, 25),
(184, 25, 33),
(185, 25, 40),
(186, 25, 45),
(187, 24, 14),
(188, 24, 20),
(189, 24, 25),
(190, 24, 33),
(191, 24, 40),
(192, 24, 45),
(193, 27, 13),
(194, 27, 20),
(195, 27, 25),
(196, 27, 33),
(197, 27, 40),
(198, 27, 46);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `deskripsi`, `harga`) VALUES
(9, 'Tubruk', 'Kopi Tubruk Adalah Minuman Kopi Khas Indonesia Yang Dibuat Dengan Menuangkan Air Panas Ke Dalam Gela', 10000),
(10, 'V Sixty', 'Teknik V60 Adalah Salah Satu Teknik Yang Paling Sering Digunakan Oleh Para Barista. Umumnya, Metode ', 20000),
(11, 'Japanese Iced Coffee', 'Berbeda Dengan Cold Brew Yang Memberi Kenikmatan Minum Kopi Dingin Yang Membutuhkan Waktu Yang Cukup', 20000),
(12, 'Iced Coffee Forty', 'Kopi Susu Dingin Ditambah Dengan Gula Aren. Cocok Untukmu Bagi Yang Menyukai Kopi Dengan Rasa Yang M', 18000),
(13, 'Iced Coffee Percent', 'Es Kopi Susu Dingin Yang Ditambahkan Dengan Bahan Rahasia Khas Kedai Kami. Cocok Untukmu Bagi Yang M', 18000),
(14, 'Moccacino', 'Sederhananya, Mochaccino Adalah Cappuccino Yang Ditambah Cokelat. Orang Italia Biasanya Menikmati Mo', 18000),
(15, 'Vietnamese', 'Kopi Vietnam Atau Yang Dikenal Sebagai CÃ  PhÃª Sá»¯a Ä‘Ã¡ Adalah Minuman Kopi Dingin Yang Berasal D', 15000),
(16, 'Long Black', 'Long Black Identik Dengan Sisa Krema Yang Berada Di Permukaan Kopi. Karena Menuangkan Air Panas Terl', 13000),
(17, 'Americano', 'Seperti Namanya, Americano Tentu Adalah Kopi Hitam Yang Berasal Dari Amerika. Meskipun Di Coffee Sho', 13000),
(18, 'Espresso', 'Espresso, Dibaca Es-press-soh, Adalah Ekstrak Dari Biji Kopi Yang Diproses Dengan Mesin Tekanan Ting', 12000),
(19, 'Cafe Latte', 'Caffe Latte Adalah Kopi Espresso Yang Diberi Susu.', 18000),
(23, 'Forty Percent Lemonade', 'Kopi Khas 40% Cafe Dengan Sentuhan Lemon', 16000),
(24, 'Matcha Iced Coffee', 'Kopi Dengan Campuran Teh Hijau ', 18000),
(25, 'Hazelnut Latte', 'Kopi Susu Dengan Campuran Hazelnut', 20000),
(26, 'Caramel Latte', 'Kopi Susu Dengan Syrup Caramel', 20000),
(27, 'Vanilla Latte', 'Kopi Susu Dengan Campuran Syrup Vanilla', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `rating` enum('Sangat Kurang','Kurang','Cukup','Baik','Sangat Baik') DEFAULT NULL,
  `id_laporan_pencarian` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `rating`, `id_laporan_pencarian`) VALUES
(1, 'Cukup', 'JLXLZMEFXK'),
(2, 'Sangat Baik', 'JXJ8NBRWAE'),
(3, 'Sangat Baik', '6UL4NEC8OA'),
(4, 'Sangat Baik', 'DC83MXMPGJ'),
(5, 'Cukup', 'LKIDND1QQX'),
(6, 'Sangat Baik', 'QTB68PVNMG'),
(7, 'Sangat Baik', 'W2MRPPXJRX'),
(8, 'Sangat Baik', 'OYERYN11DA'),
(9, 'Baik', 'QBBZ9WTPLJ'),
(10, 'Cukup', '3N13HJS86W');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nama_sub` varchar(50) DEFAULT NULL,
  `bobot_sub` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nama_sub`, `bobot_sub`) VALUES
(12, 2, 'Sangat Bagus', 5),
(13, 2, 'Kompleks', 4),
(14, 2, 'Halus', 3),
(15, 2, 'Cukup', 2),
(16, 2, 'Buruk', 1),
(17, 3, 'Sangat Bagus', 5),
(18, 3, 'Kompleks', 4),
(19, 3, 'Halus', 3),
(20, 3, 'Cukup', 2),
(21, 3, 'Buruk', 1),
(22, 4, 'Berat', 5),
(23, 4, 'Tinggi', 4),
(24, 4, 'Sedang', 3),
(25, 4, 'Tipis', 2),
(26, 4, 'Bersih', 1),
(32, 6, 'Tinggi', 5),
(33, 6, 'Sedang Ke Tinggi', 4),
(34, 6, 'Sedang', 3),
(35, 6, 'Sedang Ke Rendah', 2),
(36, 6, 'Rendah', 1),
(37, 7, 'Tinggi', 5),
(38, 7, 'Sedang Ke Tinggi', 4),
(39, 7, 'Sedang', 3),
(40, 7, 'Sedang Ke Rendah', 2),
(41, 7, 'Rendah', 1),
(42, 9, 'Tinggi', 5),
(43, 9, 'Sedang', 4),
(44, 9, 'Rendah', 3),
(45, 9, 'Tipis', 2),
(46, 9, 'Bersih', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `laporan_pencarian`
--
ALTER TABLE `laporan_pencarian`
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indexes for table `laporan_produk`
--
ALTER TABLE `laporan_produk`
  ADD PRIMARY KEY (`id_laporan_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laporan_produk`
--
ALTER TABLE `laporan_produk`
  MODIFY `id_laporan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_pencarian`
--
ALTER TABLE `laporan_pencarian`
  ADD CONSTRAINT `laporan_pencarian_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_pencarian_ibfk_2` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_produk`
--
ALTER TABLE `laporan_produk`
  ADD CONSTRAINT `laporan_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
