-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 01 dec 2017 om 14:19
-- Serverversie: 10.1.26-MariaDB
-- PHP-versie: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vanelles`
--
DROP DATABASE IF EXISTS `vanelles`;
CREATE DATABASE IF NOT EXISTS `vanelles` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vanelles`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Module`
--

CREATE TABLE `Module` (
  `id` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `path` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Module`
--

INSERT INTO `Module` (`id`, `naam`, `path`) VALUES
(1, 'Homepage', 'home.php'),
(2, 'Content', 'content.php');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `activiteit`
--

CREATE TABLE `activiteit` (
  `activiteit_id` int(11) NOT NULL,
  `inschijvingen` int(2) NOT NULL,
  `max` int(2) NOT NULL,
  `datum` date NOT NULL,
  `blog_blog_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `gebruikersnaam` varchar(45) NOT NULL,
  `wachtwoord` char(128) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `hash` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`user_id`, `gebruikersnaam`, `wachtwoord`, `salt`, `hash`) VALUES
(1, 'admin', 'daec7747c22df563deac8027abc9d1f3af3ebbb3', '00c52199eb6b3c4d086f71e082205ebbb11a4943', '60fa7364549a0d19f0d6cfc5c05a5d962dc0483a'),
(4, 'tiespol', '787cd83a8a52a8409819aac6aec19bbcb48aa59b', '1301267338046e0f2c886c29535c8a1a82b0049b', '3d4df2e023289df77a8e8a1e29a192f399727415');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `subtitle` varchar(45) NOT NULL,
  `inhoud` varchar(45) NOT NULL,
  `datum` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `beschrijving` varchar(2000) NOT NULL,
  `kernwoorden` varchar(45) NOT NULL,
  `img_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `inhoud` varchar(2000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inschijvingen`
--

CREATE TABLE `inschijvingen` (
  `inschijving_id` int(11) NOT NULL,
  `activiteit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE `leveranciers` (
  `lev_id` int(11) NOT NULL,
  `naam` varchar(45) DEFAULT NULL,
  `inhoud` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `kernwoorden` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `inhoud` mediumtext,
  `description` varchar(2000) DEFAULT NULL,
  `kernwoorden` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL COMMENT '1 = actief, 0 = inactief',
  `datum` datetime DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(45) DEFAULT NULL,
  `Module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `page`
--

INSERT INTO `page` (`id`, `title`, `subtitle`, `inhoud`, `description`, `kernwoorden`, `active`, `datum`, `image`, `Module_id`, `user_id`) VALUES
(1, 'Home', 'Welkom bij Van Elles', 'blabla', 'balabl', 'bla, bla, dofs', 1, '2017-11-29 00:00:00', 'image', 1, 1),
(2, 'First inserted page', 'een subtitel', '<p>fdsa<strong>fdsaf a&nbsp;<s>&nbsp;fdsaf dsaf</s></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style=\"font-style:italic;\">fdadfsaf</h2>\r\n', 'Dit is een korte beschrijving van de website voor het seo van google', 'kernwoord1, kernwoord2, panelles', 0, '2017-12-01 00:00:00', NULL, 2, 1),
(3, 'Second inserted page', 'een subtitel', '<p>fdsa<strong>fdsaf a&nbsp;<s>&nbsp;fdsaf dsaf</s></strong></p>\r\n\r\n<h1>test</h1>\r\n\r\n<h2 style=\"font-style:italic\">fdadfsaf</h2>\r\n', 'Dit is een korte beschrijving van de website voor het seo van google', 'kernwoord1, kernwoord2, panelles', 1, '2017-12-01 00:00:00', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `inhoud` varchar(45) NOT NULL,
  `images` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `kernwoorden` varchar(45) NOT NULL,
  `lev_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `quote` varchar(200) NOT NULL,
  `rating` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `role`
--

CREATE TABLE `role` (
  `role` int(11) NOT NULL DEFAULT '2',
  `role_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `role`
--

INSERT INTO `role` (`role`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Gebruiker'),
(3, 'Leverancier');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `insertion` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phonenumber` int(12) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `first_name`, `insertion`, `last_name`, `phonenumber`, `city`, `address`, `zipcode`, `role`) VALUES
(1, 'nick@twesq.com', 'Nick', '', 'Simons', 655194576, 'Rijssen', 'Entoshof 23', '7562 VV', 1),
(4, 'test@email2.nl', 'Ties', '', 'Pol', 699382393, 'Rijssen', 'Entoshof 23', '7462 VV', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Module`
--
ALTER TABLE `Module`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `activiteit`
--
ALTER TABLE `activiteit`
  ADD PRIMARY KEY (`activiteit_id`),
  ADD KEY `fk_activiteit_blog1_idx` (`blog_blog_id`);

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`),
  ADD KEY `fk_admin_user1_idx` (`user_id`);

--
-- Indexen voor tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `fk_blog_admin1_idx` (`user_id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `fk_contact_user1_idx` (`user_id`);

--
-- Indexen voor tabel `inschijvingen`
--
ALTER TABLE `inschijvingen`
  ADD PRIMARY KEY (`inschijving_id`),
  ADD KEY `fk_inschijvingen_activiteit1_idx` (`activiteit_id`),
  ADD KEY `fk_inschijvingen_user1_idx` (`user_id`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`lev_id`);

--
-- Indexen voor tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_page_Module1_idx` (`Module_id`),
  ADD KEY `fk_page_Module2` (`user_id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_leveranciers1_idx` (`lev_id`);

--
-- Indexen voor tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review_user1_idx` (`user_id`);

--
-- Indexen voor tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_role_idx` (`role`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Module`
--
ALTER TABLE `Module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `activiteit`
--
ALTER TABLE `activiteit`
  MODIFY `activiteit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `inschijvingen`
--
ALTER TABLE `inschijvingen`
  MODIFY `inschijving_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `activiteit`
--
ALTER TABLE `activiteit`
  ADD CONSTRAINT `fk_activiteit_blog1` FOREIGN KEY (`blog_blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `fk_blog_admin1` FOREIGN KEY (`user_id`) REFERENCES `admin` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `inschijvingen`
--
ALTER TABLE `inschijvingen`
  ADD CONSTRAINT `fk_inschijvingen_activiteit1` FOREIGN KEY (`activiteit_id`) REFERENCES `activiteit` (`activiteit_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inschijvingen_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_page_Module1` FOREIGN KEY (`Module_id`) REFERENCES `Module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_page_Module2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_leveranciers1` FOREIGN KEY (`lev_id`) REFERENCES `leveranciers` (`lev_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role`) REFERENCES `role` (`role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
