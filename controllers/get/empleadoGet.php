<?php
    include_once(MODELS_DIR .'empleado.php');
    header('Content-type: application/json');
    if($_GET)
    {
        if(isset($_GET['id']))
        {
            $id = Connection::filterInput($_GET['id']);
            Connection::connect();
            $query = "SELECT e.`id_empleado`, e.`nombre1`, e.`nombre2`, e.`apellido1`, e.`apellido2`, e.`cedula`, e.`telefono`, e.`firma`, e.`id_puesto`, e.`id_sitio`, e.`id_jefe`, e.`inss`, e.`fecha_ingreso`, e.`estado`, u.correo FROM `empleado` e inner join usuario u on e.`id_empleado` = u.`id_empleado` WHERE e.id_empleado = '$id' ";
            $result = Connection::getConnection()->query($query);
            $empleado = $result ->fetch_assoc();
            echo ('{ "empleado" : [' );
            echo(JSON_encode($empleado));
            echo (']}' );
            Connection::close();
        }
    }
?>
