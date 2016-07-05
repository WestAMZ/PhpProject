<?php

    include(MODELS_DIR . 'empleado.php');
    include(PHP_DIR . 'mail_sender.php');

    /*if($_POST)
    {*/
        //$id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado
        if(!isset($_GET['mod']))
        {   //$_POST['firma']
            if (isset($_FILES['archivo']))
            {
                echo('hay archivo');
                $archivo = $_FILES['archivo'];
                $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $time = time();
                $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
                //directorio mas nombre de archivo
                if (move_uploaded_file($archivo['tmp_name'], EMPLEADOS_DIR. $nombre))
                {
                    $retorno = 1;
                }
            }

            $empleado = new Empleado                                                         (null,$_GET['nombre1'],$_GET['nombre2'],$_GET['apellido1'],$_GET['apellido2'],$_GET['cedula'],$_GET['telefono'],null,$_GET['id_puesto'],$_GET['id_sitio'],$_GET['id_jefe'],$_GET['inss'],null,1);
            $password = Connection::generarCodigo(10);

            if($empleado->saveEmpleado($_GET['correo'],$_GET['id_role'],null,$password))
            {

                MailSender::sendCountInfo($_GET['correo'],$_GET['correo'],$password);

                echo('1');
            }
            else
            {

                echo ($empleado->add_error);
            }
        }
        //mode 1 : update
        else if($_GET['mod']==1)
        {
            //firma esta en null
            $id_mod = $_GET['id'];
            $empleado = new Empleado ($id_mod,$_GET['nombre1'],$_GET['nombre2'],$_GET['apellido1'],$_GET['apellido2'],$_GET['cedula'],$_GET['telefono'],null,$_GET['id_puesto'],$_GET['id_sitio'],$_GET['id_jefe'],$_GET['inss'],null,1);
            $empleado->update();
        }
    /*}*/
?>
