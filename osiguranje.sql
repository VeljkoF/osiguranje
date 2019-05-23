-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 07:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osiguranje`
--

-- --------------------------------------------------------

--
-- Table structure for table `osiguranici`
--

CREATE TABLE `osiguranici` (
  `id_osiguranika` int(11) NOT NULL,
  `ime_osiguranika` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prezime_osiguranika` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjenja_osiguranika` date NOT NULL,
  `broj_pasosa_osiguranika` int(9) NOT NULL,
  `telefon_osiguranika` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_osiguranika` text COLLATE utf8_unicode_ci,
  `nosilac_osiguranja` int(1) NOT NULL,
  `id_osiguranje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `osiguranja`
--

CREATE TABLE `osiguranja` (
  `id_osiguranje` int(11) NOT NULL,
  `datum_polise_osiguranje` date NOT NULL,
  `id_tip_osiguranja` int(11) NOT NULL,
  `datum_pocetka_putovanja_osigutanje` date NOT NULL,
  `datum_kraja_putovanja_osigutanje` date NOT NULL,
  `broj_dana_putovanja_osiguranje` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tip_osiguranja`
--

CREATE TABLE `tip_osiguranja` (
  `id_tip_osiguranja` int(11) NOT NULL,
  `naziv_tip_osiguranja` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tip_osiguranja`
--

INSERT INTO `tip_osiguranja` (`id_tip_osiguranja`, `naziv_tip_osiguranja`) VALUES
(1, 'Individualno'),
(2, 'Grupno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `osiguranici`
--
ALTER TABLE `osiguranici`
  ADD PRIMARY KEY (`id_osiguranika`),
  ADD KEY `id_osiguranje` (`id_osiguranje`);

--
-- Indexes for table `osiguranja`
--
ALTER TABLE `osiguranja`
  ADD PRIMARY KEY (`id_osiguranje`),
  ADD KEY `id_tip_osiguranja` (`id_tip_osiguranja`);

--
-- Indexes for table `tip_osiguranja`
--
ALTER TABLE `tip_osiguranja`
  ADD PRIMARY KEY (`id_tip_osiguranja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `osiguranici`
--
ALTER TABLE `osiguranici`
  MODIFY `id_osiguranika` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `osiguranja`
--
ALTER TABLE `osiguranja`
  MODIFY `id_osiguranje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tip_osiguranja`
--
ALTER TABLE `tip_osiguranja`
  MODIFY `id_tip_osiguranja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
