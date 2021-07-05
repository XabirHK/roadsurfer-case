-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 12:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roadsurfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `van_id` int(11) NOT NULL,
  `start_station_id` int(11) NOT NULL,
  `end_station_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `van_id`, `start_station_id`, `end_station_id`, `start_date`, `end_date`) VALUES
(1, 1, 2, 1, '2021-07-06 17:56:52', '2021-07-08 17:56:52'),
(3, 2, 1, 2, '2021-07-10 17:56:52', '2021-07-12 17:56:52'),
(4, 2, 3, 4, '2021-07-10 17:56:52', '2021-07-12 17:56:52'),
(5, 5, 1, 3, '2021-07-10 17:56:52', '2021-07-12 17:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `booking_equipment`
--

CREATE TABLE `booking_equipment` (
  `booking_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_equipment`
--

INSERT INTO `booking_equipment` (`booking_id`, `equipment_id`) VALUES
(1, 1),
(1, 2),
(3, 3),
(3, 5),
(4, 2),
(4, 4),
(5, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210704223220', '2021-07-05 00:32:58', 325),
('DoctrineMigrations\\Version20210704223448', '2021-07-05 00:34:56', 1118),
('DoctrineMigrations\\Version20210704223729', '2021-07-05 00:37:35', 215),
('DoctrineMigrations\\Version20210704224322', '2021-07-05 00:43:29', 72),
('DoctrineMigrations\\Version20210704231620', '2021-07-05 01:16:26', 274),
('DoctrineMigrations\\Version20210705084607', '2021-07-05 10:46:13', 384),
('DoctrineMigrations\\Version20210705084818', '2021-07-05 10:48:27', 47);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('chair','bed','desk','') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `type`) VALUES
(1, 'Portable Chair 1', 'chair'),
(2, 'Portable Chair 2', 'chair'),
(3, 'Portable Bed 1', 'bed'),
(4, 'Portable Bed 2', 'bed'),
(5, 'Portable Desk 1', 'desk'),
(6, 'Portable Desk  2', 'desk');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` int(11) DEFAULT NULL,
  `longitude` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Munich', 10, 10),
(2, 'Paris', 10, 10),
(3, 'Porto', 10, 10),
(4, 'Madrid', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `van`
--

CREATE TABLE `van` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van`
--

INSERT INTO `van` (`id`, `name`) VALUES
(1, 'CamperVan1'),
(2, 'CamperVan2'),
(3, 'CamperVan3'),
(4, 'CamperVan4'),
(5, 'CamperVan5'),
(6, 'CamperVan6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E00CEDDE8A128D90` (`van_id`),
  ADD KEY `IDX_E00CEDDE53721DCB` (`start_station_id`),
  ADD KEY `IDX_E00CEDDE2FF5EABB` (`end_station_id`);

--
-- Indexes for table `booking_equipment`
--
ALTER TABLE `booking_equipment`
  ADD PRIMARY KEY (`booking_id`,`equipment_id`),
  ADD KEY `IDX_400A1E803301C60` (`booking_id`),
  ADD KEY `IDX_400A1E80517FE9FE` (`equipment_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van`
--
ALTER TABLE `van`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `van`
--
ALTER TABLE `van`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_E00CEDDE2FF5EABB` FOREIGN KEY (`end_station_id`) REFERENCES `station` (`id`),
  ADD CONSTRAINT `FK_E00CEDDE53721DCB` FOREIGN KEY (`start_station_id`) REFERENCES `station` (`id`),
  ADD CONSTRAINT `FK_E00CEDDE8A128D90` FOREIGN KEY (`van_id`) REFERENCES `van` (`id`);

--
-- Constraints for table `booking_equipment`
--
ALTER TABLE `booking_equipment`
  ADD CONSTRAINT `FK_400A1E803301C60` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_400A1E80517FE9FE` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
