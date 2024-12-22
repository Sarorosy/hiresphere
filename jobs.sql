-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 04:33 PM
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
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE `tbl_jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `experience` int(11) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `skills` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `job_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`id`, `title`, `description`, `location`, `experience`, `salary`, `skills`, `company_id`, `created_at`, `job_type`) VALUES
(11, 'test', 'testt', 'chennai', 0, '120000', 'snsjkwswknsknws', 2, '2024-12-22 09:07:39', ''),
(12, 'test', 'testt', 'chennai', 0, '120000', 'snsjkwswknsknws', 2, '2024-12-22 09:10:39', ''),
(14, 'test', '<p>test <strong>TEST</strong></p>', 'fdsgfd', 28, '23232', 'adsfd , fadf, faaf', 2, '2024-12-22 10:07:22', 'Full-time'),
(17, 'Python Developer', '<p>Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg Testimg </p>', 'chennai', 2, '50000', 'hmtl,css, javacript', 2, '2024-12-22 12:20:50', 'Full-time');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_applications`
--

CREATE TABLE `tbl_job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `education` text DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job_applications`
--

INSERT INTO `tbl_job_applications` (`id`, `job_id`, `name`, `email`, `phone`, `resume`, `education`, `cover_letter`, `created_at`) VALUES
(12, 17, 'Saravanan Seenivasan', 'codersaro@gmail.com', '+919361187937', 'public/resumes/resume_1734879817.pdf', 'Rajeshwari vedachalam arts and science college', 'I will be the great fit for this job', '2024-12-22 16:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_history`
--

CREATE TABLE `tbl_order_history` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Success','Failed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_history`
--

INSERT INTO `tbl_order_history` (`id`, `org_id`, `payment_id`, `order_id`, `amount`, `status`, `created_at`) VALUES
(1, 2, 'pay_PaAPTZVjF6U4ZH', 'order_PaAP9RI9fFC3N2', 99.00, 'Success', '2024-12-22 04:38:00'),
(2, 2, 'pay_PaCgvC5zuDL8rm', 'order_PaCgCOGxXfolyJ', 99.00, 'Success', '2024-12-22 06:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organizations`
--

CREATE TABLE `tbl_organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `decrypt_password` varchar(255) DEFAULT NULL,
  `isverified` varchar(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_organizations`
--

INSERT INTO `tbl_organizations` (`id`, `name`, `email`, `password`, `profile_pic`, `contact_number`, `address`, `created_at`, `updated_at`, `decrypt_password`, `isverified`) VALUES
(2, 'Innovative Solutions', 'codersaro@gmail.com', 'f02bf3a29b01534b368a381e7965ca41', 'public/companyprofiles/profile_2.png', '09361187937', '3,main road\r\nthimmarajampettai', '2024-12-22 11:04:41', '2024-12-22 17:26:44', 'Sarorosie@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_jobs`
--

CREATE TABLE `tbl_temp_jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `experience` int(11) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `skills` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `job_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_temp_jobs`
--

INSERT INTO `tbl_temp_jobs` (`id`, `title`, `description`, `location`, `experience`, `salary`, `skills`, `company_id`, `created_at`, `job_type`) VALUES
(1, 'Test', 'sddasf', 'dfsdfsfd', 1, '2-3 LPA', 'hmtl', 2, '2024-12-22 08:02:48', ''),
(2, 'Test', 'sddasf', 'dfsdfsfd', 1, '2-3 LPA', 'hmtl', 2, '2024-12-22 08:09:41', ''),
(3, 'test', 'test', 'chennai', 2, 'Saravanan', 'hmtl', 2, '2024-12-22 08:11:00', ''),
(4, 'test', 'test', 'chennai', 2, 'Saravanan', 'hmtl', 2, '2024-12-22 08:13:43', ''),
(5, 'test', 'test', 'chennai', 2, 'Saravanan', 'hmtl', 2, '2024-12-22 08:16:16', ''),
(6, 'bjsdadd', 'dasdasdd', 'asdada', 30, 'adsdada', 'adasdd', 2, '2024-12-22 08:18:52', ''),
(7, 'bjsdadd', 'dasdasdd', 'asdada', 30, 'adsdada', 'adasdd', 2, '2024-12-22 08:21:21', ''),
(8, 'bjsdadd', 'dasdasdd', 'asdada', 30, 'adsdada', 'adasdd', 2, '2024-12-22 08:22:44', ''),
(9, 'test', 'testt', 'chennai', 0, '120000', 'snsjkwswknsknws', 2, '2024-12-22 08:50:06', ''),
(10, 'test', 'testt', 'chennai', 0, '120000', 'snsjkwswknsknws', 2, '2024-12-22 09:06:10', ''),
(11, 'test', 'testt', 'chennai', 0, '120000', 'snsjkwswknsknws', 2, '2024-12-22 09:07:39', ''),
(13, 'test', 'test', 'fdsgfd', 28, '23232', 'adsfd , fadf, faaf', 2, '2024-12-22 10:06:51', 'Full-time'),
(15, 'fdsafsd', 'afdasf', 'chennai', 429, '2432424', 'hmtl', 2, '2024-12-22 10:08:48', 'Full-time'),
(16, 'fdfs', 'sdfgdfg', 'gsdfd', 3, '120000', 'gdfsgdf', 2, '2024-12-22 10:12:00', 'Full-time'),
(18, 'Data Analyst', '<p>Testing Testing Testing Testing Testing Testing </p>', 'Bangalore', 1, '120000', 'Excel, Powerpoint', 2, '2024-12-22 16:21:26', 'Full-time');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_job_applications`
--
ALTER TABLE `tbl_job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `tbl_organizations`
--
ALTER TABLE `tbl_organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_temp_jobs`
--
ALTER TABLE `tbl_temp_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_job_applications`
--
ALTER TABLE `tbl_job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_organizations`
--
ALTER TABLE `tbl_organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_temp_jobs`
--
ALTER TABLE `tbl_temp_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD CONSTRAINT `tbl_jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_organizations` (`id`);

--
-- Constraints for table `tbl_job_applications`
--
ALTER TABLE `tbl_job_applications`
  ADD CONSTRAINT `tbl_job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`id`);

--
-- Constraints for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  ADD CONSTRAINT `tbl_order_history_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `tbl_organizations` (`id`);

--
-- Constraints for table `tbl_temp_jobs`
--
ALTER TABLE `tbl_temp_jobs`
  ADD CONSTRAINT `tbl_temp_jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_organizations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
