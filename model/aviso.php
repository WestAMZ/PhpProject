<?php
class Aviso
{
    var $id_aviso;
    var $titulo;
    var $contenido;
    var $fecha_publicacion;
    var $fecha_finalizacion;
    var $estado;
    var $id_empleado

    function __contruct($id_aviso, $titulo, $contenido, $fecha_publicacion, $fecha_finalizacion, $estado, $id_empleado)
{
    $this->id_aviso = $id_aviso;
    $this->titulo = $titulo;
    $this->contenido = $contenido;
    $this->fecha_publicacion = $fecha_publicacion;
    $this->fecha_finalizacion = $fecha_finalizacion;
    $this->estado = $estado;
    $this->id_empleado = $id_empleado
}
function setIdAviso($id_aviso)
{
    $this->id_aviso = $id_aviso;
}
function getIdAviso()
{
    return $this->id_aviso;
}
function setTitulo($titulo)
{
    $this->titulo = $titulo;
}
function getTitulo()
{
    return $this->titulo;
}
function setContenido($contenido)
{
    $this->contenido = $contenido;
}
function getContenido()
{
    return $this->contenido;
}
function setFechaPublicacion($fecha_publicacion)
{
    $this->fecha_publicacion = $fecha_publicacion;
}
function getFechaPublicacion()
{
    return $this->fecha_publicacion;
}
function setFechaFinalizacion($fecha_finalizacion)
{
    $this->fecha_finalizacion = $fecha_finalizacion;
}
function getFechaFinalizacion()
{
    return $this->fecha_finalizacion;
}
function setEstado($estado)
{
    $this->estado = $estado;
}
function getEstado()
{
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
}
?>
