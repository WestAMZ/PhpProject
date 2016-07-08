<?php
    include_once(MODELS_DIR .'aviso.php');
    header('Content-type: application/json');
    if($_GET)
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $aviso = Aviso::getAvisoById($id);
            echo ('{ "aviso" : [' );
            echo(JSON_encode($aviso));
            echo (']}' );
        }
    }
?>
