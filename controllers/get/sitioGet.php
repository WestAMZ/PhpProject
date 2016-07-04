<?php
    include_once(MODELS_DIR .'sitio.php');
    header('Content-type: application/json');
    if($_GET)
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sitio = Sitio::getSitioById($id);
            echo ('{ "sitio" : [' );
            echo(JSON_encode($sitio));
            echo (']}' );
        }
    }
?>
