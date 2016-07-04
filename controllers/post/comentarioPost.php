<?php

    include(MODELS_DIR . 'comentario.php');
    if($_POST)
    {

        if(!isset($_GET['mod']))
        {
       //$id_comentario, $fecha, $contenido, $usuario, $id_incidencia
       // $comentario = new Comentario(null,null,$_POST['comentario'],$_SESSION['id_usuario'],$_POST['Id_Insidencia']);
            $comentario = new Comentario();
            $comentario->setIdComentario(null);
            $comentario->setFecha(null);
            $comentario->setContenido($_POST['comentario']);
            $comentario->setUsuario($_SESSION['id_usuario']);
            $comentario->setId_Incidencia($_POST['Id_Insidencia']);

            if($comentario->saveComentario())
            {
                echo ('1');
            }
            else
            {
                echo ($comentario->add_error());
            }
        }
        else if($_GET['mod'] ==  1)
        {
            $comentario = new Comentario();
            $comentario->setIdComentario($_POST['id_comentario']);
            $comentario->setFecha(null);
            $comentario->setContenido($_POST['contenido']);
            $comentario->setUsuario(null);
            $comentario->setId_Incidencia(null);
            $comentario->updateComentario();
            echo('1');
        }
    }
?>
