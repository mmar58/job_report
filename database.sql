-- Adminer 4.8.1 MySQL 10.4.28-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `job_report`;
CREATE DATABASE `job_report` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `job_report`;

DROP TABLE IF EXISTS `dailywork`;
CREATE TABLE `dailywork` (
                             `date` date NOT NULL,
                             `hour` tinyint(10) NOT NULL,
                             `minutes` tinyint(10) NOT NULL,
                             `detailedWork` text NOT NULL DEFAULT '',
                             `extraminutes` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dailywork` (`date`, `hour`, `minutes`, `detailedWork`, `extraminutes`) VALUES
                                                                                        ('2023-08-07',	1,	4,	'',	0),
                                                                                        ('2023-08-06',	2,	13,	'',	0),
                                                                                        ('2023-08-05',	3,	3,	'',	0),
                                                                                        ('2023-08-08',	4,	7,	'',	0),
                                                                                        ('2024-01-13',	1,	56,	'07:32:32-08:31:43 00:59:11\n15:11:28-15:27:02 00:15:34\n18:03:27-18:44:51 00:41:24\n',	0),
                                                                                        ('2024-01-14',	2,	33,	'10:04:07-11:31:25 01:27:18\n12:47:11-13:52:51 01:05:40\n14:02:49-14:02:49 00:00:00\n',	10),
                                                                                        ('2023-12-11',	1,	55,	'04:30:59-04:41:44 00:10:45\n12:01:44-12:35:16 00:33:32\n17:28:13-17:39:13 00:11:00\n23:00:04-24:00:00 00:59:56\n',	0),
                                                                                        ('2023-08-13',	4,	39,	'',	0),
                                                                                        ('2023-08-14',	5,	36,	'',	0),
                                                                                        ('2023-08-15',	4,	34,	'',	0),
                                                                                        ('2023-12-12',	5,	40,	'00:00:00-01:20:49 01:20:49\n09:13:27-09:20:06 00:06:39\n11:24:33-11:38:57 00:14:24\n12:18:59-15:01:26 02:42:27\n18:03:03-18:30:13 00:27:10\n22:55:13-23:43:38 00:48:25\n',	0),
                                                                                        ('2023-08-17',	3,	39,	'',	0),
                                                                                        ('2023-08-18',	3,	2,	'',	0),
                                                                                        ('2023-12-13',	6,	38,	'00:31:40-00:31:55 00:00:15\n02:18:56-04:03:01 01:44:05\n14:49:32-14:49:33 00:00:01\n18:38:17-18:55:40 00:17:23\n19:11:26-23:47:27 04:36:01\n',	0),
                                                                                        ('2023-08-20',	4,	57,	'',	0),
                                                                                        ('2023-08-21',	4,	45,	'',	0),
                                                                                        ('2023-08-22',	2,	52,	'',	0),
                                                                                        ('2023-08-23',	5,	30,	'',	0),
                                                                                        ('2023-12-14',	6,	26,	'14:01:29-16:47:29 02:46:00\n20:19:54-24:00:00 03:40:06\n',	0),
                                                                                        ('2023-12-15',	1,	44,	'00:00:00-00:57:49 00:57:49\n08:35:52-09:21:36 00:45:47\n',	0),
                                                                                        ('2023-12-18',	5,	12,	'04:14:01-05:06:30 00:52:29\n12:26:27-13:07:22 00:40:55\n13:20:03-14:52:50 01:32:47\n20:08:39-22:14:35 02:05:56\n',	0),
                                                                                        ('2023-12-19',	5,	15,	'00:12:37-00:24:31 00:11:54\n12:44:42-13:51:45 01:07:03\n17:03:48-18:25:55 01:22:07\n21:25:47-24:00:00 02:34:13\n',	0),
                                                                                        ('2023-12-20',	6,	6,	'00:00:00-01:38:33 01:38:33\n01:38:48-01:45:49 00:07:01\n12:42:06-14:19:21 01:37:15\n17:03:07-19:18:46 02:15:39\n19:26:55-19:40:30 00:13:35\n23:26:20-23:29:14 00:02:54\n23:30:31-23:41:14 00:10:43\n',	0),
                                                                                        ('2023-12-21',	0,	50,	'00:48:56-01:10:10 00:21:14\n21:17:45-21:46:31 00:28:46\n',	0),
                                                                                        ('2023-12-22',	4,	3,	'04:54:21-05:42:24 00:48:03\n13:43:29-15:17:57 01:34:28\n18:04:17-18:17:34 00:13:17\n22:33:08-24:00:00 01:26:52\n',	0),
                                                                                        ('2023-12-23',	6,	24,	'00:00:00-01:22:11 01:22:11\n01:29:43-01:54:22 00:24:39\n01:57:02-02:02:00 00:04:58\n11:31:15-14:31:38 03:00:23\n18:26:17-18:57:49 00:31:32\n20:06:34-21:06:50 01:00:16\n',	0),
                                                                                        ('2023-12-24',	4,	47,	'09:22:05-10:55:36 01:33:31\n14:52:06-15:50:42 00:58:36\n18:56:46-19:03:22 00:06:36\n19:16:49-21:25:23 02:08:34\n',	0),
                                                                                        ('2023-08-30',	6,	0,	'',	0),
                                                                                        ('2023-12-25',	3,	36,	'06:18:57-06:44:39 00:25:42\n11:30:28-12:37:00 01:06:32\n14:17:09-14:21:48 00:04:39\n14:57:10-15:14:40 00:17:30\n17:24:55-18:57:30 01:32:35\n23:50:48-24:00:00 00:09:12\n',	0),
                                                                                        ('2023-12-26',	2,	19,	'00:00:00-00:52:39 00:52:39\n06:41:55-07:15:10 00:33:15\n08:40:21-09:33:15 00:52:54\n',	0),
                                                                                        ('2023-12-27',	4,	19,	'09:12:45-10:01:10 00:48:25\n10:36:59-10:38:46 00:01:47\n14:18:54-16:25:36 02:06:42\n20:49:19-21:07:27 00:18:08\n22:30:11-23:34:34 01:04:23\n',	37),
                                                                                        ('2023-09-03',	5,	36,	'',	0),
                                                                                        ('2023-12-28',	1,	42,	'00:00:00-00:02:13 00:02:13\n00:43:56-01:01:49 00:17:53\n01:09:58-01:21:23 00:11:25\n02:52:46-02:55:02 00:02:16\n10:13:44-10:37:59 00:24:15\n15:09:58-15:54:04 00:44:06\n16:18:35-16:18:35 00:00:00\n',	10),
                                                                                        ('2023-09-05',	4,	11,	'',	0),
                                                                                        ('2023-09-06',	4,	40,	'',	0),
                                                                                        ('2023-09-07',	6,	36,	'',	0),
                                                                                        ('2024-01-01',	5,	25,	'13:26:14-15:58:00 02:31:46\n20:56:58-23:50:27 02:53:29\n',	0),
                                                                                        ('2024-01-02',	7,	54,	'07:16:09-09:53:04 02:36:55\n11:17:38-13:18:22 02:00:44\n17:52:40-18:17:13 00:24:33\n18:54:02-21:24:25 02:30:23\n21:47:14-22:09:09 00:21:55\n',	0),
                                                                                        ('2024-01-03',	6,	57,	'07:14:45-09:31:52 02:17:07\n10:56:48-12:37:55 01:41:07\n12:50:39-12:58:07 00:07:28\n13:16:39-13:50:41 00:34:02\n19:06:53-20:46:16 01:39:23\n22:59:28-23:37:08 00:37:40\n',	0),
                                                                                        ('2024-01-04',	5,	17,	'08:20:45-11:28:33 03:07:48\n20:10:09-20:41:36 00:31:27\n21:14:14-22:52:04 01:37:50\n',	0),
                                                                                        ('2024-01-05',	7,	5,	'06:48:58-09:37:04 02:48:06\n10:00:54-10:44:54 00:44:00\n13:38:51-16:09:27 02:30:36\n21:17:12-22:07:38 00:50:26\n23:22:46-23:35:08 00:12:22\n',	25),
                                                                                        ('2024-01-06',	7,	32,	'00:00:00-01:01:26 01:01:26\n08:43:03-11:47:04 03:04:01\n13:58:00-14:36:51 00:38:51\n15:44:03-15:45:38 00:01:35\n21:13:48-24:00:00 02:46:12\n',	0),
                                                                                        ('2023-09-11',	4,	50,	'',	0),
                                                                                        ('2023-09-12',	10,	39,	'',	0),
                                                                                        ('2024-01-07',	4,	36,	'00:00:00-00:19:24 00:19:24\n00:55:17-00:23:40 00:01:19\n00:55:17-01:31:32 00:36:15\n10:03:03-10:16:51 00:13:48\n10:31:40-11:11:59 00:40:19\n13:30:52-14:42:53 01:12:01\n21:55:52-23:29:15 01:33:23\n',	34),
                                                                                        ('2024-01-08',	6,	25,	'00:21:12-00:58:07 00:36:55\n08:03:43-09:07:43 01:04:00\n09:50:02-11:47:31 01:57:29\n21:07:52-23:54:35 02:46:43\n',	43),
                                                                                        ('2024-01-09',	0,	14,	'18:10:28-18:24:35 00:14:07\n',	0),
                                                                                        ('2024-01-10',	6,	2,	'08:39:27-09:42:26 01:02:59\n10:30:25-10:48:06 00:17:41\n14:04:45-17:05:06 03:00:21\n20:33:05-22:13:36 01:40:31\n',	0),
                                                                                        ('2024-01-11',	2,	30,	'07:38:55-08:44:02 01:05:07\n09:30:29-10:05:01 00:34:32\n21:53:56-22:44:17 00:50:21\n',	0),
                                                                                        ('2024-01-12',	2,	26,	'07:14:09-09:03:54 01:49:45\n12:58:11-13:28:44 00:35:59\n',	0),
                                                                                        ('2023-09-18',	5,	24,	'',	0),
                                                                                        ('2023-09-19',	6,	40,	'',	0),
                                                                                        ('2023-09-20',	1,	39,	'',	0),
                                                                                        ('2023-09-21',	6,	16,	'',	0),
                                                                                        ('2023-09-22',	6,	24,	'',	0),
                                                                                        ('2023-09-23',	2,	56,	'',	0),
                                                                                        ('2023-09-24',	5,	11,	'',	0),
                                                                                        ('2023-09-25',	6,	2,	'',	0),
                                                                                        ('2023-09-26',	5,	42,	'',	0),
                                                                                        ('2023-09-28',	5,	55,	'',	0),
                                                                                        ('2023-09-27',	4,	38,	'',	0),
                                                                                        ('2023-09-29',	1,	55,	'',	0),
                                                                                        ('2023-10-01',	3,	13,	'',	0),
                                                                                        ('2023-09-30',	4,	41,	'',	0),
                                                                                        ('2023-10-02',	4,	25,	'',	0),
                                                                                        ('2023-10-03',	6,	46,	'',	0),
                                                                                        ('2023-10-04',	7,	17,	'',	0),
                                                                                        ('2023-10-05',	4,	21,	'',	0),
                                                                                        ('2023-10-06',	1,	10,	'',	0),
                                                                                        ('2023-10-07',	6,	8,	'',	0),
                                                                                        ('2023-10-08',	4,	29,	'',	0),
                                                                                        ('2023-10-09',	4,	4,	'',	0),
                                                                                        ('2023-10-10',	6,	24,	'',	0),
                                                                                        ('2023-10-11',	1,	34,	'',	0),
                                                                                        ('2023-10-12',	4,	51,	'',	0),
                                                                                        ('2023-10-13',	3,	2,	'',	0),
                                                                                        ('2023-10-14',	5,	49,	'',	0),
                                                                                        ('2023-10-15',	6,	12,	'',	0),
                                                                                        ('2023-10-16',	1,	52,	'',	0),
                                                                                        ('2023-10-17',	5,	12,	'',	0),
                                                                                        ('2023-10-18',	4,	27,	'',	0),
                                                                                        ('2023-10-19',	6,	57,	'',	0),
                                                                                        ('2023-10-20',	4,	51,	'',	0),
                                                                                        ('2023-10-21',	2,	49,	'',	0),
                                                                                        ('2023-10-22',	5,	22,	'',	0),
                                                                                        ('0000-00-00',	2,	41,	'',	0),
                                                                                        ('2023-10-29',	5,	7,	'',	0),
                                                                                        ('2023-10-28',	4,	56,	'',	0),
                                                                                        ('2023-10-27',	4,	52,	'',	0),
                                                                                        ('2023-10-26',	3,	33,	'',	0),
                                                                                        ('2023-10-25',	5,	25,	'',	0),
                                                                                        ('2023-10-24',	7,	14,	'',	0),
                                                                                        ('2023-10-23',	1,	30,	'',	0),
                                                                                        ('2023-10-30',	4,	3,	'',	0),
                                                                                        ('2023-11-02',	10,	27,	'',	-287),
                                                                                        ('2023-11-03',	4,	6,	'',	0),
                                                                                        ('2023-11-05',	3,	26,	'',	0),
                                                                                        ('2023-10-31',	0,	7,	'',	0),
                                                                                        ('2023-11-01',	3,	12,	'',	0),
                                                                                        ('2023-11-04',	3,	28,	'',	0),
                                                                                        ('2023-11-06',	13,	43,	'',	-464),
                                                                                        ('2023-11-07',	4,	23,	'',	0),
                                                                                        ('2023-11-08',	1,	32,	'',	0),
                                                                                        ('2023-11-09',	3,	52,	'02:38:55-03:40:41 01:01:46\n11:55:50-12:21:17 00:25:27\n13:18:14-14:31:18 01:13:04\n19:28:17-19:45:01 00:16:44\n21:25:38-22:20:46 00:55:08\n',	0),
                                                                                        ('2023-11-10',	4,	53,	'01:27:54-02:55:08 01:27:14\n13:32:27-14:49:48 01:17:21\n21:38:16-22:03:29 00:25:13\n22:17:14-24:00:00 01:42:46\n',	0),
                                                                                        ('2023-11-11',	4,	20,	'00:00:00-00:01:39 00:01:39\n13:12:42-15:09:12 01:56:30\n17:51:10-18:44:03 00:52:53\n20:06:05-21:34:34 01:28:29\n',	0),
                                                                                        ('2023-11-12',	2,	32,	'12:25:11-14:17:14 01:52:03\n14:17:16-14:17:16 00:00:00\n19:38:16-20:05:21 00:27:05\n20:35:19-20:48:00 00:12:41\n',	0),
                                                                                        ('2023-11-13',	3,	34,	'01:02:12-01:32:46 00:30:34\n02:11:51-02:16:41 00:04:50\n11:50:29-13:30:55 01:40:26\n21:07:50-21:20:51 00:13:01\n22:54:26-24:00:00 01:05:34\n',	0),
                                                                                        ('2023-11-14',	4,	12,	'00:00:00-00:49:04 00:49:04\n14:25:59-16:50:33 02:24:34\n23:02:04-24:00:00 00:57:56\n',	0),
                                                                                        ('2023-11-15',	5,	55,	'00:00:00-00:21:23 00:21:23\n05:30:04-05:30:04 00:00:00\n09:57:17-11:59:03 02:01:46\n19:32:58-22:02:05 02:29:07\n22:57:17-24:00:00 01:02:43\n',	0),
                                                                                        ('2023-11-16',	0,	14,	'00:00:00-00:14:16 00:14:16\n',	0),
                                                                                        ('2023-11-17',	6,	33,	'09:40:43-10:04:45 00:24:02\n10:35:30-12:21:39 01:46:09\n13:47:17-14:39:50 00:52:33\n20:29:26-24:00:00 03:30:34\n',	0),
                                                                                        ('2023-11-18',	5,	25,	'00:00:00-00:05:25 00:05:25\n00:25:27-00:36:39 00:11:12\n02:38:13-03:30:39 00:52:26\n12:57:02-15:40:15 02:43:13\n19:56:48-21:29:31 01:32:43\n',	0),
                                                                                        ('2023-11-19',	2,	37,	'08:37:34-10:42:09 02:04:35\n14:21:31-14:53:42 00:32:11\n',	0),
                                                                                        ('2023-11-20',	2,	4,	'18:04:44-18:07:11 00:02:27\n18:17:19-18:25:15 00:07:56\n20:09:43-22:03:12 01:53:29\n',	0),
                                                                                        ('2023-11-21',	6,	20,	'12:39:52-15:28:50 02:48:58\n20:01:01-23:32:09 03:31:08\n',	0),
                                                                                        ('2023-11-22',	6,	12,	'11:07:47-14:22:40 03:14:53\n21:02:46-24:00:00 02:57:14\n',	0),
                                                                                        ('2023-11-23',	3,	57,	'00:00:00-00:30:49 00:30:49\n17:23:42-20:10:13 02:46:31\n20:15:55-20:55:08 00:39:13\n',	0),
                                                                                        ('2023-11-24',	7,	19,	'02:42:30-05:23:25 02:40:55\n05:23:29-05:24:07 00:00:38\n05:24:08-05:24:08 00:00:00\n18:15:34-22:53:18 04:37:44\n',	0),
                                                                                        ('2023-11-25',	2,	24,	'02:46:44-05:08:05 02:21:21\n05:32:46-05:35:09 00:02:23\n',	0),
                                                                                        ('2023-11-26',	2,	50,	'00:05:10-00:56:45 00:51:35\n01:09:43-01:15:39 00:05:56\n15:04:32-16:57:21 01:52:49\n',	0),
                                                                                        ('2023-11-27',	1,	45,	'11:09:21-11:41:47 00:32:26\n16:45:34-17:58:20 01:12:46\n',	0),
                                                                                        ('2023-11-28',	6,	48,	'00:22:41-03:41:15 03:18:34\n13:52:07-14:02:02 00:09:55\n15:31:14-18:50:34 03:19:20\n',	0),
                                                                                        ('2023-11-29',	8,	48,	'02:33:58-05:17:18 02:43:20\n05:17:31-05:17:31 00:00:00\n14:47:19-16:26:42 01:39:23\n17:54:20-20:02:25 02:08:05\n21:42:20-24:00:00 02:17:40\n',	0),
                                                                                        ('2023-11-30',	2,	13,	'00:00:00-00:04:58 00:04:58\n12:49:08-13:47:27 00:58:19\n17:25:15-18:34:53 01:09:38\n',	0),
                                                                                        ('2023-12-01',	2,	25,	'08:06:56-10:08:11 02:01:15\n18:36:16-19:00:05 00:23:49\n',	0),
                                                                                        ('2023-12-02',	3,	34,	'10:29:22-11:40:04 01:10:42\n12:16:09-12:28:16 00:12:07\n20:52:36-23:03:40 02:11:04\n',	36),
                                                                                        ('2023-12-03',	1,	22,	'02:08:27-02:13:26 00:04:59\n08:15:44-08:21:30 00:05:46\n17:09:45-18:21:00 01:11:15\n',	0),
                                                                                        ('2023-12-04',	1,	31,	'17:20:44-18:34:37 01:13:53\n19:02:39-19:19:26 00:16:47\n',	43),
                                                                                        ('2023-12-05',	9,	24,	'03:39:45-03:46:54 00:07:09\n04:05:02-06:32:44 02:27:42\n11:14:58-12:04:11 00:49:13\n15:47:34-16:19:20 00:31:46\n16:28:28-18:58:55 02:30:27\n19:15:41-19:53:49 00:38:08\n20:03:39-21:05:13 01:01:34\n22:35:10-23:52:31 01:17:21\n23:53:28-23:54:19 00:00:51\n',	10),
                                                                                        ('2023-12-06',	4,	7,	'04:45:10-05:19:40 00:34:30\n05:27:27-05:37:37 00:10:10\n08:44:00-10:04:47 01:20:47\n17:46:57-19:39:51 01:52:54\n20:27:47-20:36:42 00:08:55\n',	0),
                                                                                        ('2023-12-07',	6,	56,	'00:07:57-05:37:43 05:29:46\n05:58:03-06:09:30 00:11:27\n06:10:06-06:15:11 00:05:05\n21:33:46-22:43:49 01:10:03\n',	10),
                                                                                        ('2023-12-08',	5,	45,	'04:18:01-04:42:06 00:24:05\n05:32:33-07:05:24 01:32:51\n12:59:51-12:59:51 00:00:00\n16:22:23-17:16:54 00:54:31\n17:56:33-19:14:33 01:18:00\n19:16:42-20:13:07 00:56:25\n23:20:49-24:00:00 00:39:11\n',	0);

DROP TABLE IF EXISTS `hourrate`;
CREATE TABLE `hourrate` (
                            `date` date NOT NULL,
                            `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hourrate` (`date`, `price`) VALUES
                                             ('2023-10-29',	375),
                                             ('2023-01-01',	312.5);

-- 2024-01-14 08:41:54