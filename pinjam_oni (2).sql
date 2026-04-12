-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2026 pada 14.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjam_oni`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `alat_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `denda_per_hari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`alat_id`, `kategori_id`, `nama_alat`, `stok`, `gambar`, `denda_per_hari`) VALUES
(1, 1, 'Bola Voli', 8, 'alat_69d7e9563c21b7.58741735.jpeg', 5000),
(2, 1, 'Bola Basket', 8, 'alat_69d7e9636e8217.93391510.jpeg', 5000),
(3, 2, 'Gitar Akustik', 6, 'alat_69d7e97147e993.98205261.jpeg', 10000),
(4, 2, 'Keyboard', 3, 'alat_69d7e986919fc8.25524107.jpeg', 20000),
(5, 3, 'Mikroskop', 6, 'alat_69d7e9a3c1c866.30684800.jpeg', 50000),
(6, 3, 'Timbangan Digital', 4, 'alat_69d7e9af2bc6a5.24883209.jpeg', 15000),
(7, 4, 'Palu ', 11, 'alat_69d7e9beeaff55.77672790.jpeg', 3000),
(8, 4, 'Obeng Set', 15, 'alat_69d7e9c9b934c0.58744017.jpeg', 2000),
(9, 4, 'drone', 5, 'alat_69d7e9d8cd4a03.61600065.jpeg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Alat Olahraga', 'Perlengkapan olahraga umum'),
(2, 'Alat Musik', 'Instrumen musik dan perlengkapan'),
(3, 'Alat Laboratorium', 'Peralatan laboratorium dan penelitian'),
(4, 'Alat Konstruksi', 'Alat-alat untuk konstruksi dan bangunan'),
(5, 'Elektronik', 'alat elektronilkk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `aksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam`
--

CREATE TABLE `peminjam` (
  `id_peminjam` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `identitas` varchar(50) NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `nama_lengkap`, `identitas`, `status`) VALUES
(1, 'Budi Santoso', '123456789', 'Aktif'),
(2, 'Siti Nurhaliza', '987654321', 'Aktif'),
(3, 'Ahmad Wijaya', '555666777', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `peminjaman_alat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali_seharusnya` date NOT NULL,
  `tgl_kembali_aktual` date DEFAULT NULL,
  `status` enum('Menunggu','Dipinjam','Kembali','Ditolak') NOT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `petugas_id` int(11) NOT NULL,
  `total_denda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `peminjaman_alat_id`, `user_id`, `tgl_pinjam`, `tgl_kembali_seharusnya`, `tgl_kembali_aktual`, `status`, `denda`, `petugas_id`, `total_denda`) VALUES
(7, 5, 7, '2026-04-10', '2026-04-11', NULL, 'Kembali', 0.00, 10, 0),
(8, 6, 7, '2026-04-10', '2026-04-11', NULL, 'Kembali', 0.00, 10, 0),
(9, 7, 7, '2026-04-10', '2026-04-11', NULL, 'Kembali', 0.00, 10, 0),
(10, 8, 7, '2026-04-10', '2026-04-11', NULL, 'Dipinjam', 0.00, 10, 0),
(11, 9, 7, '2026-04-10', '2026-04-11', NULL, 'Dipinjam', 0.00, 10, 0),
(12, 10, 7, '2026-04-12', '2026-04-14', NULL, 'Dipinjam', 0.00, 10, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_alat`
--

CREATE TABLE `peminjaman_alat` (
  `id_peminjaman` int(11) NOT NULL,
  `alat_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `denda_per_hari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman_alat`
--

INSERT INTO `peminjaman_alat` (`id_peminjaman`, `alat_id`, `kategori_id`, `nama_alat`, `stok`, `gambar`, `denda_per_hari`) VALUES
(1, 1, 1, 'Bola Voli', 10, NULL, 5000),
(2, 1, 1, 'Bola Voli', 10, NULL, 5000),
(3, 1, 1, 'Bola Voli', 10, NULL, 5000),
(4, 9, 4, 'drone', 5, NULL, NULL),
(5, 3, 2, 'Gitar Akustik', 5, NULL, 10000),
(6, 3, 2, 'Gitar Akustik', 5, NULL, 10000),
(7, 3, 2, 'Gitar Akustik', 6, NULL, 10000),
(8, 1, 1, 'Bola Voli', 10, 'alat_69d7e3cc9be600.72741871.jpeg', 5000),
(9, 1, 1, 'Bola Voli', 10, 'alat_69d7e9563c21b7.58741735.jpeg', 5000),
(10, 7, 4, 'Palu ', 12, 'alat_69d7e9beeaff55.77672790.jpeg', 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` enum('Admin','Petugas','Peminjam') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `level`, `created_at`) VALUES
(7, 'peminjam', '$2y$10$HK8ti7VMU6PpLFQXaWLrkeTR6JQAqa1n9dqFrD.W1rxSkx0kgWQc.', 'peminjam', 'Peminjam', '2026-04-09 17:06:02'),
(9, 'admin', '$2y$10$4PogKpwyy0OHwOEeieXp4e9EYMCAYAH.Tgv1XvmJX4Ne0ddd1ECVm', 'admin', 'Admin', '2026-04-09 17:08:13'),
(10, 'petugas', '$2y$10$pTTV7N7fdzZALrO/wJivBeP1pNREaHOw..DnHnhJiC/j1J24Fqz4y', 'petugas', 'Petugas', '2026-04-09 17:08:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`alat_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `peminjaman_alat_id` (`peminjaman_alat_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- Indeks untuk tabel `peminjaman_alat`
--
ALTER TABLE `peminjaman_alat`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `alat_id` (`alat_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `alat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_alat`
--
ALTER TABLE `peminjaman_alat`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`peminjaman_alat_id`) REFERENCES `peminjaman_alat` (`id_peminjaman`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman_alat`
--
ALTER TABLE `peminjaman_alat`
  ADD CONSTRAINT `peminjaman_alat_ibfk_1` FOREIGN KEY (`alat_id`) REFERENCES `alat` (`alat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_alat_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
