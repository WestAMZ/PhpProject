<?
    if($_POST)
    {
        $pass = Connection::generarCodigo(15);
        $usuario = new Usuario(null,$_POST['correo'],$pass,null,$_POST['role'],1,null);
        if($usuario->saveUsuario())
        {

        }
        else
        {
            echo($usuario->add_error());
        }
    }
?>
