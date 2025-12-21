-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2025 at 05:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idcategorie` int(11) NOT NULL,
  `nomcategorie` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idcategorie`, `nomcategorie`) VALUES
(15, 'Biere'),
(16, 'Boissons Gazeuses'),
(19, 'Alcool');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `idcommande` int(11) NOT NULL,
  `nomproduit` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double(12,2) NOT NULL,
  `total` double(12,2) NOT NULL,
  `taxe` double(7,2) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`idcommande`, `nomproduit`, `quantite`, `prix`, `total`, `taxe`, `user`, `date`) VALUES
(14, 'Prestige', 5, 200.00, 1000.00, 0.00, 'John', '2025-12-18 01:13:33'),
(15, 'Prestige', 5, 200.00, 1000.00, 0.00, 'John', '2025-12-18 01:13:55'),
(16, 'Heineken', 3, 400.00, 1200.00, 0.00, 'John', '2025-12-18 01:14:09'),
(17, 'Coca-cola', 3, 125.00, 375.00, 0.00, 'John', '2025-12-18 01:14:21'),
(18, 'Fanta', 2, 100.00, 200.00, 0.00, 'administrateur', '2025-12-18 02:13:53'),
(19, 'Pepsi', 5, 100.00, 500.00, 0.00, 'administrateur', '2025-12-18 02:14:19'),
(20, 'Prestige', 1, 200.00, 200.00, 0.00, 'John', '2025-12-20 02:52:42'),
(21, 'Prestige', 1, 200.00, 200.00, 0.00, 'John', '2025-12-20 02:52:49'),
(22, 'Prestige', 1, 200.00, 200.00, 0.00, 'John', '2025-12-20 03:00:43'),
(23, 'Prestige', 4, 200.00, 800.00, 0.00, 'John', '2025-12-20 03:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `idproduit` int(11) NOT NULL,
  `nomproduit` varchar(50) NOT NULL,
  `nomcategorie` varchar(50) NOT NULL,
  `prixproduit` double(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`idproduit`, `nomproduit`, `nomcategorie`, `prixproduit`) VALUES
(66, 'Prestige', 'Biere', 200.00),
(67, 'Ewo', 'Biere', 250.00),
(68, 'Heineken', 'Biere', 400.00),
(69, 'Guinness', 'Biere', 450.00),
(70, 'Coca-cola', 'Boissons Gazeuses', 125.00),
(71, 'Pepsi', 'Boissons Gazeuses', 100.00),
(72, 'Fanta', 'Boissons Gazeuses', 100.00),
(73, '7Up', 'Boissons Gazeuses', 125.00),
(74, 'Cola Couronne', 'Boissons Gazeuses', 125.00),
(75, 'Toro', 'Boissons Gazeuses', 150.00),
(76, 'Malta H', 'Boissons Gazeuses', 150.00),
(77, 'Barbancourt 3 etoiles', 'Alcool', 1500.00),
(78, 'Barbancourt 4 etoiles', 'Alcool', 2500.00),
(79, 'Barbancourt 5 etoiles', 'Alcool', 4500.00),
(80, 'Bakara', 'Alcool', 1500.00),
(81, 'Presidente', 'Biere', 350.00),
(82, 'Black Label', 'Alcool', 2500.00),
(83, 'Kinam', 'Biere', 150.00),
(84, 'Toro', 'Boissons Gazeuses', 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL,
  `nomcategorie` varchar(50) NOT NULL,
  `nomproduit` varchar(50) NOT NULL,
  `quantite` double NOT NULL,
  `username` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idstock`, `nomcategorie`, `nomproduit`, `quantite`, `username`, `date`) VALUES
(1, 'Biere', 'Prestige', 4863, 'John', '2025-12-06 21:40:31'),
(3, 'Biere', 'Guinness', 3600, 'John', '2025-12-06 21:42:02'),
(5, 'Biere', 'Ewo', 3100, 'administrateur', '2025-12-07 17:08:53'),
(8, 'Biere', 'Heineken', 1490, 'John', '2025-12-07 17:58:22'),
(10, 'Boissons Gazeuses', 'Coca-cola', 4995, 'John', '2025-12-07 18:32:35'),
(11, 'Boissons Gazeuses', 'Fanta', 2493, 'administrateur', '2025-12-07 18:55:20'),
(12, 'Boissons Gazeuses', 'Pepsi', 1995, 'administrateur', '2025-12-07 18:58:33'),
(13, 'Boissons Gazeuses', '7Up', 796, 'administrateur', '2025-12-11 14:37:29'),
(14, 'Boissons Gazeuses', 'Toro', 1500, 'John', '2025-12-19 22:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `statut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `passwd`, `statut`) VALUES
(1, 'administrateur', '$2y$10$oUMvnbLE5XD9ir5tjiPEQuBypKCEJDbW0pc/551c6NWq6zRmng5Ve', 'admin'),
(2, 'John', '$2y$10$RrNrCDLIVjM/QOTmSF7ooeqkZz1IywLY3Hf0zrQt9wCsBZ8TM3jmO', 'system');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idcategorie`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idcommande`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idproduit`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idstock`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idcategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `idcommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `idproduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
