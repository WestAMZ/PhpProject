INSERT INTO categoria(nombre, descripcion, url) VALUES('Administracion', 'Manuales y archivos administrativos');
INSERT INTO categoria(nombre, descripcion, url) VALUES('Recursos Humanos', 'Expediente de personal, Evaluaciones, otros');
INSERT INTO categoria(nombre, descripcion, url) VALUES('Radio Proteccion', 'Informes Dosis, Expedientes TOES, otros');
INSERT INTO categoria(nombre, descripcion, url) VALUES('Finanzas y Contabilidad', 'Estados Financieros, facturas ebco, otros');

SELECT e.nombre1,
	   e.nombre2,
	   e.firma,
	   s.id_solicitud,
	   ts.nombre,
	   s.observacion
FROM solicitud s INNER JOIN empleado e on s.id_empleado = e.id_empleado
INNER JOIN tipo_solicitud ts on s.id_tipo_solicitud = ts.id_tipo_solicitud;