-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 04:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbvirus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `pengguna` varchar(30) NOT NULL,
  `sandi` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`pengguna`, `sandi`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblaturan`
--

CREATE TABLE `tblaturan` (
  `kd_aturan` int(11) NOT NULL,
  `kd_gejala` varchar(7) NOT NULL,
  `kd_penyakit` varchar(7) NOT NULL,
  `nl_prob` decimal(2,1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblaturan`
--

INSERT INTO `tblaturan` (`kd_aturan`, `kd_gejala`, `kd_penyakit`, `nl_prob`) VALUES
(170, 'G23', 'P09', 0.9),
(171, 'G24', 'P09', 0.9),
(172, 'G03', 'P10', 0.7),
(173, 'G09', 'P10', 0.9),
(174, 'G25', 'P10', 0.9),
(175, 'G26', 'P10', 0.9),
(169, 'G15', 'P09', 0.9),
(168, 'G32', 'P08', 0.9),
(167, 'G22', 'P08', 0.9),
(166, 'G21', 'P08', 0.9),
(165, 'G20', 'P08', 0.8),
(136, 'G01', 'P01', 0.9),
(137, 'G02', 'P01', 0.9),
(138, 'G03', 'P01', 0.7),
(139, 'G04', 'P01', 0.9),
(140, 'G05', 'P02', 0.5),
(141, 'G06', 'P02', 0.1),
(142, 'G07', 'P02', 0.8),
(143, 'G08', 'P02', 0.9),
(144, 'G25', 'P02', 0.9),
(145, 'G27', 'P02', 0.5),
(146, 'G28', 'P02', 0.9),
(147, 'G29', 'P02', 0.9),
(148, 'G30', 'P02', 0.8),
(149, 'G09', 'P03', 0.9),
(150, 'G10', 'P03', 0.9),
(151, 'G11', 'P03', 0.1),
(152, 'G25', 'P03', 0.9),
(153, 'G12', 'P04', 0.7),
(154, 'G13', 'P04', 0.8),
(155, 'G14', 'P04', 0.9),
(156, 'G15', 'P05', 0.9),
(157, 'G16', 'P05', 0.9),
(158, 'G17', 'P05', 0.9),
(159, 'G01', 'P06', 0.9),
(160, 'G15', 'P06', 0.9),
(161, 'G18', 'P06', 0.9),
(162, 'G31', 'P06', 0.9),
(163, 'G15', 'P07', 0.9),
(164, 'G19', 'P07', 0.9);

-- --------------------------------------------------------

--
-- Table structure for table `tblbantu`
--

CREATE TABLE `tblbantu` (
  `id_pengunjung` int(11) NOT NULL,
  `kd_gejala` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbantu`
--

INSERT INTO `tblbantu` (`id_pengunjung`, `kd_gejala`) VALUES
(222, 'G36'),
(222, 'G37'),
(222, 'G38'),
(223, 'G01'),
(223, 'G02'),
(223, 'G49'),
(223, 'G50'),
(224, 'G01'),
(224, 'G02'),
(224, 'G03'),
(224, 'G04'),
(297, 'G31'),
(297, 'G04'),
(297, 'G03'),
(297, 'G02'),
(297, 'G01'),
(289, 'G04'),
(289, 'G03'),
(289, 'G02'),
(289, 'G01'),
(270, 'G05'),
(270, 'G04'),
(270, 'G03'),
(297, 'G32');

-- --------------------------------------------------------

--
-- Table structure for table `tblbantu_2`
--

CREATE TABLE `tblbantu_2` (
  `id_pengunjung` int(3) NOT NULL,
  `kd_penyakit` varchar(7) NOT NULL,
  `jml_gejala` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbantu_2`
--

INSERT INTO `tblbantu_2` (`id_pengunjung`, `kd_penyakit`, `jml_gejala`) VALUES
(270, 'P01', 110);

-- --------------------------------------------------------

--
-- Table structure for table `tbldiagnosa`
--

CREATE TABLE `tbldiagnosa` (
  `id_pengunjung` varchar(7) NOT NULL,
  `kd_penyakit` varchar(7) NOT NULL,
  `persen` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblgejala`
--

CREATE TABLE `tblgejala` (
  `kd_gejala` varchar(7) NOT NULL,
  `nm_gejala` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblgejala`
--

INSERT INTO `tblgejala` (`kd_gejala`, `nm_gejala`) VALUES
('G22', 'Rumpun padi mongering dan mati'),
('G23', 'Adanya bercak-bercak kuning yang dapat dilihat di sepanjang tepi daun yang baru '),
('G21', 'Adanya spot-spot kosong di dalam sawah'),
('G20', 'Memotong tanaman pada pangkal batang'),
('G19', 'Lapisan bawah daun berwarna putih'),
('G18', 'Daun yang dimakan dimulai dari tepi daun dan hanya meninggalkan tulang daun  '),
('G17', 'Daun padi yang terpotong menyerupai tabung'),
('G15', 'Kerusakan berada pada daun padi'),
('G13', 'Adanya spot-spot kosong pada petak sawah'),
('G14', 'Tanaman dibagian pinggir (keliling petak) rusak'),
('G12', 'Adanya tanaman padi yang roboh pada petak sawah'),
('G11', 'Pada daun terdapat bercak bekas hisapan'),
('G10', 'Beras berubah warna dan mengapur'),
('G09', 'Kerusakan berada pada bulir padi'),
('G08', 'Tanaman menjadi kerdil'),
('G07', 'Gabah menjadi setengah berisi atau hampa'),
('G06', 'Daun menjadi kering dan menggulung secara membujur'),
('G05', 'Di daerah sekitar lubang bekas hisapan berubah warna menjadi coklat '),
('G04', 'Adanya ngengat dipertanaman dan larva didalam batang padi'),
('G03', 'Adanya beluk (malai hampa)'),
('G16', 'Daun padi terpotong seperti digunting'),
('G01', 'Kerusakan berada pada batang padi'),
('G02', 'Anakan mati yang disebut sundep pada tanaman stadia vegetative'),
('G24', 'Daun yang terserang mengalami perubahan bentuk'),
('G25', 'Biji hampa'),
('G26', 'Biji padi banyak yang hilang'),
('G27', 'Warna tanaman berubah coklat kemerahan atau kuning'),
('G28', 'Pada fase anakan jumlah anakan berkurang'),
('G29', 'Pada fase bunting malai menjadi kerdil dan eksersi malai tidak lengkap'),
('G30', 'Populasi tinggi bugburn atau hopperburn (tanaman kering seperti terbakar)'),
('G31', 'Kerusakan berada pada malai padi'),
('G32', 'Merusak akar muda di bagian tanah');

-- --------------------------------------------------------

--
-- Table structure for table `tblpengunjung`
--

CREATE TABLE `tblpengunjung` (
  `id_pengunjung` int(7) NOT NULL,
  `nm_pengunjung` varchar(40) NOT NULL,
  `tgl_diagnosa` date NOT NULL,
  `gejala` text NOT NULL,
  `penyakit` varchar(60) NOT NULL,
  `nl_bayes` decimal(5,2) NOT NULL,
  `pengobatan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpengunjung`
--

INSERT INTO `tblpengunjung` (`id_pengunjung`, `nm_pengunjung`, `tgl_diagnosa`, `gejala`, `penyakit`, `nl_bayes`, `pengobatan`) VALUES
(302, 'RAHMA', '2024-06-01', 'Adanya ngengat dipertanaman dan larva didalam batang padi, Adanya beluk (malai hampa), Anakan mati yang disebut sundep pada tanaman stadia vegetative, Kerusakan berada pada batang padi', 'Penggerek Batang Padi (Stem Borer)', 75.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
(298, 'Rahma Setiani', '2024-06-01', 'Kerusakan berada pada batang padi, Anakan mati yang disebut sundep pada tanaman stadia vegetative, Adanya beluk (malai hampa), Adanya ngengat dipertanaman dan larva didalam batang padi', 'Penggerek Batang Padi (Stem Borer)', 100.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
(296, 'rahma', '2024-06-01', 'Daun menjadi kering dan menggulung secara membujur, Di daerah sekitar lubang bekas hisapan berubah warna menjadi coklat menyerupai g, Adanya beluk (malai hampa), Anakan mati yang disebut sundep pada tanaman stadia vegetative, Kerusakan berada pada batang padi', 'Penggerek Batang Padi (Stem Borer)', 60.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
(294, 'rahma', '2024-06-01', 'Adanya ngengat dipertanaman dan larva didalam batang padi, Adanya beluk (malai hampa), Anakan mati yang disebut sundep pada tanaman stadia vegetative, Kerusakan berada pada batang padi', 'Penggerek Batang Padi (Stem Borer)', 100.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
(292, 'mama', '2024-06-01', 'Adanya beluk (malai hampa), Anakan mati yang disebut sundep pada tanaman stadia vegetative, Kerusakan berada pada batang padi', 'Penggerek Batang Padi (Stem Borer)', 100.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
(225, 'Rahma', '2024-05-30', 'Demam, Sakit kepala, Batuk Kering, Nafsu Makan Berkurang', 'Cacar Air', 51.00, 'Mandi menggunakan air hangat, Menggunakan lotion dari dokter pada daerah yang gatal, Istirahat yang cukup, Makan makanan yang bergizi '),
(228, 'rahma', '2024-05-30', 'Nafsu Makan Berkurang, Batuk Kering, Sakit kepala, Demam, Gatal Pada Kulit Seperti Bekas Gigitan Serangga, Bersin', 'Cacar Air', 51.00, 'Mandi menggunakan air hangat, Menggunakan lotion dari dokter pada daerah yang gatal, Istirahat yang cukup, Makan makanan yang bergizi ');

-- --------------------------------------------------------

--
-- Table structure for table `tblpenyakit`
--

CREATE TABLE `tblpenyakit` (
  `kd_penyakit` varchar(7) NOT NULL,
  `nm_penyakit` varchar(40) NOT NULL,
  `nl_penyakit` float NOT NULL,
  `pengobatan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpenyakit`
--

INSERT INTO `tblpenyakit` (`kd_penyakit`, `nm_penyakit`, `nl_penyakit`, `pengobatan`) VALUES
('P01', 'Penggerek Batang Padi (Stem Borer)', 0.8588, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
('P02', 'Kepinding Tanah (Scotinophara Coarctata)', 0.7984, 'Pengendalian kepinding tanah dapat dilakukan dengan perbanyakan musuh alami seperti laba-laba dan semut, pengolahan tanah, sanitasi lingkungan, dan penyemprotan insektisida sesuai dosis anjuran.\r\n'),
('P03', 'Walang Sangit (Leptocorisa Orstorius)', 0.8714, 'Pengendalian walang sangit dapat dilakukan dengan penggunaan varietas tahan, pengelolaan air, penggunaan musuh alami seperti burung dan laba-laba, serta aplikasi insektisida berbahan aktif sesuai anjuran'),
('P04', 'Tikus (Rattus Argentiventer)', 0.8083, 'Pengendalian tikus dapat dilakukan dengan pemasangan perangkap, penggunaan umpan racun, pengelolaan sanitasi lingkungan, dan penanaman tanaman perangkap.\r\n'),
('P05', 'Hama Putih (Caseworm)', 0.9, 'Pengendalian hama putih dapat dilakukan dengan penggunaan varietas tahan, pengendalian gulma, serta aplikasi insektisida berbahan aktif sesuai anjuran.\r\n'),
('P06', 'Ulat Tentara/Grayak (Armyworm)', 0.9, 'Pengendalian ulat tentara dapat dilakukan dengan penggunaan varietas tahan, pengelolaan air, aplikasi insektisida hayati, serta aplikasi insektisida berbahan aktif sesuai anjuran.'),
('P07', 'Ulat Jengkal-Palsu Hijau(Green Semiloop)', 0.9, 'Pengendalian ulat jengkal-palsu hijau dapat dilakukan dengan penggunaan varietas tahan, penerapan praktik budidaya yang baik, serta aplikasi insektisida berbahan aktif sesuai anjuran.\r\n'),
('P08', 'Orong-Orong (Mole Cricket)', 0.8771, 'Pengendalian ulat jengkal-palsu hijau dapat dilakukan dengan penggunaan varietas tahan, penerapan praktik budidaya yang baik, serta aplikasi insektisida berbahan aktif sesuai anjuran.\r\n'),
('P09', 'Lalat Bibit (Rice Whorl Maggot)', 0.9, 'Pengendalian lalat bibit dapat dilakukan dengan penggunaan varietas tahan, pengelolaan air, serta aplikasi insektisida berbahan aktif sesuai anjuran.'),
('P10', 'Burung (Aves)', 0.8588, 'Pengendalian burung dapat dilakukan dengan pemasangan jaring, pemasangan alat pengusir burung, serta penggunaan bahan kimia penolak burung sesuai anjuran.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaturan`
--
ALTER TABLE `tblaturan`
  ADD PRIMARY KEY (`kd_aturan`);

--
-- Indexes for table `tblgejala`
--
ALTER TABLE `tblgejala`
  ADD PRIMARY KEY (`kd_gejala`);

--
-- Indexes for table `tblpengunjung`
--
ALTER TABLE `tblpengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `tblpenyakit`
--
ALTER TABLE `tblpenyakit`
  ADD PRIMARY KEY (`kd_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaturan`
--
ALTER TABLE `tblaturan`
  MODIFY `kd_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `tblpengunjung`
--
ALTER TABLE `tblpengunjung`
  MODIFY `id_pengunjung` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
