-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 05 2019 г., 13:45
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `restate`
--
CREATE DATABASE IF NOT EXISTS `restate` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `restate`;

-- --------------------------------------------------------

--
-- Структура таблицы `commertial`
--

DROP TABLE IF EXISTS `commertial`;
CREATE TABLE IF NOT EXISTS `commertial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `house` tinyint(4) NOT NULL COMMENT 'Корпус',
  `floor` tinyint(4) NOT NULL COMMENT 'Этаж',
  `section` tinyint(4) NOT NULL COMMENT 'Секция',
  `number` int(11) NOT NULL COMMENT 'Номер',
  `square` float NOT NULL COMMENT 'Площадь',
  `price` int(11) NOT NULL COMMENT 'цена',
  `height` float NOT NULL COMMENT 'высота потолков',
  `finish` tinyint(4) NOT NULL COMMENT 'Отделка',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `res_id` (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filter`
--

DROP TABLE IF EXISTS `filter`;
CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL COMMENT 'тип поля фильтра',
  `count` int(11) NOT NULL COMMENT 'количество нажатий',
  `value` varchar(50) DEFAULT NULL COMMENT 'значение поля',
  `date` varchar(20) NOT NULL COMMENT 'дата',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `flats`
--

DROP TABLE IF EXISTS `flats`;
CREATE TABLE IF NOT EXISTS `flats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `external_id` int(11) DEFAULT NULL COMMENT 'id жк во внешней системе',
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `house` tinyint(4) NOT NULL COMMENT 'номер корпуса',
  `floor` tinyint(4) NOT NULL COMMENT 'этаж',
  `section` tinyint(4) NOT NULL COMMENT 'секция',
  `number` int(11) NOT NULL COMMENT 'номер кв',
  `size` tinyint(4) NOT NULL COMMENT 'кол-во комнат',
  `square` float NOT NULL COMMENT 'площадь',
  `price` int(11) NOT NULL COMMENT 'цена',
  `state` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `res_id` (`res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=684 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flats`
--

INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(1, 11062, 1, 4, 1, 4, 531, 0, 0, 3642601, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(2, 11061, 1, 4, 1, 4, 530, 0, 0, 3557520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(3, 11060, 1, 4, 1, 4, 529, 0, 0, 3512080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(4, 11057, 1, 4, 1, 4, 526, 0, 0, 3300570, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(5, 11054, 1, 4, 1, 4, 523, 0, 0, 5264800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(6, 11053, 1, 4, 1, 3, 362, 0, 0, 3655080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(7, 11052, 1, 4, 1, 3, 361, 0, 0, 3984960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(8, 11051, 1, 4, 1, 3, 360, 0, 0, 2527240, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(9, 11050, 1, 4, 1, 3, 359, 0, 0, 2551920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(10, 11049, 1, 4, 1, 3, 358, 0, 0, 3701440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(13, 11046, 1, 4, 1, 3, 355, 0, 0, 4922610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(14, 11045, 1, 4, 1, 3, 354, 0, 0, 5349880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(15, 11044, 1, 4, 1, 2, 161, 0, 0, 3704800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(16, 11043, 1, 4, 1, 2, 160, 0, 0, 2534400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(17, 11042, 1, 4, 1, 2, 159, 0, 0, 2533520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(18, 11040, 1, 4, 1, 2, 157, 0, 0, 2350740, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(19, 11039, 1, 4, 1, 2, 156, 0, 0, 2293320, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(20, 11038, 1, 4, 1, 2, 155, 0, 0, 3441680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(21, 11037, 1, 4, 1, 2, 154, 0, 0, 3571350, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(22, 11036, 1, 4, 1, 2, 153, 0, 0, 3634860, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(23, 11035, 1, 4, 1, 2, 152, 0, 0, 5233690, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(24, 11034, 1, 4, 1, 2, 151, 0, 0, 5538750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(25, 11033, 1, 4, 1, 1, 6, 0, 0, 4357640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(26, 11032, 1, 4, 1, 1, 5, 0, 0, 5488000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(27, 11031, 1, 4, 1, 1, 4, 0, 0, 3516540, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(28, 11030, 1, 4, 1, 1, 3, 0, 0, 2603040, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(29, 11029, 1, 4, 1, 1, 2, 0, 0, 6565580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(30, 11028, 1, 4, 1, 1, 1, 0, 0, 4828800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(31, 11027, 1, 4, 2, 4, 540, 0, 0, 5604700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(32, 11026, 1, 4, 2, 4, 539, 0, 0, 3676250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(33, 11023, 1, 4, 2, 4, 536, 0, 0, 3265145, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(34, 11022, 1, 4, 2, 4, 535, 0, 0, 3394070, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(35, 11019, 1, 4, 2, 4, 532, 0, 0, 5289000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(36, 11018, 1, 4, 2, 3, 372, 0, 0, 5762140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(37, 11017, 1, 4, 2, 3, 371, 0, 0, 3857920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(38, 11016, 1, 4, 2, 3, 370, 0, 0, 3530630, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(39, 11015, 1, 4, 2, 3, 369, 0, 0, 2515200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(40, 11014, 1, 4, 2, 3, 368, 0, 0, 2511360, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(41, 11012, 1, 4, 2, 3, 366, 0, 0, 3494400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(42, 11011, 1, 4, 2, 3, 365, 0, 0, 3534720, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(43, 11010, 1, 4, 2, 3, 364, 0, 0, 4997540, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(44, 11009, 1, 4, 2, 3, 363, 0, 0, 5380020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(45, 11008, 1, 4, 2, 2, 173, 0, 0, 3563840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(46, 11007, 1, 4, 2, 2, 172, 0, 0, 2586880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(47, 11006, 1, 4, 2, 2, 171, 0, 0, 2586880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(48, 11002, 1, 4, 2, 2, 167, 0, 0, 3530960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(49, 11001, 1, 4, 2, 2, 166, 0, 0, 3622710, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(50, 11000, 1, 4, 2, 2, 165, 0, 0, 3690050, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(51, 10999, 1, 4, 2, 2, 164, 0, 0, 3674810, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(52, 10997, 1, 4, 2, 2, 162, 0, 0, 5590970, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(53, 10996, 1, 4, 2, 1, 15, 0, 0, 3230175, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(54, 10995, 1, 4, 2, 1, 14, 0, 0, 4764420, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(55, 10994, 1, 4, 2, 1, 13, 0, 0, 4849680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(56, 10993, 1, 4, 2, 1, 12, 0, 0, 5620440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(57, 10992, 1, 4, 2, 1, 11, 0, 0, 3611790, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(58, 10990, 1, 4, 2, 1, 9, 0, 0, 6543635, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(59, 10989, 1, 4, 2, 1, 8, 0, 0, 4972500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(60, 10987, 1, 4, 3, 4, 549, 0, 0, 5673050, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(61, 10985, 1, 4, 3, 4, 547, 0, 0, 3640950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(62, 10982, 1, 4, 3, 4, 544, 0, 0, 3394070, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(63, 10979, 1, 4, 3, 4, 541, 0, 0, 5353500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(64, 10978, 1, 4, 3, 3, 382, 0, 0, 5832410, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(65, 10976, 1, 4, 3, 3, 380, 0, 0, 3570300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(66, 10975, 1, 4, 3, 3, 379, 0, 0, 2541400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(67, 10974, 1, 4, 3, 3, 378, 0, 0, 2537520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(68, 10973, 1, 4, 3, 3, 377, 0, 0, 3797430, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(69, 10972, 1, 4, 3, 3, 376, 0, 0, 3530800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(70, 10971, 1, 4, 3, 3, 375, 0, 0, 3571540, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(71, 10970, 1, 4, 3, 3, 374, 0, 0, 5060800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(72, 10968, 1, 4, 3, 2, 185, 0, 0, 3605280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(73, 10967, 1, 4, 3, 2, 184, 0, 0, 2614400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(74, 10966, 1, 4, 3, 2, 183, 0, 0, 2614400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(75, 10964, 1, 4, 3, 2, 181, 0, 0, 2445300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(76, 10962, 1, 4, 3, 2, 179, 0, 0, 3569340, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(77, 10961, 1, 4, 3, 2, 178, 0, 0, 3662520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(78, 10960, 1, 4, 3, 2, 177, 0, 0, 3730600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(79, 10959, 1, 4, 3, 2, 176, 0, 0, 3716100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(80, 10957, 1, 4, 3, 2, 174, 0, 0, 5663580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(81, 10954, 1, 4, 3, 1, 22, 0, 0, 4907760, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(82, 10953, 1, 4, 3, 1, 21, 0, 0, 5687350, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(83, 10952, 1, 4, 3, 1, 20, 0, 0, 3631635, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(84, 10949, 1, 4, 3, 1, 17, 0, 0, 5001750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(85, 10948, 1, 4, 3, 1, 16, 0, 0, 2672600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(86, 10947, 1, 4, 4, 4, 558, 0, 0, 5741400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(87, 10946, 1, 4, 4, 4, 557, 0, 0, 3762750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(88, 10945, 1, 4, 4, 4, 556, 0, 0, 3680100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(89, 10942, 1, 4, 4, 4, 553, 0, 0, 3429610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(90, 10939, 1, 4, 4, 4, 550, 0, 0, 5418000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(91, 10938, 1, 4, 4, 3, 392, 0, 0, 5902680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(92, 10936, 1, 4, 4, 3, 390, 0, 0, 3609970, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(93, 10935, 1, 4, 4, 3, 389, 0, 0, 2567600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(94, 10934, 1, 4, 4, 3, 388, 0, 0, 2563680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(95, 10932, 1, 4, 4, 3, 386, 0, 0, 3567200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(96, 10931, 1, 4, 4, 3, 385, 0, 0, 3608360, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(97, 10929, 1, 4, 4, 3, 383, 0, 0, 5512860, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(98, 10928, 1, 4, 4, 2, 197, 0, 0, 3646720, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(99, 10927, 1, 4, 4, 2, 196, 0, 0, 2614400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(100, 10926, 1, 4, 4, 2, 195, 0, 0, 2614400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(101, 10924, 1, 4, 4, 2, 193, 0, 0, 2471040, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(102, 10922, 1, 4, 4, 2, 191, 0, 0, 3607720, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(103, 10921, 1, 4, 4, 2, 190, 0, 0, 3702330, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(104, 10920, 1, 4, 4, 2, 189, 0, 0, 3771150, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(105, 10919, 1, 4, 4, 2, 188, 0, 0, 3757390, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(106, 10918, 1, 4, 4, 2, 187, 0, 0, 5354910, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(107, 10917, 1, 4, 4, 2, 186, 0, 0, 5736190, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(108, 10915, 1, 4, 4, 1, 32, 0, 0, 4819500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(109, 10914, 1, 4, 4, 1, 31, 0, 0, 4965840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(110, 10913, 1, 4, 4, 1, 30, 0, 0, 5754260, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(111, 10912, 1, 4, 4, 1, 29, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(112, 10910, 1, 4, 4, 1, 27, 0, 0, 6704215, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(113, 10909, 1, 4, 4, 1, 26, 0, 0, 5031000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(114, 10903, 1, 4, 5, 4, 563, 0, 0, 3299335, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(115, 10902, 1, 4, 5, 4, 562, 0, 0, 3429610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(116, 10898, 1, 4, 5, 3, 402, 0, 0, 5902680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(117, 10897, 1, 4, 5, 3, 401, 0, 0, 3945600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(118, 10895, 1, 4, 5, 3, 399, 0, 0, 2567600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(119, 10894, 1, 4, 5, 3, 398, 0, 0, 2563680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(120, 10892, 1, 4, 5, 3, 396, 0, 0, 3567200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(121, 10889, 1, 4, 5, 3, 393, 0, 0, 5512860, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(122, 10888, 1, 4, 5, 2, 209, 0, 0, 3646720, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(123, 10884, 1, 4, 5, 2, 205, 0, 0, 2471040, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(124, 10882, 1, 4, 5, 2, 203, 0, 0, 3607720, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(125, 10881, 1, 4, 5, 2, 202, 0, 0, 3702330, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(126, 10880, 1, 4, 5, 2, 201, 0, 0, 3771150, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(127, 10879, 1, 4, 5, 2, 200, 0, 0, 3757390, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(128, 10878, 1, 4, 5, 2, 199, 0, 0, 5354910, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(129, 10877, 1, 4, 5, 2, 198, 0, 0, 5736190, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(130, 10873, 1, 4, 5, 1, 39, 0, 0, 5754260, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(131, 10872, 1, 4, 5, 1, 38, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(132, 10870, 1, 4, 5, 1, 36, 0, 0, 6704215, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(133, 10869, 1, 4, 5, 1, 35, 0, 0, 5031000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(134, 10868, 1, 4, 5, 1, 34, 0, 0, 2701650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(135, 10867, 1, 4, 6, 4, 576, 0, 0, 5809750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(136, 10865, 1, 4, 6, 4, 574, 0, 0, 3719250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(137, 10863, 1, 4, 6, 4, 572, 0, 0, 3299335, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(138, 10862, 1, 4, 6, 4, 571, 0, 0, 3429610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(139, 10859, 1, 4, 6, 4, 568, 0, 0, 5482500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(140, 10858, 1, 4, 6, 3, 412, 0, 0, 5972950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(141, 10857, 1, 4, 6, 3, 411, 0, 0, 3989440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(142, 10856, 1, 4, 6, 3, 410, 0, 0, 3649640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(143, 10855, 1, 4, 6, 3, 409, 0, 0, 2593800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(144, 10854, 1, 4, 6, 3, 408, 0, 0, 2589840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(145, 10853, 1, 4, 6, 3, 407, 0, 0, 3880890, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(146, 10852, 1, 4, 6, 3, 406, 0, 0, 3603600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(147, 10851, 1, 4, 6, 3, 405, 0, 0, 3645180, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(148, 10850, 1, 4, 6, 3, 404, 0, 0, 5187320, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(149, 10849, 1, 4, 6, 3, 403, 0, 0, 5579280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(150, 10848, 1, 4, 6, 2, 221, 0, 0, 3688160, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(151, 10847, 1, 4, 6, 2, 220, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(152, 10846, 1, 4, 6, 2, 219, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(153, 10845, 1, 4, 6, 2, 218, 0, 0, 2493870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(154, 10844, 1, 4, 6, 2, 217, 0, 0, 2496780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(155, 10842, 1, 4, 6, 2, 215, 0, 0, 3646100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(156, 10841, 1, 4, 6, 2, 214, 0, 0, 3742140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(157, 10840, 1, 4, 6, 2, 213, 0, 0, 3811700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(158, 10839, 1, 4, 6, 2, 212, 0, 0, 3798680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(159, 10838, 1, 4, 6, 2, 211, 0, 0, 5421020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(160, 10837, 1, 4, 6, 2, 210, 0, 0, 5808800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(161, 10835, 1, 4, 6, 1, 50, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(162, 10834, 1, 4, 6, 1, 49, 0, 0, 5023920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(163, 10833, 1, 4, 6, 1, 48, 0, 0, 5821170, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(164, 10832, 1, 4, 6, 1, 47, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(165, 10831, 1, 4, 6, 1, 46, 0, 0, 2660200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(166, 10830, 1, 4, 6, 1, 45, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(167, 10829, 1, 4, 6, 1, 44, 0, 0, 5089500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(168, 10828, 1, 4, 6, 1, 43, 0, 0, 2730700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(169, 10827, 1, 4, 7, 4, 585, 0, 0, 5809750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(170, 10825, 1, 4, 7, 4, 583, 0, 0, 3719250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(171, 10823, 1, 4, 7, 4, 581, 0, 0, 3299335, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(172, 10822, 1, 4, 7, 4, 580, 0, 0, 3429610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(173, 10820, 1, 4, 7, 4, 578, 0, 0, 4692920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(174, 10819, 1, 4, 7, 4, 577, 0, 0, 5482500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(175, 10818, 1, 4, 7, 3, 422, 0, 0, 5972950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(176, 10817, 1, 4, 7, 3, 421, 0, 0, 3989440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(177, 10816, 1, 4, 7, 3, 420, 0, 0, 3649640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(178, 10815, 1, 4, 7, 3, 419, 0, 0, 2593800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(179, 10814, 1, 4, 7, 3, 418, 0, 0, 2589840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(180, 10812, 1, 4, 7, 3, 416, 0, 0, 3603600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(181, 10811, 1, 4, 7, 3, 415, 0, 0, 3645180, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(182, 10810, 1, 4, 7, 3, 414, 0, 0, 5187320, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(183, 10809, 1, 4, 7, 3, 413, 0, 0, 5579280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(184, 10808, 1, 4, 7, 2, 233, 0, 0, 3688160, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(185, 10807, 1, 4, 7, 2, 232, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(186, 10806, 1, 4, 7, 2, 231, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(187, 10805, 1, 4, 7, 2, 230, 0, 0, 2493870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(188, 10804, 1, 4, 7, 2, 229, 0, 0, 2496780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(189, 10803, 1, 4, 7, 2, 228, 0, 0, 2429850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(190, 10802, 1, 4, 7, 2, 227, 0, 0, 3646100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(191, 10801, 1, 4, 7, 2, 226, 0, 0, 3742140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(192, 10800, 1, 4, 7, 2, 225, 0, 0, 3811700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(193, 10799, 1, 4, 7, 2, 224, 0, 0, 3798680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(194, 10798, 1, 4, 7, 2, 223, 0, 0, 5421020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(195, 10797, 1, 4, 7, 2, 222, 0, 0, 5808800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(196, 10796, 1, 4, 7, 1, 60, 0, 0, 3263305, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(197, 10795, 1, 4, 7, 1, 59, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(198, 10794, 1, 4, 7, 1, 58, 0, 0, 5023920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(199, 10793, 1, 4, 7, 1, 57, 0, 0, 5821170, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(200, 10792, 1, 4, 7, 1, 56, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(201, 10790, 1, 4, 7, 1, 54, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(202, 10788, 1, 4, 7, 1, 52, 0, 0, 2730700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(203, 10787, 1, 4, 8, 4, 594, 0, 0, 5809750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(204, 10786, 1, 4, 8, 4, 593, 0, 0, 3806000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(205, 10785, 1, 4, 8, 4, 592, 0, 0, 3719250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(206, 10783, 1, 4, 8, 4, 590, 0, 0, 3299335, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(207, 10782, 1, 4, 8, 4, 589, 0, 0, 3429610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(208, 10780, 1, 4, 8, 4, 587, 0, 0, 4692920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(209, 10779, 1, 4, 8, 4, 586, 0, 0, 5482500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(210, 10778, 1, 4, 8, 3, 432, 0, 0, 5972950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(211, 10777, 1, 4, 8, 3, 431, 0, 0, 3989440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(212, 10776, 1, 4, 8, 3, 430, 0, 0, 3649640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(213, 10775, 1, 4, 8, 3, 429, 0, 0, 2593800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(214, 10774, 1, 4, 8, 3, 428, 0, 0, 2589840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(215, 10773, 1, 4, 8, 3, 427, 0, 0, 3880890, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(216, 10772, 1, 4, 8, 3, 426, 0, 0, 3603600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(217, 10771, 1, 4, 8, 3, 425, 0, 0, 3645180, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(218, 10769, 1, 4, 8, 3, 423, 0, 0, 5579280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(219, 10768, 1, 4, 8, 2, 245, 0, 0, 3688160, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(220, 10766, 1, 4, 8, 2, 243, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(221, 10765, 1, 4, 8, 2, 242, 0, 0, 2493870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(222, 10764, 1, 4, 8, 2, 241, 0, 0, 2496780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(223, 10763, 1, 4, 8, 2, 240, 0, 0, 2429850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(224, 10762, 1, 4, 8, 2, 239, 0, 0, 3646100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(225, 10761, 1, 4, 8, 2, 238, 0, 0, 3742140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(226, 10760, 1, 4, 8, 2, 237, 0, 0, 3811700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(227, 10759, 1, 4, 8, 2, 236, 0, 0, 3798680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(228, 10758, 1, 4, 8, 2, 235, 0, 0, 5421020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(229, 10757, 1, 4, 8, 2, 234, 0, 0, 5808800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(230, 10756, 1, 4, 8, 1, 69, 0, 0, 3263305, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(231, 10755, 1, 4, 8, 1, 68, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(232, 10754, 1, 4, 8, 1, 67, 0, 0, 5023920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(233, 10753, 1, 4, 8, 1, 66, 0, 0, 5821170, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(234, 10752, 1, 4, 8, 1, 65, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(235, 10750, 1, 4, 8, 1, 63, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(236, 10749, 1, 4, 8, 1, 62, 0, 0, 5089500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(237, 10748, 1, 4, 8, 1, 61, 0, 0, 2730700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(238, 10747, 1, 4, 9, 4, 603, 0, 0, 5809750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(239, 10745, 1, 4, 9, 4, 601, 0, 0, 3719250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(240, 10740, 1, 4, 9, 4, 596, 0, 0, 4692920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(241, 10739, 1, 4, 9, 4, 595, 0, 0, 5482500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(242, 10738, 1, 4, 9, 3, 442, 0, 0, 5972950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(243, 10736, 1, 4, 9, 3, 440, 0, 0, 3649640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(244, 10735, 1, 4, 9, 3, 439, 0, 0, 2593800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(245, 10734, 1, 4, 9, 3, 438, 0, 0, 2589840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(246, 10732, 1, 4, 9, 3, 436, 0, 0, 3603600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(247, 10731, 1, 4, 9, 3, 435, 0, 0, 3645180, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(248, 10729, 1, 4, 9, 3, 433, 0, 0, 5579280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(249, 10728, 1, 4, 9, 2, 257, 0, 0, 3688160, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(250, 10727, 1, 4, 9, 2, 256, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(251, 10726, 1, 4, 9, 2, 255, 0, 0, 2669440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(252, 10725, 1, 4, 9, 2, 254, 0, 0, 2493870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(253, 10724, 1, 4, 9, 2, 253, 0, 0, 2496780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(254, 10723, 1, 4, 9, 2, 252, 0, 0, 2429850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(255, 10722, 1, 4, 9, 2, 251, 0, 0, 3646100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(256, 10721, 1, 4, 9, 2, 250, 0, 0, 3742140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(257, 10720, 1, 4, 9, 2, 249, 0, 0, 3811700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(258, 10719, 1, 4, 9, 2, 248, 0, 0, 3798680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(259, 10718, 1, 4, 9, 2, 247, 0, 0, 5421020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(260, 10715, 1, 4, 9, 1, 77, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(261, 10714, 1, 4, 9, 1, 76, 0, 0, 5023920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(262, 10713, 1, 4, 9, 1, 75, 0, 0, 5821170, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(263, 10712, 1, 4, 9, 1, 74, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(264, 10710, 1, 4, 9, 1, 72, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(265, 10709, 1, 4, 9, 1, 71, 0, 0, 5089500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(266, 10707, 1, 4, 10, 4, 612, 0, 0, 5809750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(267, 10706, 1, 4, 10, 4, 611, 0, 0, 3806000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(268, 10705, 1, 4, 10, 4, 610, 0, 0, 3719250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(269, 10700, 1, 4, 10, 4, 605, 0, 0, 4692920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(270, 10699, 1, 4, 10, 4, 604, 0, 0, 5482500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(271, 10698, 1, 4, 10, 3, 452, 0, 0, 5972950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(272, 10697, 1, 4, 10, 3, 451, 0, 0, 3989440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(273, 10696, 1, 4, 10, 3, 450, 0, 0, 3649640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(274, 10695, 1, 4, 10, 3, 449, 0, 0, 2593800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(275, 10694, 1, 4, 10, 3, 448, 0, 0, 2589840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(276, 10693, 1, 4, 10, 3, 447, 0, 0, 3880890, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(277, 10692, 1, 4, 10, 3, 446, 0, 0, 3603600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(278, 10689, 1, 4, 10, 3, 443, 0, 0, 5579280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(279, 10687, 1, 4, 10, 2, 268, 0, 0, 2641920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(280, 10686, 1, 4, 10, 2, 267, 0, 0, 2669440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(281, 10685, 1, 4, 10, 2, 266, 0, 0, 2493870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(282, 10684, 1, 4, 10, 2, 265, 0, 0, 2496780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(283, 10683, 1, 4, 10, 2, 264, 0, 0, 2429850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(284, 10682, 1, 4, 10, 2, 263, 0, 0, 3646100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(285, 10681, 1, 4, 10, 2, 262, 0, 0, 3742140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(286, 10680, 1, 4, 10, 2, 261, 0, 0, 3811700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(287, 10679, 1, 4, 10, 2, 260, 0, 0, 3798680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(288, 10678, 1, 4, 10, 2, 259, 0, 0, 5421020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(289, 10677, 1, 4, 10, 2, 258, 0, 0, 5808800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(290, 10676, 1, 4, 10, 1, 87, 0, 0, 3263305, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(291, 10675, 1, 4, 10, 1, 86, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(292, 10674, 1, 4, 10, 1, 85, 0, 0, 5023920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(293, 10673, 1, 4, 10, 1, 84, 0, 0, 5821170, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(294, 10672, 1, 4, 10, 1, 83, 0, 0, 3711015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(295, 10670, 1, 4, 10, 1, 81, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(296, 10669, 1, 4, 10, 1, 80, 0, 0, 5089500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(297, 10668, 1, 4, 10, 1, 79, 0, 0, 2730700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(298, 10667, 1, 4, 11, 4, 621, 0, 0, 5809750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(299, 10665, 1, 4, 11, 4, 619, 0, 0, 3669850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(300, 10662, 1, 4, 11, 4, 616, 0, 0, 3413475, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(301, 10659, 1, 4, 11, 4, 613, 0, 0, 5482500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(302, 10658, 1, 4, 11, 3, 462, 0, 0, 5972950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(303, 10655, 1, 4, 11, 3, 459, 0, 0, 2593800, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(304, 10654, 1, 4, 11, 3, 458, 0, 0, 2589840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(305, 10653, 1, 4, 11, 3, 457, 0, 0, 3832530, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(306, 10652, 1, 4, 11, 3, 456, 0, 0, 3552120, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(307, 10651, 1, 4, 11, 3, 455, 0, 0, 3593700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(308, 10649, 1, 4, 11, 3, 453, 0, 0, 5579280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(309, 10648, 1, 4, 11, 2, 281, 0, 0, 3633870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(310, 10645, 1, 4, 11, 2, 278, 0, 0, 2519580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(311, 10644, 1, 4, 11, 2, 277, 0, 0, 2496780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(312, 10643, 1, 4, 11, 2, 276, 0, 0, 2429850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(313, 10642, 1, 4, 11, 2, 275, 0, 0, 3596700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(314, 10641, 1, 4, 11, 2, 274, 0, 0, 3742140, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(315, 10640, 1, 4, 11, 2, 273, 0, 0, 3811700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(316, 10639, 1, 4, 11, 2, 272, 0, 0, 3750840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(317, 10638, 1, 4, 11, 2, 271, 0, 0, 5421020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(318, 10637, 1, 4, 11, 2, 270, 0, 0, 5763200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(319, 10635, 1, 4, 11, 1, 95, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(320, 10634, 1, 4, 11, 1, 94, 0, 0, 5023920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(321, 10633, 1, 4, 11, 1, 93, 0, 0, 5821170, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(322, 10632, 1, 4, 11, 1, 92, 0, 0, 3659590, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(323, 10631, 1, 4, 11, 1, 91, 0, 0, 2660200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(324, 10630, 1, 4, 11, 1, 90, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(325, 10629, 1, 4, 11, 1, 89, 0, 0, 5089500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(326, 10627, 1, 4, 12, 4, 630, 0, 0, 5878100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(327, 10625, 1, 4, 12, 4, 628, 0, 0, 3708480, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(328, 10623, 1, 4, 12, 4, 626, 0, 0, 3282825, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(329, 10622, 1, 4, 12, 4, 625, 0, 0, 3413475, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(330, 10620, 1, 4, 12, 4, 623, 0, 0, 4743930, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(331, 10619, 1, 4, 12, 4, 622, 0, 0, 5547000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(332, 10618, 1, 4, 12, 3, 472, 0, 0, 6043220, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(333, 10616, 1, 4, 12, 3, 470, 0, 0, 3631650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(334, 10615, 1, 4, 12, 3, 469, 0, 0, 2620000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(335, 10614, 1, 4, 12, 3, 468, 0, 0, 2616000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(336, 10613, 1, 4, 12, 3, 467, 0, 0, 3873740, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(337, 10612, 1, 4, 12, 3, 466, 0, 0, 3588000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(338, 10611, 1, 4, 12, 3, 465, 0, 0, 3630000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(339, 10610, 1, 4, 12, 3, 464, 0, 0, 5199950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(340, 10609, 1, 4, 12, 3, 463, 0, 0, 5645700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(341, 10608, 1, 4, 12, 2, 293, 0, 0, 3674700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(342, 10607, 1, 4, 12, 2, 292, 0, 0, 2669440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(343, 10606, 1, 4, 12, 2, 291, 0, 0, 2696960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(344, 10605, 1, 4, 12, 2, 290, 0, 0, 2519580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(345, 10604, 1, 4, 12, 2, 289, 0, 0, 2522520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(346, 10603, 1, 4, 12, 2, 288, 0, 0, 2454900, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(347, 10602, 1, 4, 12, 2, 287, 0, 0, 3634560, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(348, 10601, 1, 4, 12, 2, 286, 0, 0, 3781950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(349, 10600, 1, 4, 12, 2, 285, 0, 0, 3852250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(350, 10599, 1, 4, 12, 2, 284, 0, 0, 3791610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(351, 10598, 1, 4, 12, 2, 283, 0, 0, 5487130, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(352, 10597, 1, 4, 12, 2, 282, 0, 0, 5835240, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(353, 10596, 1, 4, 12, 1, 105, 0, 0, 3279870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(354, 10595, 1, 4, 12, 1, 104, 0, 0, 4902120, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(355, 10594, 1, 4, 12, 1, 103, 0, 0, 5082000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(356, 10593, 1, 4, 12, 1, 102, 0, 0, 5888080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(357, 10592, 1, 4, 12, 1, 101, 0, 0, 3718300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(358, 10591, 1, 4, 12, 1, 100, 0, 0, 2688500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(359, 10590, 1, 4, 12, 1, 99, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(360, 10589, 1, 4, 12, 1, 98, 0, 0, 5148000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(361, 10588, 1, 4, 12, 1, 97, 0, 0, 2759750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(362, 10587, 1, 4, 13, 4, 639, 0, 0, 5878100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(363, 10586, 1, 4, 13, 4, 638, 0, 0, 3794960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(364, 10585, 1, 4, 13, 4, 637, 0, 0, 3708480, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(365, 10584, 1, 4, 13, 4, 636, 0, 0, 2417580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(366, 10582, 1, 4, 13, 4, 634, 0, 0, 3413475, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(367, 10580, 1, 4, 13, 4, 632, 0, 0, 4743930, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(368, 10579, 1, 4, 13, 4, 631, 0, 0, 5547000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(369, 10578, 1, 4, 13, 3, 482, 0, 0, 6043220, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(370, 10577, 1, 4, 13, 3, 481, 0, 0, 4033280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(371, 10576, 1, 4, 13, 3, 480, 0, 0, 3631650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(372, 10575, 1, 4, 13, 3, 479, 0, 0, 2620000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(373, 10574, 1, 4, 13, 3, 478, 0, 0, 2616000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(374, 10573, 1, 4, 13, 3, 477, 0, 0, 3873740, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(375, 10572, 1, 4, 13, 3, 476, 0, 0, 3588000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(376, 10571, 1, 4, 13, 3, 475, 0, 0, 3630000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(377, 10570, 1, 4, 13, 3, 474, 0, 0, 5199950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(378, 10569, 1, 4, 13, 3, 473, 0, 0, 5645700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(379, 10568, 1, 4, 13, 2, 305, 0, 0, 3674700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(380, 10567, 1, 4, 13, 2, 304, 0, 0, 2669440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(381, 10566, 1, 4, 13, 2, 303, 0, 0, 2696960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(382, 10565, 1, 4, 13, 2, 302, 0, 0, 2519580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(383, 10564, 1, 4, 13, 2, 301, 0, 0, 2522520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(384, 10563, 1, 4, 13, 2, 300, 0, 0, 2454900, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(385, 10562, 1, 4, 13, 2, 299, 0, 0, 3634560, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(386, 10561, 1, 4, 13, 2, 298, 0, 0, 3781950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(387, 10560, 1, 4, 13, 2, 297, 0, 0, 3852250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(388, 10559, 1, 4, 13, 2, 296, 0, 0, 3791610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(389, 10558, 1, 4, 13, 2, 295, 0, 0, 5487130, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(390, 10557, 1, 4, 13, 2, 294, 0, 0, 5835240, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(391, 10556, 1, 4, 13, 1, 114, 0, 0, 3279870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(392, 10555, 1, 4, 13, 1, 113, 0, 0, 4902120, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(393, 10554, 1, 4, 13, 1, 112, 0, 0, 5082000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(394, 10553, 1, 4, 13, 1, 111, 0, 0, 5888080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(395, 10552, 1, 4, 13, 1, 110, 0, 0, 3718300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(396, 10551, 1, 4, 13, 1, 109, 0, 0, 2688500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(397, 10550, 1, 4, 13, 1, 108, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(398, 10549, 1, 4, 13, 1, 107, 0, 0, 5148000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(399, 10548, 1, 4, 13, 1, 106, 0, 0, 2759750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(400, 10547, 1, 4, 14, 4, 648, 0, 0, 5878100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(401, 10546, 1, 4, 14, 4, 647, 0, 0, 3794960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(402, 10545, 1, 4, 14, 4, 646, 0, 0, 3708480, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(403, 10543, 1, 4, 14, 4, 644, 0, 0, 3282825, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(404, 10542, 1, 4, 14, 4, 643, 0, 0, 3413475, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(405, 10540, 1, 4, 14, 4, 641, 0, 0, 4743930, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(406, 10539, 1, 4, 14, 4, 640, 0, 0, 5547000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(407, 10538, 1, 4, 14, 3, 492, 0, 0, 6043220, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(408, 10537, 1, 4, 14, 3, 491, 0, 0, 4033280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(409, 10536, 1, 4, 14, 3, 490, 0, 0, 3631650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(410, 10535, 1, 4, 14, 3, 489, 0, 0, 2620000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(411, 10534, 1, 4, 14, 3, 488, 0, 0, 2616000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(412, 10533, 1, 4, 14, 3, 487, 0, 0, 3873740, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(413, 10532, 1, 4, 14, 3, 486, 0, 0, 3588000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(414, 10531, 1, 4, 14, 3, 485, 0, 0, 3630000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(415, 10530, 1, 4, 14, 3, 484, 0, 0, 5199950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(416, 10529, 1, 4, 14, 3, 483, 0, 0, 5645700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(417, 10528, 1, 4, 14, 2, 317, 0, 0, 3674700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(418, 10527, 1, 4, 14, 2, 316, 0, 0, 2, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(419, 10526, 1, 4, 14, 2, 315, 0, 0, 2696960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(420, 10525, 1, 4, 14, 2, 314, 0, 0, 2519580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(421, 10524, 1, 4, 14, 2, 313, 0, 0, 2522520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(422, 10523, 1, 4, 14, 2, 312, 0, 0, 2454900, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(423, 10522, 1, 4, 14, 2, 311, 0, 0, 3634560, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(424, 10521, 1, 4, 14, 2, 310, 0, 0, 3781950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(425, 10520, 1, 4, 14, 2, 309, 0, 0, 3852250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(426, 10519, 1, 4, 14, 2, 308, 0, 0, 3791610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(427, 10518, 1, 4, 14, 2, 307, 0, 0, 5487130, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(428, 10517, 1, 4, 14, 2, 306, 0, 0, 5835240, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(429, 10516, 1, 4, 14, 1, 123, 0, 0, 3279870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(430, 10515, 1, 4, 14, 1, 122, 0, 0, 4902120, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(431, 10514, 1, 4, 14, 1, 121, 0, 0, 5082000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(432, 10513, 1, 4, 14, 1, 120, 0, 0, 5888080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(433, 10512, 1, 4, 14, 1, 119, 0, 0, 3718300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(434, 10511, 1, 4, 14, 1, 118, 0, 0, 2688500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(435, 10510, 1, 4, 14, 1, 117, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(436, 10509, 1, 4, 14, 1, 116, 0, 0, 5148000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(437, 10508, 1, 4, 14, 1, 115, 0, 0, 2759750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(438, 10507, 1, 4, 15, 4, 657, 0, 0, 5878100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(439, 10504, 1, 4, 15, 4, 654, 0, 0, 2417580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(440, 10503, 1, 4, 15, 4, 653, 0, 0, 3282825, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(441, 10502, 1, 4, 15, 4, 652, 0, 0, 3413475, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(442, 10500, 1, 4, 15, 4, 650, 0, 0, 4743930, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(443, 10499, 1, 4, 15, 4, 649, 0, 0, 5547000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(444, 10498, 1, 4, 15, 3, 502, 0, 0, 6043220, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(445, 10497, 1, 4, 15, 3, 501, 0, 0, 4033280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(446, 10496, 1, 4, 15, 3, 500, 0, 0, 3631650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(447, 10495, 1, 4, 15, 3, 499, 0, 0, 2620000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(448, 10494, 1, 4, 15, 3, 498, 0, 0, 2616000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(449, 10493, 1, 4, 15, 3, 497, 0, 0, 3873740, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(450, 10492, 1, 4, 15, 3, 496, 0, 0, 3588000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(451, 10491, 1, 4, 15, 3, 495, 0, 0, 3630000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(452, 10490, 1, 4, 15, 3, 494, 0, 0, 5199950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(453, 10489, 1, 4, 15, 3, 493, 0, 0, 5645700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(454, 10488, 1, 4, 15, 2, 329, 0, 0, 3674700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(455, 10486, 1, 4, 15, 2, 327, 0, 0, 2696960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(456, 10485, 1, 4, 15, 2, 326, 0, 0, 2519580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(457, 10484, 1, 4, 15, 2, 325, 0, 0, 2522520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(458, 10483, 1, 4, 15, 2, 324, 0, 0, 2454900, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(459, 10482, 1, 4, 15, 2, 323, 0, 0, 3634560, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(460, 10481, 1, 4, 15, 2, 322, 0, 0, 3781950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(461, 10479, 1, 4, 15, 2, 320, 0, 0, 3791610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(462, 10478, 1, 4, 15, 2, 319, 0, 0, 5487130, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(463, 10477, 1, 4, 15, 2, 318, 0, 0, 5835240, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(464, 10476, 1, 4, 15, 1, 132, 0, 0, 3279870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(465, 10475, 1, 4, 15, 1, 131, 0, 0, 4902120, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(466, 10474, 1, 4, 15, 1, 130, 0, 0, 5082000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(467, 10473, 1, 4, 15, 1, 129, 0, 0, 5888080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(468, 10472, 1, 4, 15, 1, 128, 0, 0, 3718300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(469, 10470, 1, 4, 15, 1, 126, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(470, 10469, 1, 4, 15, 1, 125, 0, 0, 5148000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(471, 10468, 1, 4, 15, 1, 124, 0, 0, 2759750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(472, 10467, 1, 4, 16, 4, 666, 0, 0, 5878100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(473, 10465, 1, 4, 16, 4, 664, 0, 0, 3708480, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(474, 10464, 1, 4, 16, 4, 663, 0, 0, 2417580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(475, 10463, 1, 4, 16, 4, 662, 0, 0, 3282825, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(476, 10462, 1, 4, 16, 4, 661, 0, 0, 3413475, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(477, 10460, 1, 4, 16, 4, 659, 0, 0, 4743930, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(478, 10459, 1, 4, 16, 4, 658, 0, 0, 5547000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(479, 10458, 1, 4, 16, 3, 512, 0, 0, 6043220, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(480, 10457, 1, 4, 16, 3, 511, 0, 0, 4033280, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(481, 10456, 1, 4, 16, 3, 510, 0, 0, 3631650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(482, 10455, 1, 4, 16, 3, 509, 0, 0, 2620000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(483, 10454, 1, 4, 16, 3, 508, 0, 0, 2616000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(484, 10453, 1, 4, 16, 3, 507, 0, 0, 3873740, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(485, 10452, 1, 4, 16, 3, 506, 0, 0, 3588000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(486, 10451, 1, 4, 16, 3, 505, 0, 0, 3630000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(487, 10450, 1, 4, 16, 3, 504, 0, 0, 5199950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(488, 10449, 1, 4, 16, 3, 503, 0, 0, 5645700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(489, 10448, 1, 4, 16, 2, 341, 0, 0, 3674700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(490, 10447, 1, 4, 16, 2, 340, 0, 0, 2669440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(491, 10446, 1, 4, 16, 2, 339, 0, 0, 2696960, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(492, 10445, 1, 4, 16, 2, 338, 0, 0, 2519580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(493, 10444, 1, 4, 16, 2, 337, 0, 0, 2522520, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(494, 10443, 1, 4, 16, 2, 336, 0, 0, 2454900, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(495, 10441, 1, 4, 16, 2, 334, 0, 0, 3781950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(496, 10440, 1, 4, 16, 2, 333, 0, 0, 3852250, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(497, 10439, 1, 4, 16, 2, 332, 0, 0, 3791610, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(498, 10438, 1, 4, 16, 2, 331, 0, 0, 5487130, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(499, 10437, 1, 4, 16, 2, 330, 0, 0, 5835240, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(500, 10436, 1, 4, 16, 1, 141, 0, 0, 3279870, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(501, 10435, 1, 4, 16, 1, 140, 0, 0, 4902120, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(502, 10433, 1, 4, 16, 1, 138, 0, 0, 5888080, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(503, 10432, 1, 4, 16, 1, 137, 0, 0, 3718300, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(504, 10431, 1, 4, 16, 1, 136, 0, 0, 2688500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(505, 10430, 1, 4, 16, 1, 135, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(506, 10429, 1, 4, 16, 1, 134, 0, 0, 5148000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(507, 10428, 1, 4, 16, 1, 133, 0, 0, 2759750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(508, 10425, 1, 4, 17, 4, 673, 0, 0, 3689165, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(509, 10424, 1, 4, 17, 4, 672, 0, 0, 2405370, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(510, 10420, 1, 4, 17, 4, 668, 0, 0, 4718425, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(511, 10417, 1, 4, 17, 3, 521, 0, 0, 4011360, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(512, 10416, 1, 4, 17, 3, 520, 0, 0, 3612125, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(513, 10415, 1, 4, 17, 3, 519, 0, 0, 2, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(514, 10414, 1, 4, 17, 3, 518, 0, 0, 2602920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(515, 10410, 1, 4, 17, 3, 514, 0, 0, 5168625, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(516, 10409, 1, 4, 17, 3, 513, 0, 0, 5612490, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(517, 10408, 1, 4, 17, 2, 353, 0, 0, 3654285, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(518, 10407, 1, 4, 17, 2, 352, 0, 0, 2655680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(519, 10406, 1, 4, 17, 2, 351, 0, 0, 2683200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(520, 10404, 1, 4, 17, 2, 349, 0, 0, 2509650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(521, 10403, 1, 4, 17, 2, 348, 0, 0, 2442375, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(522, 10402, 1, 4, 17, 2, 347, 0, 0, 3615630, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(523, 10401, 1, 4, 17, 2, 346, 0, 0, 3762045, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(524, 10399, 1, 4, 17, 2, 344, 0, 0, 3771225, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(525, 10398, 1, 4, 17, 2, 343, 0, 0, 5454075, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(526, 10397, 1, 4, 17, 2, 342, 0, 0, 5799220, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(527, 10395, 1, 4, 17, 1, 149, 0, 0, 4874580, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(528, 10394, 1, 4, 17, 1, 148, 0, 0, 5082000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(529, 10392, 1, 4, 17, 1, 146, 0, 0, 3698730, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(530, 10391, 1, 4, 17, 1, 145, 0, 0, 2674350, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(531, 10390, 1, 4, 17, 1, 144, 0, 0, 6784505, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(532, 10389, 1, 4, 17, 1, 143, 0, 0, 5118750, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(533, 10388, 1, 4, 17, 1, 142, 0, 0, 2745225, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(534, 10387, 1, 2, 2, 5, 453, 2, 0, 5722500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(535, 10386, 1, 2, 2, 5, 452, 1, 0, 4280640, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(536, 10384, 1, 2, 2, 5, 450, 0, 0, 2834040, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(537, 10383, 1, 2, 2, 5, 449, 3, 0, 8546125, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(538, 10382, 1, 2, 2, 4, 328, 3, 0, 7788738, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(539, 10377, 1, 2, 2, 4, 323, 1, 0, 4291950, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(540, 10376, 1, 2, 2, 4, 322, 1, 0, 4464050, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(541, 10375, 1, 2, 2, 4, 321, 2, 0, 5813565, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(542, 10374, 1, 2, 2, 3, 215, 3, 0, 7649840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(543, 10368, 1, 2, 2, 3, 209, 2, 0, 5575150, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(544, 10362, 1, 2, 2, 2, 113, 3, 0, 7664680, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(545, 10360, 1, 2, 2, 1, 6, 2, 0, 5328830, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(546, 10359, 1, 2, 2, 1, 5, 0, 0, 2596890, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(547, 10358, 1, 2, 2, 1, 4, 0, 0, 2580495, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(548, 10355, 1, 2, 2, 1, 1, 2, 0, 5827500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(549, 10350, 1, 2, 3, 5, 454, 3, 0, 8614375, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(550, 10349, 1, 2, 3, 4, 336, 3, 0, 7839900, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(551, 10345, 1, 2, 3, 4, 332, 2, 0, 5624880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(552, 10342, 1, 2, 3, 4, 329, 2, 0, 5749400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(553, 10339, 1, 2, 3, 3, 220, 0, 0, 2628000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(554, 10335, 1, 2, 3, 3, 216, 2, 0, 5578636, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(555, 10317, 1, 2, 4, 5, 459, 3, 0, 8614375, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(556, 10310, 1, 2, 4, 4, 338, 1, 0, 4421650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(557, 10309, 1, 2, 4, 4, 337, 2, 0, 5768780, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(558, 10307, 1, 2, 4, 3, 228, 0, 0, 2611575, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(559, 10305, 1, 2, 4, 3, 226, 0, 0, 2580000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(560, 10302, 1, 2, 4, 3, 223, 2, 0, 5578636, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(561, 10301, 1, 2, 4, 2, 130, 2, 0, 5650056, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(562, 10279, 1, 2, 5, 4, 348, 2, 0, 5716590, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(563, 10276, 1, 2, 5, 4, 345, 2, 0, 5781700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(564, 10256, 1, 2, 5, 1, 22, 2, 0, 5843455, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(565, 10251, 1, 2, 6, 5, 469, 3, 0, 8662500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(566, 10248, 1, 2, 6, 4, 358, 0, 0, 2902305, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(567, 10243, 1, 2, 6, 4, 353, 2, 0, 5781700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(568, 10228, 1, 2, 6, 1, 34, 2, 0, 5337195, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(569, 10223, 1, 2, 6, 1, 29, 2, 0, 5843455, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(570, 10218, 1, 2, 7, 5, 474, 3, 0, 8662500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(571, 10210, 1, 2, 7, 4, 361, 2, 0, 5781700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(572, 10209, 1, 2, 7, 3, 250, 3, 0, 7765200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(573, 10202, 1, 2, 7, 2, 148, 2, 0, 5714776, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(574, 10188, 1, 2, 8, 5, 482, 1, 0, 4345020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(575, 10185, 1, 2, 8, 5, 479, 3, 0, 8662500, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(577, 10180, 1, 2, 8, 4, 372, 2, 0, 5765502, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(578, 10176, 1, 2, 8, 3, 257, 3, 0, 7765200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(579, 10170, 1, 2, 8, 3, 251, 2, 0, 5642906, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(580, 10169, 1, 2, 8, 2, 154, 2, 0, 5714776, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(581, 10157, 1, 2, 8, 1, 43, 2, 0, 5843455, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(582, 10156, 1, 2, 9, 5, 488, 2, 0, 5892600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(583, 10147, 1, 2, 9, 4, 380, 2, 0, 5765502, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(584, 10144, 1, 2, 9, 4, 377, 2, 0, 5781700, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(585, 10143, 1, 2, 9, 3, 264, 3, 0, 7765200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(586, 10114, 1, 2, 10, 4, 388, 2, 0, 5765502, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(587, 10091, 1, 2, 10, 1, 57, 2, 0, 5843455, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(588, 10078, 1, 2, 11, 4, 393, 2, 0, 5878600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(589, 10063, 1, 2, 11, 1, 69, 2, 0, 5395525, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(590, 10053, 1, 2, 12, 5, 499, 3, 0, 8711430, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(591, 10048, 1, 2, 12, 4, 404, 2, 0, 5777730, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(592, 10047, 1, 2, 12, 4, 403, 1, 0, 4376775, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(593, 10045, 1, 2, 12, 4, 401, 2, 0, 5878600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(594, 10038, 1, 2, 12, 3, 279, 2, 0, 5707176, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(595, 10032, 1, 2, 12, 2, 173, 3, 0, 7809880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(596, 10025, 1, 2, 12, 1, 71, 2, 0, 5876100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(597, 10020, 1, 2, 13, 5, 504, 3, 0, 8711430, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(598, 10019, 1, 2, 13, 4, 416, 3, 0, 7927010, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(599, 10017, 1, 2, 13, 4, 414, 0, 0, 2902305, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(600, 10015, 1, 2, 13, 4, 412, 2, 0, 5777730, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(601, 10013, 1, 2, 13, 4, 410, 1, 0, 4458675, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(602, 10012, 1, 2, 13, 4, 409, 2, 0, 5878600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(603, 10011, 1, 2, 13, 3, 292, 3, 0, 7755850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(604, 10010, 1, 2, 13, 3, 291, 0, 0, 2635425, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(605, 10008, 1, 2, 13, 3, 289, 0, 0, 2628000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(606, 10005, 1, 2, 13, 3, 286, 2, 0, 57123176, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(607, 10004, 1, 2, 13, 2, 184, 2, 0, 5779496, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(608, 9999, 1, 2, 13, 2, 179, 3, 0, 7809880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(609, 9997, 1, 2, 13, 1, 83, 2, 0, 5395525, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(610, 9992, 1, 2, 13, 1, 78, 2, 0, 5876100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(611, 9987, 1, 2, 14, 5, 509, 3, 0, 8711430, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(612, 9982, 1, 2, 14, 4, 420, 2, 0, 5777730, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(613, 9980, 1, 2, 14, 4, 418, 1, 0, 4458675, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(614, 9979, 1, 2, 14, 4, 417, 2, 0, 5878600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(615, 9978, 1, 2, 14, 3, 299, 3, 0, 7755850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(616, 9977, 1, 2, 14, 3, 298, 0, 0, 2635425, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(617, 9973, 1, 2, 14, 3, 294, 0, 0, 2656420, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(618, 9972, 1, 2, 14, 3, 293, 2, 0, 5707176, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(619, 9964, 1, 2, 14, 1, 90, 2, 0, 5395525, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(620, 9959, 1, 2, 14, 1, 85, 2, 0, 5876100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(621, 9955, 1, 2, 15, 5, 515, 0, 0, 2779920, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(622, 9954, 1, 2, 15, 5, 514, 3, 0, 8711430, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(623, 9953, 1, 2, 15, 4, 432, 3, 0, 7927010, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(624, 9947, 1, 2, 15, 4, 426, 1, 0, 4458675, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(625, 9946, 1, 2, 15, 4, 425, 2, 0, 5878600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(626, 9943, 1, 2, 15, 3, 304, 0, 0, 2640000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(627, 9942, 1, 2, 15, 3, 303, 0, 0, 2628000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(628, 9941, 1, 2, 15, 3, 302, 0, 0, 2640000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(629, 9940, 1, 2, 15, 3, 301, 0, 0, 2656420, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(630, 9939, 1, 2, 15, 3, 300, 2, 0, 5707176, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(631, 9938, 1, 2, 15, 2, 196, 2, 0, 5779496, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(632, 9931, 1, 2, 15, 1, 97, 2, 0, 5395525, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(633, 9926, 1, 2, 15, 1, 92, 2, 0, 5876100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(634, 9921, 1, 2, 16, 5, 519, 3, 0, 8711430, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(635, 9920, 1, 2, 16, 4, 440, 3, 0, 7927010, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(636, 9912, 1, 2, 16, 3, 313, 3, 0, 7755850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(637, 9910, 1, 2, 16, 3, 311, 0, 0, 2640000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(638, 9909, 1, 2, 16, 3, 310, 0, 0, 2628000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(639, 9908, 1, 2, 16, 3, 309, 0, 0, 2640000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(640, 9907, 1, 2, 16, 3, 308, 0, 0, 2656420, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(641, 9906, 1, 2, 16, 3, 307, 2, 0, 5707176, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(642, 9900, 1, 2, 16, 2, 197, 3, 0, 7809880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(643, 9898, 1, 2, 16, 1, 104, 2, 0, 5395525, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(644, 9893, 1, 2, 16, 1, 99, 2, 0, 5876100, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(645, 9888, 1, 2, 17, 5, 524, 3, 0, 8663565, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(646, 9887, 1, 2, 17, 4, 448, 3, 0, 7883455, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(647, 9885, 1, 2, 17, 4, 446, 0, 0, 2888550, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(648, 9884, 1, 2, 17, 4, 445, 0, 0, 2847285, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(649, 9883, 1, 2, 17, 4, 444, 2, 0, 5686020, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(650, 9880, 1, 2, 17, 4, 441, 2, 0, 5814000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(651, 9877, 1, 2, 17, 3, 318, 0, 0, 2628000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(652, 9874, 1, 2, 17, 3, 315, 0, 0, 2644400, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(653, 9873, 1, 2, 17, 3, 314, 2, 0, 5707176, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(654, 9867, 1, 2, 17, 2, 203, 3, 0, 7767435, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(655, 9832, 1, 1, 2, 7, 640, 1, 0, 4975840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(656, 9824, 1, 1, 2, 6, 467, 1, 0, 5511000, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(657, 9818, 1, 1, 2, 5, 371, 0, 0, 3482200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(658, 9816, 1, 1, 2, 5, 369, 2, 0, 7042325, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(659, 9811, 1, 1, 2, 3, 214, 2, 0, 7203600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(660, 9798, 1, 1, 1, 3, 6, 0, 0, 0, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(661, 9779, 1, 1, 3, 9, 772, 1, 0, 4736445, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(662, 9763, 1, 1, 3, 6, 484, 0, 0, 3672840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(663, 9738, 1, 1, 3, 3, 215, 2, 0, 7225200, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(664, 9726, 1, 1, 3, 1, 9, 2, 0, 6578880, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(665, 9669, 1, 1, 4, 2, 130, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(666, 9584, 1, 1, 6, 10, 995, 2, 0, 7095600, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(667, 9471, 1, 1, 7, 3, 244, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(668, 9466, 1, 1, 7, 3, 239, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(669, 9402, 1, 1, 8, 3, 249, 0, 0, 3324850, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(670, 9322, 1, 1, 9, 1, 55, 0, 0, 3107015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(671, 9254, 1, 1, 10, 1, 62, 0, 0, 3107015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(672, 9182, 1, 1, 11, 1, 65, 2, 0, 6637620, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(673, 9131, 1, 1, 12, 3, 274, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(674, 9063, 1, 1, 13, 3, 280, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(675, 9000, 1, 1, 14, 5, 441, 2, 0, 7039440, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(676, 8990, 1, 1, 14, 3, 281, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(677, 8983, 1, 1, 14, 1, 91, 2, 0, 6861540, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(678, 8927, 1, 1, 15, 3, 292, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(679, 8879, 1, 1, 16, 6, 627, 0, 0, 3672840, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(680, 8854, 1, 1, 16, 3, 293, 2, 0, 7258650, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(681, 8783, 1, 1, 17, 2, 206, 0, 0, 3107015, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(682, 11, 1, 4, 1, 4, 531, 0, 0, 3642601, NULL);
INSERT INTO `flats` (`id`, `external_id`, `res_id`, `house`, `floor`, `section`, `number`, `size`, `square`, `price`, `state`) VALUES(683, 12, 1, 4, 1, 4, 531, 0, 0, 3642601, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `housing`
--

DROP TABLE IF EXISTS `housing`;
CREATE TABLE IF NOT EXISTS `housing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `house` tinyint(4) NOT NULL COMMENT 'номер корпуса',
  `floor` tinyint(4) NOT NULL COMMENT 'этажей',
  `section` tinyint(4) NOT NULL COMMENT 'секций',
  `total_flat` int(11) NOT NULL COMMENT 'всего кв',
  `year` year(4) NOT NULL COMMENT 'год сдачи',
  `state` tinyint(4) NOT NULL,
  `sell` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `housing`
--

INSERT INTO `housing` (`id`, `res_id`, `house`, `floor`, `section`, `total_flat`, `year`, `state`, `sell`) VALUES(1, 1, 1, 1, 1, 260, 2009, 0, 0);
INSERT INTO `housing` (`id`, `res_id`, `house`, `floor`, `section`, `total_flat`, `year`, `state`, `sell`) VALUES(2, 1, 2, 2, 2, 1000, 2003, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ipoteka`
--

DROP TABLE IF EXISTS `ipoteka`;
CREATE TABLE IF NOT EXISTS `ipoteka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'название банка',
  `percent` float NOT NULL COMMENT 'ставка',
  `year` tinyint(4) NOT NULL COMMENT 'до х лет',
  `money` int(11) NOT NULL COMMENT 'до х рублей ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ipoteka`
--

INSERT INTO `ipoteka` (`id`, `name`, `percent`, `year`, `money`) VALUES(1, 'Bank', 12.3, 30, 100000);

-- --------------------------------------------------------

--
-- Структура таблицы `mapping`
--

DROP TABLE IF EXISTS `mapping`;
CREATE TABLE IF NOT EXISTS `mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `x_pos` float NOT NULL,
  `y_pos` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `res_id` (`res_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mapping`
--

INSERT INTO `mapping` (`id`, `res_id`, `x_pos`, `y_pos`) VALUES(12, 1, 59.829, 30.3464);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) DEFAULT NULL COMMENT 'id ЖК',
  `tittle` varchar(200) NOT NULL COMMENT 'Заголовок',
  `description` text NOT NULL COMMENT 'Описание',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `res_id`, `tittle`, `description`, `date`) VALUES(2, 123, 'asdasd', '1wqwqe', '2019-03-01');
INSERT INTO `news` (`id`, `res_id`, `tittle`, `description`, `date`) VALUES(3, NULL, 'asd', 'asdasdas', '2019-03-01');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` int(11) NOT NULL COMMENT 'телефон',
  `res_id` int(11) DEFAULT NULL COMMENT 'id ЖК',
  `flat_id` int(11) DEFAULT NULL COMMENT 'id кв',
  `name` varchar(50) DEFAULT NULL COMMENT 'имя',
  `ask` varchar(200) DEFAULT NULL COMMENT 'вопрос',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'дата',
  `state` tinyint(4) NOT NULL COMMENT 'состояние',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resident`
--

DROP TABLE IF EXISTS `resident`;
CREATE TABLE IF NOT EXISTS `resident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'название жк',
  `link` text,
  `tittle` varchar(200) DEFAULT NULL COMMENT 'заголовок',
  `description` text COMMENT 'описание',
  `tittle1` varchar(100) DEFAULT NULL COMMENT 'для мелких плиток',
  `tittle2` varchar(100) DEFAULT NULL COMMENT 'для мелких плиток',
  `tittle3` varchar(100) DEFAULT NULL COMMENT 'для мелких плиток',
  `description1` varchar(150) DEFAULT NULL COMMENT 'для мелких плиток',
  `description2` varchar(150) DEFAULT NULL COMMENT 'для мелких плиток',
  `description3` varchar(150) DEFAULT NULL COMMENT 'для мелких плиток',
  `metro` varchar(50) DEFAULT NULL COMMENT 'ближайшее метро',
  `address` varchar(200) DEFAULT NULL COMMENT 'адрес ЖК',
  `housing` tinyint(3) UNSIGNED NOT NULL COMMENT 'кол-во корпусов',
  `total_flat` int(10) NOT NULL COMMENT 'кол-во квартир',
  `state` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `resident`
--

INSERT INTO `resident` (`id`, `name`, `link`, `tittle`, `description`, `tittle1`, `tittle2`, `tittle3`, `description1`, `description2`, `description3`, `metro`, `address`, `housing`, `total_flat`, `state`) VALUES(1, 'First', '', 'Try', 'First try add resident', 'asd', '123123', 'wqe', 'asdasd', '123123123', '', 'Звездное', 'ussr', 2, 2600, 1);
INSERT INTO `resident` (`id`, `name`, `link`, `tittle`, `description`, `tittle1`, `tittle2`, `tittle3`, `description1`, `description2`, `description3`, `metro`, `address`, `housing`, `total_flat`, `state`) VALUES(3, 'Second', NULL, 'asd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, 'asd', 'asd', 4, 1234, 2);
INSERT INTO `resident` (`id`, `name`, `link`, `tittle`, `description`, `tittle1`, `tittle2`, `tittle3`, `description1`, `description2`, `description3`, `metro`, `address`, `housing`, `total_flat`, `state`) VALUES(5, 'test', NULL, 'Try', ';lkjhgfghjkl', NULL, NULL, NULL, NULL, NULL, NULL, 'asd', 'ул. Хейкконена 21-2', 1, 10, 0);
INSERT INTO `resident` (`id`, `name`, `link`, `tittle`, `description`, `tittle1`, `tittle2`, `tittle3`, `description1`, `description2`, `description3`, `metro`, `address`, `housing`, `total_flat`, `state`) VALUES(19, 'Thitd', '', '', '', '', '', '', '', '', '', '', '', 2, 2, 1);
INSERT INTO `resident` (`id`, `name`, `link`, `tittle`, `description`, `tittle1`, `tittle2`, `tittle3`, `description1`, `description2`, `description3`, `metro`, `address`, `housing`, `total_flat`, `state`) VALUES(21, 'asd', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tittle` varchar(100) NOT NULL COMMENT 'заголовок',
  `subtittle` varchar(150) DEFAULT NULL COMMENT 'подзаголовок',
  `description` text NOT NULL COMMENT 'описание',
  `discount` float DEFAULT NULL COMMENT 'размер скидки',
  `type` tinyint(4) NOT NULL COMMENT 'тип скидки: 0 - без скидки, 1 - % за кв, 2 - % за кв.м, 3 - сумма за кв, 4 - сумма за кв.м',
  `time` datetime NOT NULL COMMENT 'когда акция кончается',
  `filter` text COMMENT 'для каких кв акция',
  `resident` text COMMENT 'к каким ЖК',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `tittle` varchar(100) NOT NULL COMMENT 'название',
  `link` varchar(150) NOT NULL COMMENT 'ссылка на видео',
  `date` date NOT NULL COMMENT 'дата',
  PRIMARY KEY (`id`),
  KEY `res_id` (`res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `video`
--

INSERT INTO `video` (`id`, `res_id`, `tittle`, `link`, `date`) VALUES(1, 1, 'Try', 'фыв', '2019-03-14');
INSERT INTO `video` (`id`, `res_id`, `tittle`, `link`, `date`) VALUES(2, 1, 'asd', '123123', '0000-00-00');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `commertial`
--
ALTER TABLE `commertial`
  ADD CONSTRAINT `commertial_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `resident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flats`
--
ALTER TABLE `flats`
  ADD CONSTRAINT `flats_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `resident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mapping`
--
ALTER TABLE `mapping`
  ADD CONSTRAINT `mapping_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `resident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `resident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
