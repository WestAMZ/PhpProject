<?php
    Connection::initSession();
    if(isset($_SESSION['role']))
    {
        switch($_SESSION['role'])
        {
            /*
                Roles-> 1:gerente general, 2:gerente de sitio , 3: ampleado
            */
            case 1 :include(PHP_DIR . 'menu-ggController.php');
                    break;

            case 2 :include(PHP_DIR . 'menu-gsController.php');
                    break;

            case 3 :include(PHP_DIR . 'menu-eController.php');
                    break;

            /* No se deberia de dar pero por si acaso*/

            default:header('location : ?view=index');
                    break;

        }
    }
    else
    {
        header('location : ?view=index');
    }
?>
