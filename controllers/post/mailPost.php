<?php
    include( PHP_DIR . 'mail_sender.php');
    echo('MAil post');
    if(isset($_GET['id']))
    {
        $id_usuario = $_GET['id'];

        Connection::connect();
        $query = "SELECT password,correo FROM usuario WHERE id_usuario = '$id_usuario' LIMIT 1";
        $result = Connection::getConnection()->query($query);
        if($result->num_rows >0)
        {
            $row = $result->fetch_assoc();
            //miramos si ya tiene contraseña asociada en este cason no hacemos nada
            if($row['password']=="")
            {
                //generamos contraseña
                $pass = Connection::generarCodigo(10);
                $correo = $row['correo'];
                $enviado = MailSender::sendCountInfo($correo,$correo,$pass);
                $pass = Connection::codify($pass);
                if($enviado)
                {
                    Connection::getConnection()->query("UPDATE usuario SET password = '$pass' WHERE id_usuario = '$id_usuario' LIMIT 1");
                    echo('ya se ha enviado correo de datos de cuenta');
                }
            }
            else
            {
                echo('Ya se ha enviado un correo de con los datos de cuenta');
            }

        }
        else
        {
            echo('id no asociado a cuentaq de usuario');
        }
        Connection::close();
    }

?>
