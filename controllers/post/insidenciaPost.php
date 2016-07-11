<?php

    include(MODELS_DIR . 'insidencia.php');

    //if($_POST)
    //{


            if(!isset($_GET['mod']))
            {

                $retorno = 0;
                $nombre = "";
                if (isset($_FILES['archivo']))
                {
                    echo('hay archivo');
                    $archivo = $_FILES['archivo'];
                    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                    $time = time();
                    $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
                    //directorio mas nombre de archivo
                    if (move_uploaded_file($archivo['tmp_name'], INSIDENCIAS_DIR. $nombre))
                    {
                        $retorno = 1;
                    }
                }




                $insidencia = new Insidencia(null,null,$_GET['descripcion'],0,0,$_SESSION['id_usuario'],$nombre, $_GET['titulo']);
                if($insidencia->saveInsidencia())
                {
                    echo ('1');
                }
                    else
                {
                    echo ($insidencia->add_error());
                }
            }
            //modificar
            else if($_GET['mod']== 1)
            {

            }
            //cambiar estado
            else if($_GET['mod']== 2)
            {
                $id = $_GET['id'];
                $estado = $_GET['estado'];
                Insidencia::cambiarEstado($id,$estado);
                echo("1");
            }

    //}
?>
