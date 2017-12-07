-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2017 a las 02:38:52
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `p_twitter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follow`
--

CREATE TABLE `follow` (
  `idFollow` int(11) NOT NULL,
  `idUserFollows` int(11) NOT NULL,
  `idUserFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `follow`
--

INSERT INTO `follow` (`idFollow`, `idUserFollows`, `idUserFollowed`) VALUES
(2, 3, 1),
(3, 1, 5),
(4, 8, 3),
(5, 8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_user`
--

CREATE TABLE `history_user` (
  `idUser` int(11) NOT NULL,
  `userName` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `userEmail` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `history_user`
--

INSERT INTO `history_user` (`idUser`, `userName`, `userEmail`, `name`, `lastName`) VALUES
(4, 'dito', 'dito@uaq.mx', 'Luis Gerardo', 'García Varela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tweet`
--

CREATE TABLE `tweet` (
  `idTweet` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `tweet` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tweet`
--

INSERT INTO `tweet` (`idTweet`, `idUser`, `type`, `tweet`, `date`, `hour`) VALUES
(2, 1, 0, 'Hello world', '2017-12-06', '00:51:51'),
(3, 1, 1, 'Agua embotellada para la CDMX', '2017-12-06', '00:52:04'),
(7, 3, 0, 'May the force be with you', '2017-12-06', '00:57:58'),
(8, 1, 0, '#HelloWorld', '2017-12-06', '01:00:26'),
(9, 3, 2, 'Se necesitan refuerzos para los rebeldes', '2017-12-06', '01:01:08'),
(10, 5, 0, '#PrimerTuitazo', '2017-12-06', '11:31:55'),
(11, 5, 0, '#SegundoTuitazo', '2017-12-06', '11:32:28'),
(12, 5, 3, 'Quique contagió a Melchor. ', '2017-12-06', '11:34:54'),
(13, 6, 0, '¡Muerte al gluten!', '2017-12-06', '11:43:54'),
(14, 8, 0, 'Hola, este es un mensaje escrito demasiado largo por que no cumple con el numero de caracteres máximo para un tweet, por lo tanto esto ya de', '2017-12-06', '12:10:03'),
(15, 8, 0, 'Este es un tweet de la #uaq #desarrolloWeb', '2017-12-06', '12:11:15'),
(16, 8, 3, 'Se me acabo el papel de baño!! #uaqala', '2017-12-06', '12:13:03'),
(19, 8, 0, '<style>*{color:red !important}</style>', '2017-12-06', '12:18:00'),
(20, 8, 0, ' ', '2017-12-06', '12:20:38'),
(21, 8, 0, 'kasnd    jasdja sd       jas jd       sd', '2017-12-06', '12:21:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `userName` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `userEmail` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `age` tinyint(3) NOT NULL,
  `registerDate` date NOT NULL,
  `photo` varchar(160) COLLATE utf8_spanish_ci DEFAULT 'img/profile_photos/default_user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idUser`, `userName`, `userEmail`, `password`, `name`, `lastName`, `age`, `registerDate`, `photo`) VALUES
(1, 'a_mayorga', 'mayorga.at@gmail.com', '460cd567cc24249b53934ad51951f54b', 'Alberto', 'Mayorga', 24, '2017-12-06', 'img/profile_photos/a_mayorga.jpg'),
(3, 'luke_skywalker', 'luke@skywalker.com', '34912fda12cbd2da49906ea8a70a44e7', 'Luke', 'Skywalker', 80, '2017-12-06', 'img/profile_photos/luke_skywalker.png'),
(5, 'dhdz', 'dhdz.arias@gmail.com', '240b02cfc481dbbf5cab47cfeac47c1c', 'Diego', 'Hernández', 20, '2017-12-06', 'img/profile_photos/dhdz.png'),
(6, 'dito', 'dito@uaq.mx', '3cf34ff5f560e837ba2d29d869f57b82', 'Luis Gerardo', 'García Varela', 20, '2017-12-06', 'img/profile_photos/dito.jpg'),
(7, 'kike', 'kike@uaq.mx', '52fa03c011dc90d9accd0a9bf2de1117', 'Anakike', 'Aguilarwalker', 23, '2017-12-06', 'img/profile_photos/kike.jpg'),
(8, '', 'lalo@uaq.mx', 'ff9b0dcd9e3271d2969b2d9cc9b55ee3', 'Eduardo', 'Aguirre', 27, '2017-12-06', 'img/profile_photos/laloaguirre.png');

--
-- Disparadores `user`
--
DELIMITER $$
CREATE TRIGGER `trigg_history_user` BEFORE DELETE ON `user` FOR EACH ROW INSERT INTO history_user(idUser, userName, userEmail, name, lastName) VALUES(OLD.idUser, OLD.userName, OLD.userEmail, OLD.name, OLD.lastName)
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`idFollow`),
  ADD KEY `fk_user_followed_id` (`idUserFollowed`),
  ADD KEY `fk_user_follows_id` (`idUserFollows`);

--
-- Indices de la tabla `history_user`
--
ALTER TABLE `history_user`
  ADD PRIMARY KEY (`idUser`);

--
-- Indices de la tabla `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`idTweet`),
  ADD KEY `fk_user_id` (`idUser`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `follow`
--
ALTER TABLE `follow`
  MODIFY `idFollow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tweet`
--
ALTER TABLE `tweet`
  MODIFY `idTweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_user_followed_id` FOREIGN KEY (`idUserFollowed`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_follows_id` FOREIGN KEY (`idUserFollows`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
