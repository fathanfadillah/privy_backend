-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2020 at 12:40 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(12, 'admin', '$2y$10$Svi8DFuFleZa3Rus/6JAXuRGbiz9DeIZV5l4fm03C2H8e3.nYNUIe', '2020-09-15 03:05:23', '2020-09-15 03:05:23'),
(13, 'axxpxmd', '$2y$10$dTCc82rgyHZdy.5l3gEk5OlNjfdSdamarPNjlBBcC4p67z6xkg4Sm', '2020-09-15 03:08:55', '2020-09-15 03:08:55'),
(15, 'fatan', '$2y$10$ibO1iIwKGErxuQIXU3azIeslNxfFD/dhcA1z8ihaUbdB/GZqa1eGC', '2020-09-22 23:23:49', '2020-09-22 23:23:49'),
(16, 'fadil', '$2y$10$jxua.gzO37DvickS7qT3necxqHS6k77xLLx/zgqKRxuChSzEWUVAy', '2020-09-24 17:19:19', '2020-09-24 17:19:19'),
(17, 'lele', '$2y$10$hA.8qbVLUO7zZ2OeoldYHuVPNO251LBTpqT8yvi4mvCXgEl.ZmItu', '2020-09-24 21:22:16', '2020-09-24 21:22:16'),
(18, 'qwerty', '$2y$10$p5yCkH5tn5jYrNrPbwk8yuB8T0mIS3QvTQXPRrtCZ5YvkCNL6b.Ey', '2020-09-25 09:34:27', '2020-09-25 09:34:27'),
(19, 'tan', '$2y$10$tKCMbZd2NGvIQ/xUQKwU8e8LyIloPxGrfFBaQqHad2bZbhlrQrcLK', '2020-09-25 15:31:15', '2020-09-25 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `admin_id`, `nama`, `email`, `no_telp`, `foto`, `created_at`, `updated_at`) VALUES
(12, 12, 'admin', 'admin@gmail.com', '02174646336', '1600141511.u4.png', '2020-09-15 03:05:24', '2020-09-15 03:45:11'),
(13, 13, 'Asip Hamdi', 'asiphamdi13@gmail.com', '083897229273', '1600139336.IMG_e4lrv5.jpg', '2020-09-15 03:08:56', '2020-09-15 03:08:56'),
(15, 15, 'fatan', 'fathan17698@gmail.com', '02450430223', '1600791829.morse.PNG', '2020-09-22 23:23:49', '2020-09-22 23:23:49'),
(16, 16, 'fadil', 'fathan17@gmail.com', '120832138012', '1600942759.3.PNG', '2020-09-24 17:19:19', '2020-09-24 17:19:19'),
(17, 17, 'lele', 'lele@gmail.com', '019283198310', '1600957336.7.PNG', '2020-09-24 21:22:16', '2020-09-24 21:22:16'),
(18, 18, 'qwerty', 'qwe@mai.com', '01237012', '1601001268.6.PNG', '2020-09-25 09:34:28', '2020-09-25 09:34:28'),
(19, 19, 'tan', 'tan@gmail.com', '0192380192', '1601022675.tengah sama.PNG', '2020-09-25 15:31:15', '2020-09-25 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasis`
--

CREATE TABLE `dokumentasis` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokumentasis`
--

INSERT INTO `dokumentasis` (`id`, `title`, `deskripsi`, `link`, `icon`, `created_at`, `updated_at`) VALUES
(35, 'Quickstart', 'Learn how to start building awesome apps with the PrivyID API.', 'Get learn started', '1601885035.2444d56.svg', '2020-10-05 15:03:55', '2020-10-05 15:03:55'),
(36, 'Documentation', 'Explore the API with our most comprehensive documentation', 'Read our API docs', '1601885482.126204e.svg', '2020-10-05 15:11:22', '2020-10-05 15:11:22'),
(37, 'Support', 'Find answer to common integration questions and issues', 'Get in touch', '1601885532.84522c1.svg', '2020-10-05 10:20:18', '2020-10-05 15:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

CREATE TABLE `enterprises` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enterprises`
--

INSERT INTO `enterprises` (`id`, `title`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(34, 'Bulk signing', 'Sign multiple documents in one go', '1601806214.bulk-sign.png', '2020-10-04 17:10:14', '2020-10-04 17:10:14'),
(36, 'Customizable access', 'Assign customizable access for your company\'s account management based on document\'s category or employee\'s department', '1601806403.company-structure.png', '2020-10-04 17:13:23', '2020-10-04 17:13:23'),
(37, 'Customizable template & document category', 'Create and upload your own document templates. Categorize your documents based on your company\'s own requirements', '1601807031.document-template.png', '2020-10-04 17:23:51', '2020-10-04 17:23:51'),
(38, 'Various roles in document access', 'Add reviewer and approver role to your company documents.', '1601807118.document-recipient.png', '2020-10-04 17:25:18', '2020-10-04 17:25:18'),
(39, 'Position stamp', 'Every employee you register with EnterpriseID gets their position displayed with each of their signature.', '1601807156.position-stamp.png', '2020-10-04 17:25:56', '2020-10-04 17:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(511) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `kategori`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(20, 'Top Asked Question', 'Bagaimana jika saya tidak bisa mengunduh dokumen yang sudah ditandatangani / dokumen asli?', 'Mohon pastikan bahwa Anda terhubung pada koneksi internet. Kemudian, pastikan koneksi internet yang Anda gunakan sudah stabil dan memiliki kecepatan yang mencukupi untuk mengunduh dokumen. Apabila masalah masih berlanjut, silakan lampirkan screenshot atau rekaman video beserta kronologi permasalahan melalui fitur Live Chat atau email kami di helpdesk@privy.id.', '2020-09-25 15:29:03', '2020-10-05 17:48:48'),
(37, 'Top Asked Question', 'Apa yang harus dilakukan jika saya telah registrasi / mendaftar, tapi belum merasa mendapat email verifikasi?', 'Mohon kerjasamanya untuk melakukan pemeriksaan pada folder kotak masuk dan spam pada alamat email yang Anda gunakan saat melakukan pendaftaran PrivyID dengan kata kunci berikut: \"Data Anda Telah Terverifikasi\"', '2020-10-05 17:47:12', '2020-10-05 17:47:12'),
(38, 'Enterprise', 'Apa itu EnterpriseID?', 'EnterpriseID adalah identitas elektronik yang disediakan Privy untuk Badan Usaha atau Badan Hukum dengan berbagai fitur yang menunjang proses transaksi elektronik perusahaan', '2020-10-06 09:24:45', '2020-10-06 09:24:45'),
(39, 'Enterprise', 'Apa alamat website yang bisa saya kunjungi untuk melakukan pendaftaran EnterpriseID?', 'Perdaftaran EnterpriseID dapat dilakukan melalui tautan berikut https://enterprise.privy.id/', '2020-10-06 09:25:14', '2020-10-06 09:25:14'),
(40, 'General', 'Perusahaan yang bergerak dalam bidang apakah PrivyID?', 'PrivyID menyelenggarakan identitas digital yang terpercaya dan tanda tangan digital mengikat secara hukum menggunakan sertifikat elektronik. PrivyID adalah penyelenggara sertifikat elektronik pertama yang mendapatkan pengakuan dari Kementerian Komunikasi dan Informatika (KOMINFO).', '2020-10-06 09:25:41', '2020-10-06 09:25:41'),
(41, 'General', 'Apakah saat ini PrivyID sedang membuka lowongan pekerjaan?', 'Anda dapat melakukan pengecekan lowongan kerja yang tersedia di Privy pada laman berikut https://privy.id/job/ dan dapat langsung mengunjungi akun instagram PrivyID', '2020-10-06 09:26:39', '2020-10-06 09:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `keuntungans`
--

CREATE TABLE `keuntungans` (
  `id` int(11) NOT NULL,
  `title_keuntungan` varchar(50) NOT NULL,
  `deskripsi_keuntungan` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keuntungans`
--

INSERT INTO `keuntungans` (`id`, `title_keuntungan`, `deskripsi_keuntungan`, `icon`, `created_at`, `updated_at`) VALUES
(41, 'Hemat Waktu', 'Tandatangani dan kirim dokumen dari mana saja, kapan saja.', '1601867036.icon-3@3x.png', '2020-10-05 10:03:56', '2020-10-05 10:03:56'),
(42, 'Hemat Biaya', 'Hilangkan biaya untuk pembelian alat tulis, ekspedisi, hingga penyimpanan dokumen.', '1601867054.icon-2@3x.png', '2020-10-05 10:04:14', '2020-10-05 10:04:14'),
(43, 'Legal', 'Tanda tangan digital bersertifikasi PrivyID memiliki kekuatan dan akibat hukum yang sah sesuai persyaratan UU ITE.', '1601867074.icon-1@3x.png', '2020-10-05 10:04:34', '2020-10-05 10:04:34'),
(44, 'Aman', 'Hilangkan risiko dokumen rusak, hilang, atau dibuka tanpa izin oleh pihak ketiga yang kerap terjadi pada dokumen kertas', '1601867119.icon-4@3x.png', '2020-10-05 10:05:19', '2020-10-05 10:05:19'),
(45, 'Selalu Tersedia', 'Kurangi penggunaan kertas dan emisi karbon dengan platform digital kami', '1601867140.icon-5@3x.png', '2020-10-05 10:05:40', '2020-10-05 10:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `kliens`
--

CREATE TABLE `kliens` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kliens`
--

INSERT INTO `kliens` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(40, '1601872681.logo_telkom.png', '2020-10-05 11:38:01', '2020-10-05 11:38:01'),
(41, '1601872726.logo_mandiri.png', '2020-10-05 11:38:46', '2020-10-05 11:38:46'),
(42, '1601872739.logo_bri.png', '2020-10-05 11:38:59', '2020-10-05 11:38:59'),
(43, '1601872755.logo_cimb.png', '2020-10-05 11:39:15', '2020-10-05 11:39:15'),
(44, '1601872868.logo_mandiri_sekuritas.png', '2020-10-05 11:41:08', '2020-10-05 11:41:08'),
(45, '1601872877.logo_lintasarta.png', '2020-10-05 11:41:17', '2020-10-05 11:41:17'),
(46, '1601872897.logo_gramedia.png', '2020-10-05 11:41:37', '2020-10-05 11:41:37'),
(47, '1601872909.logo_hellobeauty.png', '2020-10-05 11:41:49', '2020-10-05 11:41:49'),
(48, '1601872925.logo_pinang.png', '2020-10-05 11:42:05', '2020-10-05 11:42:05'),
(49, '1601872938.logo_akulaku.png', '2020-10-05 11:42:18', '2020-10-05 11:42:18'),
(50, '1601872956.telkomsel.png', '2020-10-05 11:42:36', '2020-10-05 11:42:36'),
(51, '1601872971.logo_bcafinance.png', '2020-10-05 11:42:51', '2020-10-05 11:42:51'),
(52, '1601872998.logo_adira.png', '2020-10-05 11:43:18', '2020-10-05 11:43:18'),
(53, '1601873012.logo_amartha.png', '2020-10-05 11:43:32', '2020-10-05 11:43:32'),
(54, '1601873050.logo_awantunai.png', '2020-10-05 11:44:10', '2020-10-05 11:44:10'),
(55, '1601873068.logo_koinworks.png', '2020-10-05 11:44:28', '2020-10-05 11:44:28'),
(56, '1601873086.logo_klikacc.png', '2020-10-05 11:44:46', '2020-10-05 11:44:46'),
(57, '1601873097.logo_akseleran.png', '2020-10-05 11:44:57', '2020-10-05 11:44:57'),
(58, '1601873118.logo_rhb.png', '2020-10-05 11:45:18', '2020-10-05 11:45:18'),
(59, '1601873131.logo_sinarmas.png', '2020-10-05 11:45:31', '2020-10-05 11:45:31'),
(60, '1601873142.logo_digiasia.png', '2020-10-05 11:45:42', '2020-10-05 11:45:42'),
(61, '1601873155.logo_kerjasamacom.png', '2020-10-05 11:45:55', '2020-10-05 11:45:55'),
(62, '1601873165.logo_duha_syariah.png', '2020-10-05 11:46:05', '2020-10-05 11:46:05'),
(63, '1601873183.logo_cashwagon.jpg', '2020-10-05 11:46:23', '2020-10-05 11:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_bisnis`
--

CREATE TABLE `kontak_bisnis` (
  `id` int(11) NOT NULL,
  `namaDepan` varchar(20) NOT NULL,
  `namaBelakang` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `divisi` varchar(10) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `namaPerusahaan` varchar(20) NOT NULL,
  `namaBrand` varchar(20) NOT NULL COMMENT 'merek dagang',
  `kategoriIndustri` varchar(100) NOT NULL COMMENT 'industri perushaan apa',
  `tipeDokumen` varchar(10) NOT NULL COMMENT 'Digunakan untuk dokumen (external/internal)',
  `contohDokumen` varchar(20) NOT NULL,
  `jumlahDokumen` varchar(20) NOT NULL COMMENT 'jumlah tanda tangan/bulan',
  `caraTandaTangan` varchar(50) NOT NULL COMMENT 'Bagaimana perusahaan anda menandatangani sebuah dokumen',
  `caraPenggunaan` varchar(100) NOT NULL COMMENT 'cara yang paling cocok untuk menggunakan layanan kami',
  `waktuImplementasi` varchar(50) NOT NULL COMMENT 'waktu pengerjaan',
  `catatan` varchar(400) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak_bisnis`
--

INSERT INTO `kontak_bisnis` (`id`, `namaDepan`, `namaBelakang`, `email`, `phone`, `divisi`, `jabatan`, `namaPerusahaan`, `namaBrand`, `kategoriIndustri`, `tipeDokumen`, `contohDokumen`, `jumlahDokumen`, `caraTandaTangan`, `caraPenggunaan`, `waktuImplementasi`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 'asd', 'asd', 'asd@gmail.com', '07130928019', 'ti', 'SVP/EVP', 'cenerico', 'blade', 'Conglomeration', 'Internal', 'MOU', '1 – 1.000', 'Using certified digital signature', 'Using our platform (PrivyID) as is', 'A month from now', NULL, '2020-10-23 11:58:47', '2020-10-23 11:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `liputans`
--

CREATE TABLE `liputans` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liputans`
--

INSERT INTO `liputans` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(40, '1601873766.Logo-Kumparan.png', '2020-10-05 11:56:06', '2020-10-05 11:56:06'),
(41, '1601873778.reuters.png', '2020-10-05 11:56:18', '2020-10-05 11:56:18'),
(42, '1601873798.Logo-Tech-in-Asia.png', '2020-10-05 11:56:38', '2020-10-05 11:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 'app\\User', 12, '2020-09-15 03:05:24', '2020-09-15 03:05:24'),
(2, 'app\\User', 13, '2020-09-15 03:08:56', '2020-09-15 03:21:19'),
(2, 'app\\User', 15, '2020-09-22 23:23:49', '2020-09-22 23:23:49'),
(2, 'app\\User', 16, '2020-09-24 17:19:20', '2020-09-24 17:19:20'),
(2, 'app\\User', 17, '2020-09-24 21:22:16', '2020-09-24 21:22:16'),
(2, 'app\\User', 18, '2020-09-25 09:34:28', '2020-09-25 09:34:28'),
(2, 'app\\User', 19, '2020-09-25 15:31:15', '2020-09-25 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penghargaans`
--

CREATE TABLE `penghargaans` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penghargaans`
--

INSERT INTO `penghargaans` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(36, '1601886372.forbes.png', '2020-10-05 10:45:20', '2020-10-05 15:26:12'),
(37, '1601886362.finspire.jpg', '2020-10-05 10:45:48', '2020-10-05 15:26:02'),
(38, '1601886351.e27top100.png', '2020-10-05 10:45:56', '2020-10-05 15:25:51'),
(39, '1601886331.dea.png', '2020-10-05 10:46:16', '2020-10-05 15:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'master-role', 'web', '2020-09-15 03:00:33', '2020-09-15 03:00:33'),
(3, 'setting-template', 'web', '2020-09-15 03:28:39', '2020-09-15 03:28:39'),
(4, 'master-pedagang', 'web', '2020-09-16 01:52:00', '2020-09-16 01:52:00'),
(5, 'master-pasar', 'web', '2020-09-16 01:59:27', '2020-09-16 01:59:27'),
(6, 'master-jenis', 'web', '2020-09-16 01:59:36', '2020-09-16 01:59:36'),
(7, 'master-transaksi', 'web', '2020-09-16 02:03:04', '2020-09-16 02:03:04'),
(12, 'master-privy', 'web', '2020-09-28 15:42:48', '2020-09-28 15:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `pimpinans`
--

CREATE TABLE `pimpinans` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pimpinans`
--

INSERT INTO `pimpinans` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES
(20, 'Marshall Pribadi', 'CEO & FOUNDER', '1601885745.marshall.png', '2020-09-25 15:29:03', '2020-10-05 15:15:45'),
(34, 'Guritnoggffhgfghf Adi Saputra', 'CTO & COzfdsfdsfd-FOUNDER', '1602766620.how to admin login.PNG', '2020-10-05 10:09:54', '2020-10-15 19:57:00'),
(35, 'Johan Andreas', 'EVP Business Development', '1601885707.andre.png', '2020-10-05 10:10:20', '2020-10-05 15:15:07'),
(36, 'Krishna Chandra', 'EVP Security', '1601868018.khrisna.png', '2020-10-05 10:20:18', '2020-10-05 13:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2020-09-15 02:59:32', '2020-09-15 02:59:32'),
(2, 'admin-biasa', 'web', '2020-09-15 03:21:03', '2020-09-15 03:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikats`
--

CREATE TABLE `sertifikats` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sertifikats`
--

INSERT INTO `sertifikats` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(40, '1601874039.awards (1).png', '2020-10-05 12:00:39', '2020-10-05 12:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `logo_title` varchar(100) NOT NULL,
  `logo_auth` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `logo`, `logo_title`, `logo_auth`, `created_at`, `updated_at`) VALUES
(1, '1600141302.store_icon-icons.com_54371.png', '1600139421.tangsel.png', 'auth.png', NULL, '2020-09-18 18:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `dokumentasis`
--
ALTER TABLE `dokumentasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuntungans`
--
ALTER TABLE `keuntungans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kliens`
--
ALTER TABLE `kliens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_bisnis`
--
ALTER TABLE `kontak_bisnis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liputans`
--
ALTER TABLE `liputans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`) USING BTREE,
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE;

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`) USING BTREE,
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penghargaans`
--
ALTER TABLE `penghargaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pimpinans`
--
ALTER TABLE `pimpinans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE;

--
-- Indexes for table `sertifikats`
--
ALTER TABLE `sertifikats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dokumentasis`
--
ALTER TABLE `dokumentasis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `keuntungans`
--
ALTER TABLE `keuntungans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kliens`
--
ALTER TABLE `kliens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `kontak_bisnis`
--
ALTER TABLE `kontak_bisnis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `liputans`
--
ALTER TABLE `liputans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penghargaans`
--
ALTER TABLE `penghargaans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pimpinans`
--
ALTER TABLE `pimpinans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sertifikats`
--
ALTER TABLE `sertifikats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
