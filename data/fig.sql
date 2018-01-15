-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2018 at 06:59 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fig`
--

-- --------------------------------------------------------

--
-- Table structure for table `fig`
--

CREATE TABLE `fig` (
  `id` int(11) NOT NULL,
  `numLados` int(11) NOT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lado` int(11) DEFAULT NULL,
  `base` int(11) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `hipotenusa` int(11) DEFAULT NULL,
  `radio` double DEFAULT NULL,
  `workspace` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fig`
--

INSERT INTO `fig` (`id`, `numLados`, `discr`, `lado`, `base`, `altura`, `hipotenusa`, `radio`, `workspace`) VALUES
(2, 4, 'cuadrado', 3, NULL, NULL, NULL, NULL, 1),
(3, 4, 'cuadrado', 10, NULL, NULL, NULL, NULL, 4),
(4, 3, 'triangulo', NULL, 3, 4, 5, NULL, 5),
(5, 3, 'triangulo', NULL, 9, 12, 15, NULL, 4),
(6, 6, 'hexagono', NULL, NULL, NULL, NULL, 5, 1),
(7, 6, 'hexagono', NULL, NULL, NULL, NULL, 15, 4),
(9, 3, 'triangulo', NULL, 4, 4, 4, NULL, NULL),
(10, 6, 'hexagono', NULL, NULL, NULL, NULL, 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE `workspace` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `limiteFiguras` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `workspace`
--

INSERT INTO `workspace` (`id`, `nombre`, `limiteFiguras`) VALUES
(1, 'El primero', 5),
(2, 'El segundo', 5),
(4, 'El tercero', 5),
(5, 'Solo uno', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fig`
--
ALTER TABLE `fig`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D4F24A958D940019` (`workspace`);

--
-- Indexes for table `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fig`
--
ALTER TABLE `fig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `workspace`
--
ALTER TABLE `workspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fig`
--
ALTER TABLE `fig`
  ADD CONSTRAINT `FK_D4F24A958D940019` FOREIGN KEY (`workspace`) REFERENCES `workspace` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
