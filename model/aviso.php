<?php
class Aviso
{
    var $id_aviso;
    var $titulo;
    var $contenido;
    var $fecha_publicacion;
    var $fecha_finalizacion;
    var $estado;
    var $id_empleado;

    public function __construct(){}
    function __contruct($id_aviso, $titulo, $contenido, $fecha_publicacion, $fecha_finalizacion, $estado, $id_empleado)
{
    $this->id_aviso = $id_aviso;
    $this->titulo = $titulo;
    $this->contenido = $contenido;
    $this->fecha_publicacion = $fecha_publicacion;
    $this->fecha_finalizacion = $fecha_finalizacion;
    $this->estado = $estado;
    $this->id_empleado = $id_empleado;
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
static function getAvisoById($id)
{
        Connection :: connect();
        $query = "SELECT `idaviso`, `titulo`, `contenido`, `fecha_publicacion`, `fecha_finalizacion`, `estado`, `id_empleado` FROM `aviso` WHERE `idaviso` = '$id' ";
        $result = Connection::getConnection()->query($query);

        $row = $result ->fetch_assoc();

        //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
        $aviso = new Aviso( $row['idaviso'] ,$row['titulo'] , $row['contenido'] ,
        $row['fecha_publicacion'],$row['fecha_finalizacion'] , $row['estado'] ,$row['id_empleado']);


        Connection ::close();
        return $aviso;
}
static function SearchinAvisos($search)
    {
        Connection :: connect();
        $query = "SELECT `idaviso`, `titulo`, `contenido`, `fecha_publicacion`, `fecha_finalizacion`, `estado`, `id_empleado` FROM `aviso` WHERE `titulo` LIKE '%$search%' OR `contenido` LIKE '%$search%'";
        $result = Connection::getConnection()->query($query);
        $avisos = array();
        while( $row = $result ->fetch_assoc())
        {
            $aviso = new Aviso();
            $aviso->setIdAviso($row['idaviso']);
            $aviso->setTitulo($row['titulo']);
            $aviso->setContenido($row['contenido']);
            $aviso->setFechaPublicacion($row['fecha_publicacion']);
            $aviso->setFechaFinalizacion($row['fecha_finalizacion']);
            $aviso->setEstado($row['estado']);
            $aviso->setIdEmpleado($row['id_empleado']);
            array_push($avisos,$aviso);
        }
        Connection ::close();
        return $avisos;
    }
static function getAvisos($id_empleado)
{
        Connection :: connect();
        $query = "SELECT `idaviso`, `titulo`, `contenido`, `fecha_publicacion`, `fecha_finalizacion`, `estado`, `id_empleado` FROM `aviso` WHERE `id_empleado` = '$id_empleado'";
        $result = Connection::getConnection()->query($query);
        $avisos = array();
        while( $row = $result ->fetch_assoc())
        {
            $aviso = new Aviso();
            $aviso->setIdAviso($row['idaviso']);
            $aviso->setTitulo($row['titulo']);
            $aviso->setContenido($row['contenido']);
            $aviso->setFechaPublicacion($row['fecha_publicacion']);
            $aviso->setFechaFinalizacion($row['fecha_finalizacion']);
            $aviso->setEstado($row['estado']);
            $aviso->setIdEmpleado($row['id_empleado']);
            array_push($avisos,$aviso);
                /*
            $aviso = new Aviso( $row['idaviso'],$row['titulo'],$row['contenido'],$row['fecha_publicacion'],$row['fecha_finalizacion'], $row['estado'],$row['id_empleado']);
            array_push($avisos,$aviso);
            */
        }
        Connection ::close();
        return $avisos;
}
}
?>
