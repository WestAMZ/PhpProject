<?php

    include_once(MODELS_DIR . 'puesto.php');


  if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $cargos = Puesto::searchInEmpleado(Connection::filterInput($_GET['search']));
        foreach( $empleados as &$empleado)
        {
?>

<?php
        }
    }
    else
    {

        $cargos = Puesto::getPuesto();
        foreach( $cargos as &$cargo)
        {
?>
       <tr class="cargo" onclick="select">
                <td> <?php echo($cargo->getId_Puesto())?> </td>
                <td> <?php echo($cargo->getNombre())?> </td>
        </tr>

<?php
        }
    }

?>

