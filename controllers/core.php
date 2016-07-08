<?php
    /*---   Nucleo del web site    ---*/

    //error_reporting(~E_WARNING);

    /*
        Directoríos de mvc
    */

    define('HTML_DIR','views/html/');
    define('CSS_DIR','views/css/');
    define('PHP_DIR','controllers/php/');
    define('MODELS_DIR','model/');
    define('DB_DIR','db/');
    define('JS_DIR','views/js/');
    define('LIBS_DIR','controllers/libs/');
    define('AJAX_DIR','controllers/ajax/');
    define('POST_DIR','controllers/post/');
    define('GET_DIR','controllers/get/');
    define('IMG_DIR','views/img/');
    /*
        Directorios de recursos alojados
    */
    define('PROFILE_DIR','sources/public/profile/');
    define('FILE_DIR','sources/public/files/');
    define('INSIDENCIAS_DIR','sources/public/insidencias/');
    define('EMPLEADOS_DIR','sources/private/empleados/');

    /*
        Información de correo
    */
    define('SENDER_NAME','EBCO Systems');
    define('MAIL_ADDRESS','nicatriplblog@gmail.com');
    define('MAIL_PASS','admin2016');

    /*
        Informacion del sitio
    */

    define('SITE_NAME','EBCO System');
    define('SITE_URL','http://localhost/ebco/');
    define('COPY_LIC','Todos los derechos reservados  '. date('Y',time()));

    /*
        Carga de librerías externas php
    */
    include_once(LIBS_DIR . 'libs_loader.php');

    /*
        Carga de clases propias
    */
    require_once(PHP_DIR . 'app.php');
    require_once(DB_DIR . 'connection.php');
?>
