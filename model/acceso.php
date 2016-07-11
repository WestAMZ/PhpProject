<?php
class Acceso
{
    var $id_acceso;
    var $id_subcategoria;
    var $id_usuario;
    var $permiso;

    public function __construct(){}
    function __contruct($id_acceso, $id_subcategoria, $id_usuario, $permiso)
{
    $this->id_acceso = $id_acceso;
    $this->id_subcategoria = $id_subcategoria;
    $this->id_usuario = $id_usuario;
    $this->permiso = $permiso;
}
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
?>
