<?php
    include_once(MODELS_DIR .'categoria.php');
    header('Content-type: application/json');
    if($_GET)
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $categoria = Categoria::getCategoriaById($id);
            echo ('{ "categoria" : [' );
            echo(JSON_encode($categoria));
            echo (']}' );
        }
    }
?>
