-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2020 at 08:14 AM
-- Server version: 10.1.43-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmacie`
--

-- --------------------------------------------------------

--
-- Table structure for table `bon`
--

CREATE TABLE `bon` (
  `codb` int(11) NOT NULL,
  `total_plata` int(11) NOT NULL,
  `datav` date NOT NULL,
  `codv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bon`
--

INSERT INTO `bon` (`codb`, `total_plata`, `datav`, `codv`) VALUES
(1, 15, '2019-05-25', 1),
(2, 194, '2019-05-23', 2),
(3, 150, '2019-04-30', 3),
(4, 240, '2019-06-09', 4),
(5, 240, '2019-05-13', 5),
(6, 150, '2019-05-21', 6),
(7, 45, '2019-05-21', 7),
(8, 30, '2019-11-24', 8);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `codc` int(11) NOT NULL,
  `nume` varchar(45) NOT NULL,
  `prenume` varchar(45) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `varsta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`codc`, `nume`, `prenume`, `sex`, `varsta`) VALUES
(3, 'Gheorghita   ', 'Cosmin V  ', 'Masculin', 23),
(4, 'Popa', 'Iulian', 'Masculin', 54),
(5, 'Andrei', 'Calin', 'Masculin', 21),
(6, 'Dorofte', 'Mihai', 'Masculin', 33),
(7, 'George', 'Burlui', 'Masculin', 23),
(8, 'dorofte', 'mihai', 'Masculin', 25);

-- --------------------------------------------------------

--
-- Table structure for table `farmacie`
--

CREATE TABLE `farmacie` (
  `codf` int(11) NOT NULL,
  `filiala` varchar(50) NOT NULL,
  `activa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmacie`
--

INSERT INTO `farmacie` (`codf`, `filiala`, `activa`) VALUES
(1, 'Filiala1', 1),
(2, 'Filiala2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicament`
--

CREATE TABLE `medicament` (
  `codm` int(11) NOT NULL,
  `prod` varchar(30) NOT NULL,
  `den` varchar(45) NOT NULL,
  `pret` double NOT NULL,
  `stoc` int(11) NOT NULL DEFAULT '0',
  `data_exp` date NOT NULL,
  `prescriptie` varchar(3) NOT NULL DEFAULT 'nu',
  `nat_exp` varchar(45) DEFAULT NULL,
  `nat_suba` varchar(45) DEFAULT NULL,
  `suba` varchar(45) DEFAULT NULL,
  `mod_a` varchar(45) DEFAULT NULL,
  `mod_p` varchar(45) DEFAULT NULL,
  `contraindicatii` varchar(45) DEFAULT NULL,
  `continut` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicament`
--

INSERT INTO `medicament` (`codm`, `prod`, `den`, `pret`, `stoc`, `data_exp`, `prescriptie`, `nat_exp`, `nat_suba`, `suba`, `mod_a`, `mod_p`, `contraindicatii`, `continut`) VALUES
(1, 'PharmX ', 'Parasinus 3', 30, 0, '2019-12-24', 'Nu', '-', '-', '-', '-', '-', '-', '20 pastile'),
(2, 'PharmX ', 'Aspirina ', 25, 20, '0000-00-00', 'Da', '- ', '- ', '- ', '- ', ' -', '-', '15 pastile '),
(3, 'BAYER ', 'Ospen ', 25, 25, '0000-00-00', 'Nu', '-', '-', '-', '-', '-', '-', '-'),
(4, 'OralB ', 'Strepsils ', 50, 200, '0000-00-00', 'Da', '- ', '- ', '- ', '- ', '-', '- ', '- '),
(5, 'BAYER ', 'Coldrex ', 80, 15, '0000-00-00', 'Da', '- ', '- ', '- ', '- ', '-', '- ', '- '),
(6, 'BAYER', 'Halfem', 120, 5, '2019-05-26', 'Da', '-', '-', '-', '-', '-', '-', '-'),
(7, 'BAYER', 'PradaXa', 215, 10, '2019-06-07', 'Da', '-', '-', '-', '-', '-', '-', '-'),
(8, 'Ambra', 'Pepe', 13, 14, '2019-11-24', 'Da', 'gg', '- ', 'aaaa', 'aaaaagggg', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `reteta`
--

CREATE TABLE `reteta` (
  `codr` int(11) NOT NULL,
  `doctor` varchar(45) NOT NULL,
  `diag` varchar(45) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `data_elib` date NOT NULL,
  `codc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reteta`
--

INSERT INTO `reteta` (`codr`, `doctor`, `diag`, `tip`, `data_elib`, `codc`) VALUES
(1, 'Radulescu', '-', 'Compensata(30%)', '2019-05-26', 3),
(2, 'Negreanu', '-', 'Compensata(30%)', '2019-05-18', 4),
(3, 'Beraru', '-', 'Necompensata', '2019-05-02', 6),
(4, 'Alderweiler', '-', 'Necompensata', '2019-05-26', 5),
(5, 'ggg', '555', 'Compensata(30%)', '2019-11-24', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `codu` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nivel_acces` int(1) NOT NULL,
  `job` varchar(45) NOT NULL,
  `activ` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`codu`, `user`, `password`, `nivel_acces`, `job`, `activ`) VALUES
(1, 'admin', 'admin', 1, 'Administrator', 1),
(2, 'One', 'parola', 1, 'Farmacist sef', 0),
(3, 'One', 'parola1', 1, 'Farmacist sef', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_farmacie`
--

CREATE TABLE `users_farmacie` (
  `codf` int(11) NOT NULL,
  `codu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_farmacie`
--

INSERT INTO `users_farmacie` (`codf`, `codu`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vanzare`
--

CREATE TABLE `vanzare` (
  `codv` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `codm` int(11) NOT NULL,
  `codr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vanzare`
--

INSERT INTO `vanzare` (`codv`, `cant`, `codm`, `codr`) VALUES
(1, 5, 1, 1),
(2, 3, 7, 2),
(3, 3, 4, 3),
(4, 3, 5, 3),
(5, 2, 6, 4),
(6, 5, 3, 4),
(7, 3, 4, 1),
(8, 10, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon`
--
ALTER TABLE `bon`
  ADD PRIMARY KEY (`codb`),
  ADD KEY `codv_fk` (`codv`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`codc`),
  ADD UNIQUE KEY `codc_UNIQUE` (`codc`);

--
-- Indexes for table `farmacie`
--
ALTER TABLE `farmacie`
  ADD PRIMARY KEY (`codf`);

--
-- Indexes for table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`codm`),
  ADD UNIQUE KEY `codm_UNIQUE` (`codm`);

--
-- Indexes for table `reteta`
--
ALTER TABLE `reteta`
  ADD PRIMARY KEY (`codr`),
  ADD KEY `codc_fk` (`codc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`codu`);

--
-- Indexes for table `users_farmacie`
--
ALTER TABLE `users_farmacie`
  ADD KEY `codf_fk` (`codf`),
  ADD KEY `codu_fk` (`codu`);

--
-- Indexes for table `vanzare`
--
ALTER TABLE `vanzare`
  ADD PRIMARY KEY (`codv`),
  ADD KEY `codm_fk` (`codm`),
  ADD KEY `codr_fk` (`codr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bon`
--
ALTER TABLE `bon`
  MODIFY `codb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `codc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `farmacie`
--
ALTER TABLE `farmacie`
  MODIFY `codf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `codm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reteta`
--
ALTER TABLE `reteta`
  MODIFY `codr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `codu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vanzare`
--
ALTER TABLE `vanzare`
  MODIFY `codv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bon`
--
ALTER TABLE `bon`
  ADD CONSTRAINT `codv_fk` FOREIGN KEY (`codv`) REFERENCES `vanzare` (`codv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reteta`
--
ALTER TABLE `reteta`
  ADD CONSTRAINT `codc_fk` FOREIGN KEY (`codc`) REFERENCES `client` (`codc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_farmacie`
--
ALTER TABLE `users_farmacie`
  ADD CONSTRAINT `codf_fk` FOREIGN KEY (`codf`) REFERENCES `farmacie` (`codf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codu_fk` FOREIGN KEY (`codu`) REFERENCES `users` (`codu`);

--
-- Constraints for table `vanzare`
--
ALTER TABLE `vanzare`
  ADD CONSTRAINT `codm_fk` FOREIGN KEY (`codm`) REFERENCES `medicament` (`codm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codr_fk` FOREIGN KEY (`codr`) REFERENCES `reteta` (`codr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
