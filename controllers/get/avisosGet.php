<?php
    include( MODELS_DIR . 'aviso.php');
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
    $avisos = Aviso::SearchinAvisos($_GET['search']);
    foreach ($avisos as &$aviso)
    {
?>
    <tr class="aviso">
        <td><?php echo($aviso->getIdAviso())?></td>
        <td><?php echo($aviso->getTitulo())?></td>
        <td><?php echo($aviso-> getFechaPublicacion())?></td>
        <td><?php echo($aviso->getFechaFinalizacion())?></td>
        <td><?php echo($aviso->getContenido())?></td>
        <td><a href="?post=aviso&mod=2&id=<?php echo($aviso->getIdAviso())?>">
                <?php
                    if($aviso->getEstado()==1)
                    {
                ?>
                     <a class="btn green cambiar-estado" id="<?php echo($aviso->getIdAviso())?>" estado="<?php echo($aviso->getEstado())?>">
                    <?php
                            echo('Desabilidar');
                    ?>
                     </a>

                    <?php
                    }
                    else
                    {
                    ?>

                         <a class="btn red cambiar-estado" id="<?php echo($aviso->getIdAviso())?>" estado="<?php echo($aviso->getEstado())?>">
                    <?php
                            echo('Abilidar');
                    ?>
                        </a>
                    <?php
                    }
                    ?>
           </a> </td>
    </tr>
<?php
    }
}
else
{
    $avisos = Aviso::getAvisos($_SESSION['id_empleado']);
    foreach ($avisos as &$aviso)
    {

?>
    <tr class="aviso">
        <td><?php echo($aviso->getIdAviso())?></td>
        <td><?php echo($aviso->getTitulo())?></td>
        <td><?php echo($aviso-> getFechaPublicacion())?></td>
        <td><?php echo($aviso->getFechaFinalizacion())?></td>
        <td><?php echo($aviso->getContenido())?></td>
        <td><a href="?post=aviso&mod=2&id=<?php echo($aviso->getIdAviso())?>">
             <?php
                    if($aviso->getEstado()== 1)
                    {
                ?>
                     <a class="btn green cambiar-estado" id="<?php echo($aviso->getIdAviso())?>" estado="<?php echo($aviso->getEstado())?>">
                    <?php
                            echo('Desabilidar');
                    ?>
                     </a>

                    <?php
                    }
                    else
                    {
                    ?>

                         <a class="btn red cambiar-estado" id="<?php echo($aviso->getIdAviso())?>" estado="<?php echo($aviso->getEstado())?>">
                    <?php
                            echo('Abilidar');
                    ?>
                        </a>

                    <?php
                    }
                    ?>

           </a> </td>
    </tr>

<?php
    }
}
?>
