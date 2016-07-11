<?php
    include_once(MODELS_DIR .'subcategoria.php');
    header('Content-type: application/json');
    if($_GET)
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $permiso = Permiso ::getSubcategoriaById($id);
            echo ('{ "permiso" : [' );
            echo(JSON_encode($subcategoria));
            echo (']}' );
        }
    }
?>
