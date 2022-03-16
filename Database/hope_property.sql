-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2022 pada 07.49
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hope_property`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id`, `username`, `name`, `password`, `role`, `img`) VALUES
(1, 'admin', 'admin', 'a66abb5684c45962d887564f08346e8d', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `articel`
--

CREATE TABLE `articel` (
  `id` int(11) NOT NULL,
  `citykey` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `articel` longtext NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `titleads` varchar(255) DEFAULT NULL,
  `list` int(11) DEFAULT '0',
  `dashboard` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `articel`
--

INSERT INTO `articel` (`id`, `citykey`, `title`, `articel`, `img`, `name`, `titleads`, `list`, `dashboard`) VALUES
(149, 11, 'casca', 'cascasc', '1647372325.jpg', 'ascas', 'ascasc', 1, 1),
(150, 11, 'sdfdg', 'sdfg', '1647372469.jpg', 'sadfg', 'sdfg', 1, 1),
(151, 9, 'dsadasd', 'fsdasdfd', '1647372506.jpg', 'sadsa', 'sad', 1, 1),
(152, 3, 'sadsfdsa', 'dsasdsfsadf', '1647372539.jpg', 'asdf', 'sadf', 1, 1),
(153, 6, 'dsdsf', 'dsfsdsfdsf', '1647372649.jpg', 'dssdfs', 'sadfs', 0, 0),
(154, 2, 'el fatihhhh', 'blaaaaaaaaaaaa', '1647402813.jpg', 'klik more info', 'El Fatih', 0, 0),
(155, 11, 'judul bekasi', 'bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi <h1>bekasi</h1> bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi bekasi <br>', '1647411821.jpg', 'demo nama bekasi', 'demo bekasi', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `articel_detail`
--

CREATE TABLE `articel_detail` (
  `id` int(11) NOT NULL,
  `articelkey` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `articel` longtext,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `articel_detail`
--

INSERT INTO `articel_detail` (`id`, `articelkey`, `name`, `title`, `articel`, `img`) VALUES
(154, 149, 'asca', 'ascaaaaa', 'ssssssssssssss', '1647372325_Detail1.jpg'),
(155, 149, 'aaaaaaaaaaaaaaa', 'ssssssssssssss', 'ssscccccccccccccccccccccccc', '1647372325_Detail2.jpg'),
(156, 151, 'sdsd', 'sdsdf', 'sdfsdfsds', '1647372506_Detail1.jpg'),
(157, 151, 'sdfsadf', 'sadfsdsf', 'sdsfsdsf', '1647372506_Detail2.jpg'),
(158, 151, 'sdfsd', 'fdffgfg', 'fdfddf', '1647372506_Detail3.jpg'),
(159, 152, 'sdsfasd', 'asdssds', 'fasdsfsdsf', '1647372539_Detail1.jpg'),
(160, 152, 'sdfsdfddsfd', 'sdsfsdfd', 'sddsds', '1647372539_Detail2.jpg'),
(161, 152, 'sdsfsdf', 'sdfasdsfd', 'sdfsdfddf', '1647372539_Detail3.jpg'),
(162, 153, 'sdfgefdg', 'sdfdg', 'sdfdghssfdgf', NULL),
(163, 153, 'sdsfd', 'sadsf', 'sadsfads', NULL),
(164, 154, 'El Fatih Sub', 'Promo maret', 'blaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1647402813_Detail1.jpg'),
(165, 155, 'nama detail', 'title detail', 'articel detail articel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detailarticel detail', '1647411821_Detail1.jpg'),
(166, 155, 'xc dvs', 'dcvvdsdsv', 'dvsdvsdvdvs', '1647411821_Detail2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `perpage` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `city`
--

INSERT INTO `city` (`id`, `name`, `perpage`, `title`) VALUES
(2, 'depok', 2, 'Area Depok'),
(3, 'jakarta selatan', 2, 'Area Jakarta Selatan'),
(4, 'jakarta timur', 2, 'Area Jakarta Timur'),
(5, 'nambo', 2, 'Area Nampo'),
(6, 'cibinong', 2, 'Area Cibinong'),
(7, 'tangerang', 2, 'Area Tangerang Selatan'),
(8, 'yogyakarta', 2, 'Area Yogyakarta'),
(9, 'bandung', 2, 'Area Bandung'),
(10, 'kerjasama', 2, 'Kerjasama'),
(11, 'bekasi', 2, 'Area Bekasi'),
(12, 'tangerang Selatan', 2, 'Area Tanggerang Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galery`
--

INSERT INTO `galery` (`id`, `title`, `img`) VALUES
(41, 'ascascasc', '1647368343.jpg'),
(42, 'dsfdgfnb', '1647372572.jpg'),
(43, 'sdfgrtyhghtfgdf', '1647372580.jpg'),
(44, 'fgfhgyredf', '1647372586.jpg'),
(45, 'sdfdgfhgrtyttdrdfv', '1647372598.jpg'),
(46, 'sdsfghhdrsed', '1647372617.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_company`
--

CREATE TABLE `profile_company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `titlelogin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile_company`
--

INSERT INTO `profile_company` (`id`, `name`, `alamat`, `telepon`, `phone`, `titlelogin`) VALUES
(1, 'Hope Property', 'testing', '2345423', '234532', 'Hope Property Login');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `articel`
--
ALTER TABLE `articel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `articel_detail`
--
ALTER TABLE `articel_detail`
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `profile_company`
--
ALTER TABLE `profile_company`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `articel`
--
ALTER TABLE `articel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT untuk tabel `articel_detail`
--
ALTER TABLE `articel_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT untuk tabel `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `profile_company`
--
ALTER TABLE `profile_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
