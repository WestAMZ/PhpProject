<?php

    include_once(MODELS_DIR . 'subcategoria.php');
    include_once(MODELS_DIR . 'categoria.php');
    $categoria = Categoria::getCategoriaByUrl($_GET['url']);
    $id = $categoria->getIdCategoria();
    $subcategorias = Subcategoria::getAllSubcategorias($id);
    foreach ($subcategorias as &$subcategoria)
    {
        $nombre = $subcategoria->getNombre();
        $id = $subcategoria->getIdSubcategoria();
?>
    <div class="row col s6">
        <label for="">
           <?php echo($nombre)?>
            <select class="browser-default" name="<?php echo($id)?>" required>
                <option value="" selected>Permiso</option>
                <option value="n" selected>Ninguno</option>
                <option value="r">Lectura</option>
                <option value="rw">Lectura y escritura</option>
            </select>
        </label>
    </div>
<?php
    }
?>
