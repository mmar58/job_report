-- Adminer 4.8.1 MySQL 5.5.5-10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `Postcode` varchar(100) NOT NULL,
  `Town` varchar(100) NOT NULL,
  `Region` varchar(100) NOT NULL,
  `SupplierName` varchar(100) NOT NULL,
  `Monday` int(11) NOT NULL DEFAULT 0,
  `Tuesday` int(11) NOT NULL DEFAULT 0,
  `Wednesday` int(11) NOT NULL DEFAULT 0,
  `Thursday` int(11) NOT NULL DEFAULT 0,
  `Friday` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2022-11-17 03:33:07