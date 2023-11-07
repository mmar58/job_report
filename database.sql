-- Adminer 4.8.1 MySQL 10.4.28-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `dailywork`;
CREATE TABLE `dailywork` (
  `date` date NOT NULL,
  `hour` tinyint(10) NOT NULL,
  `minutes` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dailywork` (`date`, `hour`, `minutes`) VALUES
('2023-08-07',	1,	4),
('2023-08-06',	2,	13),
('2023-08-05',	3,	3),
('2023-08-08',	4,	7),
('2023-08-09',	4,	47),
('2023-08-10',	0,	5),
('2023-08-12',	3,	39),
('2023-08-13',	4,	39),
('2023-08-14',	5,	36),
('2023-08-15',	4,	34),
('2023-08-16',	0,	33),
('2023-08-17',	3,	39),
('2023-08-18',	3,	2),
('2023-08-19',	5,	6),
('2023-08-20',	4,	57),
('2023-08-21',	4,	45),
('2023-08-22',	2,	52);

DROP TABLE IF EXISTS `hourrate`;
CREATE TABLE `hourrate` (
  `date` date NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hourrate` (`date`, `price`) VALUES
('2023-01-01',	312.5);

-- 2023-08-23 11:30:41