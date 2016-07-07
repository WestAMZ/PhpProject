<?php

    include(MODELS_DIR . 'puesto.php');

        //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
        if(!isset($_GET['mod']))
        {
            $puesto = new
            Puesto(null,$_POST['nombre'],$_POST['descripcion']);

            if($puesto->savePuesto())
            {
                echo ('1');
            }
            else
            {
                echo ($puesto->add_error());
            }
        }
        //mode 1 : update
        else if($_GET['mod']==1)
        {
            $sitio = new Sitio($_POST['id_insidencia'],$_POST['nombre'],$_POST['pais'],$_POST['ciudad'],$_POST['direccion'],$_POST['telefono'],null,null,1);
            $sitio->updateSitio();
            echo ('1');
        }
        //mode 2: cambio de estado
        else if($_GET['mod']==2)
        {
            Sitio::cambiarEstado($_GET['id'],$_GET['estado']);
            echo('1');
        }


?>
