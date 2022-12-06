-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `client_requests`;
CREATE TABLE `client_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datebirth` date NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
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


DROP TABLE IF EXISTS `specs`;
CREATE TABLE `specs` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `specname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `docadmin_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docadmin_id` (`docadmin_id`),
  CONSTRAINT `specs_ibfk_1` FOREIGN KEY (`docadmin_id`) REFERENCES `docadmins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-12-05 13:40:53
