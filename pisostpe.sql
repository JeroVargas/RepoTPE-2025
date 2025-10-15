-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `pisostpe`
--

-- Primero, eliminamos las tablas antiguas si existen para empezar de cero.
DROP TABLE IF EXISTS `pisos`;
DROP TABLE IF EXISTS `categorias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--
INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Mármoles'),
(2, 'Travertinos'),
(3, 'Baldosas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--
CREATE TABLE `pisos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `tipo_variante` varchar(255) NOT NULL,
  `origen` varchar(100) NOT NULL,
  `acabados_comunes` varchar(255) NOT NULL,
  `uso_recomendado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `pisos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;
