-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2024 pada 05.55
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
-- Database: `ecommerce-db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-12-03-173845', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1733247719, 1),
(2, '2024-12-04-043057', 'App\\Database\\Migrations\\CreateOrdersTable', 'default', 'App', 1733286877, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notification` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`, `updated_at`, `notification`) VALUES
(10, 7, 2000000.00, 'completed', '2024-12-05 16:16:46', '2024-12-05 16:16:47', NULL),
(12, 7, 40000000.00, 'completed', '2024-12-06 03:22:22', '2024-12-06 03:22:24', NULL),
(13, 7, 2000000.00, 'completed', '2024-12-06 03:22:22', '2024-12-08 02:19:45', NULL),
(14, 7, 95000.00, 'completed', '2024-12-08 03:07:37', '2024-12-08 03:08:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(255) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_history`
--

INSERT INTO `payment_history` (`id`, `order_id`, `amount`, `payment_date`, `payment_method`, `status`) VALUES
(4, 10, 2000000.00, '2024-12-05 09:16:47', 'Transfer Bank', 'completed'),
(6, 12, 40000000.00, '2024-12-05 20:22:24', 'Transfer Bank', 'completed'),
(7, 13, 2000000.00, '2024-12-07 19:19:45', 'Transfer Bank', 'completed'),
(8, 14, 95000.00, '2024-12-07 20:08:05', 'Transfer Bank', 'completed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`, `stock`, `price`) VALUES
(11, 'Outskirts - Kemeja Polos Pria Lengan Panjang Casual Slimfit', 'Dengan bahan 100% Katun Cigaret pilihan yang lembut dan adem, membuat kemeja ini nyaman dipakai untuk hang out, santai ataupun untuk keperluan kerja. Padankan dengan bawahan kesukaanmu untuk memberi tampilan yang lebih Trendy dan Fashionable. Kemeja ini memiliki Cuttingan Slim Fit agar bentuk tubuh terlihat lebih ideal.\r\n\r\n- Bahan : 100% Katun Cigarette Premium\r\n- Slim Fit\r\n- Model menggunakan size XL\r\n- Tinggi & Berat Model: 185cm & 75kg', '1733625033_6a33f95ae57df5c9e52f.png', '2024-12-08 02:30:33', '2024-12-08 03:07:37', 99, 95000.00),
(12, 'Qwertylife Workshirt Technical Olive', 'Material\r\n\r\n- Bahan Drill \r\n\r\n- Lengan Pendek  \r\n\r\n- Detail kerah  \r\n\r\n- Detail kancing  \r\n\r\n- Regular fit     \r\n\r\n\r\n\r\nPetunjuk Perawatan,  \r\n\r\nPencucian mesin suhu maks. 30\'C, \r\n\r\nJangan digelantang, Suhu Setrika maks. 150\'C, \r\n\r\nPengeringan putar suhu maks. 50\'C     \r\n\r\nLebar Dada x Panjang Badan x Panjang Lengan:  \r\n\r\n\r\n\r\nUkuran \r\n\r\n- S ( LEBAR BADAN 50 CM - PANJANG BADAN 70 CM)\r\n\r\n- M ( LEBAR BADAN 52 CM - PANJANG BADAN 71 CM)\r\n\r\n- L ( LEBAR BADAN 54 CM - PANJANG BADAN 72 CM)\r\n\r\n- XL ( LEBAR BADAN 56 CM - PANJANG BADAN 73 CM)\r\n\r\nToleransi Ukuran Akan berubah 1+2 cm Saat Produksi', '1733625130_d90b420b9f41ee71b2cc.png', '2024-12-08 02:32:10', '2024-12-08 02:32:10', 50, 105000.00),
(13, 'Puddinglane Kemeja Unisex Pria Wanita Lengan Pendek Short Sleeve Work Shirt Zipper Darla', 'Puddinglane Workshirt Zipper Corduroy Darla\r\n\r\nKemeja Dengan Bahan Corduroy Pinwall Kecil berdesign bordir dan disertakan Zipper, Tersedia dengan berbagai pilihan warna.\r\n\r\n\r\n\r\nmaterial : corduroy\r\n\r\nharga.  :  250.000,-\r\n\r\nwarna :\r\n\r\n- black wash\r\n\r\n-Cream\r\n\r\n-Brown\r\n\r\n-navy\r\n\r\n-Grey\r\n\r\n\r\n\r\nsize chart (before wash)\r\n\r\nM: Length 70 x Width 53\r\n\r\nL : Length 72 x Width 55\r\n\r\nXL : Length 74 x Width 57', '1733625201_2484033e2ffcac81034b.png', '2024-12-08 02:33:21', '2024-12-08 02:33:21', 40, 200000.00),
(14, 'Kasual Celana Black Ankle Pants Classic', 'Pemenang celana ankle #1 versi Local Brand, ini adalah pioneer celana ternyaman! Celana Black Ankle Classic dari Kasual hadir dengan material stretch, ringan dengan fitur CenterFold™ dimana terdapat lipatan tengah pada celana ini yang membuat semakin elegan.\r\n\r\n\r\n\r\nAlasan memilih celana Ankle Classic:\r\n\r\n- Developed material\r\n\r\nSerat bahan yang digunakan yaitu polyester blend dan rayon yang memiliki bahan yang super nyaman, lembut dan elastis di kreasikan sendiri dengan rangkaian R&D sehingga ketahanan, kenyamanan dan kekuatan benang bahan dapat bertahan lebih lama\r\n\r\n\r\n\r\n- 2-ways Stretch\r\n\r\nBayangkan kamu bisa bebas bergerak, duduk maupun berlari dengan satu celana yang bikin aktifitas terasa lebih mudah\r\n\r\n\r\n\r\n- Slim Ankle\r\n\r\nDengan model slimfit, celana ini membuat kaki kamu lebih berjenjang dengan potongan ankle dibawahnya\r\n\r\n\r\n\r\n- Free Custom\r\n\r\nDapatkan pengalaman memiliki celana dengan ukuranmu sendiri dengan teknologi personalization dari Kasual', '1733625468_5962f40002249fbc0e3f.png', '2024-12-08 02:37:48', '2024-12-08 02:37:48', 45, 195000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '', 'admin@gmail.com', '$2y$10$1uvyDVzzcL0eDRkD6eMfoOKptI4SY1VwmVCbqO.7m588VSV1liHRC', 'admin', NULL, NULL, NULL),
(7, 'defri ', 'user@gmail.com', '$2y$10$Djuyee9MTOHgK1mLof3KQ.sufpvvM50oqFUCg7ArIawGfscBPnP5a', 'user', NULL, NULL, NULL),
(10, 'ronaldo', 'ronaldo@gmail.com', '$2y$10$buH3OtqnnPDZJjtGou8M1ejBB3DOScGu9p9c0if97iQB0IErK3e.C', 'user', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
