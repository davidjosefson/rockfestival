-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 15, 2014 at 05:23 PM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Rockfestival`
--

-- --------------------------------------------------------

--
-- Table structure for table `Band`
--

CREATE TABLE `Band` (
`BandID` int(11) NOT NULL,
  `Namn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Landskod` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Grundades` smallint(6) DEFAULT NULL,
  `Musikstil` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Trivia` text COLLATE utf8_unicode_ci,
  `Kontaktperson` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Band`
--

INSERT INTO `Band` (`BandID`, `Namn`, `Landskod`, `Grundades`, `Musikstil`, `Trivia`, `Kontaktperson`) VALUES
(1, 'David med fiolen', 'SWE', 2010, 'Folkpunk', 'Jag gillar fiol', 1),
(2, 'Dansa med Felix', 'SWE', 2000, 'Trans-dans', 'dansa dansa DAAAANSA', 3),
(3, 'Trummande torskar', 'NO', 2005, 'March-musik', 'DUM DUM DRRRRRRUM', 2),
(4, 'Ultima Fule', 'FIN', 2000, 'Trans-dans', 'dansa dansa DAAAANSA', 3),
(5, 'Elias den braiga', 'SWE', 2011, 'Ownage', 'Jag gillar smisk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Bandmedlem`
--

CREATE TABLE `Bandmedlem` (
`BandmedlemsID` int(11) NOT NULL,
  `Band` int(11) DEFAULT NULL,
  `Namn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Instrument` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fodelseort` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fodelsear` smallint(6) DEFAULT NULL,
  `MedlemSedan` smallint(6) DEFAULT NULL,
  `Trivia` text COLLATE utf8_unicode_ci,
  `Bild` blob
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Bandmedlem`
--

INSERT INTO `Bandmedlem` (`BandmedlemsID`, `Band`, `Namn`, `Instrument`, `Fodelseort`, `Fodelsear`, `MedlemSedan`, `Trivia`, `Bild`) VALUES
(1, 1, 'Lassie', 'Flöjt', 'Lund', 1968, 1998, 'Gillar fiskar. Stora fiskar.', ''),
(2, 1, 'Bassie', 'Trumpet', 'Holland', 1966, 1991, 'Gillar smör', ''),
(3, 2, 'Felix', 'Trummor', 'Skosulan', 1974, 1992, 'Gillar skor', ''),
(4, 2, 'Flexi', 'Banjo', 'Stockholm', 1961, 1994, 'Gillar inte folk', ''),
(5, 3, 'Elias', 'Sång', 'Lund', 1968, 1998, 'Goodie', ''),
(6, 4, 'Lisa', 'Bas', 'Lund', 1988, 1998, 'Hatar festivaler.', ''),
(7, 5, 'Tina', 'Sång', 'Göteborg', 1945, 1998, 'Har varit på månen', ''),
(8, 3, 'Ronja', 'Sång', 'Borneo', 1958, 1948, 'Kan dansa salsa', ''),
(9, 3, 'Kungen', 'Triangel', 'Holland', 1966, 1991, 'Gillar Triangeln', '');

-- --------------------------------------------------------

--
-- Table structure for table `Festivaldag`
--

CREATE TABLE `Festivaldag` (
  `Dag` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Festivaldag`
--

INSERT INTO `Festivaldag` (`Dag`) VALUES
('Fredag'),
('Lördag'),
('Torsdag');

-- --------------------------------------------------------

--
-- Table structure for table `Funktionar`
--

CREATE TABLE `Funktionar` (
`FunktionarsID` int(11) NOT NULL,
  `Namn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Personnummer` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Gatuadress` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Postnummer` int(5) DEFAULT NULL,
  `Postort` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lon` int(11) DEFAULT NULL,
  `Sakerhetsbehorig` tinyint(1) DEFAULT NULL,
  `Mobilnummer` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Funktionar`
--

INSERT INTO `Funktionar` (`FunktionarsID`, `Namn`, `Personnummer`, `Gatuadress`, `Postnummer`, `Postort`, `Lon`, `Sakerhetsbehorig`, `Mobilnummer`) VALUES
(1, 'Bengt Hansson', '901104', 'Stengatan 23', 21437, 'Malmö', 20000, 1, '0709959943'),
(2, 'Farid Naisan', '871104', 'Klengatan 22', 21437, 'Malmö', 22000, 0, '0469959943'),
(3, 'Bodil Jansson ', '651104', 'Ohlengatan 21', 21437, 'Malmö', 24000, 1, '0708833343'),
(4, 'Jimmie Tråkesson', '681104', 'Bengatan 22', 21437, 'Malmö', 25000, 0, '22222222');

-- --------------------------------------------------------

--
-- Table structure for table `Sakerhetspass`
--

CREATE TABLE `Sakerhetspass` (
  `Scen` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Festivaldag` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Sakerhetstid` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Funktionar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Sakerhetspass`
--

INSERT INTO `Sakerhetspass` (`Scen`, `Festivaldag`, `Sakerhetstid`, `Funktionar`) VALUES
('Stora scenen', 'Fredag', '18.00-22.00', 1),
('Stora scenen', 'Lördag', '18.00-22.00', 1),
('Hawaii', 'Lördag', '22.00-02.00', 1),
('Stora scenen', 'Fredag', '22.00-02.00', 3),
('Flexi', 'Torsdag', '18.00-22.00', 3),
('Stora scenen', 'Lördag', '14.00-18.00', 4),
('Stora scenen', 'Lördag', '22.00-02.00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Sakerhetstid`
--

CREATE TABLE `Sakerhetstid` (
  `Tid` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Sakerhetstid`
--

INSERT INTO `Sakerhetstid` (`Tid`) VALUES
('14.00-18.00'),
('18.00-22.00'),
('22.00-02.00');

-- --------------------------------------------------------

--
-- Table structure for table `Scen`
--

CREATE TABLE `Scen` (
  `Namn` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PublikAntal` int(11) DEFAULT NULL,
  `PlatsBeskrivning` text COLLATE utf8_unicode_ci,
  `Bild` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Scen`
--

INSERT INTO `Scen` (`Namn`, `PublikAntal`, `PlatsBeskrivning`, `Bild`) VALUES
('Flexi', 2, 'I ett hemligt tält', NULL),
('Hawaii', 123, 'Vid åsnan', NULL),
('Lilla scenen', 50, 'Bakom Donken', NULL),
('Stora scenen', 500, 'Framför Donken', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Scentid`
--

CREATE TABLE `Scentid` (
  `Tid` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Scentid`
--

INSERT INTO `Scentid` (`Tid`) VALUES
('14.00-16.00'),
('16.00-18.00'),
('18.00-20.00'),
('20.00-22.00'),
('22.00-02.00');

-- --------------------------------------------------------

--
-- Table structure for table `Spelning`
--

CREATE TABLE `Spelning` (
  `Band` int(11) DEFAULT NULL,
  `Scen` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Festivaldag` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Scentid` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Starttid` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Spelning`
--

INSERT INTO `Spelning` (`Band`, `Scen`, `Festivaldag`, `Scentid`, `Starttid`) VALUES
(1, 'Flexi', 'Fredag', '18.00-20.00', '19:00:00'),
(1, 'Hawaii', 'Lördag', '14.00-16.00', '15:00:00'),
(3, 'Hawaii', 'Lördag', '16.00-18.00', '16:30:00'),
(5, 'Lilla scenen', 'Fredag', '18.00-20.00', '19:00:00'),
(4, 'Lilla scenen', 'Lördag', '18.00-20.00', '18:40:00'),
(2, 'Stora scenen', 'Lördag', '14.00-16.00', '15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Band`
--
ALTER TABLE `Band`
 ADD PRIMARY KEY (`BandID`), ADD KEY `Kontaktperson` (`Kontaktperson`);

--
-- Indexes for table `Bandmedlem`
--
ALTER TABLE `Bandmedlem`
 ADD PRIMARY KEY (`BandmedlemsID`), ADD KEY `Band` (`Band`);

--
-- Indexes for table `Festivaldag`
--
ALTER TABLE `Festivaldag`
 ADD PRIMARY KEY (`Dag`);

--
-- Indexes for table `Funktionar`
--
ALTER TABLE `Funktionar`
 ADD PRIMARY KEY (`FunktionarsID`), ADD UNIQUE KEY `Mobilnummer` (`Mobilnummer`);

--
-- Indexes for table `Sakerhetspass`
--
ALTER TABLE `Sakerhetspass`
 ADD PRIMARY KEY (`Scen`,`Sakerhetstid`,`Festivaldag`), ADD UNIQUE KEY `Funktionar` (`Funktionar`,`Festivaldag`,`Sakerhetstid`), ADD KEY `Festivaldag` (`Festivaldag`), ADD KEY `Sakerhetstid` (`Sakerhetstid`);

--
-- Indexes for table `Sakerhetstid`
--
ALTER TABLE `Sakerhetstid`
 ADD PRIMARY KEY (`Tid`);

--
-- Indexes for table `Scen`
--
ALTER TABLE `Scen`
 ADD PRIMARY KEY (`Namn`);

--
-- Indexes for table `Scentid`
--
ALTER TABLE `Scentid`
 ADD PRIMARY KEY (`Tid`);

--
-- Indexes for table `Spelning`
--
ALTER TABLE `Spelning`
 ADD PRIMARY KEY (`Scen`,`Festivaldag`,`Scentid`), ADD UNIQUE KEY `Band` (`Band`,`Festivaldag`,`Scentid`), ADD KEY `Scentid` (`Scentid`), ADD KEY `Festivaldag` (`Festivaldag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Band`
--
ALTER TABLE `Band`
MODIFY `BandID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Bandmedlem`
--
ALTER TABLE `Bandmedlem`
MODIFY `BandmedlemsID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Funktionar`
--
ALTER TABLE `Funktionar`
MODIFY `FunktionarsID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Band`
--
ALTER TABLE `Band`
ADD CONSTRAINT `band_ibfk_1` FOREIGN KEY (`Kontaktperson`) REFERENCES `Funktionar` (`FunktionarsID`);

--
-- Constraints for table `Bandmedlem`
--
ALTER TABLE `Bandmedlem`
ADD CONSTRAINT `bandmedlem_ibfk_1` FOREIGN KEY (`Band`) REFERENCES `Band` (`BandID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Sakerhetspass`
--
ALTER TABLE `Sakerhetspass`
ADD CONSTRAINT `sakerhetspass_ibfk_1` FOREIGN KEY (`Scen`) REFERENCES `Scen` (`Namn`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sakerhetspass_ibfk_2` FOREIGN KEY (`Festivaldag`) REFERENCES `Festivaldag` (`Dag`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sakerhetspass_ibfk_3` FOREIGN KEY (`Sakerhetstid`) REFERENCES `Sakerhetstid` (`Tid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sakerhetspass_ibfk_4` FOREIGN KEY (`Funktionar`) REFERENCES `Funktionar` (`FunktionarsID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Spelning`
--
ALTER TABLE `Spelning`
ADD CONSTRAINT `spelning_ibfk_1` FOREIGN KEY (`Scen`) REFERENCES `Scen` (`Namn`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `spelning_ibfk_2` FOREIGN KEY (`Band`) REFERENCES `Band` (`BandID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `spelning_ibfk_3` FOREIGN KEY (`Scentid`) REFERENCES `Scentid` (`Tid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `spelning_ibfk_4` FOREIGN KEY (`Festivaldag`) REFERENCES `Festivaldag` (`Dag`) ON DELETE CASCADE ON UPDATE CASCADE;
