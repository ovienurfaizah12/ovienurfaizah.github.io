-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2023 pada 01.55
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_wisata_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '1234admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_kriteria`
--

CREATE TABLE `daftar_kriteria` (
  `id` int(10) NOT NULL,
  `kriteria` varchar(20) NOT NULL,
  `bawah` varchar(20) NOT NULL,
  `tengah` varchar(20) NOT NULL,
  `atas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_kriteria`
--

INSERT INTO `daftar_kriteria` (`id`, `kriteria`, `bawah`, `tengah`, `atas`) VALUES
(41, 'Harga', 'Murah', 'Sedang', 'Mahal'),
(47, 'Jarak', 'Dekat', 'Sedang', 'Jauh'),
(48, 'Pengunjung', 'Sepi', 'Biasa', 'Ramai'),
(53, 'Luas', 'Sempit', 'Sedang', 'Longgar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_kriteria_static`
--

CREATE TABLE `daftar_kriteria_static` (
  `id` int(20) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `bawah` varchar(30) NOT NULL,
  `tengah` varchar(30) NOT NULL,
  `atas` varchar(30) NOT NULL,
  `nbawah` int(20) NOT NULL,
  `ntengah` int(20) NOT NULL,
  `natas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_kriteria_static`
--

INSERT INTO `daftar_kriteria_static` (`id`, `kriteria`, `bawah`, `tengah`, `atas`, `nbawah`, `ntengah`, `natas`) VALUES
(1, 'Jarak', 'Dekat', 'Sedang', 'Jauh', 5, 10, 20),
(2, 'Pengunjung', 'Sepi', 'Biasa', 'Ramai', 1000, 4500, 10000),
(3, 'Jenis', 'Alam', 'Sosial_budaya', 'Religi_Sejarah', 0, 0, 0),
(4, 'Fasilitas', 'Sedikit', 'Cukup', 'Banyak', 5, 10, 20),
(5, 'Harga', 'Murah', 'Sedang', 'Mahal', 10000, 25000, 50000),
(17, 'Luas', 'Sempit', 'Sedang', 'Longgar', 13, 123, 232);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuzzy_fasilitas`
--

CREATE TABLE `fuzzy_fasilitas` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `fasilitas` int(10) NOT NULL,
  `sedikit` float NOT NULL,
  `cukup` float NOT NULL,
  `banyak` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fuzzy_fasilitas`
--

INSERT INTO `fuzzy_fasilitas` (`id`, `obyek_wisata`, `fasilitas`, `sedikit`, `cukup`, `banyak`) VALUES
(1, 'Danau Toba & Pulau Samosir', 16, 0, 0.4, 0.6),
(2, 'Bukit Khayangan ', 7, 0.6, 0.4, 0),
(3, 'Pesisir Kalianda', 15, 0, 0.5, 0.5),
(4, 'Danau Ranau ', 4, 1, 0, 0),
(5, 'Danau Maninjau', 5, 1, 0, 0),
(6, 'Desa Budaya Dokan ', 11, 0, 0.9, 0.1),
(7, 'Pulau Kemaro ', 4, 1, 0, 0),
(8, 'Nagari 1000 Rumah Gadang ', 5, 1, 0, 0),
(9, 'Istana Pagaruyung Batusangkar ', 24, 0, 0, 1),
(10, 'Wisata Bono', 2, 1, 0, 0),
(11, 'Museum Al-Qur’an Raksasa ', 3, 1, 0, 0),
(12, 'Masjid 1000 Tiang ', 3, 1, 0, 0),
(13, 'Makam Syekh Aminullah ', 4, 1, 0, 0),
(14, 'Masjid Raya Baiturrahman ', 2, 1, 0, 0),
(15, 'Jembatan Siti Nurbaya ', 7, 0.6, 0.4, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuzzy_harga`
--

CREATE TABLE `fuzzy_harga` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `harga` float NOT NULL,
  `murah` float NOT NULL,
  `sedang` float NOT NULL,
  `mahal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fuzzy_harga`
--

INSERT INTO `fuzzy_harga` (`id`, `obyek_wisata`, `harga`, `murah`, `sedang`, `mahal`) VALUES
(1, 'Danau Toba & Pulau Samosir', 7000, 1, 0, 0),
(2, 'Bukit Khayangan ', 5000, 1, 0, 0),
(3, 'Pesisir Kalianda', 3500, 1, 0, 0),
(4, 'Danau Ranau ', 4000, 1, 0, 0),
(5, 'Danau Maninjau', 5000, 1, 0, 0),
(6, 'Desa Budaya Dokan ', 15000, 0, 1, 0),
(7, 'Pulau Kemaro ', 0, 1, 0, 0),
(8, 'Nagari 1000 Rumah Gadang ', 25000, 0.67, 0.33, 0),
(9, 'Istana Pagaruyung Batusangkar ', 60000, 0, 0, 1),
(10, 'Wisata Bono', 0, 1, 0, 0),
(11, 'Museum Al-Qur’an Raksasa ', 0, 1, 0, 0),
(12, 'Masjid 1000 Tiang ', 0, 1, 0, 0),
(13, 'Makam Syekh Aminullah ', 0, 1, 0, 0),
(14, 'Masjid Raya Baiturrahman ', 0, 1, 0, 0),
(15, 'Jembatan Siti Nurbaya ', 7500, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuzzy_jarak`
--

CREATE TABLE `fuzzy_jarak` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `jarak` int(10) NOT NULL,
  `dekat` float NOT NULL,
  `sedang` float NOT NULL,
  `jauh` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fuzzy_jarak`
--

INSERT INTO `fuzzy_jarak` (`id`, `obyek_wisata`, `jarak`, `dekat`, `sedang`, `jauh`) VALUES
(1, 'Danau Toba & Pulau Samosir', 28, 0, 0, 1),
(2, 'Bukit Khayangan ', 18, 0, 0.2, 0.8),
(3, 'Pesisir Kalianda', 25, 0, 0, 1),
(4, 'Danau Ranau ', 14, 0, 0.6, 0.4),
(5, 'Danau Maninjau', 22, 0, 0, 1),
(6, 'Desa Budaya Dokan ', 16, 0, 0.4, 0.6),
(7, 'Pulau Kemaro ', 4, 1, 0, 0),
(8, 'Nagari 1000 Rumah Gadang ', 11, 0, 0.9, 0.1),
(9, 'Istana Pagaruyung Batusangkar ', 15, 0, 0.5, 0.5),
(10, 'Wisata Bono', 18, 0, 0.2, 0.8),
(11, 'Museum Al-Qur’an Raksasa ', 10, 0, 1, 0),
(12, 'Masjid 1000 Tiang ', 9, 0.2, 0.8, 0),
(13, 'Makam Syekh Aminullah ', 16, 0, 0.4, 0.6),
(14, 'Masjid Raya Baiturrahman ', 24, 0, 0, 1),
(15, 'Jembatan Siti Nurbaya ', 15, 0, 0.5, 0.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuzzy_jenis`
--

CREATE TABLE `fuzzy_jenis` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `alam` float NOT NULL,
  `sosial_budaya` float NOT NULL,
  `religi_sejarah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fuzzy_jenis`
--

INSERT INTO `fuzzy_jenis` (`id`, `obyek_wisata`, `jenis`, `alam`, `sosial_budaya`, `religi_sejarah`) VALUES
(1, 'Danau Toba & Pulau Samosir', 'Alam', 1, 0, 0),
(2, 'Bukit Khayangan ', 'Alam', 1, 0, 0),
(3, 'Pesisir Kalianda', 'Alam', 1, 0, 0),
(4, 'Danau Ranau ', 'Alam', 1, 0, 0),
(5, 'Danau Maninjau', 'Alam', 1, 0, 0),
(6, 'Desa Budaya Dokan ', 'Sosial dan Budaya', 0, 1, 0),
(7, 'Pulau Kemaro ', 'Sosial dan Budaya', 0, 1, 0),
(8, 'Nagari 1000 Rumah Gadang ', 'Sosial dan Budaya', 0, 1, 0),
(9, 'Istana Pagaruyung Batusangkar ', 'Sosial dan Budaya', 0, 1, 0),
(10, 'Wisata Bono', 'Alam', 1, 0, 0),
(11, 'Museum Al-Qur’an Raksasa ', 'Religi dan Sejarah', 0, 0, 1),
(12, 'Masjid 1000 Tiang ', 'Religi dan Sejarah', 0, 0, 1),
(13, 'Makam Syekh Aminullah ', 'Religi dan Sejarah', 0, 0, 1),
(14, 'Masjid Raya Baiturrahman ', 'Religi dan Sejarah', 0, 0, 1),
(15, 'Jembatan Siti Nurbaya ', 'Sosial dan Budaya', 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuzzy_luas`
--

CREATE TABLE `fuzzy_luas` (
  `id` int(11) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `luas` float NOT NULL,
  `sempit` float NOT NULL,
  `sedang` float NOT NULL,
  `longgar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fuzzy_luas`
--

INSERT INTO `fuzzy_luas` (`id`, `obyek_wisata`, `luas`, `sempit`, `sedang`, `longgar`) VALUES
(1, 'Danau Toba & Pulau Samosir', 123, 0, 1, 0),
(2, 'Bukit Khayangan ', 21, 0.927273, 0.0727273, 0),
(3, 'Pesisir Kalianda', 23, 0.909091, 0.0909091, 0),
(4, 'Danau Ranau ', 232, 0, 0, 0.886179),
(5, 'Danau Maninjau', 23, 0.909091, 0.0909091, 0),
(6, 'Desa Budaya Dokan ', 23, 0.909091, 0.0909091, 0),
(7, 'Pulau Kemaro ', 23, 0.909091, 0.0909091, 0),
(8, 'Nagari 1000 Rumah Gadang ', 232, 0, 0, 0.886179),
(9, 'Istana Pagaruyung Batusangkar ', 32, 0.827273, 0.172727, 0),
(10, 'Wisata Bono', 23, 0.909091, 0.0909091, 0),
(11, 'Museum Al-Qur’an Raksasa ', 323, 0, 0, 1),
(12, 'Masjid 1000 Tiang ', 23, 0.909091, 0.0909091, 0),
(13, 'Makam Syekh Aminullah ', 123, 0, 1, 0),
(14, 'Masjid Raya Baiturrahman ', 133, 0, 0.908257, 0.0813008),
(15, 'Jembatan Siti Nurbaya ', 232, 0, 0, 0.886179);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuzzy_pengunjung`
--

CREATE TABLE `fuzzy_pengunjung` (
  `id` int(11) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `pengunjung` int(10) NOT NULL,
  `sepi` float NOT NULL,
  `biasa` float NOT NULL,
  `ramai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fuzzy_pengunjung`
--

INSERT INTO `fuzzy_pengunjung` (`id`, `obyek_wisata`, `pengunjung`, `sepi`, `biasa`, `ramai`) VALUES
(1, 'Danau Toba & Pulau Samosir', 66558, 0, 0, 1),
(2, 'Bukit Khayangan ', 31446, 0, 0, 1),
(3, 'Pesisir Kalianda', 29257, 0, 0, 1),
(4, 'Danau Ranau ', 934, 1, 0, 0),
(5, 'Danau Maninjau', 3832, 0.1909, 0.8091, 0),
(6, 'Desa Budaya Dokan ', 31187, 0, 0, 1),
(7, 'Pulau Kemaro ', 4644, 0, 0.9863, 0.0137),
(8, 'Nagari 1000 Rumah Gadang ', 1487, 0.8609, 0.1391, 0),
(9, 'Istana Pagaruyung Batusangkar ', 25043, 0, 0, 1),
(10, 'Wisata Bono', 900, 1, 0, 0),
(11, 'Museum Al-Qur’an Raksasa ', 3888, 0.1749, 0.8251, 0),
(12, 'Masjid 1000 Tiang ', 4255, 0.07, 0.93, 0),
(13, 'Makam Syekh Aminullah ', 5627, 0, 0.8927, 0.1073),
(14, 'Masjid Raya Baiturrahman ', 649, 1, 0, 0),
(15, 'Jembatan Siti Nurbaya ', 4411, 0.0254, 0.9746, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(10) NOT NULL,
  `nama kelompok` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`id`, `nama kelompok`) VALUES
(1, 'harga'),
(2, 'jarak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_wisata_tb`
--

CREATE TABLE `tempat_wisata_tb` (
  `obyek_wisata` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `fasilitas` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `pengunjung` int(10) NOT NULL,
  `jarak` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `luas` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tempat_wisata_tb`
--

INSERT INTO `tempat_wisata_tb` (`obyek_wisata`, `jenis`, `fasilitas`, `harga`, `pengunjung`, `jarak`, `id`, `luas`) VALUES
('Danau Toba & Pulau Samosir', 'Alam', 16, 7000, 66558, 28, 1, 123),
('Bukit Khayangan ', 'Alam', 7, 5000, 31336, 18, 2, 21),
('Pesisir Kalianda', 'Alam', 15, 3500, 29257, 25, 3, 23),
('Danau Ranau ', 'Alam', 6, 4000, 3833, 22, 4, 232),
('Danau Maninjau', 'Alam', 6, 5000, 710, 14, 5, 23),
('Desa Budaya Dokan ', 'Sosial dan Budaya', 10, 15000, 4644, 4, 6, 23),
('Pulau Kemaro ', 'Sosial dan Budaya', 5, 0, 1487, 11, 7, 23),
('Nagari 1000 Rumah Gadang ', 'Sosial dan Budaya', 11, 25000, 31187, 16, 8, 232),
('Istana Pagaruyung Batusangkar ', 'Sosial dan Budaya', 24, 60000, 25043, 15, 9, 32),
('Wisata Bono', 'Alam', 2, 0, 900, 18, 10, 23),
('Museum Al-Qur’an Raksasa ', 'Religi dan Sejarah', 3, 0, 3888, 10, 11, 323),
('Masjid 1000 Tiang ', 'Religi dan Sejarah', 3, 0, 4255, 9, 12, 23),
('Makam Syekh Aminullah ', 'Religi dan Sejarah', 4, 0, 5627, 16, 13, 123),
('Masjid Raya Baiturrahman ', 'Religi dan Sejarah', 2, 0, 649, 24, 14, 133),
('Jembatan Siti Nurbaya ', 'Sosial dan Budaya', 7, 7500, 4411, 15, 15, 232);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_kriteria`
--
ALTER TABLE `daftar_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_kriteria_static`
--
ALTER TABLE `daftar_kriteria_static`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuzzy_fasilitas`
--
ALTER TABLE `fuzzy_fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuzzy_harga`
--
ALTER TABLE `fuzzy_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuzzy_jarak`
--
ALTER TABLE `fuzzy_jarak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuzzy_jenis`
--
ALTER TABLE `fuzzy_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuzzy_luas`
--
ALTER TABLE `fuzzy_luas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuzzy_pengunjung`
--
ALTER TABLE `fuzzy_pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tempat_wisata_tb`
--
ALTER TABLE `tempat_wisata_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_kriteria`
--
ALTER TABLE `daftar_kriteria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `daftar_kriteria_static`
--
ALTER TABLE `daftar_kriteria_static`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `fuzzy_fasilitas`
--
ALTER TABLE `fuzzy_fasilitas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `fuzzy_harga`
--
ALTER TABLE `fuzzy_harga`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `fuzzy_jarak`
--
ALTER TABLE `fuzzy_jarak`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `fuzzy_jenis`
--
ALTER TABLE `fuzzy_jenis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `fuzzy_luas`
--
ALTER TABLE `fuzzy_luas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `fuzzy_pengunjung`
--
ALTER TABLE `fuzzy_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tempat_wisata_tb`
--
ALTER TABLE `tempat_wisata_tb`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
