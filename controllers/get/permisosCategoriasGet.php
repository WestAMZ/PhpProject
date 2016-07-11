<?php
    /* <div class="input-field col s6 m2">

                    <div class="input-field col s6 m2">
                        <a id="select-jefe" class="waves-effect waves-light btn">jefe</a>
                    </div>

                </div>*/
    include(MODELS_DIR . 'subcategoria.php');
    $subcategorias = Subcategoria::getAllSubcategorias($_GET['id']);
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
