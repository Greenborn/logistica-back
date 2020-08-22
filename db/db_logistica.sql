-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-08-2020 a las 06:23:53
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
(1, 'Tandil');

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
(1, '50'),
(2, '100');

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
  `destination_address` varchar(50) DEFAULT NULL,
  `destination_sucursal` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shipping`
--

INSERT INTO `shipping` (`id`, `origin_full_name`, `origin_contact`, `destination_full_name`, `destination_contact`, `distance_id`, `service_type_id`, `shipping_type_id`, `destination_address`, `destination_sucursal`, `price`, `date`) VALUES
(1, '\'Laion\'', '\'123123123\'', '\'Lalin\'', '\'123123123\'', 1, 1, 1, NULL, 1, 120.5, ''),
(2, '\'Laion\'', '\'123123123\'', '\'Lalin\'', '\'123123123\'', 1, 1, 1, NULL, 1, 120.5, ''),
(3, '\'Laion laion\'', '\'123123123\'', '\'Lalin\'', '\'123123123\'', 1, 1, 1, NULL, 1, 120.5, '\'1598054400\'');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping_item`
--

CREATE TABLE `shipping_item` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `shipping_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `auth_key` varchar(45) DEFAULT NULL,
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

INSERT INTO `user` (`id`, `username`, `password_hash`, `password_reset_token`, `auth_key`, `status`, `created_at`, `updated_at`, `role_id`, `access_id`, `branch_office_id`) VALUES
(1, 'admin', '$2y$13$4WqFx4cJnSy5kVJX53JHK.rUtS9ctKqbjYlsmmXRM3vA0YqF9ryvm\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1);

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
  ADD KEY `shippint_type_index` (`shipping_type_id`),
  ADD KEY `destination_sucursal_index` (`destination_sucursal`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `distance`
--
ALTER TABLE `distance`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `shipping_item`
--
ALTER TABLE `shipping_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `shipping_type`
--
ALTER TABLE `shipping_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Filtros para la tabla `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_2` FOREIGN KEY (`distance_id`) REFERENCES `distance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shipping_ibfk_3` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
