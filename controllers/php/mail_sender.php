<?php
    class MailSender
    {
        static function sendCountInfo($destine,$user,$pass)
        {
            $mail = new PHPMailer();
            $mail->From     = MAIL_ADDRESS;
            $mail->FromName = SENDER_NAME;
            $mail->AddAddress($destine);
            /*
                Datos del correo
            */
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $mail->Subject  =  'Datos de cuenta EBCO Systems';
            /*
                Cuerpo del correo
            */
            $mail->Body =
            "<h1>EBCO Systems</h1>\n<br/>"+
            "<strong>Correo de acceso:</strong>$user \n<br/>".
            "<strong>Password:</strong>$pass \n<br />";
            /*
                Datos del servidor SMTP
            */
            $mail->IsSMTP();
            $mail->Host = "ssl://smtp.gmail.com:465";//servidor SMTP de google
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_ADDRESS;
            $mail->Password = MAIL_PASS;
            /*
                Activo condificacción utf-8
            */
            $mail->CharSet = 'UTF-8';

            return $mail->Send();
        }

    }
?>
