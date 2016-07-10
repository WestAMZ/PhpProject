<?php
    include( MODELS_DIR . 'subcategoria.php');
    $subcategorias = Subcategoria::getSubcategorias($_GET['url']);

    foreach ($subcategorias as &$subcategoria)
    {
?>
    <a class="menu-btn categoria col s11 m4 offset-m1" href="?<?php echo($subcategoria->getVista())?>" id="<?php echo($subcategoria->getIdCategoria())?>">
        <div class="menu-div">
            <img src="<?php echo(IMG_DIR)?>folder-2.svg" alt="">
        </div>
        <div class="menu-div">
            <p class="title">
                <?php echo($subcategoria->getNombre())?>
            </p>
        </div>
    </a>

    <?php
     }
?>
