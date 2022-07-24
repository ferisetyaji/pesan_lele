-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2020 pada 02.13
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesan_lele`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ikan_lele`
--

CREATE TABLE `ikan_lele` (
  `id_ikan_lele` int(11) NOT NULL,
  `nama_ikan_lele` varchar(100) NOT NULL,
  `kode_ikan_lele` varchar(100) NOT NULL,
  `jenis_ikan_lele` varchar(100) NOT NULL,
  `jumlah_ikan_lele` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepala_pimpinan`
--

CREATE TABLE `kepala_pimpinan` (
  `id_kepala_pimpinan` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kepala_pimpinan`
--

INSERT INTO `kepala_pimpinan` (`id_kepala_pimpinan`, `nama_lengkap`, `username`, `password`, `jenis_kelamin`, `alamat`) VALUES
(1, 'admin', 'admin', 'admin', 'Laki - laki', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_jual` date NOT NULL DEFAULT current_timestamp(),
  `kode_ikan_lele` varchar(100) NOT NULL,
  `jumlah_terjual` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nama_lengkap`, `username`, `password`, `jenis_kelamin`, `alamat`) VALUES
(1, 'produksi', 'produksi', 'produksi', 'Laki - laki', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_ikan_lele`
--

CREATE TABLE `stok_ikan_lele` (
  `id_stok_ikan_lele` int(11) NOT NULL,
  `kode_ikan_lele` varchar(100) NOT NULL,
  `nama_ikan_lele` varchar(100) NOT NULL,
  `jenis_ikan_lele` varchar(100) NOT NULL,
  `jumlah_ikan_lele` bigint(20) NOT NULL,
  `bulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ikan_lele`
--
ALTER TABLE `ikan_lele`
  ADD PRIMARY KEY (`id_ikan_lele`);

--
-- Indeks untuk tabel `kepala_pimpinan`
--
ALTER TABLE `kepala_pimpinan`
  ADD PRIMARY KEY (`id_kepala_pimpinan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indeks untuk tabel `stok_ikan_lele`
--
ALTER TABLE `stok_ikan_lele`
  ADD PRIMARY KEY (`id_stok_ikan_lele`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ikan_lele`
--
ALTER TABLE `ikan_lele`
  MODIFY `id_ikan_lele` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kepala_pimpinan`
--
ALTER TABLE `kepala_pimpinan`
  MODIFY `id_kepala_pimpinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stok_ikan_lele`
--
ALTER TABLE `stok_ikan_lele`
  MODIFY `id_stok_ikan_lele` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
