<?php
class Comentario
{
    var $id_comentario;
    var $fecha;
    var $contenido;
    var $usuario;
    var $id_incidencia;

    public function __construct(){}
    function __contruct($id_comentario, $fecha, $contenido, $usuario, $id_incidencia)
    {
        $this->id_comentario = $id_comentario;
        $this->fecha = $fecha;
        $this->contenido = $contenido;
        $this->usuario = $usuario;
        $this->id_incidencia = $id_incidencia;
    }

    function setIdComentario($id_comentario)
    {
    $this->id_comentario = $id_comentario;
    }
    function getIdComentario()
    {
    return $this->id_comentario;
    }
    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function getFecha()
    {
        return $this->fecha;
    }
    function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
    function getContenido()
    {
        return $this->contenido;
    }
    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    function getUsuario()
    {
        return $this->usuario;
    }
    function setId_Incidencia($id_incidencia)
    {
        $this->id_incidencia = $id_incidencia;
    }
    function getId_Incidencia()
    {
        return $this->id_incidencia;
    }
    static function getTotalComment($idinsidencia)
    {
            Connection::connect();
            $query = "SELECT COUNT(id_comentario) as cantidad FROM `comentario` WHERE id_insidencias = '$idinsidencia'";
            $result = Connection::getConnection()->query($query);
            $row=$result->fetch_assoc();
            $cantidad = $row['cantidad'];
            Connection::close();
            return $cantidad;
    }
    static function getComentarios($idinsidencia)
    {

        Connection::connect();
        $query = "SELECT `id_comentario`,`fecha`,`contenido`,`id_usuario`,`id_insidencias` FROM `comentario` WHERE `id_insidencias` = '$idinsidencia'";
        $result = Connection::getConnection()->query($query);
        $comentarios = array();
        while($row = $result->fetch_assoc())
        {
            $comentario = new Comentario();
            $comentario->setIdComentario($row['id_comentario']);
            $comentario->setFecha($row['fecha']);
            $comentario->setContenido($row['contenido']);
            $comentario->setUsuario($row['id_usuario']);
            $comentario->setId_Incidencia($row['id_insidencias']);
            // $comentario = new Comentario($row['id_comentario'],$row['fecha'],$row['contenido'],$row['id_usuario'],$row['id_insidencias']);

            array_push($comentarios,$comentario);

        }
        Connection::close();
        return $comentarios;
    }
    function saveComentario()
    {
        $added = false;
        Connection::connect();
        try
        {
            $query = "INSERT INTO comentario(`fecha`,`contenido`,`id_insidencias`,`id_usuario`,`Adjunto`) VALUES(CURRENT_DATE,'$this->contenido','$this->id_incidencia','$this->usuario',null)";
             $result = Connection :: getConnection() -> query($query);
            $added = true;
        }catch(Exception $e)
        {
            $this->add_error = '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    ha ocurrido un error !! </div>';
        }
        Connection::close();
         return $added;
    }
    function updateComentario()
    {
        Connection::connect();
        $query = "UPDATE `comentario` SET`contenido` = '$this->contenido' WHERE `id_comentario` = '$this->id_comentario'";
        $result = Connection::getConnection()->query($query);
        Connection :: close();

    }
}
?>
