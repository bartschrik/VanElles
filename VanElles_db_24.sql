-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 15 dec 2017 om 11:17
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
(4, 'Blog', 'blog.php'),
(5, 'Leverancies', 'leveranciers.php'),
(6, 'Producten', 'producten.php');

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
(1, 'admin', 'e47c2d19323f9fcd5497283c4122385b038deea4', '2d4d2641ab872aed5ffd612d68443462d400703a', '5ef7529e527c391935d2810992e8b54fd7e074da'),
(4, 'admin2', '061b372a731c418b1d77aac63ea089860a02a0cb', 'dd3d95218baf9b083ebb07ec2c7bf9b19df55f54', '2c05bad453d0bd665d56bb00e28717a8d5e69b66');

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
  `korte_inhoud` varchar(250) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `beschrijving` varchar(2000) NOT NULL,
  `kernwoorden` varchar(150) NOT NULL,
  `img_name` varchar(45) NOT NULL,
  `activiteit` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Nee, 1 = Ja',
  `inschrijving` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Nee, 1 = Ja',
  `inschrijving_aantal` int(3) DEFAULT NULL,
  `verwijderd` int(1) NOT NULL DEFAULT '0' COMMENT '0=nee,1=ja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `blog`
--

INSERT INTO `blog` (`blog_id`, `user_id`, `title`, `subtitle`, `inhoud`, `korte_inhoud`, `datum`, `beschrijving`, `kernwoorden`, `img_name`, `activiteit`, `inschrijving`, `inschrijving_aantal`, `verwijderd`) VALUES
(1, 1, 'WORKSHOP ITALIAANSE KERST AMUSES MAKEN', 'MET TUTTI IL BENE', '<p>Heerlijke, bijzondere, Italiaanse kerst hapjes deze keer&hellip;.</p>\r\n\r\n<p>Na het grote succes van 25 nov organiseren we nog 1 workshop voor de kerst&nbsp;&ldquo;Italiaanse amuses en/of voorgerechten maken&rdquo;.&nbsp;Het begint om&nbsp;19.00 uur en het duurt ongeveer&nbsp;1,5 uur.&nbsp;En uiteraard neem je de hapjes lekker mee naar huis.&nbsp;Ook zin in een gezellige avond geef je dan snel op en stuur een mailtje aan:&nbsp;hallo@leuk-ER.nl&nbsp;Verzeker je van een plekje want VOL = VOL (Er kunnen 8 deelnemers per workshop meedoen).</p>\r\n\r\n<p>Wil je voor de volgende workshop een uitnodiging krijgen? Schrijf je dan in voor de&nbsp;<a href=\"https://www.vanelles-webshop.nl/newsletter/\" target=\"_blank\">nieuwsbrief</a>&nbsp;.</p>\r\n', '', NULL, 'Na het grote succes van 25 nov organiseren we nog 1 workshop voor de kerstÂ â€œItaliaanse amuses en/of voorgerechten makenâ€.Â Het begint omÂ 19.00 uur en het duurt ongeveerÂ 1,5 uur.', 'Italiaanse, hapjes', 'f3642a9437540e93ba5905cc3ed6e6564d4133cb.png', 1, 1, NULL, 0);

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
(1, 'Nick', '2017-12-07 08:49:43', 'Hallo1234', 7),
(2, 'sfafdsa', '2017-12-07 12:25:09', 'jkslfjalkdfjas', 17),
(3, 'bart ', '2017-12-07 14:27:38', 'test', 20);

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
  `inhoud` mediumtext,
  `korte_inhoud` varchar(250) NOT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `kernwoorden` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`lev_id`, `naam`, `inhoud`, `korte_inhoud`, `logo`, `description`, `kernwoorden`) VALUES
(3, 'HKLIVING', '<p>is een Nederlands merk, opgericht in 2009. De Nederlandse kijk op ontwerpen vertaalt zich in de puurheid en originaliteit van de items die ze ontwikkelen.</p>\r\n\r\n<p>De belangrijkste focus dit jaar was het upgraden van de collectie in trendy kleuren en aan de collectie een eigentijdse draai te geven. Totaal vernieuwend in deze collectie zijn bijvoorbeeld de metalen meubelen met een nieuw verfrissend ontwerp en de nieuwe broodplank collectie.</p>\r\n', 'De Nederlandse kijk op ontwerpen vertaalt zich in de puurheid en originaliteit van de items die ze ontwikkelen. De belangrijkste focus dit jaar was het upgraden van de collectie in trendy kleuren en aan de ', '74336a4b268b7dee0b5d9d33ab5e48298e8ddcd7.jpg', 'HKLIVING is een Nederlands merk, opgericht in 2009. De belangrijkste focus dit jaar was het upgraden van de collectie in trendy kleuren en aan de collectie een eigentijdse draai te geven.', 'hkliving,living'),
(4, 'HOUSE DOCTOR', '<p>In 1999 begonnen de zusters Rikke Juhl Jensen, Gitte Juhl Capel en hun broer Klaus Juhl Pedersen een succesvol handenarbeidbedrijf. Ze ontwikkelden al snel allerlei idee&euml;n voor nieuwe producten.</p>\r\n\r\n<p>Inmiddels verschijnt er per jaar twee keer een collectie: in january &lsquo;Everyday&rsquo; en in augustus &lsquo;Moments&rsquo;. Everyday bestaat uit nieuwe producten en toppers uit eerdere collecties. Moments bestaat ook uit nieuwe producten, maar dan aangevuld met seizoensartikelen.</p>\r\n\r\n<p>House Doctor levert onder meer meubelen, kleinmeubilair, woonaccessoires, juwelen, keuken- en eetgerei, kleding en textiel.</p>\r\n', 'House Doctor in 1999 begonnen de zusters Rikke Juhl Jensen, Gitte Juhl Capel en hun broer Klaus Juhl Pedersen een succesvol handenarbeidbedrijf. Ze ontwikkelden al snel allerlei ideeÃ«n voor nieuwe producten.', 'aa845cb8033eab9babfc9092b505ab614911ff15.jpg', 'House Doctor in 1999 begonnen de zusters Rikke Juhl Jensen, Gitte Juhl Capel en hun broer Klaus Juhl Pedersen een succesvol handenarbeidbedrijf. Ze ontwikkelden al snel allerlei ideeÃ«n voor nieuwe producten.', 'House, Doctor, House doctor'),
(5, 'A LITTLE LOVELY COMPANY', '<p>In de winter van 2013 starten ontwerpsters en oprichters: Judith de Ruijter en Nikki Hateley hun nieuwe gezamenlijke Little Lovely avontuur: vanuit een gedeelde passie voor het transformeren van gewone huis-en feestdecoraties tot unieke en persoonlijke sfeerbrengers. Met oog voor mooi design, kleine details en passende kleuren maken decoraties en accessoires een kamer of feest niet alleen persoonlijk en uniek, maar ben je in staat om een bijzondere sfeer en: &ldquo;Lovelyness&rdquo; aan te brengen.</p>\r\n\r\n<p>Deze filosofie leidde tot een concept: een combinatie van unieke en sfeervolle woon- en feestdecoraties: a Little Lovely Company was geboren!</p>\r\n\r\n<p>De Little Lovely collectie omvat o.a: vrolijke slingers en unieke gevulde confetti-ballonnen, maar ook uniek ontworpen letterbanners, posters en diverse designdecoraties voor de seizoenen, kinder- en woonkamers en mooie hoogtepunten in een ieders leven&hellip;</p>\r\n\r\n<p>Alles onder het motto: lets start:<strong>&nbsp;Making Life Lovely!</strong></p>\r\n', 'A Little Lovely Company in de winter van 2013 starten ontwerpsters en oprichters: Judith de Ruijter en Nikki Hateley hun nieuwe gezamenlijke Little Lovely avontuur: vanuit een gedeelde passie voor het transformeren van gewone huis-en feestdecoraties ', '345115b4057a8a622970f0b57e1991e5e0ab5dd7.jpg', 'In de winter van 2013 starten ontwerpsters en oprichters: Judith de Ruijter en Nikki Hateley hun nieuwe gezamenlijke Little Lovely avontuur: vanuit een gedeelde passie voor het transformeren van gewone huis-en feestdecoraties tot unieke en persoonlijke sfeerbrengers.', 'Little lovely Company, Little, lovely, company');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `file_dimensions` varchar(100) NOT NULL,
  `file_url` varchar(1000) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `alt_text` tinytext,
  `upload_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `upload_by` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`, `file_size`, `file_dimensions`, `file_url`, `title`, `alt_text`, `upload_date`, `upload_by`) VALUES
(1, '1004775_673373039355572_884445800_n1.jpg', 'image/jpeg', '24514', '470x206', '632d8a11f65840d31edddacd5ab9f1d6f58ba7fd.jpg', '1004775_673373039355572_884445800_n1', NULL, '2017-12-14 13:31:12', 1),
(2, 'HKliving-BLUERGB1.jpg', 'image/jpeg', '34477', '800x800', '897c35ac15089c59bb79c40a05371e73147114ba.jpg', 'HKliving-BLUERGB1', NULL, '2017-12-14 13:31:12', 1),
(3, 'vt01-BK-Sukha-1.png', 'image/png', '1298796', '1293x802', '29482c42209d331b31cfc49bf71f727c4e201279.png', 'vt01-BK-Sukha-1', NULL, '2017-12-14 13:42:37', 1);

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
  `kernwoorden` varchar(150) DEFAULT NULL,
  `active` int(1) DEFAULT '1' COMMENT '1 = actief, 0 = inactief',
  `datum` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(45) DEFAULT NULL,
  `Module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `page_order` int(11) NOT NULL DEFAULT '99'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `page`
--

INSERT INTO `page` (`id`, `pagetitle`, `title`, `subtitle`, `inhoud`, `description`, `kernwoorden`, `active`, `datum`, `image`, `Module_id`, `user_id`, `url`, `page_order`) VALUES
(1, 'Home', 'Over de winkel', 'En leuk-ER conceptstore', '<p>Vind jij het ook leuk om naast je webshop een fysiek verkooppunt te hebben, maar is een pand huren voor jou te duur? Ontwerp, maak en cre&euml;er jij de allerleukste dingen, maar heb je net niet dat stukje ondernemerschap in je om het aan de man te brengen?</p>\r\n\r\n<p>Word jij ook vrolijk van dat wat je maakt en wil je eigenlijk wel graag dat het in de winkel ligt?<br />\r\nOf ben jij die leverancier die nog een gaaf verkooppunt zoekt in het Oosten van het land?<br />\r\nDan zijn wij op zoek naar jou! Voor informatie kun je ons een berichtje sturen op hallo@leuk-ER.nl, verzeker je van een plekje in de winkel op een mooie locatie in het centrum van Rijssen en binnenkort zijn jouw spullen te zien en te koop bij&nbsp;Leuk-ER bij Van Elles.</p>\r\n\r\n<p>Tot snel!</p>\r\n\r\n<p>Hartelijke groet,<br />\r\nElles Ligtenberg en Rianne Wessels-Crans</p>\r\n', 'balabl', 'bla, bla, dofs', 1, '2017-12-13 19:16:49', 'image', 1, 1, 'Home', 1),
(2, 'Blog', 'First inserted page bewerkt', 'een subtitel', '<p>fdsa<strong>fdsaf a&nbsp;<s>&nbsp;fdsaf dsaf</s></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style=\"font-style:italic\">fdadfsaf</h2>\r\n', 'Dit is een korte beschrijving van de website voor het seo van google', 'kernwoord1, kernwoord2, panelles', 1, '2017-12-12 13:56:21', NULL, 4, 1, 'Blog', 3),
(4, 'Contact', 'Contact', 'Stel al uw vragen', '<h1>&nbsp;</h1>\r\n\r\n<p>&nbsp;</p>\r\n', 'fdsafdasfdsa', 'dfasfsaf', 1, '2017-12-12 13:56:13', NULL, 3, 1, 'Contact', 100),
(12, 'LEUK-ER', 'LEUK-ER', 'Conceptstore', '<p>Al voordat Van Elles in september 2015 haar winkel opende was er een enorme drang om een podium geven aan starters. Mensen die hun eigen mooie producten ontwerpen, maken en online verkopen. Hoe mooi zou het zijn om ook deze groep mensen de mogelijkheid te geven hun producten in een fysieke winkel te verkopen? En Elles weet als geen ander dat de kosten hoog zijn en de risico&rsquo;s groot. Hoe mooi zou het zijn om voor deze mensen wat te betekenen?</p>\r\n\r\n<p>Omdat het runnen van een eigen winkel al de nodige uren met zich meebrengt zocht Elles een samenwerking op en die vond ze.</p>\r\n\r\n<p>Samen met Rianne Wessels-Crans start ze daarom vanaf juni Leuk-ER bij Van Elles.</p>\r\n\r\n<p>Bij Van Elles en bij Leuk-ER valt er altijd wat te beleven. Een nieuwe winkel, een nieuwe ervaring. Het gaat in eerste instantie vooral om beleven, een plek waar mooie spullen en mooie mensen samen komen en er net zo van genieten als wij. Een plek waar je alle tijd hebt om je keuzes te maken, voor jezelf of voor een ander. Laat je verrassen en inspireren. En vooral GENIET!</p>\r\n\r\n<p>Wil jij je&nbsp;<a href=\"#\" target=\"_blank\">aanmelden</a>?</p>\r\n\r\n<p>Nieuwsgierig naar de deelnemers?</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'LEUK-ER is een conceptstore', 'LEUK-ER, Conceptstore, vanelles, van, Elles', 1, '2017-12-12 13:56:25', NULL, 2, 1, 'LEUK-ER', 2),
(13, 'Leveranciers', 'Leveranciers', '', '', 'Leverancier', 'Leverancier', 1, '2017-12-14 14:38:42', NULL, 5, 1, 'Leveranciers', 99),
(14, 'Producten', 'Producten', '', '', 'Producten', 'Producten', 1, '2017-12-08 12:36:10', NULL, 6, 1, 'Producten', 99);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `inhoud` mediumtext NOT NULL,
  `korte_inhoud` varchar(250) NOT NULL,
  `images` varchar(2000) NOT NULL,
  `webshop_url` varchar(1000) DEFAULT NULL,
  `description` varchar(150) NOT NULL,
  `kernwoorden` varchar(150) NOT NULL,
  `lev_id` int(11) NOT NULL,
  `uitgelicht` int(1) NOT NULL DEFAULT '0' COMMENT '0=nee, 1=ja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`product_id`, `naam`, `inhoud`, `korte_inhoud`, `images`, `webshop_url`, `description`, `kernwoorden`, `lev_id`, `uitgelicht`) VALUES
(1, 'A Little Lovely Company Spaarpot regenboog', '<p>Deze superlieve regenboog-spaarpot is een must voor elke kleine meisjeskamer.&nbsp;<br />\r\nHet co&ouml;rdineert prachtig met onze kleine mooie lichten en inspireert kleintjes om hun centen te sparen.&nbsp;<br />\r\n<br />\r\nDe spaarpot kan worden geopend via de draai- en klikklap eronder.</p>\r\n\r\n<ul>\r\n	<li>Materiaal: BPA en ftalaatvrij PVC</li>\r\n	<li>Maten: 16.0 x 6.4 x 8.0 cm</li>\r\n</ul>\r\n', 'Deze superlieve regenboog-spaarpot is een must voor elke kleine meisjeskamer.Â \r\nHet coÃ¶rdineert prachtig met onze kleine mooie lichten en inspireert kleintjes om hun centen te sparen.', 'ff77fb0e81f10c3aac5c5f620e6c3c16aa47d453.jpg', 'https://www.vanelles-webshop.nl/a-50518931/a-little-lovely-company/a-little-lovely-company-spaarpot-regenboog/', 'Deze superlieve regenboog-spaarpot is een must voor elke kleine meisjeskamer.Â \r\nHet coÃ¶rdineert prachtig met onze kleine mooie lichten en inspireert', 'Little, lovely, Company, regenboog, spaarpot', 5, 1),
(2, 'A Little Lovely Company ledlamp spook', '<p>Dit spooklicht is een must voor elke jongenskamer en natuurlijk voor een coole meidenkamer!&nbsp;Geef de kamer van het kind een cool uiterlijk met deze kleine, mooie geest.&nbsp;Iedereen houdt van deze vriendelijke geest!&nbsp;<br />\r\n<br />\r\nDit milieuvriendelijke lampje is kindveilig en gemaakt van BPA- en loodvrij PVC;&nbsp;en geven een zachte gloed wanneer ingeschakeld.&nbsp;U kunt ervoor kiezen om het licht aan, uit of aan te zetten.&nbsp;Wanneer u de timer inschakelt, wordt het lampje na 15 minuten automatisch uitgeschakeld.&nbsp;Dit spaart batterijvermogen en is beter voor het milieu!&nbsp;<br />\r\nWe adviseren u om deze timer te gebruiken, omdat de meegeleverde batterijen ongeveer 20 uur meegaan.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Maten: 10,5 x 13 x 11 cm</li>\r\n	<li>Materiaal: BPA- en loodvrij PVC</li>\r\n	<li>Het lampje werkt met 3 LR44-batterijen (inclusief)</li>\r\n	<li>Timer optie</li>\r\n</ul>\r\n', 'Dit spooklicht is een must voor elke jongenskamer en natuurlijk voor een coole meidenkamer!Â Geef de kamer van het kind een cool uiterlijk met deze kleine, mooie geest.Â Iedereen houdt van deze vriendelijke geest!Â ', '91d1a685710682f341b3b911b02d46411a00d49b.jpg', 'https://www.vanelles-webshop.nl/a-50518802/a-little-lovely-company/a-little-lovely-company-ledlamp-spook/', 'Dit spooklicht is een must voor elke jongenskamer en natuurlijk voor een coole meidenkamer!Â Geef de kamer van het kind een cool uiterlijk met deze kl', 'spooklicht, jongenskamer, meidenkamer', 5, 1),
(3, 'House Doctor Kandelaar drop goud', '<p>Deze gave goudkleurige koperen kandelaar van House Doctor zal extra shinen op uw feestelijk gedekte tafel of in uw interieur.</p>\r\n\r\n<p>Door zijn moderne en stylvolle uitstraling is de kandelaar goed te combineren in ieder interieur.</p>\r\n\r\n<p>Ook erg gaaf om deze kandelaar te combineren met andere kandelaars om zo een mooi sfeervol geheel te cre&euml;ren.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Afmeting: 10,5 x 6,5 cm</p>\r\n', 'Deze gave goudkleurige koperen kandelaar van House Doctor zal extra shinen op uw feestelijk gedekte tafel of in uw interieur. Door zijn moderne en stylvolle uitstraling is de kandelaar goed te combineren in ieder interieur.', 'bfc5b8e212bdfef314090ee556ca87f3d9b5f534.jpg', 'https://www.vanelles-webshop.nl/a-50759641/house-doctor/house-doctor-kandelaar-drop-goud/', 'Deze gave goudkleurige koperen kandelaar van House Doctor zal extra shinen op uw feestelijk gedekte tafel of in uw interieur.', 'kandelaar,koperen,House,Doctor', 4, 1),
(4, 'House Doctor Poef Jute', '<p>Deze poef is gemaakt van jute en door de combinatie met donker groen helemaal trendy.</p>\r\n\r\n<p>Een poef is multifunctioneel. Gebruik hem als voetenbankje, bijzettafeltje of als extra zitplek.</p>\r\n\r\n<p>Afmeting: H 35 x D 45 cm</p>\r\n', 'Deze poef is gemaakt van jute en door de combinatie met donker groen helemaal trendy. Een poef is multifunctioneel. Gebruik hem als voetenbankje, bijzettafeltje of als extra zitplek.', '0d2ab21e2f8262404bc3194a8d62558b5af71017.jpg', 'https://www.vanelles-webshop.nl/a-48909279/house-doctor/house-doctor-poef-jute/', 'Deze poef is gemaakt van jute en door de combinatie met donker groen helemaal trendy. Een poef is multifunctioneel. Gebruik hem als voetenbankje, bijz', 'voetenbankje,poef, trendy', 4, 1);

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
(3, 'Super leuke en vernieuwende winkel in Rijssen, met goede klantenservice!', 5, 8, '2017-12-07 10:34:56', 1),
(4, 'Superhippe woonwinkel, je komt ogen te kort!\r\nElke x weer iets origineels!\r\nAanrader voor leuke cadeautjes.', 4, 9, '2017-12-07 10:35:35', 1),
(5, 'Superhippe woonwinkel, je komt ogen te kort!\r\nElke x weer iets origineels!\r\nAanrader voor leuke cadeautjes.', 3, 10, '2017-12-07 10:37:03', 1);

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
  `birthday` date DEFAULT NULL,
  `phonenumber` int(12) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  `newsletter` int(1) NOT NULL DEFAULT '0' COMMENT '0=nee, 1=ja',
  `verwijderd` int(1) NOT NULL DEFAULT '0' COMMENT '0=nee, 1=ja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `first_name`, `insertion`, `last_name`, `birthday`, `phonenumber`, `city`, `address`, `zipcode`, `role`, `newsletter`, `verwijderd`) VALUES
(1, 'nick@twesq.com', 'Admin', '', '', '0000-00-00', 655194576, 'Rijssen', 'Entoshof 23', '7562 VV', 1, 0, 0),
(4, 'test@email.nl', 'Ties', '', 'Poll', '1997-03-23', 699382393, 'Rijssen', 'Entoshof 23', '7462 VV', 1, 0, 0),
(5, 'nick.simons@live.nl', 'Nick', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(7, 'nick@live.nl', 'Nick', NULL, NULL, NULL, 8473209, NULL, NULL, NULL, 2, 0, 0),
(8, 'bart@live.nl', 'Bart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(9, 'erhan@live.nl', 'Erhan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(10, 'michael@gmail.nl', 'Michael', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(11, 'Anja@live.nl', 'Anja', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(12, 'hoi@hoi.nl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1),
(14, 'sofa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(16, 'jklsadfa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(17, 'nfdsjk@kldjf.nl', NULL, NULL, NULL, NULL, 23412324, NULL, NULL, NULL, 2, 0, 1),
(18, 'jkdfsla@jkflds.nljk', 'Ties', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(19, 'jklfdsjlk@LKjflkdjslkfjkl.dfsjkl', 'jkdslaf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(20, 'bart.schrik@hhhh.nl', NULL, NULL, NULL, NULL, 876435, NULL, NULL, NULL, 2, 0, 1),
(21, 'Baer.scgruk@gh.nl', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(22, 'nick.simons@live.nls', 'Nick', '', 'Simons', '0000-00-00', 655194576, 'Rijssen', 'Entoshof 23', '7462 VV', 2, 0, 0),
(23, 'nickjflJ@jklfds.nl', 'Nick', '', 'Simons', '1997-03-23', 2147483647, 'Rijssen', 'Entoshof 23', '7462 VV', 2, 0, 0),
(24, 'nickjflJ@jklfds.nls', 'Nick', '', 'Simons', '1997-03-23', 2147483647, 'Rijssen', 'Entoshof 23', '7462 VV', 2, 0, 0),
(25, 'test@live.nl', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0);

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
-- Indexen voor tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `activiteit`
--
ALTER TABLE `activiteit`
  MODIFY `activiteit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `inschrijvingen`
--
ALTER TABLE `inschrijvingen`
  MODIFY `inschijving_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
