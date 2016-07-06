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
           $aviso = new Aviso();
           $aviso->setIdAviso($_POST['id_aviso']);
           $aviso->setTitulo($_POST['titulo']);
           $aviso->setContenido($_POST['contenido']);
           $aviso->setFechaPublicacion($_POST['fecha_publicacion']);
           $aviso->setFechaFinalizacion($_POST['fecha_finalizacion']);
           $aviso->setEstado(null);
           $aviso->setIdEmpleado($_SESSION['id_empleado']);
           $aviso->updateAviso();
            echo ('1');
        }
        //mode 2: cambio de estado
        else if($_GET['mod']==2)
        {
            Aviso::cambiarEstado($_GET['id'],$_GET['estado']);
            echo('1');
        }


?>
