<?php
    include( MODELS_DIR . 'insidencia.php');
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
    $insidencias = insidencia::Searchininsidencias($_GET['search']);
    foreach ($insidencias as &$insidencia)
    {
?>
    <tr id="<?php echo($insidencia->getIdinsidencia())?>" class="insidencia">
        <td>
            <?php echo($insidencia->getIdInsidencia())?>
        </td>
        <td>
            <?php echo($insidencia->getEstado())?>
        </td>
        <td>
            <?php echo($insidencia->getFecha())?>
        </td>
        <td>
            <?php echo($insidencia->getTitulo())?>
        </td>
        <td>
            <?php echo($insidencia->getDescripcion())?>
        </td>
        <td>
            <?php echo($insidencia->getId_Usuario())?>
        </td>
    </tr>
    <?php
    }
}
else
{
    $insidencias = Insidencia::getInsidencias();
    foreach ($insidencias as &$insidencia)
    {

?>

        <tr id="<?php echo($insidencia->getIdInsidencia())?>" class="insidencia">
            <td>
                <?php echo($insidencia->getIdInsidencia())?>
            </td>
            <td>
                <?php echo($insidencia->getEstado())?>
            </td>
            <td>
                <?php echo($insidencia->getFecha())?>
            </td>
            <td>
                <?php echo($insidencia->getTitulo())?>
            </td>
            <td>
                <?php echo($insidencia->getDescripcion())?>
            </td>
            <td>
                <?php echo($insidencia->getId_Usuario())?>
            </td>
        </tr>
        <?php
    }
}
?>
