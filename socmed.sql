-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 08:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socmed`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `content` varbinary(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 0x436d62ff896cba2aaa326c2587dd8212, '2025-03-27 18:42:20', '2025-03-27 18:42:20'),
(2, 1, 0xbf57537cb75950bc03ffb0d99994bc68, '2025-03-27 18:42:27', '2025-03-27 18:42:27'),
(3, 1, 0x8d0e31f5ffffe70aedf3e6cd2885f12f, '2025-03-27 18:42:56', '2025-03-27 18:42:56'),
(4, 1, 0x4023bf33313a4e025e01c36b80651504, '2025-03-27 21:17:51', '2025-03-27 21:17:51'),
(5, 1, 0x0044a217fc61297e3b5be96c162a23ce, '2025-03-28 01:10:49', '2025-03-28 01:10:49'),
(6, 1, 0xab98df016fa58b69c482b019f43eb96d, '2025-03-28 01:52:55', '2025-03-28 01:52:55'),
(7, 1, 0xe1041065d362810f9da4f2ee7152be08, '2025-03-28 13:54:26', '2025-03-28 13:54:26'),
(8, 1, 0x60e59d7f6b8ce50243d6044ad583b154, '2025-03-29 15:18:36', '2025-03-29 15:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `directory` varbinary(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `directory`, `created_at`, `updated_at`) VALUES
(1, 5, 0xd5caab3bbd923215531bbeb8e669a9b9343bccb92119c80f0ee6f2f87cd7a0d4f5fd19198d0ee702e00a47f995e8d044, '2025-03-28 01:10:49', '2025-03-28 01:10:49'),
(2, 8, 0xd5caab3bbd923215531bbeb8e669a9b97cb00e16cfee023f28068e9cdaf78cc9f5fd19198d0ee702e00a47f995e8d044, '2025-03-29 15:18:36', '2025-03-29 15:18:36'),
(3, 8, 0xd5caab3bbd923215531bbeb8e669a9b9d06f7eb9ad3240ba21d2c1d263162ac085bbe32852e3371139e1b492379de49a, '2025-03-29 15:18:36', '2025-03-29 15:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_image` varbinary(255) DEFAULT NULL,
  `fname` varbinary(255) DEFAULT NULL,
  `lname` varbinary(255) DEFAULT NULL,
  `birthdate` varbinary(255) DEFAULT NULL,
  `email` varbinary(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_image`, `fname`, `lname`, `birthdate`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 0x5e16fca9b087448ad28c96c4ab5c10cf917c7860fd10d814c1126c04896ac86740cbbf790b8073b4df503acc4ff1495e, 0x9ccc036be6bf09d20d595ef5fde10ee9, 0x9ccc036be6bf09d20d595ef5fde10ee9, 0x06697c1b3e9ac23a343dabf09ca1e1f3, 0xd3bc36f6380c1d5210afe5ca2d11c829, 'admin', '$2y$10$aoQr9WaPnmrvI1o8gqSYF.k6DvxlyX6u9gL9eIVKeYUtB6LKBMCC.', '2025-03-27 18:41:57', '2025-03-27 18:41:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
-- ALTER TABLE `post`
--   MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- --
-- -- AUTO_INCREMENT for table `post_images`
-- --
-- ALTER TABLE `post_images`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --
-- -- AUTO_INCREMENT for table `users`
-- --
-- ALTER TABLE `users`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
