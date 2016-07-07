<?php
class Reporte extends FPDF
{
     static function generateReport($id_empleado)
    {   $pdf = new FPDF();
        Connection::connect();
        $query = "SELECT DATE_FORMAT(so.fecha_solicitud,'%m-%d-%Y') as fecha_solicitud,CONCAT(e.nombre1, ' ', e.nombre2, ' ',e.apellido1,' ',e.apellido2) as nombre,e.cedula as cedula,e.firma as firma,s.nombre as sitio,p.nombre as cargo,e.telefono as telefono,e.fecha_ingreso as fecha_ingreso,fvlm.numero_dias as numeros_dias,fvlm.periodo as periodo, fvlm.inicio as dia_inicio,fvlm.termina as dia_fin,fvlm.regresa as dia_regreso, so.observacion as observaciones,
        (SELECT CONCAT(j.nombre1, ' ',j.nombre2,' ', j.apellido1, ' ', j.apellido2) FROM empleado e INNER JOIN empleado j ON j.id_empleado = e.id_jefe where e.id_empleado = '$id_empleado') as jefe,
        (SELECT j.firma FROM empleado e INNER JOIN empleado j ON j.id_empleado = e.id_jefe where e.id_empleado = '$id_empleado') as firma_jefe,
        (SELECT CONCAT(e.nombre1, ' ', e.nombre2, ' ' , e.apellido1, ' ', e.apellido2) FROM empleado e INNER JOIN puesto p on e.id_puesto = p.id_puesto WHERE p.id_puesto =  1) as gerente_general,
        (SELECT e.firma FROM empleado e INNER JOIN puesto p on e.id_puesto = p.id_puesto WHERE p.id_puesto =  1) as firma_gerente_general
        FROM puesto p INNER JOIN empleado e on p.id_puesto = e.id_puesto INNER JOIN sitio s on e.id_sitio = s.id_sitio INNER JOIN solicitud so on e.id_empleado = so.id_empleado INNER JOIN tipo_solicitud ts on so.id_tipo_solicitud = ts.idTipo_Solicitud INNER JOIN formato_vacaciones_licencia_medica fvlm on so.id_solicitud = fvlm.id_solicitud WHERE e.id_jefe != e.id_empleado and e.id_empleado = '$id_empleado'";
        $result = Connection::getConnection()->query($query);
        $row=$result->fetch_assoc();
        //$pdf = new FPD();
        $pdf->AddPage();
        $pdf->Image(IMG_DIR . 'logo.png', 10, 6, 30);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(145);
        $pdf->Cell(50,7, 'FSLM-1',1,1,'C');
        $pdf->Ln(5);
        $pdf->Cell(145);
        $pdf->Cell(50, 7, 'Fecha Solicitud: ' . $row['fecha_solicitud'], 1, 0, 'C');
        $pdf->Ln(20);
        $pdf->Cell(50);
        $pdf->SetDrawColor(10,80,180);
        $pdf->SetFillColor(230,230,0);
        $pdf->Cell(90, 8, 'SOLICITUD DE LICENCIA MEDICA', 1, 0 , 'C');
        $pdf->Ln(15);
        $pdf->Cell(50);
        $pdf->Cell(80, 8, 'DATOS DEL TRABAJADOR', 0, 0 , 'C');
        $pdf->Ln(7);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(0,0,0);
        $pdf->Cell(100,5, 'NOMBRES Y APELLIDOS', 1 , 0 , 'C');
        $pdf->Cell(40,5, 'CEDULA IDENTIDAD', 1 , 0 , 'C');
        $pdf->Cell(40,5, 'FIRMA', 1 , 0 , 'C');
        $pdf->Ln(5);
        $pdf->Cell(100,8,$row['nombre'],1,0,'C');
        $pdf->Cell(40,8,$row['cedula'],1,0,'C');
        $pdf->Cell(40,8,$row['firma'],1,0,'C');
        $pdf->Ln(15);
        $pdf->Cell(60,5, 'NOMBRE DEL SITIO', 1 , 0 , 'C');
        $pdf->Cell(40,5, 'CARGO', 1 , 0 , 'C');
        $pdf->Cell(40,5, 'TELEFONO', 1 , 0 , 'C');
        $pdf->Cell(40,5, 'FECHA INGRESO', 1 , 0 , 'C');
        $pdf->Ln(5);
        $pdf->Cell(60,8, $row['sitio'], 1 , 0 , 'C');
        $pdf->Cell(40,8, $row['cargo'], 1 , 0 , 'C');
        $pdf->Cell(40,8, $row['telefono'], 1 , 0 , 'C');
        $pdf->Cell(40,8, $row['fecha_ingreso'], 1 , 0 , 'C');
        $pdf->Ln(15);
        $pdf->setFont('Arial', 'B', 10);
        $pdf->Cell(50);
        $pdf->Cell(80, 8, 'FECHAS PROPUESTAS PARA EL USO DE LICENCIA MEDICA', 0, 0 , 'C');
        $pdf->Ln(7);
        $pdf->setFont('Arial', '', 8);
        $pdf->Cell(35,5, 'NUMERO DE DIAS', 1 , 0 , 'C');
        $pdf->Cell(39,5, 'PERIODO', 1 , 0 , 'C');
        $pdf->Cell(36,5, 'INICIO', 1 , 0 , 'C');
        $pdf->Cell(36,5, 'TERMINA', 1 , 0 , 'C');
        $pdf->Cell(36,5, 'REGRESA', 1 , 0 , 'C');
        $pdf->Ln(5);
        $pdf->Cell(35,7, $row['numeros_dias'], 1 , 0 , 'C');
        $pdf->Cell(39,7, $row['periodo'], 1 , 0 , 'C');
        $pdf->Cell(36,7, $row['dia_inicio'], 1 , 0 , 'C');
        $pdf->Cell(36,7, $row['dia_fin'], 1 , 0 , 'C');
        $pdf->Cell(36,7, $row['dia_regreso'], 1 , 0 , 'C');
        $pdf->Ln(15);
        $pdf->setFont('Arial', 'B', 10);
        $pdf->Cell(50);
        $pdf->Cell(80, 8, 'OBSERVACIONES A DETALLAR PERSONA QUE DEJA A CARGO DE FUNCIONES', 0, 0 , 'C');
        $pdf->Ln(9);
        $pdf->setFont('Arial','' , 8);
        $pdf->MultiCell(180,6, $row['observaciones'], 1, 'J' );
        $pdf->Ln(5);
        $pdf->setFont('Arial', '', 8);
        $pdf->Cell(180,5, 'SOLICITANTE', 1, 0, 'C');
        $pdf->Ln(5);
        $pdf->Cell(180,5, 'NOMBRE Y FIRMA:', 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->Cell(180,12, $row['nombre'], 1, 0, 'C');
        $pdf->Ln(15);
        $pdf->Cell(180,5, 'APROBACION', 1, 0, 'C');
        $pdf->Ln(5);
        $pdf->Cell(90,5, 'JEFE INMEDIATO', 1, 0, 'C');
        $pdf->Cell(90,5, 'GERENCIA GENERAL', 1, 0, 'C');
        $pdf->Ln(5);
        $pdf->Cell(90,10, $row['jefe'], 1, 0, 'C');
        $pdf->Cell(90,10, $row['gerente_general'], 1, 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(90,5, 'FIRMA Y SELLO', 1, 0, 'C');
        $pdf->Cell(90,5, 'FIRMA Y SELLO', 1, 0, 'C');
        $pdf->Ln(5);
        $pdf->Cell(90,15, $row['firma_jefe'], 1, 0, 'C');
        $pdf->Cell(90,15, $row['firma_gerente_general'], 1, 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(90,5, 'NOMBRE Y APELLIDO', 1 , 0 , 'C');
        $pdf->Cell(90,5, 'NOMBRE Y APELLIDO', 1 , 0 , 'C');
        $pdf->Ln(5);
        $pdf->Cell(90,15, '', 1 , 0 , 'C');
        $pdf->Cell(90,15, '', 1 , 0 , 'C');

        $pdf->output();
        Connection::close();
    }
}
?>
