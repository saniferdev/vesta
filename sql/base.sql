-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 sep. 2022 à 12:25
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stock_sanifer`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `site` varchar(50) NOT NULL,
  `rayon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `username`, `password`, `site`, `rayon`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'TALYS', 'administrateur'),
(2, 's1.outillage', '5587e2b919ff5d2ea68e056743703b3c', 'S1', 'outillage'),
(3, 's2.outillage', '99f1a10542c683923bd96f746d595db2', 'S2', 'outillage'),
(4, 's3.outillage', 'b6203915e54ee3b9ac5a5f546a3b1db5', 'S3', 'outillage'),
(5, 's4.outillage', 'bc93151ba18f42503c42115a6286dbf4', 'S4', 'outillage'),
(6, 's1.quincaillerie', '567a8d93b822d1d64eb0abbba929cdd4', 'S1', 'quincaillerie'),
(7, 's2.quincaillerie', '68c7cc2b6cbeb4517af62e86b786defb', 'S2', 'quincaillerie'),
(8, 's3.quincaillerie', '36de8d58506d0fbaf278d986aeea9dec', 'S3', 'quincaillerie'),
(9, 's4.quincaillerie', '3cbcc085c042d981d5e0e880b5920c83', 'S4', 'quincaillerie'),
(10, 's1.electricite', 'f715421633d60e556f1a1e700defab72', 'S1', 'electricite'),
(11, 's2.electricite', 'c298fc9fe02ce4f7e2685dcb4016637c', 'S2', 'electricite'),
(12, 's3.electricite', '43fdd1cb3db646bd835c2d6bcbc132f5', 'S3', 'electricite'),
(13, 's4.electricite', 'c71ea2285ab28442793e6ccb7c2bf459', 'S4', 'electricite'),
(14, 's1.luminaire', '1085cfa672595f37a6af0586b73475d9', 'S1', 'luminaire'),
(15, 's2.luminaire', '6523e9248211e427c2de6453caf0ac9b', 'S2', 'luminaire'),
(16, 's3.luminaire', 'cda562b2bd26feff25b55e871f1d7416', 'S3', 'luminaire'),
(17, 's4.luminaire', '36b9a512a649a4c4ffaa8b3a15c0ba44', 'S4', 'luminaire'),
(18, 's1.plomberie', 'b4f64ee83c7404ffe6608b3799a77c66', 'S1', 'plomberie'),
(19, 's2.plomberie', '3e49e093f41274fd2fb5d5919a1d0e2d', 'S2', 'plomberie'),
(20, 's3.plomberie', 'b0ec0b248a110cd0888455253459bec8', 'S3', 'plomberie'),
(21, 's4.plomberie', '7426743aa30854522fbaf799410ec6e5', 'S4', 'plomberie'),
(22, 's1.sanitaire', '0c03a9c8fab365438a51f9342fca9dcf', 'S1', 'sanitaire'),
(23, 's2.sanitaire', '1a217c1fdfd490ebe88ee79067a5b24e', 'S2', 'sanitaire'),
(24, 's3.sanitaire', 'ca3220f9a3652a35e1e1ef180f4a6952', 'S3', 'sanitaire'),
(25, 's4.sanitaire', 'f734489dc6c43fc629c0075c0f311227', 'S4', 'sanitaire'),
(26, 's1.cuisine_salle_de_bain', '3123444810da2e7c5470c8cc0f71c289', 'S1', 'cuisine_salle_de_bain'),
(27, 's2.cuisine_salle_de_bain', 'fe499ad53ddd0a767bf95cc19f9474ea', 'S2', 'cuisine_salle_de_bain'),
(28, 's3.cuisine_salle_de_bain', '022fae713cae8a03387bcb9b5e5bf018', 'S3', 'cuisine_salle_de_bain'),
(29, 's4.cuisine_salle_de_bain', 'add3642c21ad08bf3d545df9886507d9', 'S4', 'cuisine_salle_de_bain'),
(30, 's1.peinture', '836d8658969d96bb4f52573a189fd3e3', 'S1', 'peinture'),
(31, 's2.peinture', '09964e438c8124d8a4aed6b56883d216', 'S2', 'peinture'),
(32, 's3.peinture', '91e823c749ce2d66a7324efc149425e0', 'S3', 'peinture'),
(33, 's4.peinture', '29e13d708b3108c47f4a09ab9d95c9b7', 'S4', 'peinture'),
(34, 's1.sols', '674d2ec94c970e340ffeafab2ed6993b', 'S1', 'sols'),
(35, 's2.sols', 'a39d29aa4d6f382265975417a84d458a', 'S2', 'sols'),
(36, 's3.sols', '5d11674a3afe0e693809762f811bd6ca', 'S3', 'sols'),
(37, 's4.sols', '8f80e5677e38c98db445568ffd596d46', 'S4', 'sols'),
(38, 's1.jardin_piscine', '26f4274777a0661365af290eb6531757', 'S1', 'jardin_piscine'),
(39, 's2.jardin_piscine', 'bb62dd20831f04bdd90d130f36912741', 'S2', 'jardin_piscine'),
(40, 's3.jardin_piscine', '36e1e9c8c0a4367b0b324d6db00eb44e', 'S3', 'jardin_piscine'),
(41, 's4.jardin_piscine', 'cb48b88e2359988e5bcfa38923087077', 'S4', 'jardin_piscine'),
(42, 's1.materiaux', '1ca1d29ecd13be356432e9de203091c8', 'S1', 'materiaux'),
(43, 's2.materiaux', 'f8d0d21e855b8421b44bb3d7088d8f52', 'S2', 'materiaux'),
(44, 's3.materiaux', '6aab8b29c6b572ede4534a785f2c77b7', 'S3', 'materiaux'),
(45, 's4.materiaux', '8f969c06f235d5456b542548f5a99a10', 'S4', 'materiaux'),
(46, 's1.bois', '752b71ab7008cd2cacfd23316109fd9f', 'S1', 'bois'),
(47, 's2.bois', '8fcefd1c0280b208a732185219654f99', 'S2', 'bois'),
(48, 's3.bois', '48ec01c96c2af3749a1223f245027f11', 'S3', 'bois'),
(49, 's4.bois', '6bc3903a317c4ee3bb3b8b1207a3c2ed', 'S4', 'bois'),
(50, 's1.decoration', '162dd059f2f0a8da305d3f26a2cc4258', 'S1', 'decoration'),
(51, 's2.decoration', '1e2a53af633db7dbf6844d4ebf0a4775', 'S2', 'decoration'),
(52, 's3.decoration', '47693e0a310f34e5c4e8c56efa29bba3', 'S3', 'decoration'),
(53, 's4.decoration', '82d1f3663a47f87ac0119e9968e6b43f', 'S4', 'decoration'),
(54, 's1.solaire', 'baba2e91677c55784859d7d81d7b8a96', 'S1', 'solaire'),
(55, 's2.solaire', 'd94c487598088ffd58b1799256463f24', 'S2', 'solaire'),
(56, 's3.solaire', '0bb32c54f3de3aec3169ff14ff3a8f94', 'S3', 'solaire'),
(57, 's4.solaire', '80a279bd045a855d3c7ad4045fc72dbc', 'S4', 'solaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
