-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 19 2020 г., 21:28
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `turtrans`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buses`
--

CREATE TABLE `buses` (
  `id` int(11) NOT NULL,
  `brand` varchar(250) DEFAULT NULL,
  `model` varchar(250) DEFAULT NULL,
  `number` varchar(250) DEFAULT NULL,
  `seats` varchar(250) DEFAULT NULL,
  `short_descr` text,
  `full_descr` text,
  `photo` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buses`
--

INSERT INTO `buses` (`id`, `brand`, `model`, `number`, `seats`, `short_descr`, `full_descr`, `photo`, `status`, `carrier_id`) VALUES
(1, 'Scania', 'irizar', 'АТ1287АМ', '80', 'Опис для Scania', 'Опис для Scania. Опис для Scania. Опис для Scania. Опис для Scania. Опис для Scania. ', 'bus1_1579082286.jpg', 1, 2),
(2, 'Mercedes-Benz', 'Tourismo О-350', 'АТ1778АМ', '60', 'Опис для Mercedes-Benz. ', 'Опис для Mercedes-Benz. Опис для Mercedes-Benz. Опис для Mercedes-Benz. Опис для Mercedes-Benz. Опис для Mercedes-Benz. ', 'bus2_1579082296.jpg', 1, 2),
(3, 'Neoplan', 'N 1216 Cityliner', 'АТ3267АМ', '50', 'Опис для Neoplan. ', 'Опис для Neoplan. Опис для Neoplan. Опис для Neoplan. Опис для Neoplan. Опис для Neoplan. ', 'bus3_1577378256.jpg', 1, 2),
(12, 'BMW', 'X6', 'BM32671W', '100', 'Опис для BMW', 'Опис для BMW. Опис для BMW. Опис для BMW. Опис для BMW. Опис для BMW.', 'bus12_1579082343.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `buses_gallery`
--

CREATE TABLE `buses_gallery` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buses_gallery`
--

INSERT INTO `buses_gallery` (`id`, `bus_id`, `photo`) VALUES
(9, 3, 'gallery3_0.jpg'),
(10, 3, 'gallery3_1.jpg'),
(11, 3, 'gallery3_2.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `buses_options`
--

CREATE TABLE `buses_options` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL DEFAULT '0',
  `option_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buses_options`
--

INSERT INTO `buses_options` (`id`, `bus_id`, `option_id`) VALUES
(63, 1, 4),
(62, 1, 3),
(61, 1, 2),
(24, 0, 3),
(66, 2, 5),
(65, 2, 3),
(23, 0, 2),
(22, 7, 1),
(17, 4, 3),
(64, 2, 2),
(25, 0, 5),
(68, 3, 1),
(29, 8, 3),
(34, 9, 3),
(35, 10, 4),
(36, 10, 5),
(39, 11, 2),
(67, 12, 1),
(69, 3, 2),
(70, 3, 4),
(71, 3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `discount` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `promo_price` varchar(250) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `sign` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `type`, `discount`, `price`, `promo_price`, `date_from`, `date_to`, `sign`, `status`, `search`, `carrier_id`) VALUES
(1, 'Кожна 10 поїздка', 1, '5', NULL, NULL, '2019-11-20 00:00:00', '2019-11-25 00:00:00', 0, 1, 1, 2),
(2, 'Новорічна знижка на рейс', 0, NULL, '1000', '300', '2019-12-25 00:00:00', '2020-01-07 00:00:00', 0, 1, 1, 2),
(3, 'Діти: від 5 до 8 років', 1, '10', NULL, NULL, '2019-09-01 00:00:00', '2020-05-31 00:00:00', 0, 1, 0, 2),
(4, 'Кожна 20 поїздка', 1, '8', NULL, NULL, '2019-11-20 00:00:00', '2019-11-25 00:00:00', 1, 1, 1, 2),
(5, 'Різдвяна знижка на рейс', 0, NULL, '1500', '800', '2019-12-25 00:00:00', '2020-01-07 00:00:00', 1, 1, 1, 2),
(6, 'Діти: від 9 до 12 років', 1, '5', NULL, NULL, '2019-09-01 00:00:00', '2020-05-31 00:00:00', 1, 1, 0, 2),
(7, 'Кожна 20 поїздка', 1, '3', NULL, NULL, '2019-11-20 00:00:00', '2019-11-25 00:00:00', 2, 1, 1, 2),
(8, 'Кожна 50 поїздка', 1, '5', NULL, NULL, '2019-12-25 00:00:00', '2020-01-07 00:00:00', 2, 1, 1, 2),
(9, 'Кожна 100 поїздка', 1, '15', NULL, NULL, '2019-12-31 21:55:00', '2020-05-31 00:00:00', 2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `city` varchar(250) DEFAULT NULL,
  `region` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `locations`
--

INSERT INTO `locations` (`id`, `city`, `region`, `country`, `status`, `carrier_id`) VALUES
(1, 'Київ', 'Київська', 'Україна', 1, 2),
(2, 'Мюнхен', NULL, 'Німеччина', 1, 2),
(3, 'Дортмунд', NULL, 'Німеччина', 1, 2),
(4, 'Манчестер', NULL, 'Англія', 1, 2),
(5, 'Прага', NULL, 'Чехія', 1, 2),
(6, 'Кропивницький', 'Кіровоградська', 'Україна', 1, 2),
(7, 'Олександрія', 'Кіровоградська', 'Україна', 1, 2),
(8, 'Львів', 'Львівська', 'Україна', 1, 2),
(9, 'Тернопіль', 'Тернопільска', 'Україна', 1, 2),
(10, 'Вінниця', 'Вінницька', 'Україна', 1, 2),
(11, 'Одеса', 'Одеська', 'Україна', 1, 2),
(12, 'Дніпро', 'Дніпровська', 'Україна', 1, 2),
(13, 'Херсон', 'Херсонська', 'Україна', 1, 2),
(14, 'Миколаїв', 'Миколаївська', 'Україна', 1, 2),
(15, 'Харків', 'Харківська', 'Україна', 1, 2),
(16, 'Варшава', NULL, 'Польща', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `description`, `photo`, `status`, `created`, `carrier_id`) VALUES
(1, 'Тестовая новость', 'Описание тестовой новости', 'news_1579082286.jpg', 1, '2020-09-15 08:21:00', 2),
(4, 'ok;lkl;;kl;k', 'lk;lkll;k  gfkjgrelk rjkghrjkl jkrghklr goiuh oiugr', 'news4_1600172994.jpg', 1, '2020-09-15 15:25:16', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `body` text,
  `created` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `body`, `created`, `status`) VALUES
(5, 1, 'Купівля квитка: Львів-Прага', '2020-09-18 22:34:14', 0),
(6, 1, 'Купівля квитка: Львів-Прага', '2020-09-18 22:34:14', 0),
(7, 1, 'Купівля квитка: Львів-Прага', '2020-09-19 21:21:53', 0),
(8, 1, 'Купівля квитка: Львів-Прага', '2020-09-19 21:21:54', 0),
(9, 1, 'Купівля квитка: Львів-Прага', '2020-09-19 21:25:38', 0),
(10, 1, 'Купівля квитка: Львів-Прага', '2020-09-19 21:25:38', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `options`
--

INSERT INTO `options` (`id`, `name`, `description`, `status`, `carrier_id`) VALUES
(1, 'Кофе', NULL, 1, 2),
(2, 'Чай', NULL, 1, 2),
(3, 'Снікерс', 'Або марс чи баунті', 1, 2),
(4, 'Wi-fi', NULL, 1, 2),
(5, 'Телевізор', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `passengers`
--

CREATE TABLE `passengers` (
  `id` int(11) NOT NULL,
  `name1` varchar(250) DEFAULT NULL,
  `name2` varchar(250) DEFAULT NULL,
  `name3` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `trips_count` int(11) NOT NULL DEFAULT '0',
  `city` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) DEFAULT '1',
  `added_by` varchar(250) DEFAULT NULL,
  `ip` varchar(250) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `passengers`
--

INSERT INTO `passengers` (`id`, `name1`, `name2`, `name3`, `email`, `phone`, `trips_count`, `city`, `country`, `photo`, `pass`, `description`, `status`, `added_by`, `ip`, `last_login`, `last_logout`, `carrier_id`) VALUES
(3, 'Шлюхова', 'Анжела', 'Петрівна', 'pass3@gmail.com', '+380951111111', 20, 'Вінниця', 'Україна', '', '123', 'Непристойно себе поводила та залицялася до інших пасажирів', 1, NULL, '192.168.1.1', '2019-11-21 10:00:00', '2019-11-21 11:00:00', 2),
(1, 'Кресяк', 'Василь', 'Васильович', 'vasylovych.gmail.com', '+380661111111', 50, 'Трускавець', 'Україна', 'passenger1_1577375024.jpg', '123', 'Розбив вікно', 1, 'Ігор Марков', '192.168.100.200', '2019-11-23 14:34:33', '2019-11-23 14:31:21', 2),
(2, 'Бухарев', 'Антон', 'Васильович', 'pass2@gmail.com', '+380662222222', 30, 'Львів', 'Україна', '', '123', 'Зайшов в автобус набуханний та обригав свого сусіда зліва', 1, NULL, '192.168.5.8', '2019-11-20 14:00:00', '2019-11-20 21:00:00', 2),
(17, 'huiyiihuhuh', 'huhuhu', NULL, 'uhhuhuh', 'huuhuhuh', 0, NULL, NULL, NULL, 'uhuhuhu', NULL, 1, NULL, '127.0.0.1', '2020-01-24 16:26:10', NULL, 1),
(16, 'Марков', 'Ігор', 'Олегович', 'markov.io.1982@gmail.com', '+380951234567', 15, 'Кропивницький', 'Україна', 'passenger16_1579192947.jpg', '123', 'Взагалі нічого цікавого', 1, NULL, '127.0.0.1', '2020-09-19 19:58:55', '2020-01-24 16:26:24', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`, `description`, `status`, `carrier_id`) VALUES
(6, 'Водій', 'Водій опис ...', 1, 2),
(7, 'Механік', '', 1, 2),
(3, 'Директор', NULL, 1, 2),
(4, 'Бухгалтер', NULL, 1, 2),
(5, 'Стюард', 'Ніхто не розуміє навіщо він тут потрібен', 0, 2),
(1, 'Адміністратор', 'Супер-адмін', 1, 0),
(2, 'Перевізник', 'Перевізник - адмін у своїй системі', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `position_id` int(1) NOT NULL DEFAULT '0',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  `del` tinyint(1) NOT NULL DEFAULT '0',
  `locations` tinyint(1) NOT NULL DEFAULT '0',
  `buses` tinyint(1) NOT NULL DEFAULT '0',
  `options` tinyint(1) NOT NULL DEFAULT '0',
  `personnel` tinyint(1) NOT NULL DEFAULT '0',
  `positions` tinyint(1) NOT NULL DEFAULT '0',
  `roles` tinyint(1) NOT NULL DEFAULT '0',
  `discounts` tinyint(1) NOT NULL DEFAULT '0',
  `stops` tinyint(1) NOT NULL DEFAULT '0',
  `trips` tinyint(1) NOT NULL DEFAULT '0',
  `tickets` tinyint(1) NOT NULL DEFAULT '0',
  `site_info` tinyint(1) NOT NULL DEFAULT '0',
  `passengers` tinyint(1) NOT NULL DEFAULT '0',
  `admins` tinyint(1) NOT NULL DEFAULT '0',
  `news` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `position_id`, `edit`, `del`, `locations`, `buses`, `options`, `personnel`, `positions`, `roles`, `discounts`, `stops`, `trips`, `tickets`, `site_info`, `passengers`, `admins`, `news`, `carrier_id`) VALUES
(1, 'Доступи супер-адміна', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(2, 'Доступи перевізника №1', 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0),
(3, 'Доступи водія №1', 6, 0, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 2),
(9, 'Доступи перевізника №2', 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0),
(4, 'Доступи директора №1', 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `stops`
--

CREATE TABLE `stops` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stops`
--

INSERT INTO `stops` (`id`, `city_id`, `name`, `address`, `status`, `carrier_id`) VALUES
(1, 1, 'супермаркет Копілка', 'вулиця Велика Перспективна, 20', 1, 2),
(2, 1, 'Стрийський', 'вулиця Стрийська, 109', 1, 2),
(3, 1, 'Приміський автовокзал', 'вулиця Білогірська, 1', 1, 2),
(5, 2, 'Пивний бар \"Баварія\"', NULL, 1, 2),
(6, 2, 'Футбольний стадіон', NULL, 1, 2),
(7, 8, 'Львівська №1', NULL, 1, 2),
(8, 8, 'Львівська №2', NULL, 1, 2),
(9, 16, 'Варшавська №1', NULL, 1, 2),
(10, 16, 'Варшавська №2', NULL, 1, 2),
(11, 5, 'Празька №1', NULL, 1, 2),
(12, 5, 'Празька №2', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL DEFAULT '0',
  `name1` varchar(250) DEFAULT NULL,
  `name2` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `loc_from_id` int(11) NOT NULL DEFAULT '0',
  `loc_to_id` int(11) NOT NULL DEFAULT '0',
  `number` varchar(250) DEFAULT NULL,
  `date_buy` datetime DEFAULT NULL,
  `date_departure` datetime DEFAULT NULL,
  `seat` int(11) NOT NULL DEFAULT '0',
  `cost` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_reserv_start` datetime DEFAULT NULL,
  `date_reserv_end` datetime DEFAULT NULL,
  `discount_id` int(11) NOT NULL DEFAULT '0',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `passenger_id`, `name1`, `name2`, `email`, `phone`, `trip_id`, `loc_from_id`, `loc_to_id`, `number`, `date_buy`, `date_departure`, `seat`, `cost`, `status`, `date_reserv_start`, `date_reserv_end`, `discount_id`, `carrier_id`) VALUES
(1, 16, 'Ігор', 'Марков', 'markov.io.1982@gmail.com', '+380951234567', 10, 1, 4, 'YT000825bsa', NULL, '2019-01-15 12:35:00', 15, '800', 1, '2019-01-14 10:36:57', '2019-01-14 22:36:57', 0, 2),
(2, 16, 'Петро', 'Порошенко', 'petro@gmail.com', '+380951234569', 20, 6, 10, 'YT000833wer', '2019-01-14 09:36:57', '2019-01-17 18:10:00', 44, '1200', 2, NULL, NULL, 0, 2),
(22, 16, 'Ігор', 'Марков', 'markov.io.1982@gmail.com', '+380951234567', 13, 8, 5, '2WDYZLNXMB', '2020-09-19 21:21:35', '2020-09-19 00:00:00', 4, '360', 2, NULL, NULL, 0, 0),
(19, 16, 'Ігор', 'Марков', 'markov.io.1982@gmail.com', '+380951234567', 13, 8, 5, '830JSCIZXV', '2020-09-16 16:50:48', '2020-02-28 00:00:00', 3, '380', 2, NULL, NULL, 0, 0),
(21, 16, 'Ігор', 'Марков', 'markov.io.1982@gmail.com', '+380951234567', 13, 8, 5, 'LFP8N7AHIK', '2020-09-19 21:21:35', '2020-09-19 00:00:00', 3, '380', 2, NULL, NULL, 0, 0),
(20, 16, 'Ігор', 'Марков', 'markov.io.1982@gmail.com', '+380951234567', 13, 8, 5, 'V5T96GKXNM', '2020-09-16 16:50:48', '2020-02-28 00:00:00', 4, '360', 2, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `loc_from_id` int(11) NOT NULL DEFAULT '0',
  `stop_from_id` int(11) NOT NULL DEFAULT '0',
  `start_time` time DEFAULT NULL,
  `loc_to_id` int(11) NOT NULL DEFAULT '0',
  `stop_to_id` int(11) NOT NULL DEFAULT '0',
  `end_time` time DEFAULT NULL,
  `bus_id` int(11) NOT NULL DEFAULT '0',
  `blocked_dates` text,
  `blocked_seats` text,
  `reserv_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `carrier_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trips`
--

INSERT INTO `trips` (`id`, `loc_from_id`, `stop_from_id`, `start_time`, `loc_to_id`, `stop_to_id`, `end_time`, `bus_id`, `blocked_dates`, `blocked_seats`, `reserv_disabled`, `carrier_id`) VALUES
(8, 8, 7, '10:00:00', 2, 6, '17:00:00', 12, '24-01-2020,25-01-2020', '', 0, 2),
(13, 1, 1, '08:00:00', 2, 5, '18:00:00', 2, '24-01-2020,25-01-2020', '10,15,20,25,30,35,40,45,50,55', 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `trips_discounts`
--

CREATE TABLE `trips_discounts` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `discount_id` int(11) NOT NULL DEFAULT '0',
  `trips_from` varchar(250) DEFAULT NULL,
  `trips_to` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trips_discounts`
--

INSERT INTO `trips_discounts` (`id`, `trip_id`, `discount_id`, `trips_from`, `trips_to`) VALUES
(89, 13, 9, '100', '1000'),
(88, 13, 8, '50', '99'),
(87, 13, 7, '20', '49'),
(86, 13, 6, NULL, NULL),
(85, 13, 2, NULL, NULL),
(84, 13, 1, NULL, NULL),
(83, 13, 3, NULL, NULL),
(82, 8, 5, NULL, NULL),
(81, 8, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `trips_prices`
--

CREATE TABLE `trips_prices` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `loc_from_id` int(11) NOT NULL DEFAULT '0',
  `loc_to_id` int(11) NOT NULL DEFAULT '0',
  `price` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trips_prices`
--

INSERT INTO `trips_prices` (`id`, `trip_id`, `loc_from_id`, `loc_to_id`, `price`) VALUES
(263, 13, 5, 2, '800'),
(262, 13, 16, 2, '500'),
(261, 13, 16, 5, '400'),
(260, 13, 8, 2, '300'),
(259, 13, 8, 5, '400'),
(258, 13, 8, 16, '100'),
(257, 13, 1, 2, '1200'),
(256, 13, 1, 5, '300'),
(255, 13, 1, 16, '200'),
(53, 14, 1, 8, '100'),
(54, 14, 1, 16, '200'),
(55, 14, 1, 2, '800'),
(56, 14, 8, 16, ''),
(57, 14, 8, 2, ''),
(58, 14, 16, 2, ''),
(254, 13, 1, 8, '100'),
(253, 8, 5, 2, '500'),
(252, 8, 8, 2, '800'),
(251, 8, 8, 5, '200');

-- --------------------------------------------------------

--
-- Структура таблицы `trips_seats_reserv`
--

CREATE TABLE `trips_seats_reserv` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `seats` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trips_seats_reserv`
--

INSERT INTO `trips_seats_reserv` (`id`, `trip_id`, `date`, `seats`) VALUES
(74, 13, '2020-02-28', '22,23'),
(73, 13, '2020-02-27', '1,2,3,4');

-- --------------------------------------------------------

--
-- Структура таблицы `trips_stops`
--

CREATE TABLE `trips_stops` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `loc_id` int(11) NOT NULL DEFAULT '0',
  `stop_id` int(11) NOT NULL DEFAULT '0',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `distance` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trips_stops`
--

INSERT INTO `trips_stops` (`id`, `trip_id`, `loc_id`, `stop_id`, `start_time`, `end_time`, `distance`) VALUES
(118, 14, 16, 1, '06:27:00', '03:27:00', ''),
(181, 13, 5, 11, '15:30:00', '16:30:00', '20'),
(180, 13, 16, 9, '13:00:00', '14:00:00', '15'),
(117, 14, 8, 1, '05:27:00', '08:27:00', ''),
(179, 13, 8, 7, '10:00:00', '11:00:00', '10'),
(178, 8, 5, 12, '14:00:00', '15:00:00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `position_id` int(11) DEFAULT '0',
  `phone` varchar(250) DEFAULT NULL,
  `login` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `ip` varchar(250) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `carrier_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `position_id`, `phone`, `login`, `email`, `pass`, `photo`, `status`, `ip`, `last_login`, `last_logout`, `carrier_id`, `role_id`) VALUES
(3, 'Гіві Камікадзе', 6, '+380951111111', 'driver1', 'driver1@gmail.com', '123', '', 1, '::1', '2019-12-01 10:14:35', '2019-12-01 10:14:42', 2, 3),
(4, 'Артем Рукожопов', 7, '+380952222222', 'mechanic1', 'mechanic1@gmail.com', '123', '', 1, '192.168.1.2', '2019-11-21 15:00:00', '2019-11-21 20:00:00', 2, 3),
(5, 'Генадій Дятлов', 3, '+380953333333', 'director1', 'director1@gmail.com', '123', 'user5_1577375330.jpg', 1, '192.168.1.3', '2019-11-22 12:00:00', '2019-11-23 16:00:00', 2, 4),
(1, 'Ігор Марков', 1, '+380661111111', 'admin', 'markov.io.1982@gmail.com', 'admin', 'user1_1577375377.jpg', 1, '127.0.0.1', '2020-09-18 15:41:02', '2019-12-26 18:51:52', 0, 1),
(2, 'Олег Ковальчук', 2, '+380662222222', 'carrier1', 'carrier1@gmail.com', '123', 'user2_1577375216.jpg', 1, '::1', '2019-12-01 10:43:30', '2019-12-01 10:46:34', 0, 2),
(13, 'Сашко Дебіленко', 2, '+380664444444', 'carrier2', 'carrier2@gmail.com', '123', 'user13_1577375223.jpg', 1, '::1', '2019-12-01 10:46:40', '2019-12-01 10:47:28', 0, 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `buses_gallery`
--
ALTER TABLE `buses_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `buses_options`
--
ALTER TABLE `buses_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trips_discounts`
--
ALTER TABLE `trips_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trips_prices`
--
ALTER TABLE `trips_prices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trips_seats_reserv`
--
ALTER TABLE `trips_seats_reserv`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trips_stops`
--
ALTER TABLE `trips_stops`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `buses_gallery`
--
ALTER TABLE `buses_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `buses_options`
--
ALTER TABLE `buses_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `stops`
--
ALTER TABLE `stops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `trips_discounts`
--
ALTER TABLE `trips_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT для таблицы `trips_prices`
--
ALTER TABLE `trips_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT для таблицы `trips_seats_reserv`
--
ALTER TABLE `trips_seats_reserv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT для таблицы `trips_stops`
--
ALTER TABLE `trips_stops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
