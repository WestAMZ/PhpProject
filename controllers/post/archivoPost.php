<?php
    if(!isset($_GET['mod']))
    {

        if (isset($_FILES['archivo']))
        {

            $archivo = $_FILES['archivo'];
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $time = time();
            $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
            //directorio mas nombre de archivo
            if (move_uploaded_file($archivo['tmp_name'], EMPLEADOS_DIR. $nombre))
            {
                $_archivo = new Archivo(null,$nombre,$_GET['descripcion'],null,$_SESSION['id_usuario']);
                if($_archivo->saveArchivo())
                {
                    echo(1);
                }
                else
                {
                    echo($_archivo->error);
                }
            }
        }
    }
    /*
        update
    */
    else if($_GET['mod']==1)
    {
        if (isset($_FILES['archivo']))
        {

            $archivo = $_FILES['archivo'];
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $time = time();
            $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
            //directorio mas nombre de archivo
            if (move_uploaded_file($archivo['tmp_name'], EMPLEADOS_DIR. $nombre))
            {
                $_archivo = new Archivo($_GET['id_archivo'],$nombre,$_GET['descripcion'],null,$_SESSION['id_usuario']);
                if($_archivo->update())
                {
                    echo(1);
                }
                else
                {
                    echo($_archivo->error);
                }
            }
        }
        else
        {
            $_archivo = Archivo::getArchivoById($_GET['id_archivo']);
            $_archivo->setDescripcion($_GET['descripcion']);
            if($_archivo->update())
            {
                echo(1);
            }
            else
            {
                echo($_archivo->error);
            }
        }

    }
?>
