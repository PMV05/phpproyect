-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2025 a las 15:06:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `opportunihubdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribution_list`
--

CREATE TABLE `distribution_list` (
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distribution_list`
--

INSERT INTO `distribution_list` (`email`) VALUES
('jjvega20@yahoo.com'),
('jonathan.vega14@upr.edu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opportunities`
--

CREATE TABLE `opportunities` (
  `oppID` int(11) NOT NULL,
  `oppType` int(11) NOT NULL,
  `ownerUserID` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `sponsor` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `attachmentPath` varchar(100) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `datePosted` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opportunities`
--

INSERT INTO `opportunities` (`oppID`, `oppType`, `ownerUserID`, `title`, `description`, `sponsor`, `url`, `attachmentPath`, `deadline`, `datePosted`) VALUES
(1, 1, 'jonathan.vega', 'Web Developer', 'Esto es solo una descripcion de ejemplo:\r\n\r\nRequisitos:\r\n\r\n* Matricula\r\n* Resume', 'INVID', 'https://invidgroup.com/', '', '2025-12-07', '2025-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opportunities_type`
--

CREATE TABLE `opportunities_type` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opportunities_type`
--

INSERT INTO `opportunities_type` (`typeID`, `typeName`) VALUES
(1, 'Empleo'),
(2, 'Internado'),
(3, 'Beca'),
(4, 'Proyecto de Investigación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`) VALUES
(1, 'Contribuidor'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `userID` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `userRole`) VALUES
('jonathan.vega', 'jonathan.vega14@upr.edu', '$2y$10$Sw1u9PtBu71.qT8o.xJMiO.bqBnbnYeOTB9X4tLTSzWhp58TR9uGm', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `distribution_list`
--
ALTER TABLE `distribution_list`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `opportunities`
--
ALTER TABLE `opportunities`
  ADD PRIMARY KEY (`oppID`),
  ADD KEY `ownerUserID` (`ownerUserID`),
  ADD KEY `fk_opp_type` (`oppType`);

--
-- Indices de la tabla `opportunities_type`
--
ALTER TABLE `opportunities_type`
  ADD PRIMARY KEY (`typeID`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_role` (`userRole`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `opportunities`
--
ALTER TABLE `opportunities`
  MODIFY `oppID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `opportunities_type`
--
ALTER TABLE `opportunities_type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `opportunities`
--
ALTER TABLE `opportunities`
  ADD CONSTRAINT `fk_opp_type` FOREIGN KEY (`oppType`) REFERENCES `opportunities_type` (`typeID`),
  ADD CONSTRAINT `fk_opp_user` FOREIGN KEY (`ownerUserID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`userRole`) REFERENCES `roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
