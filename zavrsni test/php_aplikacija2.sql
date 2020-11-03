-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2020 at 01:08 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_aplikacija2`
--
CREATE DATABASE IF NOT EXISTS `php_aplikacija2` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `php_aplikacija2`;

-- --------------------------------------------------------

--
-- Table structure for table `aktivnosti`
--

CREATE TABLE `aktivnosti` (
  `aktivnost_id` int(191) UNSIGNED NOT NULL,
  `aktivnost_dodelio` int(191) UNSIGNED NOT NULL,
  `aktivnost_primio` int(191) UNSIGNED NOT NULL,
  `opis_aktivnosti` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `naslov_aktivnosti` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `rok_izvrsenja` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `dani_do_isteka` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `urgencija` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `vreme_dodeljivanja` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `status_aktivnosti` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'nije uradjeno',
  `vreme_do_isteka` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(191) UNSIGNED NOT NULL,
  `korisnicko_ime` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ime_prezime` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uloga_id` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `status_odobrenja` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'nije odobren',
  `pokusaji_prijavljivanja` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(10) UNSIGNED NOT NULL,
  `naziv_uloge` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `prioritet` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `naziv_uloge`, `prioritet`) VALUES
(1, 'administrator', 2),
(2, 'obican korisnik', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivnosti`
--
ALTER TABLE `aktivnosti`
  ADD PRIMARY KEY (`aktivnost_id`),
  ADD KEY `aktivnost_dodelio` (`aktivnost_dodelio`),
  ADD KEY `aktivnost_primio` (`aktivnost_primio`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uloga_id` (`uloga_id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivnosti`
--
ALTER TABLE `aktivnosti`
  MODIFY `aktivnost_id` int(191) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(191) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivnosti`
--
ALTER TABLE `aktivnosti`
  ADD CONSTRAINT `aktivnosti_ibfk_1` FOREIGN KEY (`aktivnost_dodelio`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktivnosti_ibfk_2` FOREIGN KEY (`aktivnost_primio`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`uloga_id`) REFERENCES `uloge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
