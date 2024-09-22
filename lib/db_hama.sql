-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 07:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hama`
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
(182, 'G08', 'P01', 0.9),
(183, 'G09', 'P01', 0.9),
(184, 'G13', 'P01', 0.9),
(185, 'G18', 'P01', 0.8),
(186, 'G19', 'P01', 0.7),
(187, 'G15', 'P02', 0.6),
(188, 'G19', 'P02', 0.7),
(189, 'G24', 'P02', 0.6),
(190, 'G04', 'P03', 0.7),
(191, 'G05', 'P03', 0.8),
(192, 'G06', 'P03', 0.8),
(193, 'G23', 'P03', 0.7),
(194, 'G15', 'P04', 0.6),
(195, 'G22', 'P04', 0.9),
(197, 'G28', 'P04', 0.8),
(198, 'G07', 'P05', 0.6),
(199, 'G14', 'P05', 0.8),
(200, 'G16', 'P05', 0.8),
(201, 'G02', 'P06', 0.7),
(202, 'G05', 'P06', 0.8),
(203, 'G13', 'P06', 0.9),
(204, 'G02', 'P07', 0.7),
(205, 'G05', 'P07', 0.8),
(206, 'G13', 'P07', 0.9),
(207, 'G18', 'P07', 0.8),
(208, 'G04', 'P08', 0.7),
(209, 'G10', 'P08', 0.8),
(210, 'G22', 'P08', 0.9),
(211, 'G01', 'P09', 0.6),
(212, 'G04', 'P09', 0.7),
(213, 'G16', 'P09', 0.8),
(214, 'G22', 'P10', 0.9),
(215, 'G29', 'P10', 0.9),
(216, 'G03', 'P11', 0.6),
(217, 'G16', 'P11', 0.8),
(218, 'G01', 'P12', 0.6),
(219, 'G06', 'P12', 0.8),
(220, 'G20', 'P12', 0.8),
(221, 'G11', 'P13', 0.7),
(222, 'G13', 'P13', 0.9),
(223, 'G21', 'P13', 0.7),
(224, 'G17', 'P14', 0.7),
(225, 'G23', 'P14', 0.7),
(226, 'G11', 'P15', 0.7),
(227, 'G17', 'P15', 0.7),
(228, 'G30', 'P15', 0.7),
(229, 'G12', 'P04', 0.7),
(230, 'G25', 'P04', 0.7),
(231, 'G26', 'P04', 0.6),
(232, 'G27', 'P04', 0.6);

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
(297, 'G32'),
(322, 'G25'),
(322, 'G09'),
(322, 'G08'),
(322, 'G07'),
(322, 'G06');

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
(270, 'P01', 130),
(322, 'P12', 2),
(322, 'P03', 1),
(322, 'P05', 1);

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
('G27', 'Tanaman dibagian pinggir (keliling petak) rusak'),
('G26', 'Adanya spot-spot kosong di dalam sawah'),
('G25', 'Akar muda di bagian tanah dirusak'),
('G24', 'Penurunan kesuburan tanah sekitar tanaman'),
('G23', 'Tanaman terpapar atau tertekan secara fisik akibat hujan lebat atau angin kencan'),
('G22', 'Kehilangan atau pengurangan hasil panen yang drastis'),
('G21', 'Tanaman menunjukkan pertumbuhan tidak merata atau kerdil'),
('G20', 'Penurunan pertumbuhan tanaman'),
('G19', 'Kehadiran serangga kecil berwarna putih pada permukaan tanaman'),
('G18', 'Kehadiran larva atau kotoran serangga'),
('G17', 'Kerusakan fisik atau pembusukan'),
('G12', 'Pembusukan pada bagian pangkal batang'),
('G13', 'Penurunan hasil panen atau produksi'),
('G14', 'Penurunan kualitas tanaman'),
('G15', 'Pembengkakan tanah'),
('G16', 'Kerusakan pada biji'),
('G09', 'Kerusakan pada batang'),
('G10', 'Batang kering atau patah'),
('G11', 'Batang memiliki bercak berwarna gelap atau hitam'),
('G08', 'Batang kosong atau berongga'),
('G07', 'Daun memiliki bintik-bintik kecil berwarna putih atau abu-abu'),
('G05', 'Daun kering dan layu'),
('G06', 'Daun menjadi kering dan menggulung memanjang'),
('G01', 'Daun menguning.'),
('G02', 'Daun berlubang.'),
('G03', 'Daun memiliki bercak coklat'),
('G04', 'Daun terkulai'),
('G28', 'Adanya tanaman padi yang roboh pada petak sawah'),
('G29', 'Biji padi banyak yang hilang'),
('G30', 'Beras berubah warna dan mengapur');

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
(228, 'rahma', '2024-05-30', 'Nafsu Makan Berkurang, Batuk Kering, Sakit kepala, Demam, Gatal Pada Kulit Seperti Bekas Gigitan Serangga, Bersin', 'Cacar Air', 51.00, 'Mandi menggunakan air hangat, Menggunakan lotion dari dokter pada daerah yang gatal, Istirahat yang cukup, Makan makanan yang bergizi '),
(0, 'rhma', '2024-09-22', 'Batang kosong atau berongga, Daun memiliki bercak coklat, Kerusakan pada batang, Kehadiran serangga kecil berwarna putih pada permukaan tanaman, Kehilangan atau pengurangan hasil panen yang drastis', 'Penggerek Batang Padi ', 51.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
(0, 'Rahma', '2024-09-22', 'Batang kosong atau berongga, Daun memiliki bercak coklat, Kerusakan pada batang, Kehadiran serangga kecil berwarna putih pada permukaan tanaman, Kehilangan atau pengurangan hasil panen yang drastis', 'Penggerek Batang Padi ', 51.00, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.');

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
('P01', 'Penggerek Batang Padi ', 0.8476, 'Pengobatan untuk penggerek batang padi meliputi penggunaan varietas tahan, praktek budidaya yang baik, pengendalian hayati, insektisida nabati, pemantauan rutin, dan penggunaan insektisida atau fungisida sesuai kebutuhan.'),
('P02', 'Kepinding Tanah ', 0.6368, 'Pengendalian kepinding tanah dapat dilakukan dengan perbanyakan musuh alami seperti laba-laba dan semut, pengolahan tanah, sanitasi lingkungan, dan penyemprotan insektisida sesuai dosis anjuran.\r\n'),
('P03', 'Walang Sangit ', 0.7533, 'Pengendalian walang sangit dapat dilakukan dengan penggunaan varietas tahan, pengelolaan air, penggunaan musuh alami seperti burung dan laba-laba, serta aplikasi insektisida berbahan aktif sesuai anjuran'),
('P04', 'Tikus ', 0.7163, 'Pengendalian tikus dapat dilakukan dengan pemasangan perangkap, penggunaan umpan racun, pengelolaan sanitasi lingkungan, dan penanaman tanaman perangkap.\r\n'),
('P05', 'Hama Putih ', 0.7455, 'Pengendalian hama putih dapat dilakukan dengan penggunaan varietas tahan, pengendalian gulma, serta aplikasi insektisida berbahan aktif sesuai anjuran.\r\n'),
('P06', 'Ulat Tentara/Grayak ', 0.8083, 'Pengendalian ulat tentara dapat dilakukan dengan penggunaan varietas tahan, pengelolaan air, aplikasi insektisida hayati, serta aplikasi insektisida berbahan aktif sesuai anjuran.'),
('P07', 'Ulat Jengkal Palsu Hijau ', 0.8063, 'Pengendalian ulat jengkal-palsu hijau dapat dilakukan dengan penggunaan varietas tahan, penerapan praktik budidaya yang baik, serta aplikasi insektisida berbahan aktif sesuai anjuran.\r\n'),
('P08', 'Orong-Orong ', 0.8083, 'Pengendalian ulat jengkal-palsu hijau dapat dilakukan dengan penggunaan varietas tahan, penerapan praktik budidaya yang baik, serta aplikasi insektisida berbahan aktif sesuai anjuran.\r\n'),
('P09', 'Lalat Bibit ', 0.7095, 'Pengendalian lalat bibit dapat dilakukan dengan penggunaan varietas tahan, pengelolaan air, serta aplikasi insektisida berbahan aktif sesuai anjuran.'),
('P10', 'Burung ', 0.9, 'Pengendalian burung dapat dilakukan dengan pemasangan jaring, pemasangan alat pengusir burung, serta penggunaan bahan kimia penolak burung sesuai anjuran.'),
('P11', 'Jamur Cochliobolus miyabeanus', 0.7143, 'Untuk mengatasi penyakit bercak daun coklat yang disebabkan oleh Cochliobolus miyabeanus, gunakan varietas padi yang tahan, praktikkan rotasi tanaman, kelola irigasi dengan baik, dan aplikasikan fungisida sesuai petunjuk.'),
('P12', 'Tungro', 0.7455, 'Untuk mengatasi penyakit Tungro pada padi, gunakan varietas padi yang tahan, kontrol vektor seperti wereng hijau dengan insektisida, dan lakukan rotasi tanaman untuk memutus siklus penyakit.'),
('P13', 'Penyakit Karat', 0.7783, 'Untuk mengatasi penyakit karat pada padi, gunakan varietas tahan karat, aplikasi fungisida yang sesuai, dan praktikkan rotasi tanaman untuk mengurangi infeksi jamur.'),
('P14', 'Kerusakan Akibat Cuaca', 0.7, 'Untuk mengatasi kerusakan akibat cuaca pada padi, tingkatkan perlindungan tanaman dengan pemilihan lokasi yang baik, penggunaan penutup tanaman, dan perbaikan drainase.'),
('P15', 'Jamur Hitam', 0.7, 'Untuk mengatasi jamur hitam pada padi, gunakan varietas tahan, aplikasikan fungisida sesuai petunjuk, dan jaga kebersihan lingkungan serta drainase.');

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
  MODIFY `kd_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
