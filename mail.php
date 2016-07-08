<?php
    echo('mail');
    require('controllers/php/mail_sender.php');
    require('controllers/core.php');
    MailSender::sendCountInfo('westlymeza@gmail.com','el usuario','el password');
?>
