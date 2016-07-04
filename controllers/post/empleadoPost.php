<?php

    include(MODELS_DIR . 'empleado.php');
    include(PHP_DIR . 'mail_sender.php');

    if($_POST)
    {
        //$id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado
        if(!isset($_GET['mod']))
        {   //$_POST['firma']
            $empleado = new Empleado                                                         (null,$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['cedula'],$_POST['telefono'],null,$_POST['id_puesto'],$_POST['id_sitio'],$_POST['id_jefe'],$_POST['inss'],null,1);
            $password = Connection::generarCodigo(10);

            if($empleado->saveEmpleado($_POST['correo'],$_POST['id_role'],null,$password))
            {

                MailSender::sendCountInfo($_POST['correo'],$_POST['correo'],$password);

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
            $empleado = new Empleado ($id_mod,$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['cedula'],$_POST['telefono'],null,$_POST['id_puesto'],$_POST['id_sitio'],$_POST['id_jefe'],$_POST['inss'],null,1);
            $empleado->update();
            echo(1);
        }
    }
?>
