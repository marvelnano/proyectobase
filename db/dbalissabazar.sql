-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-05-2022 a las 23:55:38
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbhermano`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_usuario_negocio`
--

CREATE TABLE `codigo_usuario_negocio` (
  `idcodigousuarionegocio` varchar(8) NOT NULL,
  `idusuario` varchar(8) NOT NULL,
  `idnegocio` varchar(8) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='código único generado para que usuario le de a conocer a la ';

--
-- Disparadores `codigo_usuario_negocio`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_codigo_usuario_negocio` BEFORE INSERT ON `codigo_usuario_negocio` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM codigo_usuario_negocio) = 0   THEN
        SET NEW.idcodigousuarionegocio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idcodigousuarionegocio = (SELECT MAX(idcodigousuarionegocio)+1 FROM codigo_usuario_negocio);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `idnegocio` varchar(8) NOT NULL,
  `idrubronegocio` varchar(8) NOT NULL,
  `ruc` varchar(11) NOT NULL,
  `razon_social` varchar(250) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `celular` varchar(9) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `pagina_web` varchar(200) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='negocios que darán comisiones por conseguir usuarios.';

--
-- Disparadores `negocio`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_negocio` BEFORE INSERT ON `negocio` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM negocio) = 0   THEN
        SET NEW.idnegocio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idnegocio = (SELECT MAX(idnegocio)+1 FROM negocio);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_usuario`
--

CREATE TABLE `nivel_usuario` (
  `idnivelusuario` varchar(8) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nivel_usuario`
--

INSERT INTO `nivel_usuario` (`idnivelusuario`, `descripcion`, `estado`, `usuariocrea`, `fechacrea`, `usuariomodifica`, `fechamodifica`) VALUES
('20220001', 'Administrador', 1, '20220001', '2022-05-18 17:46:01', NULL, NULL);

--
-- Disparadores `nivel_usuario`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_nivelusuario` BEFORE INSERT ON `nivel_usuario` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM nivel_usuario) = 0   THEN
        SET NEW.idnivelusuario = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idnivelusuario = (SELECT MAX(idnivelusuario)+1 FROM nivel_usuario);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE `plantilla` (
  `id` int(11) NOT NULL,
  `barraSuperior` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `textoSuperior` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `colorFondo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `colorTexto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `logo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `icono` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `categoria` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `redesSociales` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `apiFacebook` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `pixelFacebook` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `googleAnalytics` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plantilla`
--

INSERT INTO `plantilla` (`id`, `barraSuperior`, `textoSuperior`, `colorFondo`, `colorTexto`, `logo`, `icono`, `categoria`, `redesSociales`, `apiFacebook`, `pixelFacebook`, `googleAnalytics`) VALUES
(1, NULL, NULL, NULL, NULL, 'vistas/img/plantilla/logo.png', 'vistas/img/plantilla/icono.png', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla_web`
--

CREATE TABLE `plantilla_web` (
  `idplantillaweb` varchar(8) NOT NULL,
  `idnegocio` varchar(8) NOT NULL,
  `idplantillawebseccion` varchar(8) NOT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `plantilla_web`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_plantilla_web` BEFORE INSERT ON `plantilla_web` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM plantilla_web) = 0   THEN
        SET NEW.idplantillaweb = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillaweb = (SELECT MAX(idplantillaweb)+1 FROM plantilla_web);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla_web_area_portfolio`
--

CREATE TABLE `plantilla_web_area_portfolio` (
  `idplantillawebareaportfolio` varchar(8) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `plantilla_web_area_portfolio`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_plantilla_web_area_portfolio` BEFORE INSERT ON `plantilla_web_area_portfolio` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM plantilla_web_area_portfolio) = 0   THEN
        SET NEW.idplantillawebareaportfolio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillawebareaportfolio = (SELECT MAX(idplantillawebareaportfolio)+1 FROM plantilla_web_area_portfolio);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla_web_portfolio`
--

CREATE TABLE `plantilla_web_portfolio` (
  `idplantillawebportfolio` varchar(8) NOT NULL,
  `idplantillaweb` varchar(8) NOT NULL,
  `idplantillawebareaportfolio` varchar(8) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `plantilla_web_portfolio`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_plantilla_web_portfolio` BEFORE INSERT ON `plantilla_web_portfolio` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM plantilla_web_portfolio) = 0   THEN
        SET NEW.idplantillawebportfolio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillawebportfolio = (SELECT MAX(idplantillawebportfolio)+1 FROM plantilla_web_portfolio);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla_web_seccion`
--

CREATE TABLE `plantilla_web_seccion` (
  `idplantillawebseccion` varchar(8) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `plantilla_web_seccion`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_plantilla_web_seccion` BEFORE INSERT ON `plantilla_web_seccion` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM plantilla_web_seccion) = 0   THEN
        SET NEW.idplantillawebseccion = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillawebseccion = (SELECT MAX(idplantillawebseccion)+1 FROM plantilla_web_seccion);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idproyecto` varchar(8) NOT NULL,
  `idubigeo` char(10) NOT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `razonsocial` varchar(200) DEFAULT NULL,
  `nombrecomercial` varchar(200) DEFAULT NULL,
  `abreviatura` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `web` varchar(200) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `pass_firma` varchar(200) DEFAULT NULL,
  `usuario_sol` varchar(50) DEFAULT NULL,
  `clave_sol` varchar(200) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `proyecto`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_proyecto` BEFORE INSERT ON `proyecto` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM proyecto) = 0   THEN
        SET NEW.idproyecto = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idproyecto = (SELECT MAX(idproyecto)+1 FROM proyecto);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro_negocio`
--

CREATE TABLE `rubro_negocio` (
  `idrubronegocio` varchar(8) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sector del mercado en el que se desempeña el negocio.';

--
-- Disparadores `rubro_negocio`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_rubronegocio` BEFORE INSERT ON `rubro_negocio` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM rubro_negocio) = 0   THEN
        SET NEW.idrubronegocio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idrubronegocio = (SELECT MAX(idrubronegocio)+1 FROM rubro_negocio);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo`
--

CREATE TABLE `ubigeo` (
  `idubigeo` char(10) NOT NULL,
  `idpais` char(4) DEFAULT NULL,
  `parent` char(10) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` varchar(8) NOT NULL,
  `idnivelusuario` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dni` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nombre_completo` varchar(200) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono_fijo` varchar(10) DEFAULT NULL,
  `celular` varchar(9) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `clave_inicial` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuariocrea` varchar(8) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuariomodifica` varchar(8) DEFAULT NULL,
  `fechamodifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idnivelusuario`, `dni`, `nombre_completo`, `foto`, `direccion`, `telefono_fijo`, `celular`, `email`, `usuario`, `password`, `clave_inicial`, `estado`, `usuariocrea`, `fechacrea`, `usuariomodifica`, `fechamodifica`) VALUES
('20220001', '20220001', '43985161', 'webadmin', 'vistas/img/perfiles/622.png', 'x ahi', '', '', 'admin@admin.com', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'admin', 1, '20220001', '2022-05-20 23:43:59', NULL, NULL);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `tg_insert_usuario` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
    if (SELECT COUNT(*) FROM usuario) = 0   THEN
        SET NEW.idusuario = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idusuario = (SELECT MAX(idusuario)+1 FROM usuario);
  END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigo_usuario_negocio`
--
ALTER TABLE `codigo_usuario_negocio`
  ADD PRIMARY KEY (`idcodigousuarionegocio`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idnegocio` (`idnegocio`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`idnegocio`),
  ADD KEY `idrubronegocio` (`idrubronegocio`);

--
-- Indices de la tabla `nivel_usuario`
--
ALTER TABLE `nivel_usuario`
  ADD PRIMARY KEY (`idnivelusuario`);

--
-- Indices de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantilla_web`
--
ALTER TABLE `plantilla_web`
  ADD PRIMARY KEY (`idplantillaweb`),
  ADD KEY `idnegocio` (`idnegocio`),
  ADD KEY `idplantillawebseccion` (`idplantillawebseccion`);

--
-- Indices de la tabla `plantilla_web_area_portfolio`
--
ALTER TABLE `plantilla_web_area_portfolio`
  ADD PRIMARY KEY (`idplantillawebareaportfolio`);

--
-- Indices de la tabla `plantilla_web_portfolio`
--
ALTER TABLE `plantilla_web_portfolio`
  ADD PRIMARY KEY (`idplantillawebportfolio`),
  ADD KEY `idplantillaweb` (`idplantillaweb`),
  ADD KEY `idplantillawebareaportfolio` (`idplantillawebareaportfolio`);

--
-- Indices de la tabla `plantilla_web_seccion`
--
ALTER TABLE `plantilla_web_seccion`
  ADD PRIMARY KEY (`idplantillawebseccion`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idproyecto`),
  ADD KEY `idubigeo` (`idubigeo`);

--
-- Indices de la tabla `rubro_negocio`
--
ALTER TABLE `rubro_negocio`
  ADD PRIMARY KEY (`idrubronegocio`);

--
-- Indices de la tabla `ubigeo`
--
ALTER TABLE `ubigeo`
  ADD PRIMARY KEY (`idubigeo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idnivelusuario` (`idnivelusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `codigo_usuario_negocio`
--
ALTER TABLE `codigo_usuario_negocio`
  ADD CONSTRAINT `codigo_usuario_negocio_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `codigo_usuario_negocio_ibfk_2` FOREIGN KEY (`idnegocio`) REFERENCES `negocio` (`idnegocio`);

--
-- Filtros para la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD CONSTRAINT `negocio_ibfk_1` FOREIGN KEY (`idrubronegocio`) REFERENCES `rubro_negocio` (`idrubronegocio`);

--
-- Filtros para la tabla `plantilla_web`
--
ALTER TABLE `plantilla_web`
  ADD CONSTRAINT `plantilla_web_ibfk_1` FOREIGN KEY (`idnegocio`) REFERENCES `negocio` (`idnegocio`),
  ADD CONSTRAINT `plantilla_web_ibfk_2` FOREIGN KEY (`idplantillawebseccion`) REFERENCES `plantilla_web_seccion` (`idplantillawebseccion`);

--
-- Filtros para la tabla `plantilla_web_portfolio`
--
ALTER TABLE `plantilla_web_portfolio`
  ADD CONSTRAINT `plantilla_web_portfolio_ibfk_1` FOREIGN KEY (`idplantillaweb`) REFERENCES `plantilla_web` (`idplantillaweb`),
  ADD CONSTRAINT `plantilla_web_portfolio_ibfk_2` FOREIGN KEY (`idplantillawebareaportfolio`) REFERENCES `plantilla_web_area_portfolio` (`idplantillawebareaportfolio`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`idubigeo`) REFERENCES `ubigeo` (`idubigeo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idnivelusuario`) REFERENCES `nivel_usuario` (`idnivelusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
