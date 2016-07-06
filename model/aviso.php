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
        $aviso = new Aviso();
        $aviso->setIdAviso($row['idaviso']);
        $aviso->setTitulo($row['titulo']);
        $aviso->setContenido($row['contenido']);
        $aviso->setFechaPublicacion($row['fecha_publicacion']);
        $aviso->setFechaFinalizacion($row['fecha_finalizacion']);
        $aviso->setEstado($row['estado']);
        $aviso->setIdEmpleado($row['id_empleado']);
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

        }
        Connection ::close();
        return $avisos;
}
 function saveAvisos()
{
    $added = false;
    Connection :: connect();

    try
    {
        $query = "INSERT INTO aviso(`titulo`,`contenido`,`fecha_publicacion`,`fecha_finalizacion`,`estado`,`id_empleado`) VALUES('$this->titulo','$this->contenido','$this->fecha_publicacion','$this->fecha_finalizacion','1','$this->id_empleado')";
        $result = Connection :: getConnection() -> query($query);
        $added = true;

    }catch(Exception $e)
    {
        $added = false;
        $this->add_error = '<div class="alert alert-dismissible alert-danger">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     ha ocurrido un error </div>';
    }

    Connection :: close();

    return $added;
}
function updateAviso()
{
    Connection :: connect();
    $query = "UPDATE aviso set `titulo` = '$this->titulo',`contenido` = '$this->contenido',`fecha_publicacion` = '$this->fecha_publicacion', `fecha_finalizacion` = '$this->fecha_finalizacion' WHERE `idaviso` = '$this->id_aviso'";
    $result = Connection::getConnection()->query($query);
    Connection :: close();
}
static function cambiarEstado($id_aviso,$estado)
{
    Connection :: connect();
    $query = "UPDATE aviso set `estado` = '$estado' WHERE `idaviso` = '$this->id_aviso'";
    $result = Connection::getConnection()->query($query);
    Connection :: close();
}

static function getAvisosDelDia()
{
    Connection :: connect();
        $query = "SELECT a.idaviso, a.titulo,a.contenido,a.fecha_publicacion,a.fecha_finalizacion,a.estado,a.id_empleado FROM aviso a INNER JOIN empleado e on a.id_empleado = e.id_empleado INNER JOIN sitio s on e.id_sitio = s.id_sitio WHERE a.estado = true and a.fecha_finalizacion >= CURRENT_DATE and a.fecha_publicacion <= CURRENT_DATE";
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
        Connection :: close();
        return $avisos;
}
}
?>
