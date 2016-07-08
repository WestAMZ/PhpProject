<?php

    include(MODELS_DIR . 'empleado.php');
    include(PHP_DIR . 'mail_sender.php');


        //$id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado
        if(!isset($_GET['mod']))
        {   //$_POST['firma']
            $nombre = "";
            $hay_archivo = '0';
            if (isset($_FILES['archivo']))
            {

                $archivo = $_FILES['archivo'];
                $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $time = time();
                $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
                //directorio mas nombre de archivo
                if (move_uploaded_file($archivo['tmp_name'], EMPLEADOS_DIR. $nombre))
                {
                    $hay_archivo = '1';
                }
            }
            if($hay_archivo == '0')
            {
                $nombre="";
            }
            $empleado = new Empleado();
            $empleado->setId_Empleado(null);
            $empleado->setNombre1($_GET['nombre1']);
            $empleado->setNombre2($_GET['nombre2']);
            $empleado->setApellido1($_GET['apellido1']);
            $empleado->setApellido2($_GET['apellido2']);
            $empleado->setCedula($_GET['cedula']);
            $empleado->setTelefono($_GET['telefono']);
            $empleado->setFirma(null);
            $empleado->setId_Puesto($_GET['id_puesto']);
            $empleado->setId_Sitio($_GET['id_sitio']);
            $empleado->setId_Jefe($_GET['id_jefe']);
            $empleado->setInss($_GET['inss']);
            $empleado->setFecha_Ingreso($_GET['fecha_ingreso']);
            $empleado->setEstado(1);
            $empleado->setDocumentos($nombre);


            if($empleado->saveEmpleado($_GET['correo'],$_GET['id_role'],null,""))
            {

                //MailSender::sendCountInfo($_GET['correo'],$_GET['correo'],$password);
                $correo = $_GET['correo'];
                Connection::connect();
                $query = "SELECT id_usuario FROM usuario WHERE correo = '$correo' ";
                $result = Connection::getConnection()->query($query);
                $row = $result ->fetch_assoc();

                Connection::close();
                echo($row['id_usuario']);
            }
            else
            {

                echo ($empleado->add_error);
            }
        }
        //mode 1 : update
        else if($_GET['mod']==1)
        {
            $nombre = "";
            $hay_archivo = '0';
            if (isset($_FILES['archivo']))
            {

                $archivo = $_FILES['archivo'];
                $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $time = time();
                $nombre = "{$_POST['nombre_archivo']}_$time.$extension";
                //directorio mas nombre de archivo
                if (move_uploaded_file($archivo['tmp_name'], EMPLEADOS_DIR. $nombre))
                {
                    $hay_archivo = '1';
                }
            }
            if($hay_archivo == '0')
            {
                 $empleado = Empleado:: getEmpleadoById($_GET['id']);
                $nombre = $empleado->getDocumentos();
            }
            //firma esta en null
            //$id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado
            $id_mod = $_GET['id'];

            $empleado = new Empleado();
            $empleado->setId_Empleado($id_mod);
            $empleado->setNombre1($_GET['nombre1']);
            $empleado->setNombre2($_GET['nombre2']);
            $empleado->setApellido1($_GET['apellido1']);
            $empleado->setApellido2($_GET['apellido2']);
            $empleado->setCedula($_GET['cedula']);
            $empleado->setTelefono($_GET['telefono']);
            $empleado->setFirma(null);
            $empleado->setId_Puesto($_GET['id_puesto']);
            $empleado->setId_Sitio($_GET['id_sitio']);
            $empleado->setId_Jefe($_GET['id_jefe']);
            $empleado->setInss($_GET['inss']);
            $empleado->setFecha_Ingreso($_GET['fecha_ingreso']);
            $empleado->setEstado($_GET['estado']);
            $empleado->setDocumentos($nombre);
            $empleado->update($_GET['correo']);
        }

?>
