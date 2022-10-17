-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `medlite` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `medlite`;

DROP TABLE IF EXISTS `client_requests`;
CREATE TABLE `client_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datebirth` date NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spec_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_meet` date DEFAULT NULL,
  `time_meet` time DEFAULT NULL,
  `who_edited` tinyint(1) NOT NULL,
  `when_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `docadmins`;
CREATE TABLE `docadmins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mid_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spec_id` tinyint(3) unsigned NOT NULL,
  `spec_id_2` tinyint(3) DEFAULT NULL,
  `spec_id_3` tinyint(3) DEFAULT NULL,
  `cost` smallint(5) DEFAULT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '1',
  `docadmin_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spec_id_1` (`spec_id`),
  KEY `docadmin_id` (`docadmin_id`),
  CONSTRAINT `docs_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`),
  CONSTRAINT `docs_ibfk_2` FOREIGN KEY (`docadmin_id`) REFERENCES `docadmins` (`id`)
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


-- 2022-10-17 06:43:05
