/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `detail_transaksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gift_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_produk` int NOT NULL,
  `jumlah_beli_produk` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `gifts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_gift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_gift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_cost` int NOT NULL,
  `stock` int DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `klaim_poin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `gift_id` bigint unsigned NOT NULL,
  `tanggal_klaim` date NOT NULL,
  `status` enum('Menunggu','Terklaim','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `klaim_poin_user_id_foreign` (`user_id`),
  KEY `klaim_poin_gift_id_foreign` (`gift_id`),
  CONSTRAINT `klaim_poin_gift_id_foreign` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`),
  CONSTRAINT `klaim_poin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `klasifikasigunung` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gunung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_gunung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketinggian` enum('Rendah','Sedang','Tinggi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesulitan` enum('Rendah','Sedang','Tinggi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama_pendakian` enum('Pendek','Sedang','Panjang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu` enum('Dingin','Sedang','Hangat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kritiksaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `isi_kritiksaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepuasan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tgl_kirim` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kritiksaran_user_id_foreign` (`user_id`),
  CONSTRAINT `kritiksaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `produk` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_produk` int NOT NULL,
  `kategori` enum('Pakaian & Celana','Peralatan Outdoor','Peralatan Keamanan','Sepatu & Sandal','Ransel','Jaket & Jas Hujan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` enum('Consina','Forester') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketinggian` enum('Rendah','Sedang','Tinggi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesulitan` enum('Rendah','Sedang','Tinggi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama_pendakian` enum('Pendek','Sedang','Panjang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu` enum('Dingin','Sedang','Hangat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `transaksi` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` int NOT NULL,
  `poin_diperoleh` int NOT NULL,
  `poin_ditukar` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_user_id_foreign` (`user_id`),
  CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kasir','member','manajer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telpon` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `detail_transaksi` (`id`, `produk_id`, `transaksi_id`, `gift_id`, `harga_produk`, `jumlah_beli_produk`, `created_at`, `updated_at`) VALUES
(13, 'PR279', 'NT-20240512-149', NULL, 460000, 1, '2024-05-12 16:50:16', '2024-05-12 16:50:16');
INSERT INTO `detail_transaksi` (`id`, `produk_id`, `transaksi_id`, `gift_id`, `harga_produk`, `jumlah_beli_produk`, `created_at`, `updated_at`) VALUES
(14, 'PR671', 'NT-20240512-149', NULL, 250000, 1, '2024-05-12 16:50:16', '2024-05-12 16:50:16');
INSERT INTO `detail_transaksi` (`id`, `produk_id`, `transaksi_id`, `gift_id`, `harga_produk`, `jumlah_beli_produk`, `created_at`, `updated_at`) VALUES
(15, 'PR572', 'NT-20240512-986', NULL, 300000, 3, '2024-05-12 16:50:40', '2024-05-12 16:50:40');
INSERT INTO `detail_transaksi` (`id`, `produk_id`, `transaksi_id`, `gift_id`, `harga_produk`, `jumlah_beli_produk`, `created_at`, `updated_at`) VALUES
(16, 'PR288', 'NT-20240512-629', NULL, 240000, 2, '2024-05-12 16:50:58', '2024-05-12 16:50:58'),
(17, 'PR634', 'NT-20240512-832', NULL, 570000, 1, '2024-05-12 16:51:24', '2024-05-12 16:51:24'),
(18, 'PR288', 'NT-20240512-832', NULL, 240000, 2, '2024-05-12 16:51:24', '2024-05-12 17:42:39'),
(19, 'PR279', 'NT-20240513-208', NULL, 460000, 3, '2024-05-13 16:57:21', '2024-05-13 16:57:21'),
(20, 'PR279', 'NT-20240513-208', NULL, 460000, 2, '2024-05-13 16:57:21', '2024-05-13 16:57:21'),
(21, 'PR279', 'NT-20240513-806', NULL, 460000, 2, '2024-05-13 16:58:27', '2024-05-13 16:58:27'),
(22, 'PR279', 'NT-20240513-657', NULL, 460000, 2, '2024-05-13 16:59:52', '2024-05-13 16:59:52'),
(23, 'PR279', 'NT-20240514-101', NULL, 460000, 3, '2024-05-14 14:30:36', '2024-05-14 15:08:17'),
(24, 'PR288', 'NT-20240514-101', NULL, 240000, 1, '2024-05-14 14:30:36', '2024-05-14 15:06:55'),
(25, 'PR572', 'NT-20240514-101', NULL, 300000, 1, '2024-05-14 14:30:36', '2024-05-14 15:06:55'),
(26, 'PR671', 'NT-20240514-101', NULL, 250000, 1, '2024-05-14 14:51:32', '2024-05-14 15:06:55');



INSERT INTO `gifts` (`id`, `nama_gift`, `gambar_gift`, `poin_cost`, `stock`, `deskripsi`, `created_at`, `updated_at`) VALUES
(3, 'CONSINA MUG CANGKIR GELAS CAMPING TRAVEL PORTABLE', '20240513_daun.png', 5000, 3, 'lebih praktis, awet, dan sangat membantu dalam pendakian atau camping', '2024-05-12 15:27:29', '2024-05-12 15:28:53');
INSERT INTO `gifts` (`id`, `nama_gift`, `gambar_gift`, `poin_cost`, `stock`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'CONSINA BETA ORGANIZER PACK ABU', '20240513_daun.png', 2000, 0, 'muat untuk berbagai barang', '2024-05-12 15:29:42', '2024-05-15 15:55:21');
INSERT INTO `gifts` (`id`, `nama_gift`, `gambar_gift`, `poin_cost`, `stock`, `deskripsi`, `created_at`, `updated_at`) VALUES
(5, 'CONSINA KAOS KAKI 04 MISTY 81', '20240513_daun.png', 1500, 0, 'mampu menghangatkan dan melindungi kaki saat pendakian atau camping', '2024-05-12 15:30:48', '2024-05-14 17:04:26');
INSERT INTO `gifts` (`id`, `nama_gift`, `gambar_gift`, `poin_cost`, `stock`, `deskripsi`, `created_at`, `updated_at`) VALUES
(6, 'CONSINA BELT 08 HITAM', '20240513_daun.png', 5200, 4, 'dengan bahan yang bagus maka tidak cepat rusak', '2024-05-12 15:32:06', '2024-05-12 15:32:06'),
(7, 'CRF 6D001 KEY CHAIN CARABINER 6D MATTE ENGRAVE LIMITED', '20240513_daun.png', 1600, 1, 'gantungan kunci', '2024-05-12 15:32:58', '2024-05-12 15:32:58'),
(8, 'DF 00199 DOMPET STNK BDR', '20240513_daun.png', 5500, 2, 'dompet stnk dengan bahan yang awet dan ringan', '2024-05-12 15:34:18', '2024-05-12 15:34:18'),
(9, 'test', '20240513_daun.png', 1000, 1, 'teassdads', '2024-05-13 13:18:32', '2024-05-14 17:01:35');

INSERT INTO `klaim_poin` (`id`, `user_id`, `gift_id`, `tanggal_klaim`, `status`, `created_at`, `updated_at`) VALUES
(7, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:41:35', '2024-05-14 16:56:41');
INSERT INTO `klaim_poin` (`id`, `user_id`, `gift_id`, `tanggal_klaim`, `status`, `created_at`, `updated_at`) VALUES
(8, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:41:45', '2024-05-14 16:56:45');
INSERT INTO `klaim_poin` (`id`, `user_id`, `gift_id`, `tanggal_klaim`, `status`, `created_at`, `updated_at`) VALUES
(9, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:41:52', '2024-05-14 16:56:48');
INSERT INTO `klaim_poin` (`id`, `user_id`, `gift_id`, `tanggal_klaim`, `status`, `created_at`, `updated_at`) VALUES
(10, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:47:20', '2024-05-14 16:56:50'),
(11, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:47:33', '2024-05-14 16:56:53'),
(12, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:51:10', '2024-05-14 16:56:55'),
(13, 10, 3, '2024-05-12', 'Terklaim', '2024-05-12 17:51:40', '2024-05-14 16:56:58'),
(14, 10, 7, '2024-05-12', 'Terklaim', '2024-05-12 18:00:30', '2024-05-14 16:57:00'),
(15, 10, 7, '2024-05-12', 'Terklaim', '2024-05-12 18:00:59', '2024-05-14 16:57:02'),
(16, 10, 7, '2024-05-12', 'Ditolak', '2024-05-12 18:01:11', '2024-05-14 16:57:05'),
(17, 10, 5, '2024-05-14', 'Terklaim', '2024-05-14 17:04:26', '2024-05-14 17:08:56'),
(18, 10, 4, '2024-05-14', 'Ditolak', '2024-05-14 17:09:38', '2024-05-14 17:09:54'),
(19, 10, 4, '2024-05-14', 'Ditolak', '2024-05-14 17:10:06', '2024-05-14 17:10:17'),
(20, 10, 4, '2024-05-14', 'Ditolak', '2024-05-14 17:12:04', '2024-05-14 17:12:18'),
(21, 10, 4, '2024-05-14', 'Ditolak', '2024-05-14 17:39:34', '2024-05-14 17:39:48'),
(22, 10, 4, '2024-05-15', 'Terklaim', '2024-05-15 15:55:21', '2024-05-15 15:56:37');

INSERT INTO `klasifikasigunung` (`id`, `nama_gunung`, `gambar_gunung`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('GN036', 'Gede', '20240512_gede.jpg', 'Sedang', 'Sedang', 'Sedang', 'Sedang', '2024-05-12 15:03:04', '2024-05-12 15:03:04');
INSERT INTO `klasifikasigunung` (`id`, `nama_gunung`, `gambar_gunung`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('GN578', 'Merbabu', '20240512_merbabu.jpg', 'Sedang', 'Sedang', 'Sedang', 'Sedang', '2024-05-12 15:14:49', '2024-05-12 15:14:49');
INSERT INTO `klasifikasigunung` (`id`, `nama_gunung`, `gambar_gunung`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('GN588', 'Lawu', '20240512_lawu.jpg', 'Rendah', 'Rendah', 'Pendek', 'Sedang', '2024-05-12 15:03:56', '2024-05-12 15:03:56');
INSERT INTO `klasifikasigunung` (`id`, `nama_gunung`, `gambar_gunung`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('GN636', 'Raung', '20240512_raung.jpeg', 'Tinggi', 'Sedang', 'Sedang', 'Sedang', '2024-05-12 15:11:13', '2024-05-12 15:11:13'),
('GN688', 'Sumbing', '20240512_sumbing.jpg', 'Tinggi', 'Sedang', 'Sedang', 'Sedang', '2024-05-12 15:17:58', '2024-05-12 15:17:58'),
('GN732', 'Kerinci', '20240512_kerinci.jpg', 'Tinggi', 'Tinggi', 'Panjang', 'Dingin', '2024-05-12 15:09:27', '2024-05-12 15:09:27'),
('GN937', 'Semeru', '20240512_semeru.jpg', 'Tinggi', 'Tinggi', 'Panjang', 'Dingin', '2024-05-12 15:10:09', '2024-05-12 15:10:09'),
('GN941', 'Prau', '20240512_Prau.jpg', 'Rendah', 'Rendah', 'Pendek', 'Dingin', '2024-05-12 15:06:46', '2024-05-12 15:06:46');

INSERT INTO `kritiksaran` (`id`, `user_id`, `isi_kritiksaran`, `kepuasan`, `created_at`, `updated_at`, `tgl_kirim`) VALUES
(4, 10, 'pelayanan nya sangat baik!!', 2, '2024-05-12 15:36:04', '2024-05-12 15:36:04', '2024-05-12');
INSERT INTO `kritiksaran` (`id`, `user_id`, `isi_kritiksaran`, `kepuasan`, `created_at`, `updated_at`, `tgl_kirim`) VALUES
(5, 10, 'saya suka berbelanja disini karena banyak gift menarik', 3, '2024-05-12 15:36:21', '2024-05-12 15:36:21', '2024-05-12');
INSERT INTO `kritiksaran` (`id`, `user_id`, `isi_kritiksaran`, `kepuasan`, `created_at`, `updated_at`, `tgl_kirim`) VALUES
(6, 10, 'saya suka tempatnya!!', 1, '2024-05-12 15:36:50', '2024-05-12 15:36:50', '2024-05-12');
INSERT INTO `kritiksaran` (`id`, `user_id`, `isi_kritiksaran`, `kepuasan`, `created_at`, `updated_at`, `tgl_kirim`) VALUES
(7, 10, 'baguss', 5, '2024-05-29 15:52:09', '2024-05-29 15:52:09', '2024-05-29');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_23_080558_create_produk_table', 1),
(6, '2024_04_22_145509_create_klasifikasigunung_table', 1),
(7, '2024_05_02_121353_create_kritiksaran_table', 1),
(8, '2024_05_05_091738_create_transaksi_table', 1),
(9, '2024_05_05_102234_create_gifts_table', 1),
(10, '2024_05_07_152305_create_klaim_poin_table', 1),
(11, '2024_05_07_162811_create_detail_transaksi_table', 1);





INSERT INTO `produk` (`id`, `nama_produk`, `gambar_produk`, `harga_produk`, `kategori`, `deskripsi`, `merk`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('PR279', 'FORESTER 40176 WAISTBAG GIFERCHIL 0.2', '20240512_FORESTER 40176 WAISTBAG GIFERCHIL 0.2.jpeg', 460000, 'Ransel', 'muat banyak barang dan tidak mudah rusak', 'Forester', 'Rendah', 'Rendah', 'Pendek', 'Dingin', '2024-05-12 16:15:34', '2024-05-12 16:15:34');
INSERT INTO `produk` (`id`, `nama_produk`, `gambar_produk`, `harga_produk`, `kategori`, `deskripsi`, `merk`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('PR288', 'CONSINA GLACIER SARUNG TANGAN GUNUNG', '20240512_CONSINA GLACIER SARUNG TANGAN GUNUNG.jpg', 240000, 'Peralatan Outdoor', 'berguna untuk menghangatkan tangan', 'Consina', 'Tinggi', 'Sedang', 'Sedang', 'Sedang', '2024-05-12 16:12:33', '2024-05-12 16:12:33');
INSERT INTO `produk` (`id`, `nama_produk`, `gambar_produk`, `harga_produk`, `kategori`, `deskripsi`, `merk`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('PR572', 'CONSINA DREAMCATCHER SLEEPING BAG', '20240511_CONSINA DREAMCATCHER SLEEPING BAG.jpg', 300000, 'Peralatan Outdoor', 'awet, tidak mudah kotor, dan usefull', 'Consina', 'Tinggi', 'Tinggi', 'Panjang', 'Dingin', '2024-05-11 18:44:48', '2024-05-12 16:08:25');
INSERT INTO `produk` (`id`, `nama_produk`, `gambar_produk`, `harga_produk`, `kategori`, `deskripsi`, `merk`, `ketinggian`, `kesulitan`, `lama_pendakian`, `suhu`, `created_at`, `updated_at`) VALUES
('PR634', 'FORESTER 90065 TECTONA TAS CARRIRER RUCSACK 45L', '20240512_FORESTER 90065 TECTONA TAS CARRIRER RUCSACK 45L.jpeg', 570000, 'Ransel', 'sangat kokoh', 'Forester', 'Tinggi', 'Tinggi', 'Panjang', 'Dingin', '2024-05-12 16:18:17', '2024-05-12 16:18:17'),
('PR671', 'CONSINA HIKER PRO SEPATU GUNUNG', '20240512_CONSINA HIKER PRO SEPATU GUNUNG.jpeg', 250000, 'Sepatu & Sandal', 'sangat bagus dan awet', 'Consina', 'Tinggi', 'Tinggi', 'Panjang', 'Dingin', '2024-05-11 18:44:15', '2024-05-12 16:10:55');

INSERT INTO `transaksi` (`id`, `user_id`, `tanggal_transaksi`, `total`, `poin_diperoleh`, `poin_ditukar`, `created_at`, `updated_at`) VALUES
('NT-20240512-149', 10, '2024-05-01', 710000, 7100, NULL, '2024-05-12 16:50:15', '2024-05-12 16:50:15');
INSERT INTO `transaksi` (`id`, `user_id`, `tanggal_transaksi`, `total`, `poin_diperoleh`, `poin_ditukar`, `created_at`, `updated_at`) VALUES
('NT-20240512-629', 11, '2024-05-06', 480000, 4800, NULL, '2024-05-12 16:50:58', '2024-05-12 16:50:58');
INSERT INTO `transaksi` (`id`, `user_id`, `tanggal_transaksi`, `total`, `poin_diperoleh`, `poin_ditukar`, `created_at`, `updated_at`) VALUES
('NT-20240512-832', 11, '2024-05-17', 1050000, 10500, NULL, '2024-05-12 16:51:24', '2024-05-12 17:42:39');
INSERT INTO `transaksi` (`id`, `user_id`, `tanggal_transaksi`, `total`, `poin_diperoleh`, `poin_ditukar`, `created_at`, `updated_at`) VALUES
('NT-20240512-986', 10, '2024-05-04', 900000, 9000, NULL, '2024-05-12 16:50:40', '2024-05-12 16:50:40'),
('NT-20240513-208', 11, '2024-05-13', 2300000, 23000, NULL, '2024-05-13 16:57:21', '2024-05-13 16:57:21'),
('NT-20240513-657', 11, '2024-05-13', 920000, 9200, NULL, '2024-05-13 16:59:52', '2024-05-13 16:59:52'),
('NT-20240513-806', 11, '2024-05-13', 920000, 9200, NULL, '2024-05-13 16:58:27', '2024-05-13 16:58:27'),
('NT-20240514-101', 11, '2024-05-14', 2150000, 21500, 20000, '2024-05-14 14:30:36', '2024-05-14 15:08:17');

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `email`, `nomor_telpon`, `poin`, `created_at`, `updated_at`) VALUES
(7, 'admin', '$2y$12$VR9aRmwDr45YtY4c.zypfOv7/ACxRGtbMs2hWGCKWVVA73ZH17JyK', 'admin', 'Eirina', 'trini', '2001-03-05', 'P', 'eirina@gmail.com', '089767776543', NULL, '2024-05-12 14:16:19', '2024-05-12 14:16:19');
INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `email`, `nomor_telpon`, `poin`, `created_at`, `updated_at`) VALUES
(8, 'kasir', '$2y$12$FeXptcm5cVD5D3tf/hkAzOnNF3nVWv0nhrzsZ6lhugX6fvBndu8Im', 'kasir', 'Kumala', 'sleman', '2001-03-05', 'P', 'kumala@gmail.com', '08182666651', NULL, '2024-05-12 14:16:19', '2024-05-12 14:16:19');
INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `email`, `nomor_telpon`, `poin`, `created_at`, `updated_at`) VALUES
(9, 'manajer', '$2y$12$8WciYg6GTxEUqBLXhbGxWO0KccgAQ83vKxNfGkUeo/iuBIEjx33sy', 'manajer', 'Reirina', 'gamping', '2001-03-05', 'P', 'reirina@gmail.com', '08138825093', NULL, '2024-05-12 14:16:19', '2024-05-12 14:16:19');
INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `email`, `nomor_telpon`, `poin`, `created_at`, `updated_at`) VALUES
(10, 'member', '$2y$12$GhamLc.nd.1jgPpCKrKzm.MryWonLoAukM2quWEJEBVAqlqmct4Ia', 'member', 'Lala', 'jombor', '2001-03-06', 'P', 'lala@gmail.com', '08576234654', '2500', '2024-05-12 14:16:19', '2024-05-15 15:56:37'),
(11, 'member2', '$2y$12$iUHZnY/C9L2p0UsEq.R12edkdfwXKeBbDA4h8Zd1WFTytgKjKWdRi', 'member', 'laeina', 'trini', '2001-03-05', 'P', 'laeina@gmail.com', '08576234654', '81600', '2024-05-12 14:16:19', '2024-05-14 15:08:17');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;