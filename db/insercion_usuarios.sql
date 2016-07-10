INSERT INTO `puesto` (`id_puesto`, `nombre`, `descripcion`) VALUES
(1, 'Gerente general', 'Administra los sitios a nivel general');


INSERT INTO `sitio` (`id_sitio`, `nombre`, `pais`, `ciudad`, `direccion`, `latitud`, `longitud`, `telefono`, `estado`) VALUES
(1, 'Administracion general', 'Nicaragua', 'Managua', ' ', 0, 0, '25223765', 1);


INSERT INTO `empleado` (`id_empleado`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `cedula`, `telefono`, `firma`, `id_puesto`, `id_sitio`, `id_jefe`, `inss`, `fecha_ingreso`, `estado`) VALUES
(1, 'westly', 'alejandro', 'meza', 'sotomayor', '001-160695-0026D', NULL, NULL, 1, 1, NULL, '', '2000-02-02', 1);

INSERT INTO `usuario` (`id_usuario`, `correo`, `password`, `id_empleado`, `role`, `estado`, `foto`) VALUES
(1, 'westlymeza@gmail.com', 'a1d5285401e5441cf7ff053c4276c1af764f4ef3', 1, 1, 1, '');
