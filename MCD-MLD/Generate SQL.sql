

-- Listage de la structure de la base pour hpmieux21_hpm
CREATE DATABASE IF NOT EXISTS `hpmieux21_hpm`;
USE `hpmieux21_hpm`;

-- Listage de la structure de la table hpmieux21_hpm. loguser
CREATE TABLE IF NOT EXISTS `loguser` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `passwordHash` varchar(256) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hpmieux21_hpm. travel
CREATE TABLE IF NOT EXISTS `travel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `destination` varchar(256) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `image` varchar(256) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `isVisible` binary(1) NOT NULL,
  `IDLogUser` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_travel_loguser` (`IDLogUser`),
  CONSTRAINT `FK_travel_loguser` FOREIGN KEY (`IDLogUser`) REFERENCES `loguser` (`id`)
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hpmieux21_hpm. checklist
CREATE TABLE IF NOT EXISTS `checklist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `thingsToTake` varchar(50) NOT NULL DEFAULT '',
  `thingsToDo` varchar(50) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
);

-- Listage des données de la table hpmieux21_hpm.checklist : ~6 rows (environ)

INSERT INTO `checklist` (`ID`, `thingsToTake`, `thingsToDo`) VALUES
	(1, 'Vêtement chaud', ''),
	(2, 'Chaussure de marche', ''),
	(3, 'Chaussettes de rechange', ''),
	(4, 'Raquette de ping pong', ''),
	(5, 'Equipement de plongée', ''),
	(6, 'Divers', '');




-- Listage de la structure de la table hpmieux21_hpm. activity
CREATE TABLE IF NOT EXISTS `activity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` float NOT NULL DEFAULT '0',
  `hypertextLink` varchar(50) NOT NULL DEFAULT '',
  `remark` text NOT NULL,
  `IDTravel` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_activity_travel` (`IDTravel`),
  CONSTRAINT `FK_activity_travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hpmieux21_hpm. lodgingplace
CREATE TABLE IF NOT EXISTS `lodgingplace` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `departureTime` date NOT NULL DEFAULT '0000-00-00',
  `arrivalTime` date NOT NULL DEFAULT '0000-00-00',
  `price` float NOT NULL DEFAULT '0',
  `reservationCode` varchar(50) NOT NULL DEFAULT '',
  `hypertextLink` varchar(50) NOT NULL DEFAULT '',
  `remark` text NOT NULL,
  `IDTravel` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_lodgingplace_travel` (`IDTravel`),
  CONSTRAINT `FK_lodgingplace_travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
);

-- Les données exportées n'étaient pas sélectionnées.


-- Listage de la structure de la table hpmieux21_hpm. participate
CREATE TABLE IF NOT EXISTS `participate` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userAccepted` binary(1) NOT NULL,
  `IDLoguser` int(11) NOT NULL,
  `IDTravel` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_participate_loguser` (`IDLoguser`),
  KEY `FK_participate_travel` (`IDTravel`),
  CONSTRAINT `FK_participate_loguser` FOREIGN KEY (`IDLoguser`) REFERENCES `loguser` (`id`),
  CONSTRAINT `FK_participate_travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table hpmieux21_hpm. transport
CREATE TABLE IF NOT EXISTS `transport` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `departurePlace` varchar(50) NOT NULL DEFAULT '',
  `arrivalPlace` varchar(50) NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0',
  `reservationCode` varchar(50) NOT NULL DEFAULT '',
  `schedule` varchar(50) NOT NULL DEFAULT '',
  `hypertextLink` varchar(50) NOT NULL DEFAULT '',
  `remark` text NOT NULL,
  `IDTravel` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_transport_travel` (`IDTravel`),
  CONSTRAINT `FK_transport_travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
);

-- Les données exportées n'étaient pas sélectionnées.



-- Listage de la structure de la table hpmieux21_hpm. travel_checklist
CREATE TABLE IF NOT EXISTS `travel_checklist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `isOk` binary(1) NOT NULL,
  `IDTravel` int(11) NOT NULL DEFAULT '0',
  `IDChecklist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_travel_checklist_travel` (`IDTravel`),
  KEY `FK_travel_checklist_checklist` (`IDChecklist`),
  CONSTRAINT `FK_travel_checklist_checklist` FOREIGN KEY (`IDChecklist`) REFERENCES `checklist` (`id`),
  CONSTRAINT `FK_travel_checklist_travel` FOREIGN KEY (`IDTravel`) REFERENCES `travel` (`id`)
);


