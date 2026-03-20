-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 24 2026 г., 12:09
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bank_sys`
--

-- --------------------------------------------------------

--
-- Структура таблицы `prixod_operation`
--

CREATE TABLE `prixod_operation` (
  `id` int(11) NOT NULL,
  `id_wallet` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_and_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `prixod_operation`
--

INSERT INTO `prixod_operation` (`id`, `id_wallet`, `total`, `date_and_time`) VALUES
(1, 1, '15000.00', '2025-10-01 09:30:00'),
(2, 2, '250.00', '2025-10-02 11:15:00'),
(3, 3, '7000.00', '2025-10-03 10:00:00'),
(4, 4, '1200.00', '2025-10-04 08:45:00'),
(5, 5, '5000.00', '2025-10-05 14:20:00'),
(6, 1, '18000.00', '2025-10-02 09:30:00'),
(7, 1, '6000.00', '2025-10-03 09:30:00'),
(8, 2, '200.00', '2025-10-03 11:15:00'),
(9, 2, '150.00', '2025-10-04 11:15:00'),
(10, 3, '5000.00', '2025-10-03 10:00:00'),
(11, 3, '3000.00', '2025-10-03 10:00:00'),
(12, 4, '1200.00', '2025-10-04 08:45:00'),
(13, 4, '3500.00', '2025-10-05 08:45:00'),
(14, 5, '4700.00', '2025-10-04 08:45:00'),
(15, 5, '5000.00', '2025-10-05 14:20:00'),
(16, 6, '5000.00', '2025-10-20 11:18:34'),
(17, 12, '8000.00', '2025-10-20 11:20:02'),
(18, 13, '108236.00', '2026-02-24 11:51:00');

-- --------------------------------------------------------

--
-- Структура таблицы `rashod_operation`
--

CREATE TABLE `rashod_operation` (
  `id` int(11) NOT NULL,
  `id_wallet` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_and_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rashod_operation`
--

INSERT INTO `rashod_operation` (`id`, `id_wallet`, `total`, `date_and_time`) VALUES
(1, 1, '3000.00', '2025-10-06 12:00:00'),
(2, 2, '50.00', '2025-10-07 13:45:00'),
(3, 3, '1500.00', '2025-10-06 09:20:00'),
(4, 4, '800.00', '2025-10-06 10:00:00'),
(5, 5, '1000.00', '2025-10-07 11:40:00'),
(6, 1, '35000.00', '2025-10-07 12:00:00'),
(7, 1, '10000.00', '2025-10-08 12:00:00'),
(8, 2, '500.00', '2025-10-08 13:45:00'),
(9, 2, '450.00', '2025-10-09 13:45:00'),
(10, 3, '3500.00', '2025-10-07 09:20:00'),
(11, 3, '5500.00', '2025-10-08 09:20:00'),
(12, 4, '9000.00', '2025-10-07 10:00:00'),
(13, 4, '7000.00', '2025-10-08 10:00:00'),
(14, 5, '5000.00', '2025-10-08 11:40:00'),
(15, 5, '12000.00', '2025-10-09 11:40:00'),
(16, 6, '500.00', '2025-10-20 11:17:46'),
(17, 12, '800.00', '2025-10-20 11:20:13');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$10$QhAM0G.OEAZUdPsazL6Vru6xv3vFYAcconmb//WZq1oxttxsESGiS', 'Administrator', '2026-02-24 08:50:21');

-- --------------------------------------------------------

--
-- Структура таблицы `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `wallet_currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wallet`
--

INSERT INTO `wallet` (`id`, `id_client`, `wallet_currency`) VALUES
(1, 1, 'RUB'),
(2, 2, 'RUB'),
(3, 3, 'EUR'),
(4, 4, 'RUB'),
(5, 5, 'USD'),
(6, 1, 'USD'),
(12, 1, 'RUB'),
(13, 6, 'RUB');

-- --------------------------------------------------------

--
-- Структура таблицы `сlients`
--

CREATE TABLE `сlients` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `сlients`
--

INSERT INTO `сlients` (`id`, `full_name`) VALUES
(1, 'Иванов Иван Иванович'),
(2, 'Петров Петр Петрович'),
(3, 'Сидорова Анна Николаевна'),
(4, 'Кузнецов Сергей Владимирович'),
(5, 'Соколова Мария Андреевна'),
(6, 'Круг Квадрат Треугольник');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `prixod_operation`
--
ALTER TABLE `prixod_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wallet` (`id_wallet`);

--
-- Индексы таблицы `rashod_operation`
--
ALTER TABLE `rashod_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wallet` (`id_wallet`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `сlients`
--
ALTER TABLE `сlients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `prixod_operation`
--
ALTER TABLE `prixod_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `rashod_operation`
--
ALTER TABLE `rashod_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `сlients`
--
ALTER TABLE `сlients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `prixod_operation`
--
ALTER TABLE `prixod_operation`
  ADD CONSTRAINT `prixod_operation_ibfk_1` FOREIGN KEY (`id_wallet`) REFERENCES `wallet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rashod_operation`
--
ALTER TABLE `rashod_operation`
  ADD CONSTRAINT `rashod_operation_ibfk_1` FOREIGN KEY (`id_wallet`) REFERENCES `wallet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `сlients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
