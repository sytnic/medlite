-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `client_reqs`;
CREATE TABLE `client_reqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datebirth` date NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_id` int(10) unsigned DEFAULT NULL,
  `spec_id` tinyint(3) unsigned NOT NULL,
  `doctime_id` int(10) unsigned DEFAULT NULL,
  `who_edited` tinyint(1) DEFAULT NULL,
  `when_edited` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  KEY `spec_id` (`spec_id`),
  KEY `doctime_id` (`doctime_id`),
  CONSTRAINT `client_reqs_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `docs` (`id`),
  CONSTRAINT `client_reqs_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`),
  CONSTRAINT `client_reqs_ibfk_3` FOREIGN KEY (`doctime_id`) REFERENCES `doctime` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `docadmins`;
CREATE TABLE `docadmins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mid_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '1',
  `docadmin_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docadmin_id` (`docadmin_id`),
  CONSTRAINT `docs_ibfk_2` FOREIGN KEY (`docadmin_id`) REFERENCES `docadmins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `docspec`;
CREATE TABLE `docspec` (
  `doc_id` int(10) unsigned NOT NULL,
  `spec_id` tinyint(3) unsigned NOT NULL,
  UNIQUE KEY `doc_id_spec_id` (`doc_id`,`spec_id`),
  KEY `spec_id` (`spec_id`),
  CONSTRAINT `docspec_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `docs` (`id`),
  CONSTRAINT `docspec_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `doctime`;
CREATE TABLE `doctime` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doc_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  `clientreqs_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_time` (`date`,`time`),
  KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `specs`;
CREATE TABLE `specs` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `specname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `docadmin_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docadmin_id` (`docadmin_id`),
  CONSTRAINT `specs_ibfk_1` FOREIGN KEY (`docadmin_id`) REFERENCES `docadmins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-12-16 13:50:23
