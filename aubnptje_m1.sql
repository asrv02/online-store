-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 16 2023 г., 01:21
-- Версия сервера: 5.7.33-0ubuntu0.16.04.1
-- Версия PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `aubnptje_m1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'лазерные принтеры'),
(2, 'струйные принтеры'),
(3, 'термопринтер');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_id` int(10) UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `sum` int(10) UNSIGNED NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `time`, `status_id`, `count`, `sum`, `reason`, `title`) VALUES
(10, 5, '2023-02-16 09:06:11', 1, 2, 106080, 'yretyer', NULL),
(11, 5, '2023-02-16 07:37:23', 2, 8, 132650, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `count` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `count`, `title`, `price`, `product_id`) VALUES
(6, 10, '1', 'Термопринтер стационарный TSC ', 95090, 9),
(7, 10, '1', 'Принтер струйный Canon Pixma ', 10990, 10),
(8, 11, '1', 'Принтер струйный Canon Pixma ', 10990, 10),
(9, 11, '7', 'Принтер лазерный Brother ', 17380, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `count` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `color`, `price`, `count`, `country`, `view`, `photo`, `category_id`) VALUES
(3, 'Принтер лазерный HP Laser ', '2021', 18980, '20', 'Китай', '107r черно-белый, цвет: белый', '/img/2_1671445144.png', 1),
(4, 'Принтер струйный HP Ink Tank ', '2021', 24990, '20', 'Китай', '115 цветной, цвет: черный', '/img/2_1671445204.png', 2),
(5, 'Принтер лазерный HP Color LaserJet Laser ', '2020', 39990, '25', 'Китай', '150a цветной, цвет: белый', '/img/2_1671445268.png', 1),
(6, 'Принтер струйный HP OfficeJet ', '2022', 15530, '10', 'Корея', '202 цветной, цвет: черный', '/img/2_1671445310.png', 2),
(7, 'Термопринтер стационарный Brother ', '2022', 90940, '10', 'Корея', 'PT-P950NW, светло-серый [ptp950nwr1]', '/img/2_1671445360.png', 3),
(8, 'Термопринтер стационарный TSC ', '2022', 46390, '4', 'Корея', 'TC200, черный [99-059a003-6002]', '/img/2_1671445409.png', 3),
(9, 'Термопринтер стационарный TSC ', '2021', 95090, '3', 'Россия', 'MB340T, черный [99-068a002-1202]', '/img/2_1671445458.png', 3),
(10, 'Принтер струйный Canon Pixma ', '2020', 10990, '11', 'Китай', 'TS304 цветной, цвет: черный [2321c007]', '/img/2_1671445495.png', 2),
(11, 'Принтер лазерный Brother ', '2021', 17380, '0', 'Корея', 'HL-L2300DR черно-белый, цвет: черный [hll2300dr1]', '/img/2_1671445528.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'Новый'),
(2, 'Подтверждённый'),
(3, 'Отменённый ');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `role_id`, `auth_key`) VALUES
(1, 'Angelina', 'Smirnova', NULL, 'qwerty', 'hfghd@yandex.ru', '$2y$13$pQyQkMfjJxAIqWoefNzJVumC5nAFw7iv.7FVqS8v1v.9ZdOh51xgm', 2, 'z-lZHSmJ_llhWbw6mM3e3djI8n6Nw5eD'),
(2, 'admin', 'admin', NULL, 'admin', 'admin@yandex.ru', '$2y$13$a.PqI6MVQrxTWa5hH7oYM.tNLxE1xHz0oXhalTWLIyyKZxq/PvUne', 1, 'FvVavK8je6tmUSeK6Z94BBzUsM_QOZjg'),
(3, 'Qwerty', 'Qwerty', NULL, 'Qwerty@yandex.ru', 'Qwerty', '$2y$13$J8QYIGZv6p9CEUu5qQZKtuyqhfwx9ZwtprXlSJSRAOxnkyovn0Et2', 2, 'EYBuAyWLDOtmstTWx0zPh3k_JpxJQAiq'),
(5, 'we', 'we', NULL, 'we', 'w@w.w', '$2y$13$n0Y69vu9xOi006Rquc/YIeZtUvT16wPsMKeCF0Q4Wwar7mJSoGzo2', 2, 'eygfeCOKtuFxW_BIJIGvVeRzN7iZiyi1'),
(12, 'r', 'r', 'r', 'r', 'r@r.r', '$2y$13$lqW4ftmQVGyJXS205yOr/ud/v9fVKE0w9tNKI/mFS/OhbtT7oS1ji', 2, '2QJ6ZA85V2rx-AInZjXo8Pt7eSyrmqUa');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `id_product` (`product_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`category_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
