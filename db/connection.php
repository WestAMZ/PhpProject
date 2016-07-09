<?php
    class Connection
    {
        private static $mysqli = null;
        //validacion de acceso
        public static function login($correo,$pass)
        {
            //error_reporting(~E_WARNING);


            self :: connect();
            $pass = self :: codify($pass);
            $query = "SELECT id_usuario,password,role,u.id_empleado,foto,id_sitio FROM  `empleado` e INNER JOIN usuario u ON e.id_empleado = u.id_empleado WHERE correo = '$correo' ";
            $result = self :: getConnection() ->query($query);
            if($result->num_rows > 0)
            {
                $row = $result -> fetch_assoc();

                if (!($row['password'] == $pass))
                {
                    echo "Datos ingresados incorrectos o cuenta inactiva";
                }
                else
                {
                    self::initSession();
                    $_SESSION['session'] = 'active';
                    $_SESSION['id_sitio'] = $row['id_sitio'];
                    $_SESSION['id_usuario'] = $row['id_usuario'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['id_empleado'] = $row['id_empleado'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['hora_conexion'] = date("Y-m-d") .' '. date("h:i:sa");
                    echo 1;
                }
            }
            else
            {
                echo('usuario inexistente o inactivo');
            }
            self :: getConnection()->close();

        }
        //conecction

        public static function connect()
        {
            //nombre del host

            $host ="localhost";
            $db = "ebco";
            $user = 'root';
            $pass = 'sistema123';

/*
            $host ="localhost";
            $db = "ebco_sistema";
            $user = 'ebco_sistema';
            $pass = '$$ebco';
*/

            self:: $mysqli =new mysqli($host, $user, $pass,$db);
            if( self :: $mysqli -> connect_error)
            {
                 self :: $mysqli -> close();
                 self :: $mysqli = null;
            }
            return self :: $mysqli -> connect_error;
        }

        public static function close()
        {
            self :: $mysqli->close();
            self :: $mysqli = null;
        }

        public static function logout()
        {
            session_start();
            $_SESSION['session'] = null;
            $_SESSION['id_usuario'] = null;
            $_SESSION['id_empleado'] = null;
            $_SESSION['role'] = null;
            $_SESSION['foto'] = null;
            session_unset();
            session_destroy();
            header('Location: ?view=index');
            self :: close();
        }

        public static function getConnection()
        {
            return self :: $mysqli;
        }

        public static function codify($string)
        {
            for($cont = 0; $cont < 1000; $cont++)
            {
                $string = sha1(md5($string));
            }
            return $string;
        }

        public static function filterAccess()
        {
            #$isSessionActive = (session_status() == PHP_SESSION_ACTIVE);
            $isSessionActive = isset($_SESSION);
            if( ! $isSessionActive)
            {
                session_start();
            }
            if( isset($_SESSION['session'] ))
            {
                if($_SESSION['session']!='active')
                {
                    header('Location: index.php');
                }
            }
            else
            {
                    header('Location: index.php');
            }

        }
        public static function initSession()
        {
            #$isSessionActive = (session_status() == PHP_SESSION_ACTIVE);
            $isSessionActive = isset($_SESSION);
            if(!$isSessionActive)
            {
                session_start();
            }
        }


        public static function filterInput($string)
        {
            self :: connect();
            $string = htmlspecialchars($string);
            $string = self::getConnection() -> real_escape_string($string);
            self :: close();
            return $string;
        }

        /*
                Obtención de IP del visitante
        */
        public static function getIp()
        {

            if (isset($_SERVER["HTTP_CLIENT_IP"]))
            {
                return $_SERVER["HTTP_CLIENT_IP"];
            }
            elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            {
                return $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
            {
                return $_SERVER["HTTP_X_FORWARDED"];
            }
            elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
            {
                return $_SERVER["HTTP_FORWARDED_FOR"];
            }
            elseif (isset($_SERVER["HTTP_FORWARDED"]))
            {
                return $_SERVER["HTTP_FORWARDED"];
            }
            else
            {
                return $_SERVER["REMOTE_ADDR"];
            }
        }
        public static function generarCodigo($longitud)
        {
             $key = '';
             $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
             $max = strlen($pattern)-1;
             for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
             return $key;
        }
    }
?>
