-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2025 pada 21.07
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
-- Database: `log_pegawai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daily_logs`
--

CREATE TABLE `daily_logs` (
  `id_logs` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `log_date` date NOT NULL,
  `activity_summary` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verification_note` text DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `daily_logs`
--

INSERT INTO `daily_logs` (`id_logs`, `user_id`, `log_date`, `activity_summary`, `status`, `verified_by`, `verification_note`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-12-31', 'Debugging LOGAREA', 'approved', 1, NULL, '2025-12-30 12:56:10', '2025-12-30 11:34:33', '2025-12-30 12:56:10'),
(2, 2, '2026-01-01', 'BUG INI ADA ERORR', 'approved', 1, NULL, '2025-12-30 12:56:07', '2025-12-30 11:35:35', '2025-12-30 12:56:07'),
(3, 2, '2026-01-02', 'HIKS CAPE BELUM TIDUR', 'approved', 1, NULL, '2025-12-30 12:56:05', '2025-12-30 11:35:54', '2025-12-30 12:56:05'),
(4, 1, '2025-12-31', 'testing', 'approved', 1, NULL, '2025-12-30 11:38:05', '2025-12-30 11:38:05', '2025-12-30 11:38:05'),
(5, 4, '2025-12-31', 'testing & debugging logarea', 'approved', 2, 'try again', '2025-12-30 12:54:23', '2025-12-30 12:00:50', '2025-12-30 12:54:23'),
(6, 4, '2026-01-01', 'bugg lagii', 'approved', 2, NULL, '2025-12-30 12:54:15', '2025-12-30 12:01:12', '2025-12-30 12:54:15'),
(7, 4, '2026-01-02', 'need it support', 'rejected', 2, 'try again', '2025-12-30 12:54:09', '2025-12-30 12:01:24', '2025-12-30 12:54:09'),
(8, 1, '2026-01-01', 'anuan test', 'approved', 1, NULL, '2025-12-30 12:02:21', '2025-12-30 12:02:21', '2025-12-30 12:02:21'),
(9, 1, '2026-01-03', 'heyhey', 'approved', 1, NULL, '2025-12-30 12:21:26', '2025-12-30 12:21:26', '2025-12-30 12:21:26'),
(10, 2, '2026-01-03', 'anu deh testing', 'rejected', 1, 'anu', '2025-12-30 12:56:01', '2025-12-30 12:22:30', '2025-12-30 12:56:01'),
(11, 4, '2026-01-03', 'testing lagiii', 'approved', 2, NULL, '2025-12-30 12:53:39', '2025-12-30 12:23:52', '2025-12-30 12:53:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_30_142854_create_custom_schema', 1),
(2, '2025_12_30_185506_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('15aa730a-5287-422c-bb8f-44e258158a8d', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 1, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 03 Jan 2026 telah APPROVED\",\"note\":null,\"log_id\":9}', '2025-12-30 12:56:18', '2025-12-30 12:21:26', '2025-12-30 12:56:18'),
('251a4506-6998-441b-8d2b-c1fa275eabc8', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Verification Required\",\"message\":\"Bawahan Anda (Staff 1) mengirim log baru.\",\"log_id\":7}', '2025-12-30 12:56:47', '2025-12-30 12:01:24', '2025-12-30 12:56:47'),
('297265c8-e864-4f99-af4a-4641f45b1aef', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 02 Jan 2026 telah APPROVED\",\"note\":null,\"log_id\":3}', '2025-12-30 12:56:47', '2025-12-30 12:56:04', '2025-12-30 12:56:47'),
('2b577fef-1fd8-42fb-84cc-aae8e4d12c5a', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 4, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 01 Jan 2026 telah APPROVED\",\"note\":null,\"log_id\":6}', NULL, '2025-12-30 12:54:15', '2025-12-30 12:54:15'),
('2ff09c40-05b9-4e7f-bd3a-7477751ddd18', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 01 Jan 2026 telah APPROVED\",\"note\":null,\"log_id\":2}', '2025-12-30 12:56:47', '2025-12-30 12:56:07', '2025-12-30 12:56:47'),
('33ffdd94-3640-46a0-ae50-ee3dfbfe39ac', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Verification Required\",\"message\":\"Bawahan Anda (Staff 1) mengirim log baru.\",\"log_id\":11}', '2025-12-30 12:56:47', '2025-12-30 12:23:52', '2025-12-30 12:56:47'),
('4420e97d-f730-492c-9efe-b9b50fb11d15', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Verification Required\",\"message\":\"Bawahan Anda (Staff 1) mengirim log baru.\",\"log_id\":6}', '2025-12-30 12:56:47', '2025-12-30 12:01:12', '2025-12-30 12:56:47'),
('7c4a02b8-c70b-4d1f-829d-3b371fe46c97', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 02 Jan 2026 telah APPROVED\",\"note\":null,\"log_id\":3}', '2025-12-30 12:56:47', '2025-12-30 12:56:05', '2025-12-30 12:56:47'),
('8d9bb617-7a7d-4059-8a27-71bd8603cf7d', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Log Rejected\",\"message\":\"Log harian Anda tanggal 03 Jan 2026 telah REJECTED\",\"note\":\"anu\",\"log_id\":10}', '2025-12-30 12:56:47', '2025-12-30 12:56:01', '2025-12-30 12:56:47'),
('afdf2626-6376-4a55-af10-671b6d4872d6', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 31 Dec 2025 telah APPROVED\",\"note\":null,\"log_id\":1}', '2025-12-30 12:56:47', '2025-12-30 12:56:10', '2025-12-30 12:56:47'),
('c3a1e20e-45cc-4325-bf23-f7a8beaa9b72', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 4, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 03 Jan 2026 telah APPROVED\",\"note\":null,\"log_id\":11}', NULL, '2025-12-30 12:53:39', '2025-12-30 12:53:39'),
('c8e514a5-28d4-4510-8d76-41fadcd6659a', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 4, '{\"title\":\"Log Created Successfully\",\"message\":\"Log harian Anda tanggal 03 Jan 2026 berhasil dibuat (Status: PENDING).\",\"log_id\":11}', '2025-12-30 12:28:45', '2025-12-30 12:23:52', '2025-12-30 12:28:45'),
('cc841748-4ad2-4412-9f2f-a81036ec5cca', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Log Created Successfully\",\"message\":\"Log harian Anda tanggal 03 Jan 2026 berhasil dibuat (Status: PENDING).\",\"log_id\":10}', '2025-12-30 12:56:47', '2025-12-30 12:22:30', '2025-12-30 12:56:47'),
('e967420a-6366-4e99-96b2-25fbe416d2ea', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 4, '{\"title\":\"Log Approved\",\"message\":\"Log harian Anda tanggal 31 Dec 2025 telah APPROVED\",\"note\":\"try again\",\"log_id\":5}', NULL, '2025-12-30 12:54:23', '2025-12-30 12:54:23'),
('eb708330-1d37-46c5-8866-46dc2d1ba1c5', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 2, '{\"title\":\"Verification Required\",\"message\":\"Bawahan Anda (Staff 1) mengirim log baru.\",\"log_id\":5}', '2025-12-30 12:56:47', '2025-12-30 12:00:50', '2025-12-30 12:56:47'),
('ece67e19-7ffc-4ca3-9401-0a32e86b94cf', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 1, '{\"title\":\"Verification Required\",\"message\":\"Bawahan Anda (Kepala Bidang 1) mengirim log baru.\",\"log_id\":10}', '2025-12-30 12:56:18', '2025-12-30 12:22:30', '2025-12-30 12:56:18'),
('ed22c031-fe3a-4802-a74a-ef25b3f30792', 'App\\Notifications\\LogSubmitted', 'App\\Models\\User', 4, '{\"title\":\"Log Rejected\",\"message\":\"Log harian Anda tanggal 02 Jan 2026 telah REJECTED\",\"note\":\"try again\",\"log_id\":7}', NULL, '2025-12-30 12:54:09', '2025-12-30 12:54:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email_user` varchar(150) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role` enum('staff','kepala_bidang','kepala_dinas') NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `email_user`, `user_password`, `role`, `supervisor_id`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Dinas', 'kadis@example.com', '$2y$12$Ymal3iH7YbGJO2NY7luom.u7EsCNW1r2yJ8jAziy6YvI.00dXUZ6O', 'kepala_dinas', NULL, '2025-12-30 07:36:11', '2025-12-30 07:36:11'),
(2, 'Kepala Bidang 1', 'kabid1@example.com', '$2y$12$Ymal3iH7YbGJO2NY7luom.u7EsCNW1r2yJ8jAziy6YvI.00dXUZ6O', 'kepala_bidang', 1, '2025-12-30 07:36:11', '2025-12-30 07:36:11'),
(3, 'Kepala Bidang 2', 'kabid2@example.com', '$2y$12$Ymal3iH7YbGJO2NY7luom.u7EsCNW1r2yJ8jAziy6YvI.00dXUZ6O', 'kepala_bidang', 1, '2025-12-30 07:36:11', '2025-12-30 07:36:11'),
(4, 'Staff 1', 'staff1@example.com', '$2y$12$Ymal3iH7YbGJO2NY7luom.u7EsCNW1r2yJ8jAziy6YvI.00dXUZ6O', 'staff', 2, '2025-12-30 07:36:11', '2025-12-30 07:36:11'),
(5, 'Staff 2', 'staff2@example.com', '$2y$12$Ymal3iH7YbGJO2NY7luom.u7EsCNW1r2yJ8jAziy6YvI.00dXUZ6O', 'staff', 3, '2025-12-30 07:36:11', '2025-12-30 07:36:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD PRIMARY KEY (`id_logs`),
  ADD UNIQUE KEY `daily_logs_user_id_log_date_unique` (`user_id`,`log_date`),
  ADD KEY `daily_logs_verified_by_foreign` (`verified_by`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_user_unique` (`email_user`),
  ADD KEY `users_supervisor_id_foreign` (`supervisor_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daily_logs`
--
ALTER TABLE `daily_logs`
  MODIFY `id_logs` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD CONSTRAINT `daily_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `daily_logs_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
