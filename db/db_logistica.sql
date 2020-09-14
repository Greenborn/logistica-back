-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-09-2020 a las 22:54:52
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_logistica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `last_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_office`
--

CREATE TABLE `branch_office` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `branch_office`
--

INSERT INTO `branch_office` (`id`, `name`) VALUES
(1, 'Tandil'),
(2, 'Mar del Plata'),
(3, 'Flores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_office_has_service_type`
--

CREATE TABLE `branch_office_has_service_type` (
  `branch_office_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_office_has_shipping_type`
--

CREATE TABLE `branch_office_has_shipping_type` (
  `branch_office_id` int(11) NOT NULL,
  `shipping_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distance`
--

CREATE TABLE `distance` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `distance`
--

INSERT INTO `distance` (`id`, `description`) VALUES
(1, '50 km'),
(2, '100 km'),
(3, '150 km');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identification`
--

CREATE TABLE `identification` (
  `id` int(11) NOT NULL,
  `value` varchar(15) NOT NULL,
  `identification_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `identification`
--

INSERT INTO `identification` (`id`, `value`, `identification_type`) VALUES
(1, '34058938', 1),
(2, '34458765', 1),
(3, '34458765', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identification_type`
--

CREATE TABLE `identification_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `identification_type`
--

INSERT INTO `identification_type` (`id`, `name`) VALUES
(1, 'DNI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `type`) VALUES
(1, 'administrator');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_type`
--

CREATE TABLE `service_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `service_type`
--

INSERT INTO `service_type` (`id`, `description`) VALUES
(1, 'Estándar (48hs a 72hs)'),
(2, 'Urgente (24hs)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `origin_full_name` varchar(45) DEFAULT NULL,
  `origin_contact` varchar(45) DEFAULT NULL,
  `destination_full_name` varchar(45) DEFAULT NULL,
  `destination_contact` varchar(45) DEFAULT NULL,
  `distance_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `shipping_type_id` int(11) NOT NULL,
  `origin_address` varchar(50) DEFAULT NULL,
  `destination_address` varchar(50) DEFAULT NULL,
  `origin_branch_office` int(11) DEFAULT NULL,
  `destination_branch_office` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `payment_at_origin` tinyint(1) NOT NULL,
  `sender_identification_id` int(11) DEFAULT NULL,
  `receiver_identification_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shipping`
--

INSERT INTO `shipping` (`id`, `origin_full_name`, `origin_contact`, `destination_full_name`, `destination_contact`, `distance_id`, `service_type_id`, `shipping_type_id`, `origin_address`, `destination_address`, `origin_branch_office`, `destination_branch_office`, `price`, `date`, `status`, `payment_at_origin`, `sender_identification_id`, `receiver_identification_id`) VALUES
(2, 'Lalin', '123123123', 'Lalin', '123123123', 1, 1, 1, NULL, NULL, 1, 2, 120.5, '', 1, 1, 1, 1),
(3, 'la pipol', '123123123', 'Lalin', '123123123', 1, 1, 1, NULL, NULL, 1, 3, 120.5, '1598054400', 2, 1, 1, 1),
(4, 'Laionel Díaz', '123123123 12', 'Lalin y Lalon', '12331231 23', 1, 1, 1, NULL, NULL, 1, 2, 120.5, '1598138612', 3, 1, 1, 1),
(5, 'Laionel Díaz de la zamponia', '123123123 12', 'Lalin y Lalon y lalazo', '12331231 23', 1, 1, 1, NULL, NULL, 1, 2, 122.5, '1598140517', 1, 1, 1, 1),
(6, 'Marco Antonio Solis', '123123123 12', 'Maracaibo y andresito', '12331231 23', 1, 1, 1, NULL, NULL, 1, 2, 120.5, '1598142750', 2, 1, 1, 1),
(9, 'Laion algo mas o algo menos', '2494533698', 'Maracaibo Sunset', '2284533698', 1, 1, 1, NULL, NULL, 1, 2, 120.5, '1598545252', 1, 1, 1, 1),
(10, 'Laion algo mas o algo menos', '2494533698', 'Maracaibo Sunset', '2284533698', 1, 1, 1, NULL, NULL, 1, 2, 120.5, '1598545266', 2, 1, 1, 1),
(11, 'Laion algo mas o algo menos', '2494533698', 'Maracaibo Sunset', '2284533698', 1, 1, 1, NULL, NULL, 1, 2, 120.5, '1598545688', 1, 1, 1, 1),
(23, 'Alana Ilbran', '2494533698', 'Alberto Gageti', '2284533698', 1, 1, 1, 'San Martin 1200', 'Rivadavía 500, esquina uriburu', 3, 2, 120.5, '1599158940', 1, 1, 1, 1),
(25, 'Laion algo mas', '2494533698', 'Maracaibo', '2284533698', 1, 1, 1, NULL, NULL, 3, 1, 120.5, '1599323598', 1, 1, 1, 1),
(26, 'Pedido con remito en respuesta', '2494533698', 'Solaris AB ocular 2', '2284533698', 1, 1, 1, NULL, NULL, 3, 2, 420.5, '1599541394', 1, 1, 1, 1),
(27, 'Pedido con remito en respuesta', '2494533698', 'Solaris AB ocular 2', '2284533698', 1, 1, 1, NULL, NULL, 3, 2, 420.5, '1599541427', 1, 1, 1, 1),
(28, 'Pedido con remito en respuesta version 2', '2494533698', 'Solaris AB ocular 2', '2284533698', 1, 1, 1, NULL, NULL, 3, 2, 420.5, '1599541488', 1, 1, 1, 1),
(29, 'Respuesta version 2', '2494533698', 'Solaris AB ocular 2', '2284533698', 1, 1, 1, NULL, NULL, 3, 2, 420.5, '1599541535', 1, 1, 1, 1),
(30, 'Respuesta version 2', '2494533698', 'Solaris AB ocular 2', '2284533698', 1, 1, 1, NULL, NULL, 3, 2, 420.5, '1599769444', 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping_item`
--

CREATE TABLE `shipping_item` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `shipping_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shipping_item`
--

INSERT INTO `shipping_item` (`id`, `item`, `shipping_id`) VALUES
(3, 'un radioalbum', 23),
(5, 'descripción del nuevo item', 25),
(6, 'otro item mas', 25),
(7, 'Un color esperanza', 26),
(8, 'Un sonido alegría', 26),
(9, 'Un color esperanza', 27),
(10, 'Un sonido alegría', 27),
(11, 'Un color esperanza', 28),
(12, 'Un sonido alegría', 28),
(13, 'Un color esperanza', 29),
(14, 'Un sonido alegría', 29),
(15, 'Un color esperanza', 30),
(16, 'Un sonido alegría', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping_type`
--

CREATE TABLE `shipping_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shipping_type`
--

INSERT INTO `shipping_type` (`id`, `description`) VALUES
(1, 'Sucursal a Sucursal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `access_token` varchar(128) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `access_id` int(11) DEFAULT NULL,
  `branch_office_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `password_reset_token`, `access_token`, `status`, `created_at`, `updated_at`, `role_id`, `access_id`, `branch_office_id`) VALUES
(1, 'admin', '$2y$13$maydzLNRwqH4cQP2L8FCQu6OxIU/.GpzxwRxcqM3Tnzhk9uLMzcrm', NULL, '$2y$13$2/EF2ACv9kptY8XGXOC0QuDc2Do.UoCBikl9nxDHiaTlEj7d.1Sr.%', 1, NULL, NULL, 1, NULL, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `access`
--
ALTER TABLE `access`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `branch_office`
--
ALTER TABLE `branch_office`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `branch_office_has_service_type`
--
ALTER TABLE `branch_office_has_service_type`
  ADD KEY `branch_office_index` (`branch_office_id`),
  ADD KEY `service_type_index` (`service_type_id`);

--
-- Indices de la tabla `branch_office_has_shipping_type`
--
ALTER TABLE `branch_office_has_shipping_type`
  ADD KEY `branch_office_index` (`branch_office_id`),
  ADD KEY `shipping_type_index` (`branch_office_id`),
  ADD KEY `branch_office_has_shipping_type_ibfk_2` (`shipping_type_id`);

--
-- Indices de la tabla `distance`
--
ALTER TABLE `distance`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `identification`
--
ALTER TABLE `identification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `identification_type_id` (`identification_type`) USING BTREE;

--
-- Indices de la tabla `identification_type`
--
ALTER TABLE `identification_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distance_index` (`distance_id`),
  ADD KEY `service_type_index` (`service_type_id`),
  ADD KEY `destination_branch_office` (`destination_branch_office`),
  ADD KEY `shipping_type_index` (`shipping_type_id`) USING BTREE,
  ADD KEY `origin_branch_office_index` (`origin_branch_office`),
  ADD KEY `sender_id_index` (`sender_identification_id`) USING BTREE,
  ADD KEY `receiver_id_index` (`receiver_identification_id`) USING BTREE;

--
-- Indices de la tabla `shipping_item`
--
ALTER TABLE `shipping_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_index` (`shipping_id`);

--
-- Indices de la tabla `shipping_type`
--
ALTER TABLE `shipping_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role1_idx` (`role_id`),
  ADD KEY `fk_user_access1_idx` (`access_id`),
  ADD KEY `branch_office_index` (`branch_office_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `branch_office`
--
ALTER TABLE `branch_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `distance`
--
ALTER TABLE `distance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `identification`
--
ALTER TABLE `identification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `identification_type`
--
ALTER TABLE `identification_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `service_type`
--
ALTER TABLE `service_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `shipping_item`
--
ALTER TABLE `shipping_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `shipping_type`
--
ALTER TABLE `shipping_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `branch_office_has_service_type`
--
ALTER TABLE `branch_office_has_service_type`
  ADD CONSTRAINT `branch_office_has_service_type_ibfk_1` FOREIGN KEY (`branch_office_id`) REFERENCES `branch_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `branch_office_has_service_type_ibfk_2` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `branch_office_has_shipping_type`
--
ALTER TABLE `branch_office_has_shipping_type`
  ADD CONSTRAINT `branch_office_has_shipping_type_ibfk_1` FOREIGN KEY (`branch_office_id`) REFERENCES `branch_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `branch_office_has_shipping_type_ibfk_2` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `identification`
--
ALTER TABLE `identification`
  ADD CONSTRAINT `identification_ibfk_1` FOREIGN KEY (`identification_type`) REFERENCES `identification_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_2` FOREIGN KEY (`distance_id`) REFERENCES `distance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_3` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_4` FOREIGN KEY (`destination_branch_office`) REFERENCES `branch_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_5` FOREIGN KEY (`origin_branch_office`) REFERENCES `branch_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_6` FOREIGN KEY (`sender_identification_id`) REFERENCES `identification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_7` FOREIGN KEY (`receiver_identification_id`) REFERENCES `identification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `shipping_item`
--
ALTER TABLE `shipping_item`
  ADD CONSTRAINT `shipping_item_ibfk_1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`branch_office_id`) REFERENCES `branch_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`access_id`) REFERENCES `access` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
