-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Bulan Mei 2024 pada 04.51
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zafaisy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `image_path`) VALUES
(1, 'Madu Herbal', 76000.00, 'madu habbat.png', 'MADUH.png'),
(2, 'Minyak Herba Sinergi', 65000.00, 'MHS.png', 'MHS.png'),
(3, 'Minyak Zaitun', 40000.00, 'zaitun.png', 'zaitun.png'),
(4, 'Susu Kambing ETTA GOAT MILK', 64000.00, 'ETTAWA.png', 'ETTAWA.png'),
(5, 'Sari Kurma', 70000.00, 'KURMA.png', 'KURMA.png'),
(6, 'Habbatusauda', 85000.00, 'HABBATUSAUDA.png', 'HABBATUSAUDA.png'),
(7, 'Pasta Gigi Herbal', 16000.00, 'PGH.png', 'PGH.png'),
(8, 'Madu Pahit', 60000.00, 'PAHIT.png', 'PAHIT.png'),
(9, 'Sabun Herbal', 7000.00, 'HIBIS.png', 'HIBIS.png'),
(10, 'Extra Food', 68000.00, 'EXTRA.png', 'EXTRA.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `product_id`, `user_id`, `quantity`, `order_date`) VALUES
(1, 3, 1, 3, '2024-05-17 00:22:58'),
(2, 4, 1, 4, '2024-05-17 00:29:46'),
(3, 4, 1, 4, '2024-05-17 00:31:42'),
(4, 4, 1, 4, '2024-05-17 00:32:31'),
(5, 10, 1, 3, '2024-05-17 01:43:44'),
(6, 1, 1, 5, '2024-05-17 01:55:09'),
(7, 4, 1, 100, '2024-05-17 02:46:23'),
(8, 4, 1, 100, '2024-05-17 02:50:45'),
(9, 4, 1, 100, '2024-05-17 02:54:01'),
(10, 7, 1, 12, '2024-05-17 02:55:23'),
(11, 2, 1, 3, '2024-05-17 03:11:52'),
(12, 4, 3, 1, '2024-05-17 03:30:43'),
(13, 4, 3, 1, '2024-05-17 03:30:58'),
(14, 8, 4, 10, '2024-05-17 07:59:35'),
(15, 2, 1, 2, '2024-05-17 08:59:42'),
(16, 10, 5, 2, '2024-05-17 15:54:36'),
(17, 10, 5, 1, '2024-05-17 15:58:21'),
(18, 3, 1, 2, '2024-05-17 16:55:05'),
(19, 10, 1, 1, '2024-05-18 13:15:53'),
(20, 3, 1, 3, '2024-05-19 07:07:50'),
(22, 9, 1, 2, '2024-05-19 12:57:20'),
(25, 5, 1, 3, '2024-05-20 04:12:39'),
(26, 5, 1, 3, '2024-05-20 04:52:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `plain_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `plain_password`) VALUES
(1, 'Fadhil', '$2y$10$Ouf4XdrxxuRjxmC1KKG.suyXJx3DeQxCZAkq.RqTWI0PbK/jwFts2', 'newpro1239@gmail.com', 'user', '112233665544'),
(2, 'zahra', '$2y$10$UAyJxk.nvtvlPUa4mi6cnORRYMvUVvA1J8cUTzbaLwipUyilUKjTG', 'fadhilfathirahesya@gmail.com', 'admin', '00000'),
(3, 'pentolkorek', '$2y$10$XlmHf5m/st542g7SkXBxw.9iDIXLo/PQ8L2nMraBqPD0uSqwcvIK6', 'newpro1239@gmail.com', 'user', '112233665544'),
(4, 'luis', '$2y$10$EcEq8q8pG.L61iqEpeNoR.faip8R7yCti.460fZ72KxRV1Azvsw66', 'newpro1239@gmail.com', 'user', '112233665544'),
(5, 'aisyah', '$2y$10$6Ge5nNle4i/lmG9MgTGK9uGNtnPGprG8yrHLvV9wvdhJ5mxOnFXBa', 'newpro1239@gmail.com', 'user', '112233665544'),
(6, 'zhapip', '$2y$10$YUGyS/iZj/ztdQrHmbemwuc.uQfpvaaB6YUe8gesNWM5z7dXOU7t2', 'newpro1239@gmail.com', 'admin', '771177'),
(14, 'permatasari', '$2y$10$G2krWOUktt7c4lzrMEUpaOcEphPsd39SwRrgeN7/npnFpGLow7wVq', 'sari@gmail.com', 'user', '11111111');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
