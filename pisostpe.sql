-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2025 a las 22:44:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pisostpe`
--

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
-- Volcado de datos para la tabla `pisos`
--

INSERT INTO `pisos` (`id`, `id_categoria`, `tipo_variante`, `origen`, `acabados_comunes`, `uso_recomendado`) VALUES
(1, 1, 'Marmol Veteado', 'Italia - Grecia', 'Pulido, Apomazado', 'Interiores de lujo, Encimera'),
(3, 2, 'Travertino para Piso ', 'Italia - Turquia', 'Taponado (Pulido/Apomazado)', 'Interiores y Exteriores Generales'),
(4, 3, 'Baldosa de Terracota', 'Artesanal', 'Natural, Sellado, Encerado', 'Rústicos, Cocinas, Patio'),
(8, 2, 'test', 'test', 'test', 'test333');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `level`) VALUES
(1, 'niggerkiller@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$R3F4WjhDY3VWM1pSZVJ4ZQ$UjEl4vmpyaJlW8DKCybxPTd4VMp3gAw61WZ67I9h0jg', 'usuario'),
(2, 'hello@digitaldream.com.ar', '$argon2id$v=19$m=65536,t=4,p=1$YkNmWFcxM3N1V2U1ZXp3dg$fRzICj1JXoFPXOjzIQMjbxnVYPWR9j2d694oSFqSk0I', 'usuario'),
(3, 'hola@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$OGl1UGNrb2luUVdYQk12Vg$wesXt/7/BkDoKwfpFdo3fbkZeEcqH8s/YTiYk7TTewA', 'admin'),
(4, 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$OFpsSmZVak1KVTF2TnJ6cQ$t87sqnFCJgXm3JclisOXlkWNA2hoQ0c27Rr4okp8018', 'usuario'),
(5, 'admin@todopisos.com', '$argon2id$v=19$m=65536,t=4,p=1$L1ZrSWpELjFqeUV6eTF1Rg$Kw5BPARWhFaESnPybXph9FTC+eMaJsjJKdH8sZjpLzw', 'admin');

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `pisos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
