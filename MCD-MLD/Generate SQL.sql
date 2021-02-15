-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.11 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour hotelplanenmieux
CREATE DATABASE IF NOT EXISTS `hotelplanenmieux` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `hotelplanenmieux`;

-- Listage de la structure de la table hotelplanenmieux. activity
CREATE TABLE IF NOT EXISTS `activity` (
  `ID` int(11) NOT NULL,
  `description` varchar(50) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` float NOT NULL DEFAULT '0',
  `hypertextLink` varchar(50) NOT NULL DEFAULT '',
  `remark` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. checklist
CREATE TABLE IF NOT EXISTS `checklist` (
  `ID` int(11) NOT NULL,
  `thingsToTake` varchar(50) NOT NULL DEFAULT '',
  `thingsToDo` varchar(50) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. lodgingplace
CREATE TABLE IF NOT EXISTS `lodgingplace` (
  `ID` int(11) NOT NULL,
  `address` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `departureTime` date NOT NULL DEFAULT '0000-00-00',
  `arrivalTime` date NOT NULL DEFAULT '0000-00-00',
  `price` float NOT NULL DEFAULT '0',
  `reservationCode` varchar(50) NOT NULL DEFAULT '',
  `hypertextLink` varchar(50) NOT NULL DEFAULT '',
  `remark` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. loguser
CREATE TABLE IF NOT EXISTS `loguser` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `passwordHash` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. participate
CREATE TABLE IF NOT EXISTS `participate` (
  `ID` int(11) NOT NULL,
  `userAccepted` binary(1) NOT NULL DEFAULT '\0',
  `IDLoguser` int(11) NOT NULL,
  `IDTravel` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK__loguser` (`IDLoguser`),
  KEY `FK__travel` (`IDTravel`),
  CONSTRAINT `FK__loguser` FOREIGN KEY (`IDLoguser`) REFERENCES `loguser` (`id`),
  CONSTRAINT `FK__travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. transport
CREATE TABLE IF NOT EXISTS `transport` (
  `ID` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `departurePlace` varchar(50) NOT NULL DEFAULT '',
  `arrivalPlace` varchar(50) NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0',
  `reservationCode` varchar(50) NOT NULL DEFAULT '',
  `schedule` varchar(50) NOT NULL DEFAULT '',
  `hypertextLink` varchar(50) NOT NULL DEFAULT '',
  `remark` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. travel
CREATE TABLE IF NOT EXISTS `travel` (
  `ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `destination` varchar(50) NOT NULL DEFAULT '',
  `image` varchar(50) NOT NULL DEFAULT '',
  `isVisible` binary(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hotelplanenmieux. travel_checklist
CREATE TABLE IF NOT EXISTS `travel_checklist` (
  `ID` int(11) NOT NULL,
  `isOk` varchar(50) NOT NULL DEFAULT '',
  `IDTravel` int(11) NOT NULL DEFAULT '0',
  `IDChecklist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_Travel` (`IDTravel`),
  KEY `FK_Checklist` (`IDChecklist`),
  CONSTRAINT `FK_Checklist` FOREIGN KEY (`IDChecklist`) REFERENCES `checklist` (`id`),
  CONSTRAINT `FK_Travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
