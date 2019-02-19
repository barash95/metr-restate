-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 19 2019 г., 09:44
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

-- --------------------------------------------------------

--
-- Структура таблицы `filter`
--

CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'тип поля фильтра',
  `count` int(11) NOT NULL COMMENT 'количество нажатий',
  `value` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'значение поля',
  `date` date NOT NULL COMMENT 'дата'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `flat`
--

CREATE TABLE `flat` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `house` tinyint(4) NOT NULL COMMENT 'номер корпуса',
  `floor` tinyint(4) NOT NULL COMMENT 'этаж',
  `section` tinyint(4) NOT NULL COMMENT 'секция',
  `number` int(11) NOT NULL COMMENT 'номер кв',
  `size` tinyint(4) NOT NULL COMMENT 'кол-во комнат',
  `square` float NOT NULL COMMENT 'площадь',
  `price` int(11) NOT NULL COMMENT 'цена',
  `state` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `housing`
--

CREATE TABLE `housing` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `house` tinyint(4) NOT NULL COMMENT 'номер корпуса',
  `floor` tinyint(4) NOT NULL COMMENT 'этажей',
  `section` tinyint(4) NOT NULL COMMENT 'секций',
  `total_flat` int(11) NOT NULL COMMENT 'всего кв',
  `year` year(4) NOT NULL COMMENT 'год сдачи'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `ipoteka`
--

CREATE TABLE `ipoteka` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'название банка',
  `percent` float NOT NULL COMMENT 'ставка',
  `year` tinyint(4) NOT NULL COMMENT 'до х лет',
  `money` int(11) NOT NULL COMMENT 'до х рублей '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `mapping`
--

CREATE TABLE `mapping` (
  `res_id` int(11) NOT NULL,
  `x_pos` float NOT NULL,
  `y_pos` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `res_id` int(11) DEFAULT NULL COMMENT 'id ЖК',
  `tittle` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT 'Заголовок',
  `description` text CHARACTER SET utf8 NOT NULL COMMENT 'Описание',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `phone` int(11) NOT NULL COMMENT 'телефон',
  `res_id` int(11) DEFAULT NULL COMMENT 'id ЖК',
  `flat_id` int(11) DEFAULT NULL COMMENT 'id кв',
  `name` varchar(50) DEFAULT NULL COMMENT 'имя',
  `ask` varchar(200) DEFAULT NULL COMMENT 'вопрос',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'дата',
  `state` tinyint(4) NOT NULL COMMENT 'состояние'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resident`
--

CREATE TABLE `resident` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'название жк',
  `tittle` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'заголовок',
  `description` text CHARACTER SET utf8 COMMENT 'описание',
  `tittle1` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'для мелких плиток',
  `tittle2` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'для мелких плиток',
  `tittle3` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'для мелких плиток',
  `description1` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT 'для мелких плиток',
  `description2` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT 'для мелких плиток',
  `description3` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT 'для мелких плиток',
  `metro` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ближайшее метро',
  `address` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'адрес ЖК',
  `housing` tinyint(3) UNSIGNED NOT NULL COMMENT 'кол-во корпусов',
  `total_flat` int(10) NOT NULL COMMENT 'кол-во квартир',
  `state` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `resident`
--

INSERT INTO `resident` (`id`, `name`, `tittle`, `description`, `tittle1`, `tittle2`, `tittle3`, `description1`, `description2`, `description3`, `metro`, `address`, `housing`, `total_flat`, `state`) VALUES
(1, 'First', 'Try', 'First try add resident', NULL, NULL, NULL, NULL, NULL, NULL, 'Звездное', 'ussr', 2, 2600, 1),
(2, 'фыв', 'фыв', 'фыв', NULL, NULL, NULL, NULL, NULL, NULL, 'фыв', 'фыв', 9, 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL COMMENT 'id ЖК',
  `tittle` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'название',
  `link` varchar(150) CHARACTER SET utf8 NOT NULL COMMENT 'ссылка на видео',
  `date` date NOT NULL COMMENT 'дата'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flat`
--
ALTER TABLE `flat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ipoteka`
--
ALTER TABLE `ipoteka`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mapping`
--
ALTER TABLE `mapping`
  ADD PRIMARY KEY (`res_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Индексы таблицы `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `flat`
--
ALTER TABLE `flat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `housing`
--
ALTER TABLE `housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ipoteka`
--
ALTER TABLE `ipoteka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
