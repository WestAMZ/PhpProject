/*
    Categorias establecidas
*/
INSERT INTO `categoria` (`id_categoria`, `nombre`, `img`, `url`, `estado`,`vista`) VALUES
(1, 'AdministraciÃ²n', '', 'url=1468175259', 1,''),
(2, 'RRHH', 'team.svg', '1468175267', 1,''),
(3, 'Radio pretecciÃ²n', '', 'url=1468175295', 1,''),
(4, 'Finanzas y contabilidad', '', 'url=1468175318', 1,''),
(5, 'Suministros', '', 'url=1468175440', 1,''),
(6, 'Inventario', 'stock.svg', 'url=1468175449', 1,''),
(7, 'Operaciones', '', 'url=1468175466', 1,''),
(8, 'Seguimientos', 'technology.svg', 'url=1468175478', 1,''),
(9, 'InformaciÃ²n de sitios', 'information.svg', '1468175501', 1,'');

/*
    Subcategorias Administracion
*/
INSERT INTO `sub_categoria` (`id_subcategoria`, `nombre`, `img`, `id_categoria`, `url`, `estado`, `vista`) VALUES
(1, 'Circulares y comunicados', '', 1, '1468175946', 1, NULL),
(2, 'Normativas y reglamentos', '', 1, '1468175957', 1, NULL),
(3, 'Contratos', '', 1, '1468175980', 1, NULL),
(4, 'DocumentaciÃ²n legal del a empresa', '', 1, '1468176000', 1, NULL),
(5, 'Actas de entregas', '', 1, '1468176015', 1, NULL),
(6, 'Seguros', '', 1, '1468176022', 1, NULL),
(7, 'Certificaciones', '', 1, '1468176041', 1, NULL),
(8, 'Consultas', '', 1, '1468176048', 1, NULL),
(9, 'CertificaciÃ²n ISO 9001', '', 1, '1468176099', 1, NULL),
(10, 'Alvimer', '', 1, '1468176120', 1, NULL);


/*
    Subcategorias RRHH
*/
