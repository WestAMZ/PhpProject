<?php
    include( MODELS_DIR . 'sitio.php');
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
    $sitios = Sitio::SearchinSitios($_GET['search']);
    foreach ($sitios as &$sitio)
    {
?>
    <tr id="<?php echo($sitio->getIdSitio())?>" class="sitio">
        <td>
            <?php echo($sitio->getIdSitio())?>
        </td>
        <td>
            <?php echo($sitio->getName())?>
        </td>
        <td>
            <?php echo($sitio->getCity())?>
        </td>
        <td>
            <?php echo($sitio->getCountry())?>
        </td>
        <td>
            <?php echo($sitio->getPhone())?>
        </td>
        <td>
            <?php echo($sitio->getAddress())?>
        </td>
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

        <tr id="<?php echo($sitio->getIdSitio())?>" class="sitio">
            <td>
                <?php echo($sitio->getIdSitio())?>
            </td>
            <td>
                <?php echo($sitio->getName())?>
            </td>
            <td>
                <?php echo($sitio->getCity())?>
            </td>
            <td>
                <?php echo($sitio->getCountry())?>
            </td>
            <td>
                <?php echo($sitio->getPhone())?>
            </td>
            <td>
                <?php echo($sitio->getAddress())?>
            </td>
        </tr>

        <?php
    }
}
?>
