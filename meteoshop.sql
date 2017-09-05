-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Sep 2017 la 13:19
-- Versiune server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meteoshop`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `clienti`
--

CREATE TABLE `clienti` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` text COLLATE utf8_unicode_ci NOT NULL,
  `creat` datetime NOT NULL,
  `modificat` datetime NOT NULL,
  `statut` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `clienti`
--

INSERT INTO `clienti` (`id`, `nume`, `email`, `telefon`, `adresa`, `creat`, `modificat`, `statut`) VALUES
(1, 'Butiu Catalin', 'abcdefghij@gmail.com', '12345678910', 'Targu-Mures', '2017-08-30 00:00:00', '2017-08-30 00:00:00', '1');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `comenzi`
--

CREATE TABLE `comenzi` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `pret_total` float(10,2) NOT NULL,
  `creat` datetime NOT NULL,
  `modificat` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `comenzi`
--

INSERT INTO `comenzi` (`id`, `id_client`, `pret_total`, `creat`, `modificat`, `status`) VALUES
(31, 1, 449.50, '2017-08-31 13:16:17', '2017-08-31 13:16:17', '1'),
(32, 1, 45.00, '2017-08-31 13:43:55', '2017-08-31 13:43:55', '1'),
(40, 1, 182.40, '2017-09-05 11:27:44', '2017-09-05 11:27:44', '1'),
(53, 1, 74.75, '2017-09-05 13:03:03', '2017-09-05 13:03:03', '1');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `produse`
--

CREATE TABLE `produse` (
  `id` int(11) NOT NULL,
  `nume` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descriere` text COLLATE utf8_unicode_ci NOT NULL,
  `imagine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pret` float(10,2) NOT NULL,
  `cantitate` int(7) NOT NULL,
  `creat` datetime NOT NULL,
  `modificat` datetime NOT NULL,
  `statut` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `produse`
--

INSERT INTO `produse` (`id`, `nume`, `descriere`, `imagine`, `pret`, `cantitate`, `creat`, `modificat`, `statut`) VALUES
(1, 'Termometru', 'termometru de buzunar', 'WT.gif', 18.99, 11, '2017-08-27 00:00:00', '0000-00-00 00:00:00', '1'),
(2, 'Anemometru', 'anemometru manual', 'ANE.gif', 45.00, 4, '2017-08-27 00:00:00', '0000-00-00 00:00:00', '1'),
(3, 'Higrometru', 'higrometru digital', 'HYG.gif', 74.75, 15, '2017-08-28 00:00:00', '0000-00-00 00:00:00', '1'),
(4, 'Pluviometru', 'pluviometru manual', 'RAIN.jpg', 32.90, 15, '2017-08-28 00:00:00', '0000-00-00 00:00:00', '1'),
(5, 'Statie meteo', 'statie meteo digitala automata', 'STATION.gif', 100.00, 8, '2017-08-28 00:00:00', '0000-00-00 00:00:00', '1'),
(6, 'Doppler Radar', 'radar Doppler meteorologic', 'RADAR.jpg', 1000000.00, 0, '2017-08-28 00:00:00', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `produse_comandate`
--

CREATE TABLE `produse_comandate` (
  `id` int(11) NOT NULL,
  `id_comanda` int(11) NOT NULL,
  `id_produs` int(11) NOT NULL,
  `cantitate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `produse_comandate`
--

INSERT INTO `produse_comandate` (`id`, `id_comanda`, `id_produs`, `cantitate`) VALUES
(70, 31, 5, 3),
(71, 31, 3, 2),
(72, 32, 2, 1),
(88, 40, 4, 1),
(89, 40, 3, 2),
(103, 53, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `produse`
--
ALTER TABLE `produse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produse_comandate`
--
ALTER TABLE `produse_comandate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comanda` (`id_comanda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clienti`
--
ALTER TABLE `clienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `produse`
--
ALTER TABLE `produse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produse_comandate`
--
ALTER TABLE `produse_comandate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `comenzi`
--
ALTER TABLE `comenzi`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clienti` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrictii pentru tabele `produse_comandate`
--
ALTER TABLE `produse_comandate`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `comenzi` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
