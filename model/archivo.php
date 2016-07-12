<?php
    include_once(MODELS_DIR . 'subcategoria.php');
    class Archivo
    {
        var $id_archivo;
        var $nombre;
        var $fecha_subida;
        var $descripcion;
        var $id_subcategoria;
        var $id_usuario;
        var $estado;

        function __construct(){}
        function contructor($id_archivo,$nombre,$fecha_subida,$descripcion,$id_subcategoria, $id_usuario)
        {
            $this->id_archivo = $id_archivo;
            $this->nombre = $nombre;
            $this->fecha_subida = $fecha_subida;
            $this->descripcion = $descripcion;
            $this->$id_subcategoria = $id_subcategoria;
            $this->id_usuario = $id_usuario;
            return $this;
        }
        /*
            Metodos setters
        */
        function setEstado($estado)
        {
            $this->estado = $estado;
        }
        function setIdArchivo($id_archivo)
        {
            $this->id_archivo = $id_archivo;
        }
        function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        function setFechaSubida($fecha_subida)
        {
            $this->fecha_subida = $fecha_subida;
        }
        function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
        function setIdSubcategoria($id_subcategoria)
        {
            $this->id_subcategoria = $id_subcategoria;
        }
        function setIdUsuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
        }
        /*
            Metodos getters
        */
        function getIdArchivo()
        {
            return $this->id_archivo;
        }
        function getNombre()
        {
            return $this->nombre;
        }
        function getFechaSubida()
        {
            return $this->fecha_subida;
        }
        function getDescripcion()
        {
            return $this->descripcion;
        }
        function getIdSubcategoria()
        {
            return $this->id_subcategoria;
        }
        function getIdUsuario()
        {
            return $this->id_usuario;
        }
        function getEstado()
        {
            return $this->estado;
        }
        function saveArchivo()
        {
            $added = false;
            Connection :: connect();
            try
            {
                $query = "INSERT INTO archivo(fecha_subida, descripcion, nombre, id_subcategoria, id_usuario,estado) VALUES( CURRENT_DATE(), '$this->descripcion', '$this->nombre', '$this->id_subcategoria', '$this->id_usuario' , '1')";
                $result = Connection :: getConnection()->query($query);
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
        static function getArchivo()
        {
            Connection :: connect();
            $query = "SELECT id_archivo,DATE_FORMAT(fecha_subida,'%m-%d-%Y') as fecha_subida, descripcion, nombre, id_subcategoria, id_usuario,estado FROM archivo ";
            $result = Connection :: getConnection()->query($query);
            $archivos = array();
            while($row = $result->fetch_assoc())
            {
                $archivo = new Archivo();
                $archivo->setIdArchivo($row['id_archivo']);
                $archivo->setFechaSubida($row['fecha_subida']);
                $archivo->setDescripcion($row['descripcion']);
                $archivo->setNombre($row['nombre']);
                $archivo->setIdSubcategoria($row['id_subcategoria']);
                $archivo->setIdUsuario($row['id_usuario']);
                $archivo->setEstado($row['estado']);
                array_push($archivos, $archivo);
            }
            Connection :: close();
            return $archivos;
        }

        static function getAllArchivos($id_subcategoria)
        {
            Connection :: connect();
            $query = "SELECT id_archivo,fecha_subida, descripcion, nombre, id_subcategoria, id_usuario,estado FROM archivo WHERE id_subcategoria = '$id_subcategoria' ";
            $result = Connection :: getConnection()->query($query);

            $archivos = array();
            while($row = $result->fetch_assoc())
            {
                $archivo = new Archivo();
                $archivo->setIdArchivo($row['id_archivo']);
                $archivo->setFechaSubida($row['fecha_subida']);
                $archivo->setDescripcion($row['descripcion']);
                $archivo->setNombre($row['nombre']);
                $archivo->setIdSubcategoria($row['id_subcategoria']);
                $archivo->setIdUsuario($row['id_usuario']);
                $archivo->setEstado($row['estado']);
                array_push($archivos, $archivo);
            }
            Connection :: close();
            return $archivos;
        }
        function getUrl()
        {
            $url= Subcategoria::getFullUrlById($this->id_subcategoria);
            $url = DOCS_DIR . $url . '/'. $this->nombre;
            return $url;
        }

        static function searchArchivos($search,$id_subcategoria)
        {
            Connection :: connect();
            $query = "SELECT id_archivo,fecha_subida, descripcion, nombre, id_subcategoria, id_usuario,estado FROM archivo WHERE id_subcategoria ='$id_subcategoria' AND (descripcion LIKE '%$search%' OR nombre LIKE '%$search%')";
            echo($query);
            $result = Connection :: getConnection()->query($query);

            $archivos = array();
            while($row = $result->fetch_assoc())
            {
                $archivo = new Archivo();
                $archivo->setIdArchivo($row['id_archivo']);
                $archivo->setFechaSubida($row['fecha_subida']);
                $archivo->setDescripcion($row['descripcion']);
                $archivo->setNombre($row['nombre']);
                $archivo->setIdSubcategoria($row['id_subcategoria']);
                $archivo->setIdUsuario($row['id_usuario']);
                $archivo->setEstado($row['estado']);
                /*if($archivo->setIdSubcategoria($row['id_subcategoria']) == $id_subcategoria)
                {*/
                    array_push($archivos, $archivo);
                /*}*/
            }
            Connection :: close();
            return $archivos;
        }

        static function cambiarEstado($id,$estado)
        {
            $flag = false;
            Connection::connect();
            $query = "UPDATE archivo SET estado = '$estado' WHERE id_archivo = '$id' ";
            if(Connection::getConnection()->query($query))
            {
                $flag = true;
            }
            Connection::close();
            return $flag;
        }
}
?>
