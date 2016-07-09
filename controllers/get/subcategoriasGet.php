<?php
    include( MODELS_DIR . 'categoria.php');
    $subcategorias = Categoria::getSubcategorias();
     foreach ($categorias as &$categoria)
    {
?>
    <a class="menu-btn categoria col s11 m4 offset-m1" href="#" id="<?php echo($categoria->getIdCategoria())?>">
        <div class="menu-div">
            <img src="<?php echo(IMG_DIR)?>folder-3.svg" alt="">
        </div>
        <div class="menu-div">
            <p class="title">
                <?php echo($categoria->getNombre())?>
            </p>
        </div>
    </a>

    <?php
     }
?>
