<?php
    include(MODELS_DIR . 'subcategoria.php');
    include(MODELS_DIR. 'archivo.php');
    if(!isset($_GET['mod']))
    {

        if (isset($_FILES['archivo']))
        {

            $archivo = $_FILES['archivo'];
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $time = time();
            $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
            //directorio mas nombre de archivo
            $dir_archivo = Subcategoria::getFullUrlById($_GET['id_subcategoria']);
            $dir_archivo = DOCS_DIR . $dir_archivo .'/';

            if (move_uploaded_file($archivo['tmp_name'], $dir_archivo . $nombre))
            {
                $_archivo = new Archivo();
                $_archivo->id_archivo = null;
                $_archivo->nombre = $nombre;
                $_archivo->fecha_subida = null;
                $_archivo->descripcion = $_GET['descripcion'];
                $_archivo->id_subcategoria = $_GET['id_subcategoria'];
                $_archivo->id_usuario = $_SESSION['id_usuario'];
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
