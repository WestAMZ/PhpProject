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
                     <button class="btn green">
                    <?php
                            echo('Desabilidar');
                    ?>
                     </button>

                    <?php
                    }
                    else
                    {
                    ?>

                         <button class="btn red">
                    <?php
                            echo('Abilidar');
                    ?>
                         </button
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
    $avisos = Aviso::getAvisos();
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
                     <button class="btn green">
                    <?php
                            echo('Desabilidar');
                    ?>
                     </button>

                    <?php
                    }
                    else
                    {
                    ?>

                         <button class="btn red">
                    <?php
                            echo('Abilidar');
                    ?>
                         </button

                    <?php
                    }
                    ?>
           </a> </td>
    </tr>

<?php
    }
}
?>
