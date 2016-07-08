<?php

    include_once(MODELS_DIR . 'puesto.php');


  if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $cargos = Puesto::searchPuesto(Connection::filterInput($_GET['search']));
        foreach( $cargos as &$cargo)
        {
?>
              <tr class="cargo" onclick="select()">
              <td><?php echo($cargo->getId_Puesto())?></td>
              <td> <?php echo($cargo->getNombre())?> </td>
               <td><?php echo($cargo->getDescripcion())?></td>
              </tr>
<?php
        }
    }
    else
    {

        $cargos = Puesto::getPuesto();
        foreach( $cargos as &$cargo)
        {
?>
       <tr class="cargo">
                <td> <?php echo($cargo->getId_Puesto())?> </td>
                <td> <?php echo($cargo->getNombre())?> </td>
                <td><?php echo($cargo->getDescripcion())?></td>
        </tr>

<?php
        }
    }

?>

