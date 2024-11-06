-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 03. 23:42
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `portfolio_jegy`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bill`
--

CREATE TABLE `bill` (
  `id` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bought` varchar(10000) NOT NULL,
  `money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `bill`
--

INSERT INTO `bill` (`id`, `email`, `bought`, `money`) VALUES
('12068862826', 'g@gmail.com', '#5 - Fuji Hegyi túra - Early Bird -2#3 - Fuji Hegyi túra - csoves jegy -2', 4000),
('32776753176', 'i@freemail.com', '#9 - verseny - meet&greet -1', 100000),
('85199442386', 'gonosztelapo@gmail.com', '#2 - Fuji Hegyi túra - VIP jegy -2#9 - verseny - meet&greet -1', 150000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `uploaderid` int(11) NOT NULL,
  `nev` varchar(10000) NOT NULL,
  `img` varchar(255) NOT NULL,
  `leiras` varchar(10000) NOT NULL,
  `ido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `events`
--

INSERT INTO `events` (`id`, `uploaderid`, `nev`, `img`, `leiras`, `ido`) VALUES
(1, 1, 'Fuji Hegyi túra', 'taj.jpg', 'Egy idegenvezető segítségével a Fujit járhatjuk be amely egy nagyon festői környezet', '2025-10-30 08:00:00'),
(13, 1, 'mukodike', 'töri.png', 'ez igy jo?', '2024-10-21 00:07:00'),
(15, 1, 'Shaolin leszámolás', 'kardos.png', 'Jönnek a cigányok karddal', '2024-12-09 18:25:00'),
(16, 1, 'verseny', '1.png', 'Egy barátságtalan gyorsulási versenyt tekinthetnek meg itt...', '2024-12-06 20:52:00'),
(17, 3, 'valami új', 'loading.png', 'vajon mi jön következőnek? ettől biztos leolvad az agyad!', '2024-11-08 23:40:00'),
(18, 1, 'Zsoze meeting', 'letöltés (1).jfif', 'höll, neked ez köll', '2024-11-21 22:46:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tickets`
--

INSERT INTO `tickets` (`id`, `eventid`, `type`, `ar`, `quantity`) VALUES
(1, 1, 'Deluxe Jegy', 10000, 0),
(2, 1, 'VIP jegy', 25000, 16),
(3, 1, 'csoves jegy', 100, 43),
(4, 2, 'Deluxe Jegy', 2000, 10),
(5, 1, 'Early Bird', 1900, 1178),
(6, 2, 'ezres jegy', 1000, 210),
(7, 15, 'kardos jegy', 1000, 0),
(8, 14, 'Doge', 2250, 26),
(9, 16, 'meet&greet', 100000, 2),
(10, 17, 'I.osztály', 3000, 1000),
(11, 17, 'II.osztály', 2000, 100),
(12, 17, 'III.osztály', 1000, 10);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Test1', 'test@gmail.com', '$2y$10$EDbVc8WTiek07b3i5B9G1.bpoR.gfNSPBsF6VnMELKiNKa3U4tCB6'),
(2, 'Roli', 'www.tothroli2003@gmail.com', '$2y$10$REyNeywk1Ji2ZRbJbTVVquklalCf6UeapXQcqD/yi2Fe/sgKA7PK2'),
(3, 'test', 'a@bmail.com', '$2y$10$oP5/rQAp.FeFeC0nEP7KJ.c5RGYJYHL6LWTdURkLkYhGrZf4lDuo2'),
(6, 'xy', 'xy@gmail.com', '$2y$10$qwQnEBqzoCGx2oc9mm6W/uvctzQGqzWRduQvsTTtcG6EVMPSzGFey');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
