<?php
class Acceso
{
    var $id_acceso;
    var $id_subcategoria;
    var $id_usuario;
    var $permiso;

function __construct(){}

function setIdAcceso($id_acceso)
{
    $this->id_acceso = $id_acceso;
}
function getIdSubcategoria()
{
    return $this->id_subcategoria;
}
function setIdUsuario($id_usuario)
{
    $this->id_usuario = $id_usuario;
}
function getIdUsuario()
{
    return $this->id_usuario;
}
function setPermiso($permiso)
{
    $this->permiso = $permiso;
}
function getPermiso()
{
    return $this->permiso;
}

}
static function getAccesoByEmpleadoAndCategoria($id_empleado, $id_categoria)
{
    Connection :: connect();
    $query = "SELECT a.id_acceso,
                     a.permiso,
	                 a.id_subcategoria,
                     a.usuario_id_usuario
              FROM usuario u INNER JOIN acceso a ON u.id_usuario = a.usuario_id_usuario
              INNER JOIN sub_categoria sc ON a.id_subcategoria = sc.id_subcategoria
              WHERE e.id_empleado = '$id_empleado' AND c.id_categoria = $id_categoria";
    $result = Connection :: getConnection()->query($query);
    $accesos = array();
    while($row = $result->fetch_assoc())
    {
        $acceso = new Acceso();
        $acceso->setIdAcceso($row['id_acceso']);
        $acceso->setIdSubcategoria($row['id_subcategoria']);
        $acceso->setIdUsuario($row['usuario_id_usuario']);
        $acceso->setPermiso($row['permiso']);
        array_push($accesos, $acceso);
    }
    Connection :: close();
    return $accesos;
}

static function saveAcceso()
{

}

?>
