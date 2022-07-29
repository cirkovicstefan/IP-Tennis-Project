-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 04:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekreativnitenisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `pol` varchar(50) DEFAULT NULL,
  `visina` int(11) DEFAULT NULL,
  `godine` int(11) DEFAULT NULL,
  `pobeda` int(11) DEFAULT NULL,
  `porazi` int(11) DEFAULT NULL,
  `naziv_kluba` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `profilna_slika` longblob DEFAULT NULL,
  `id_opreme` int(11) DEFAULT NULL,
  `id_uloge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `pol`, `visina`, `godine`, `pobeda`, `porazi`, `naziv_kluba`, `email`, `lozinka`, `profilna_slika`, `id_opreme`, `id_uloge`) VALUES
(6, 'Marko', 'Markovic', NULL, NULL, NULL, NULL, NULL, 'Borac', 'marko.markovic@gmail.com', 'fdc242f86ffc866597894f944a9e0ff4', NULL, NULL, 3),
(7, 'Dragutin', 'Dragutinović', 'muški', 200, 22, 6, 2, NULL, 'dragutin@gmail.com', '19efbb11b5776872210f3ade10d2316f', NULL, NULL, 1),
(8, 'Mialn', 'Milanković', 'muški', 200, 19, 4, 8, NULL, 'milan.milankovic@gmail.com', '6e48efd5ee769ef43674c95f0819b3a7', NULL, NULL, 1),
(9, 'Jovan', 'Jovanović', 'muški', 200, 39, 10, 3, NULL, 'jovan.jovanovic@gmail.com', 'f3c1dd7c0d8b0d160be05c5df693ef2e', NULL, NULL, 1),
(10, 'Ostoja', 'Marković', 'muški', 200, 26, 11, 14, NULL, 'ostoja.markovic@gmail.com', 'f3602c6b2ef6ee2ba436eaf037bcc052', NULL, NULL, 1);
INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `pol`, `visina`, `godine`, `pobeda`, `porazi`, `naziv_kluba`, `email`, `lozinka`, `profilna_slika`, `id_opreme`, `id_uloge`) VALUES
INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `pol`, `visina`, `godine`, `pobeda`, `porazi`, `naziv_kluba`, `email`, `lozinka`, `profilna_slika`, `id_opreme`, `id_uloge`) VALUES
(24, 'Milan', 'Jaksimović', 'muški', 200, 23, 8, 4, NULL, 'milan@gmail.com', '6e48efd5ee769ef43674c95f0819b3a7', NULL, NULL, 1),
(25, 'Admin', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 2),
(29, 'Janko', 'Janković', 'muški', 20, 25, 2, 0, NULL, 'janko.jankovic@gmail.com', '2598c4fd1e249b053ae98ac91c79ba21', NULL, NULL, 1),
(30, 'Mileta', 'Miletić', 'muški', 200, 19, 0, 1, NULL, 'mileta.miletic@gmail.com', '80a71da13d73f53f2e0397d3c80e6031', NULL, NULL, 1);
INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `pol`, `visina`, `godine`, `pobeda`, `porazi`, `naziv_kluba`, `email`, `lozinka`, `profilna_slika`, `id_opreme`, `id_uloge`) VALUES
INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `pol`, `visina`, `godine`, `pobeda`, `porazi`, `naziv_kluba`, `email`, `lozinka`, `profilna_slika`, `id_opreme`, `id_uloge`) VALUES
(32, 'Ivan', 'Petrović', 'muški', 200, 29, 0, 0, NULL, 'ivan.petrovic@gmail.com', 'cf1c48aab0920df9ad3287f851d8a942', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mecevi`
--

CREATE TABLE `mecevi` (
  `id` int(11) NOT NULL,
  `tip_meca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mecevi`
--

INSERT INTO `mecevi` (`id`, `tip_meca`) VALUES
(5, 'trening'),
(6, 'meč'),
(7, 'turnir');

-- --------------------------------------------------------

--
-- Table structure for table `opreme`
--

CREATE TABLE `opreme` (
  `id` int(11) NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `naziv` varchar(255) NOT NULL,
  `id_tip_opreme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opreme`
--

INSERT INTO `opreme` (`id`, `opis`, `naziv`, `id_tip_opreme`) VALUES
(3, NULL, 'Nike', 2),
(4, NULL, 'Adidas', 2),
(5, NULL, 'Head', 1),
(6, NULL, 'Wilson', 1),
(7, NULL, 'Wilson', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pregled_rezultata`
--

CREATE TABLE `pregled_rezultata` (
  `id` int(11) NOT NULL,
  `rezultat` varchar(255) NOT NULL,
  `potvrda_rezultata` bit(1) NOT NULL,
  `id_rezervacije` int(11) NOT NULL,
  `status_meca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pregled_rezultata`
--

INSERT INTO `pregled_rezultata` (`id`, `rezultat`, `potvrda_rezultata`, `id_rezervacije`, `status_meca`) VALUES
(11, '3-1', b'1', 50, 'odigran'),
(12, '3-0', b'1', 51, 'odigran'),
(13, '3-0', b'1', 52, 'odigran');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `id` int(11) NOT NULL,
  `id_igraca1` int(11) NOT NULL,
  `id_igraca2` int(11) NOT NULL,
  `id_igraca3` int(11) DEFAULT NULL,
  `id_igraca4` int(11) DEFAULT NULL,
  `id_terena` int(11) NOT NULL,
  `id_meca` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vreme` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id`, `id_igraca1`, `id_igraca2`, `id_igraca3`, `id_igraca4`, `id_terena`, `id_meca`, `datum`, `vreme`) VALUES
(50, 7, 8, NULL, NULL, 10, 6, '2022-07-06', '16:29:00'),
(51, 10, 29, 8, 30, 12, 6, '2022-07-03', '16:30:00'),
(52, 9, 8, NULL, NULL, 58, 6, '2022-07-01', '19:28:00'),
(53, 29, 10, NULL, NULL, 12, 6, '2022-07-08', '18:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `sportski_klubovi`
--

CREATE TABLE `sportski_klubovi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sportski_klubovi`
--

INSERT INTO `sportski_klubovi` (`id`, `naziv`, `adresa`) VALUES
(1, 'Borac', 'Cacak'),
(2, 'Zevzda', 'Beograd'),
(3, 'Partizan', 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `tereni`
--

CREATE TABLE `tereni` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `lokacija` varchar(255) NOT NULL,
  `vrsta_podloge` varchar(255) NOT NULL,
  `kapacitet` int(11) NOT NULL,
  `id_kluba` int(11) NOT NULL,
  `zauzet` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tereni`
--

INSERT INTO `tereni` (`id`, `naziv`, `lokacija`, `vrsta_podloge`, `kapacitet`, `id_kluba`, `zauzet`) VALUES
(10, 'Borac', 'Čačak', 'Šljaka', 50, 1, b'0'),
(12, 'Sloboda', 'Čačak', 'Beton', 10, 1, b'1'),
(58, 'Mladost', 'Atenica', 'Šljaka', 10, 1, b'0'),
(59, 'Polet', 'Ljubić', 'Beton', 10, 1, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tip_opreme`
--

CREATE TABLE `tip_opreme` (
  `id` int(11) NOT NULL,
  `tipovi_opreme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tip_opreme`
--

INSERT INTO `tip_opreme` (`id`, `tipovi_opreme`) VALUES
(1, 'reket'),
(2, 'patike'),
(3, 'žice'),
(4, 'lopte'),
(5, 'čarape'),
(6, 'odeća'),
(7, 'znojnice');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(11) NOT NULL,
  `naziv_uloge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `naziv_uloge`) VALUES
(1, 'igrac'),
(2, 'admin'),
(3, 'klub');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_opreme` (`id_opreme`),
  ADD KEY `id_uloge` (`id_uloge`);

--
-- Indexes for table `mecevi`
--
ALTER TABLE `mecevi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opreme`
--
ALTER TABLE `opreme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tip_opreme` (`id_tip_opreme`);

--
-- Indexes for table `pregled_rezultata`
--
ALTER TABLE `pregled_rezultata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rezervacije` (`id_rezervacije`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_igraca1` (`id_igraca1`),
  ADD KEY `id_igraca2` (`id_igraca2`),
  ADD KEY `id_terena` (`id_terena`),
  ADD KEY `id_meca` (`id_meca`),
  ADD KEY `id_igraca3` (`id_igraca3`),
  ADD KEY `id_igraca4` (`id_igraca4`);

--
-- Indexes for table `sportski_klubovi`
--
ALTER TABLE `sportski_klubovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tereni`
--
ALTER TABLE `tereni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kluba` (`id_kluba`);

--
-- Indexes for table `tip_opreme`
--
ALTER TABLE `tip_opreme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mecevi`
--
ALTER TABLE `mecevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `opreme`
--
ALTER TABLE `opreme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pregled_rezultata`
--
ALTER TABLE `pregled_rezultata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sportski_klubovi`
--
ALTER TABLE `sportski_klubovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tereni`
--
ALTER TABLE `tereni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tip_opreme`
--
ALTER TABLE `tip_opreme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`id_opreme`) REFERENCES `opreme` (`id`),
  ADD CONSTRAINT `korisnici_ibfk_2` FOREIGN KEY (`id_uloge`) REFERENCES `uloge` (`id`);

--
-- Constraints for table `opreme`
--
ALTER TABLE `opreme`
  ADD CONSTRAINT `opreme_ibfk_1` FOREIGN KEY (`id_tip_opreme`) REFERENCES `tip_opreme` (`id`);

--
-- Constraints for table `pregled_rezultata`
--
ALTER TABLE `pregled_rezultata`
  ADD CONSTRAINT `pregled_rezultata_ibfk_8` FOREIGN KEY (`id_rezervacije`) REFERENCES `rezervacije` (`id`);

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `rezervacije_ibfk_1` FOREIGN KEY (`id_igraca1`) REFERENCES `korisnici` (`id`),
  ADD CONSTRAINT `rezervacije_ibfk_2` FOREIGN KEY (`id_igraca2`) REFERENCES `korisnici` (`id`),
  ADD CONSTRAINT `rezervacije_ibfk_4` FOREIGN KEY (`id_terena`) REFERENCES `tereni` (`id`),
  ADD CONSTRAINT `rezervacije_ibfk_5` FOREIGN KEY (`id_meca`) REFERENCES `mecevi` (`id`),
  ADD CONSTRAINT `rezervacije_ibfk_6` FOREIGN KEY (`id_igraca3`) REFERENCES `korisnici` (`id`),
  ADD CONSTRAINT `rezervacije_ibfk_7` FOREIGN KEY (`id_igraca4`) REFERENCES `korisnici` (`id`);

--
-- Constraints for table `tereni`
--
ALTER TABLE `tereni`
  ADD CONSTRAINT `tereni_ibfk_1` FOREIGN KEY (`id_kluba`) REFERENCES `sportski_klubovi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;