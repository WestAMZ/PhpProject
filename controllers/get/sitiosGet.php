<?php
    include( MODELS_DIR . 'sitio.php');
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
    $sitios = Sitio::SearchinSitios($_GET['search']);
    foreach ($sitios as &$sitio)
    {
?>
    <tr class="sitio">
        <td><?php echo($sitio->getIdSitio())?></td>
        <td><?php echo($sitio->getName())?></td>
        <td><?php echo($sitio->getCity())?></td>
        <td><?php echo($sitio->getCountry())?></td>
        <td><?php echo($sitio->getPhone())?></td>
        <td><?php echo($sitio->getAddress())?></td>
        <td>
            <button class="btn cambiar-estado" id="<?php echo($sitio->getIdSitio())?>" estado="<?php echo($sitio->getStatus())?>">
                <?php
                    if($sitio->getStatus()==1)
                    {
                        echo('Desabilidar');
                    }
                    else
                    {
                        echo('Habilitar');
                    }
                ?>
            </button></td>
    </tr>
<?php
    }
}
else
{
    $sitios = Sitio::getSitios();
    foreach ($sitios as &$sitio)
    {

?>

    <tr class="sitio">
        <td><?php echo($sitio->getIdSitio())?></td>
        <td><?php echo($sitio->getName())?></td>
        <td><?php echo($sitio->getCity())?></td>
        <td><?php echo($sitio->getCountry())?></td>
        <td><?php echo($sitio->getPhone())?></td>
        <td><?php echo($sitio->getAddress())?></td>
        <td>
            <button class="btn cambiar-estado" id="<?php echo($sitio->getIdSitio())?>" estado="<?php echo($sitio->getStatus())?>">
                <?php
                    if($sitio->getStatus()==1)
                    {
                        echo('Desabilidar');
                    }
                    else
                    {
                        echo('Habilitar');
                    }
                ?>
            </button></td>
    </tr>

<?php
    }
}
?>
