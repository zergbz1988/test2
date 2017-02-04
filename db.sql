-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 04 2017 г., 15:45
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test2`
--
CREATE DATABASE IF NOT EXISTS `test2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test2`;

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `title` varchar(120) NOT NULL,
  `message` text NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `title`, `message`, `approved`) VALUES
(1, 'Вася', 'example@mail.com', 'Заголовок тестовый', 'Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый Текст сообщения тестовый ', 1),
(22, 'Vasya', 'test1@test.ru', 'Zagolovok', 'Text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text ', 1),
(23, 'Petya', 'dfghddg@dgbdg.ru', 'Zagolovok 2', 'text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 text2 ', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`, `isAdmin`) VALUES
(1, 'Marat', 'admin@admin.com', '$2y$13$PSGSlo5/nNJxw4.KwgX9CeA2.FbXv27343iS321GyU3y65ktTyY5G', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
