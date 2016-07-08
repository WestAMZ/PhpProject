<?php
class Usuario
{
    var $id_usuario;
    var $correo;
    var $contrasena;
    var $foto;
    var $role;
    var $estado;
    var $id_empleado;

    public function __construct(){}
    function __contruct($id_usuario, $correo, $contrasena, $foto, $role, $estado, $id_empleado)
    {
        $this->id_usuario = $id_usuario;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
        $this->foto = $foto;
        $this->role = $role;
        $this->estado = $estado;
        $this->id_empleado = $id_empleado;
    }
    function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    function getIdUsuario()
    {
        return $this->id_usuario;
    }
    function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
    function getContrasena()
    {
        return $this->contrasena;
    }
    function setFoto($foto)
    {
        $this->foto = $foto;
    }
    function getFoto()
    {
        if($this->foto == null)
        {
            return 'profile.svg';
        }
        else
        {
            return $this->foto;
        }
    }
    function setRole($role)
    {
        $this->role = $role;
    }
    function getRole()
    {
        return $this->role;
    }
    function setEstado($estado)
    {
        $this->estado = $estado;
    }
    function getEstado()
    {
        return $this->estado;
        return $this->estado;
    }
    function setIdEmpleado($id_empleado)
    {
        $this->id_empleado = $id_empleado;
    }
    function getIdEmpleado()
    {
        return $id_empleado;
    }

    static function saveUsuario()
    {
        $added = false;
        Connection :: connect();
        $returned = Connection :: getConnection() -> query("SELECT `correo` FROM `usuario` WHERE `correo` = '$this->correo' LIMIT 1");
        if(!($returned->num_rows >0))
        {

           $returned2 = Connection :: getConnection() -> query("SELECT MAX(id_usuario) as id_usuario FROM usuario");
           $obj = $returned2->fetch_assoc();
            $obj1 = $obj['id_usuario'];
            $query = "INSERT INTO usuario(`correo`,`password`,`id_empleado`,`role`,`estado`,`foto`) VALUES('$this->correo',null,$obj1,'$this->role',true,null)";

            $result = Connection :: getConnection() -> query($query);
            $added = true;
        }
        else
        {
            $obj = $returned->fetch_assoc();
                if(strtolower($obj['correo']) == strtolower($this->correo))
                    {
                     $this->add_error = '<div class="alert alert-dismissible alert-danger">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     ya existe un usuario con este correo electronico </div>';
                    }
        }

        return $added;
    }

    //$id_usuario, $correo, $contrasena, $foto, $role, $estado, $id_empleado
    static function getUsuarioById($id)
    {
        Connection::connect();
            $query = "SELECT `id_usuario` as id_usuario,`correo` as correo,`password` as password,`id_empleado` as id_empleado,`role` as role,`estado` as estado,`foto` as foto FROM `usuario` WHERE `id_usuario` = '$id'";

            $result = Connection::getConnection()->query($query);
            $row=$result->fetch_assoc();
            $usuario =  new Usuario();

            $usuario->setIdUsuario($row['id_usuario']);
            $usuario->setCorreo($row['correo']);
            $usuario->setContrasena($row['password']);
            $usuario->setFoto($row['foto']);
            $usuario->setRole($row['role']);
            $usuario->setEstado($row['estado']);
            $usuario->setIdEmpleado($row['id_empleado']);

        //Usuario($row['id_usuario'],$row['$correo'],$row['password'],$row['foto'],$row['role'],$row['estado'],$row['id_empleado']);
            Connection::close();
            return $usuario;
    }
    static function getNameUser($id)
    {
            Connection::connect();
            $query = "select CONCAT(e.nombre1,' ',e.apellido1) as nombre from  usuario u INNER JOIN empleado e on u.id_empleado = e.id_empleado where u.id_usuario = '$id'";
            $result = Connection::getConnection()->query($query);
            $row=$result->fetch_assoc();
            $fullname = $row['nombre'];
            Connection::close();
            return $fullname;
    }

    static function saveUser()
    {
        Connection::connect();
        $query="INSERT
                    INTO
                      `usuario`
                      (
                        `id_usuario`,
                        `correo`,
                        `password`,
                        `id_empleado`,
                        `role`,
                        `estado`,
                        `foto`
                      )
                    VALUES
                    (
                      '$this->id_usuario',
                      '$this->correo',
                      'Connection::codify($this->password)',
                      '$this->id_empleado',
                      '$this->role',
                      '$this->estado',
                      '$this->foto'
                    )";
        Connection::getConnection()->query();
        Connection::close();
    }
    function searchInUser($search)
    {
        Connection :: connect();
        $query = "SELECT u.id_usuario, e.cedula, CONCAT(e.`nombre1`,' ', e.`nombre2`,' ', e.`apellido1`,' ',e.`apellido2`) as nombre, u.correo, u.password as contrasena FROM empleado e INNER JOIN usuario u on e.id_empleado = u.id_empleado HAVING nombre LIKE  '%$search%' or `cedula` LIKE '%$search%' OR u.correo LIKE '%$search%'";
        $result = Connection::getConnection()->query($query);
        $usuarios = array();
        while($row = $result ->fetch_assoc())
        {
           $usuario = new Usuario($row['id_usuario'],$row['correo'],$row['contrasena'],null,null,null,null);
            array_push($usuarios,$usuario);
        }
        Connection ::close();
        return $usuarios;
    }

}
?>
