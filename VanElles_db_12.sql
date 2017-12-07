-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 07 dec 2017 om 10:00
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
(1, 'Homepage', 'homepage.php'),
(2, 'Content', 'content.php'),
(3, 'Contact', 'contact.php'),
(4, 'Blog', 'blog_overzicht.php');

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
  `inhoud` mediumtext NOT NULL,
  `datum` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `beschrijving` varchar(2000) NOT NULL,
  `kernwoorden` varchar(45) NOT NULL,
  `img_name` varchar(45) NOT NULL,
  `activiteit` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Nee, 1 = Ja',
  `inschrijving` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Nee, 1 = Ja',
  `inschrijving_aantal` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inhoud` varchar(2000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `date`, `inhoud`, `user_id`) VALUES
(1, 'Nick', '2017-12-07 08:49:43', 'Hallo1234', 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inschrijvingen`
--

CREATE TABLE `inschrijvingen` (
  `inschijving_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `pagetitle` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `inhoud` mediumtext,
  `description` varchar(2000) DEFAULT NULL,
  `kernwoorden` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL COMMENT '1 = actief, 0 = inactief',
  `datum` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(45) DEFAULT NULL,
  `Module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `page_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `page`
--

INSERT INTO `page` (`id`, `pagetitle`, `title`, `subtitle`, `inhoud`, `description`, `kernwoorden`, `active`, `datum`, `image`, `Module_id`, `user_id`, `url`, `page_order`) VALUES
(1, 'Home', 'Over de winkel', 'En leuk-ER conceptstore', '<p>Vind jij het ook leuk om naast je webshop een fysiek verkooppunt te hebben, maar is een pand huren voor jou te duur? Ontwerp, maak en cre&euml;er jij de allerleukste dingen, maar heb je net niet dat stukje ondernemerschap in je om het aan de man te brengen?</p>\r\n\r\n<p>Word jij ook vrolijk van dat wat je maakt en wil je eigenlijk wel graag dat het in de winkel ligt?<br />\r\nOf ben jij die leverancier die nog een gaaf verkooppunt zoekt in het Oosten van het land?<br />\r\nDan zijn wij op zoek naar jou! Voor informatie kun je ons een berichtje sturen op hallo@leuk-ER.nl, verzeker je van een plekje in de winkel op een mooie locatie in het centrum van Rijssen en binnenkort zijn jouw spullen te zien en te koop bij&nbsp;Leuk-ER bij Van Elles.</p>\r\n\r\n<p>Tot snel!</p>\r\n\r\n<p>Hartelijke groet,<br />\r\nElles Ligtenberg en Rianne Wessels-Crans</p>\r\n', 'balabl', 'bla, bla, dofs', 1, '2017-12-07 09:52:14', 'image', 1, 1, 'Home', 1),
(2, 'Blog', 'First inserted page bewerkt', 'een subtitel', '<p>fdsa<strong>fdsaf a&nbsp;<s>&nbsp;fdsaf dsaf</s></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style=\"font-style:italic\">fdadfsaf</h2>\r\n', 'Dit is een korte beschrijving van de website voor het seo van google', 'kernwoord1, kernwoord2, panelles', 1, '2017-12-06 21:17:54', NULL, 4, 1, 'Blog', 2),
(4, 'Contact', 'Contact', 'Stel al uw vragen', '<h1>&nbsp;</h1>\r\n\r\n<p>&nbsp;</p>\r\n', 'fdsafdasfdsa', 'dfasfsaf', 1, '2017-12-07 09:48:17', NULL, 3, 1, 'Contact', 3),
(10, 'test', 'test', NULL, NULL, NULL, NULL, NULL, '2017-12-06 14:13:40', NULL, 1, 4, 'test', 4),
(11, 'test1', 'test', NULL, NULL, NULL, NULL, NULL, '2017-12-06 14:58:39', NULL, 1, 4, 'test', 0),
(12, 'LEUK-ER', 'LEUK-ER', 'Conceptstore', '<p>Al voordat Van Elles in september 2015 haar winkel opende was er een enorme drang om een podium geven aan starters. Mensen die hun eigen mooie producten ontwerpen, maken en online verkopen. Hoe mooi zou het zijn om ook deze groep mensen de mogelijkheid te geven hun producten in een fysieke winkel te verkopen? En Elles weet als geen ander dat de kosten hoog zijn en de risico&rsquo;s groot. Hoe mooi zou het zijn om voor deze mensen wat te betekenen?</p>\r\n\r\n<p>Omdat het runnen van een eigen winkel al de nodige uren met zich meebrengt zocht Elles een samenwerking op en die vond ze.</p>\r\n\r\n<p>Samen met Rianne Wessels-Crans start ze daarom vanaf juni Leuk-ER bij Van Elles.</p>\r\n\r\n<p>Bij Van Elles en bij Leuk-ER valt er altijd wat te beleven. Een nieuwe winkel, een nieuwe ervaring. Het gaat in eerste instantie vooral om beleven, een plek waar mooie spullen en mooie mensen samen komen en er net zo van genieten als wij. Een plek waar je alle tijd hebt om je keuzes te maken, voor jezelf of voor een ander. Laat je verrassen en inspireren. En vooral GENIET!</p>\r\n\r\n<p>Wil jij je&nbsp;<a href=\"#\" target=\"_blank\">aanmelden</a>?</p>\r\n\r\n<p>Nieuwsgierig naar de deelnemers?</p>\r\n', 'LEUK-ER is een conceptstore', 'LEUK-ER, Conceptstore, vanelles, van, Elles', 1, '2017-12-07 09:58:41', NULL, 1, 1, 'LEUK-ER', 0);

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
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Niet geaccepteerd, 1 = geaccepteerd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `review`
--

INSERT INTO `review` (`review_id`, `quote`, `rating`, `user_id`, `datum`, `active`) VALUES
(1, 'hdajslkfa', 5, 5, '2017-12-06 09:16:54', 0),
(2, 'Top website!', 5, 7, '2017-12-06 15:32:55', 1);

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
  `birthday` datetime DEFAULT NULL,
  `phonenumber` int(12) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  `newsletter` int(1) NOT NULL DEFAULT '0' COMMENT '0=nee, 1=ja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `first_name`, `insertion`, `last_name`, `birthday`, `phonenumber`, `city`, `address`, `zipcode`, `role`, `newsletter`) VALUES
(1, 'nick@twesq.com', 'Nick', '', 'Simons', NULL, 655194576, 'Rijssen', 'Entoshof 23', '7562 VV', 1, 0),
(4, 'test@email2.nl', 'Ties', '', 'Pol', NULL, 699382393, 'Rijssen', 'Entoshof 23', '7462 VV', 1, 0),
(5, 'nick.simons@live.nl', 'Nick', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0),
(7, 'nick@live.nl', 'Nick', NULL, NULL, NULL, 8473209, NULL, NULL, NULL, 2, 0);

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
-- Indexen voor tabel `inschrijvingen`
--
ALTER TABLE `inschrijvingen`
  ADD PRIMARY KEY (`inschijving_id`),
  ADD KEY `fk_inschijvingen_activiteit1_idx` (`blog_id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `inschrijvingen`
--
ALTER TABLE `inschrijvingen`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
-- Beperkingen voor tabel `inschrijvingen`
--
ALTER TABLE `inschrijvingen`
  ADD CONSTRAINT `fk_inschijvingen_blog1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
