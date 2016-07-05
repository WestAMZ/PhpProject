<?php

    include(MODELS_DIR . 'aviso.php');

        //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
        if(!isset($_GET['mod']))
        {
           $aviso = new Aviso();
           $aviso->setIdAviso(null);
           $aviso->setTitulo($_POST['titulo']);
           $aviso->setContenido($_POST['contenido']);
           $aviso->setFechaPublicacion($_POST['fecha_publicacion']);
           $aviso->setFechaFinalizacion($_POST['fecha_finalizacion']);
           $aviso->setEstado(1);
           $aviso->setIdEmpleado($_SESSION['id_empleado']);
            if($aviso->saveAvisos())
            {
                echo ('1');
            }
            else
            {
                echo ($aviso->add_error());
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
