--
-- Base de datos: `nicatrip_ebco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--
use ebco_sistema;

CREATE TABLE `aviso` (
  `idaviso` int(11) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `contenido` varchar(400) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `contenido` varchar(300) NOT NULL,
  `id_insidencias` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Adjunto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `fecha`, `contenido`, `id_insidencias`, `id_usuario`, `Adjunto`) VALUES
(1, '2016-06-29', 'hacerca de que tienes problemas ???', 1, 1, NULL),
(2, '2016-06-29', 'aun no he logrado encontrar la solucion', 1, 1, NULL),
(3, '2016-06-29', 'De acuerdo! ', 2, 1, NULL),
(4, '2016-06-30', 'me parece muchachos', 2, 4, NULL),
(5, '2016-06-30', 'mejorando', 3, 1, NULL),
(6, '2016-06-30', 'comentario mio', 3, 4, NULL),
(7, '2016-06-30', 'comentario mio', 3, 4, NULL),
(8, '2016-06-30', 'es otra prueba de modificacion', 3, 2, NULL),
(9, '2016-06-30', 'Este es mi comentario para probar que esta pasando ', 3, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_viatico`
--

CREATE TABLE `detalle_viatico` (
  `id_detalle_viatico` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `numero_factura` varchar(25) DEFAULT NULL,
  `concepto` varchar(60) NOT NULL,
  `monto` decimal(10,4) NOT NULL,
  `total` decimal(10,4) NOT NULL,
  `id_formato_viatico_reembolso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre1` varchar(45) NOT NULL,
  `nombre2` varchar(30) DEFAULT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `cedula` varchar(16) NOT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `firma` varchar(45) DEFAULT NULL,
  `id_puesto` int(11) NOT NULL,
  `id_sitio` int(11) NOT NULL,
  `id_jefe` int(11) DEFAULT NULL,
  `inss` varchar(45) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `cedula`, `telefono`, `firma`, `id_puesto`, `id_sitio`, `id_jefe`, `inss`, `fecha_ingreso`, `estado`) VALUES
(1, 'westly', 'alejandro', 'meza', 'sotomayor', '001-160695-0026D', NULL, NULL, 1, 1, NULL, '', '2000-02-02', 1),
(2, 'Eleazar', 'Gerardo', 'Martinez', 'Carballo', '401-180196-0004C', NULL, NULL, 2, 4, 1, '', '2004-04-02', 1),
(4, 'Ricardo', 'Enmanuel', 'Martinez', 'Carballo', '401-180196-0003B', NULL, NULL, 2, 5, 2, '', '2006-06-12', 1),
(5, 'Donaldo', 'Javier', 'Vargas', 'Mena', '001-180397-0002S', NULL, NULL, 3, 2, 1, '', '2004-03-10', 1),
(6, 'Martin', 'Rene', 'Larios', 'Sotomayor', '001-150593-0023D', '88941156', '', 6, 5, 5, '5648521-9', '0000-00-00', 1),
(7, 'Reymundo', 'Javier', 'Tenorio', 'Quiroz', '401-130192-003X', NULL, NULL, 5, 2, 1, '', '2000-06-23', 1),
(8, 'Nuvia', 'Yolanda', 'Sanchez', 'Sandigo', '401-251293-0006F', NULL, NULL, 6, 5, 1, '', '2006-05-02', 1),
(9, 'Luis', 'Alfonso', 'Cardoza', 'Bird', '001-150795-0002K', NULL, NULL, 6, 1, 1, '', '2005-04-08', 1),
(10, 'Jeeson', 'Steven', 'Dominguez', NULL, '401-101194-0012L', NULL, NULL, 6, 3, 1, '', '2008-03-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_vacaciones_licencia_medica`
--

CREATE TABLE `formato_vacaciones_licencia_medica` (
  `id_formato_vacaciones_licencia_medica` int(11) NOT NULL,
  `numero_dias` int(11) NOT NULL,
  `periodo` varchar(45) NOT NULL,
  `inicio` date NOT NULL,
  `termina` date NOT NULL,
  `regresa` date NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formato_vacaciones_licencia_medica`
--

INSERT INTO `formato_vacaciones_licencia_medica` (`id_formato_vacaciones_licencia_medica`, `numero_dias`, `periodo`, `inicio`, `termina`, `regresa`, `id_solicitud`) VALUES
(1, 29, 'Del 20-07-2016 al 20-08-2016', '2016-07-20', '2016-08-19', '2016-08-20', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_viatico_reembolso`
--

CREATE TABLE `formato_viatico_reembolso` (
  `id_formato_viatico_reembolso` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_reingreso` date NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insidencia`
--

CREATE TABLE `insidencia` (
  `id_insidencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `nivel` int(11) NOT NULL COMMENT 'Que tan critico es',
  `estado` int(11) NOT NULL COMMENT 'Insidencia:\n\n1= no resuelta\n2= resuelta\n',
  `id_usuario` int(11) NOT NULL,
  `adjunto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `insidencia`
--

INSERT INTO `insidencia` (`id_insidencia`, `fecha`, `descripcion`, `nivel`, `estado`, `id_usuario`, `adjunto`) VALUES
(1, '2016-06-29', 'Problemas en el area de mantenimiento', 0, 1, 1, ''),
(2, '2016-06-29', 'Tambien estoy teniendo unos inconvenientes en esa area, si sabe de algo me lo hacen saber por favor', 0, 1, 1, ''),
(3, '2016-06-29', 'jghg', 0, 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logacceso`
--

CREATE TABLE `logacceso` (
  `id_log_acceso` int(11) NOT NULL,
  `tiempo_ingreso` datetime NOT NULL,
  `tiempo_salida` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logacciones`
--

CREATE TABLE `logacciones` (
  `id_logacciones` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(150) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `id_puesto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id_puesto`, `nombre`, `descripcion`) VALUES
(1, 'Gerente general', 'Administra los sitios a nivel general'),
(2, 'Gerente de sitio', 'Administra a nivel de sitio o sucursal'),
(3, 'Contador', 'lleva la contabilidad de la empresa'),
(4, 'Jefe Recursos Humanos', 'Lleva el control del personal dentro de la empresa'),
(5, 'Jefe de Finanzas', 'Encargado del area de finanzas dentro de la empresa'),
(6, 'Tecnico de Mantenimiento', 'Realiza las distintas actividades de mantenimiento a las maquinas de la empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitio`
--

CREATE TABLE `sitio` (
  `id_sitio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sitio`
--

INSERT INTO `sitio` (`id_sitio`, `nombre`, `pais`, `ciudad`, `direccion`, `latitud`, `longitud`, `telefono`, `estado`) VALUES
(1, 'Sucursal Corinto', 'Nicaragua', 'Chinandega', '', 0, 0, '25223765', 1),
(2, 'Sucursal San Jorge', 'Nicaragua', 'Rivas', '', 0, 0, '25223740', 1),
(3, 'Puerto Sandino', 'Nicaragua', 'Nagarote', NULL, 0, 0, NULL, 1),
(4, 'Sucursal San Juan del sur', 'Nicaragua', 'Rivas', NULL, 0, 0, NULL, 1),
(5, 'Sucursal Puerto Cabeza', 'Nicaragua', 'Zelaya RAAN', NULL, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `observacion` varchar(250) NOT NULL,
  `estado` varchar(15) NOT NULL COMMENT 'Estados : aprovada,rechazada,gestionando',
  `id_empleado` int(11) NOT NULL,
  `fase` int(11) NOT NULL COMMENT 'fases:\n1 = Emitida por gerencia de sitio y enviada a        generencia general\n\n2 = Recepcionada por gerencia general\n3 = Recepcionada por gerencia de sitio\n4 = Recepcionada por trabajador involucrado       (con respuesta)\n',
  `id_tipo_solicitud` int(11) NOT NULL,
  `generado_por` int(11) NOT NULL,
  `fecha_aprovacion` datetime DEFAULT NULL,
  `aprobado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `fecha_solicitud`, `observacion`, `estado`, `id_empleado`, `fase`, `id_tipo_solicitud`, `generado_por`, `fecha_aprovacion`, `aprobado_por`) VALUES
(2, '2016-07-02 00:00:00', 'La personalidad del deportista o atleta es un punto a veces no ponderado pero decisivo en el resultado y proyección.El carisma del sujeto incide mucho en su actuación competitiva y su relación con el entorno participativo se afecta por esa particular', '1', 4, 1, 1, 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

CREATE TABLE `tipo_solicitud` (
  `idTipo_Solicitud` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`idTipo_Solicitud`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'SOLICITUD DE LICENCIA MEDICA', 'Para solicitar licencia medica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `password`, `id_empleado`, `role`, `estado`, `foto`) VALUES
(1, 'westlymeza@gmail.com', 'a1d5285401e5441cf7ff053c4276c1af764f4ef3', 1, 1, 1, '120161106.jpg'),
(2, 'eleazarg2112@gmail.com', 'a1d5285401e5441cf7ff053c4276c1af764f4ef3', 2, 2, 1, '220160630.jpg'),
(4, 'ricardom0490@gmail.com', 'a1d5285401e5441cf7ff053c4276c1af764f4ef3', 4, 2, 1, '320160630.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`idaviso`),
  ADD KEY `fk_aviso_empleado1_idx` (`id_empleado`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentario_insidencia1_idx` (`id_insidencias`),
  ADD KEY `fk_comentario_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `detalle_viatico`
--
ALTER TABLE `detalle_viatico`
  ADD PRIMARY KEY (`id_detalle_viatico`),
  ADD KEY `fk_detalle_viatico_formato_viatico_reembolso1_idx` (`id_formato_viatico_reembolso`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_empleado_puesto1_idx` (`id_puesto`),
  ADD KEY `fk_empleado_sitio1_idx` (`id_sitio`),
  ADD KEY `fk_empleado_empleado1_idx` (`id_jefe`);

--
-- Indices de la tabla `formato_vacaciones_licencia_medica`
--
ALTER TABLE `formato_vacaciones_licencia_medica`
  ADD PRIMARY KEY (`id_formato_vacaciones_licencia_medica`),
  ADD KEY `fk_formato_viatico_solicitud1_idx` (`id_solicitud`);

--
-- Indices de la tabla `formato_viatico_reembolso`
--
ALTER TABLE `formato_viatico_reembolso`
  ADD PRIMARY KEY (`id_formato_viatico_reembolso`),
  ADD KEY `fk_formato_viatico_reembolso_solicitud1_idx` (`id_solicitud`);

--
-- Indices de la tabla `insidencia`
--
ALTER TABLE `insidencia`
  ADD PRIMARY KEY (`id_insidencia`),
  ADD KEY `fk_insidencia_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `logacceso`
--
ALTER TABLE `logacceso`
  ADD PRIMARY KEY (`id_log_acceso`),
  ADD KEY `fk_logacceso_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `logacciones`
--
ALTER TABLE `logacciones`
  ADD PRIMARY KEY (`id_logacciones`),
  ADD KEY `fk_logacciones_empleado1_idx` (`id_empleado`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `sitio`
--
ALTER TABLE `sitio`
  ADD PRIMARY KEY (`id_sitio`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `fk_solicitud_empleado1_idx` (`id_empleado`),
  ADD KEY `fk_solicitud_Tipo_Solicitud1_idx` (`id_tipo_solicitud`),
  ADD KEY `fk_solicitud_empleado2_idx` (`generado_por`),
  ADD KEY `fk_solicitud_empleado3_idx` (`aprobado_por`);

--
-- Indices de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  ADD PRIMARY KEY (`idTipo_Solicitud`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_empleado1_idx` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviso`
--
ALTER TABLE `aviso`
  MODIFY `idaviso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `detalle_viatico`
--
ALTER TABLE `detalle_viatico`
  MODIFY `id_detalle_viatico` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `formato_vacaciones_licencia_medica`
--
ALTER TABLE `formato_vacaciones_licencia_medica`
  MODIFY `id_formato_vacaciones_licencia_medica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `formato_viatico_reembolso`
--
ALTER TABLE `formato_viatico_reembolso`
  MODIFY `id_formato_viatico_reembolso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `insidencia`
--
ALTER TABLE `insidencia`
  MODIFY `id_insidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `logacceso`
--
ALTER TABLE `logacceso`
  MODIFY `id_log_acceso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logacciones`
--
ALTER TABLE `logacciones`
  MODIFY `id_logacciones` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sitio`
--
ALTER TABLE `sitio`
  MODIFY `id_sitio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  MODIFY `idTipo_Solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aviso`
--
ALTER TABLE `aviso`
  ADD CONSTRAINT `fk_aviso_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_insidencia1` FOREIGN KEY (`id_insidencias`) REFERENCES `insidencia` (`id_insidencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_viatico`
--
ALTER TABLE `detalle_viatico`
  ADD CONSTRAINT `fk_detalle_viatico_formato_viatico_reembolso1` FOREIGN KEY (`id_formato_viatico_reembolso`) REFERENCES `formato_viatico_reembolso` (`id_formato_viatico_reembolso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_empleado1` FOREIGN KEY (`id_jefe`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_puesto1` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id_puesto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_sitio1` FOREIGN KEY (`id_sitio`) REFERENCES `sitio` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `formato_vacaciones_licencia_medica`
--
ALTER TABLE `formato_vacaciones_licencia_medica`
  ADD CONSTRAINT `fk_formato_viatico_solicitud1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `formato_viatico_reembolso`
--
ALTER TABLE `formato_viatico_reembolso`
  ADD CONSTRAINT `fk_formato_viatico_reembolso_solicitud1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `insidencia`
--
ALTER TABLE `insidencia`
  ADD CONSTRAINT `fk_insidencia_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logacceso`
--
ALTER TABLE `logacceso`
  ADD CONSTRAINT `fk_logacceso_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logacciones`
--
ALTER TABLE `logacciones`
  ADD CONSTRAINT `fk_logacciones_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_solicitud_Tipo_Solicitud1` FOREIGN KEY (`id_tipo_solicitud`) REFERENCES `tipo_solicitud` (`idTipo_Solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_empleado2` FOREIGN KEY (`generado_por`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_empleado3` FOREIGN KEY (`aprobado_por`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
