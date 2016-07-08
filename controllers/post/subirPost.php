<?php
    include(MODELS_DIR . 'sitio.php');
    if($_POST)
    {
        //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
        if(Uploader::upload($_POST['uploadedfile']))
        {

        }

    }

?>
