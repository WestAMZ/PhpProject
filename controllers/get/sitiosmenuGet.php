<?php
    include( MODELS_DIR . 'sitio.php');
    $sitios = Sitio::getSitiosDisponibles();
     foreach ($sitios as &$sitio)
    {
?>

    <a class="menu-btn categoria col s11 m3 offset-s1 offset-m1" href="?view=insidenciasitio&id=<?php echo($sitio->getIdSitio())?>">
        <div class="menu-div">
            <img src="<?php echo(IMG_DIR . "market.png") ?>" alt="">
        </div>
        <div class="menu-div">
            <p class="title">
                <?php echo($sitio->getName())?>
            </p>
        </div>
    </a>
    <?php
     }
?>
