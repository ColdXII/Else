-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2022 pada 03.22
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_hotel`
--
CREATE DATABASE IF NOT EXISTS `db_hotel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_hotel`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(10) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE IF NOT EXISTS `kamar` (
  `nomor_kamar` int(10) NOT NULL AUTO_INCREMENT,
  `jenis_kamar` varchar(20) NOT NULL,
  `harga_kamar` decimal(10,0) NOT NULL,
  `jenis_kasur` varchar(20) NOT NULL,
  PRIMARY KEY (`nomor_kamar`),
  KEY `nomor_kamar` (`nomor_kamar`),
  KEY `nomor_kamar_2` (`nomor_kamar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resepsionis`
--

CREATE TABLE IF NOT EXISTS `resepsionis` (
  `id_resepsionis` int(10) NOT NULL AUTO_INCREMENT,
  `nama_resepsionis` varchar(20) NOT NULL,
  `id_tamu` int(10) NOT NULL,
  `nomor_pesanan` int(10) NOT NULL,
  `nomor_kamar` int(10) NOT NULL,
  `tgl_check_in` date NOT NULL,
  `tgl_check_out` date NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_resepsionis`),
  KEY `id_tamu` (`id_tamu`),
  KEY `id_resepsionis` (`id_resepsionis`),
  KEY `nomor_kamar` (`nomor_kamar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE IF NOT EXISTS `reservasi` (
  `nomor_pesanan` int(10) NOT NULL AUTO_INCREMENT,
  `id_tamu` int(10) NOT NULL,
  `nama_tamu` varchar(15) NOT NULL,
  `tgl_check_in` date NOT NULL,
  `tgl_check_out` date NOT NULL,
  `nomor_kamar` int(10) NOT NULL,
  `jenis_kamar` varchar(15) NOT NULL,
  `fasilitas` varchar(15) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `id_resepsionis` int(10) NOT NULL,
  PRIMARY KEY (`nomor_pesanan`),
  KEY `id_tamu` (`id_tamu`),
  KEY `id_resepsionis` (`id_resepsionis`),
  KEY `nomor_kamar` (`nomor_kamar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE IF NOT EXISTS `tamu` (
  `id_tamu` int(10) NOT NULL AUTO_INCREMENT,
  `nama_tamu` varchar(20) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `JK` varchar(1) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`id_tamu`),
  UNIQUE KEY `id_tamu` (`id_tamu`),
  KEY `id_tamu_2` (`id_tamu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `resepsionis`
--
ALTER TABLE `resepsionis`
  ADD CONSTRAINT `resepsionis_ibfk_1` FOREIGN KEY (`id_tamu`) REFERENCES `tamu` (`id_tamu`),
  ADD CONSTRAINT `resepsionis_ibfk_2` FOREIGN KEY (`nomor_kamar`) REFERENCES `kamar` (`nomor_kamar`);

--
-- Ketidakleluasaan untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_1` FOREIGN KEY (`id_tamu`) REFERENCES `tamu` (`id_tamu`),
  ADD CONSTRAINT `reservasi_ibfk_2` FOREIGN KEY (`id_resepsionis`) REFERENCES `resepsionis` (`id_resepsionis`),
  ADD CONSTRAINT `reservasi_ibfk_3` FOREIGN KEY (`nomor_kamar`) REFERENCES `kamar` (`nomor_kamar`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
