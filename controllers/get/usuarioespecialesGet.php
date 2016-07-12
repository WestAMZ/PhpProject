<?php
    include_once(MODELS_DIR . 'usuario.php');
    include_once(MODELS_DIR . 'empleado.php');

    if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $empleados = Empleado::searchInEmpleado(Connection::filterInput($_GET['search']));
        foreach( $empleados as &$empleado)
        {
?>
            <tr class="empleado" onclick="" id_usuario ="<?php
                                                            $usuario = Usuario::getUsuarioByEmpleado($empleado->getId_Empleado());
                                                            echo($usuario->getIdUsuario());
                                                         ?>">
                <td><?php echo($empleado->getId_Empleado())?></td>
                <td><?php echo($empleado->getCedula())?></td><!-correo-->
                <td class="nombre"><?php echo($empleado->getAllName())?></td>
                <td><?php echo($empleado->getTelefono())?></td>
                <td><?php echo($empleado->getFecha_Ingreso())?></td>
                <?php
                    if($empleado->getDocumentos() !="")
                    {
                ?>
                    <td><a href="<?php echo(EMPLEADOS_DIR . $empleado->getDocumentos())?>">Documentos</a></td>
                <?php
                    }
                ?>
            </tr>
<?php
        }
    }
    else
    {
        $empleados = Empleado::getEmpleadosEspeciales();
        foreach( $empleados as &$empleado)
        {

?>

            <tr class="empleado">
                <td><?php echo($empleado->getId_Empleado())?></td>
                <td><?php echo($empleado->getCedula())?></td>
                <td class="nombre"><?php echo($empleado->getAllName())?></td>
                <td><?php echo($empleado->getTelefono())?></td>
                <td><?php echo($empleado->getFecha_Ingreso())?></td>
            </tr>
<?php
        }
    }
?>
