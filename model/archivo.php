<?php
    class Archivo
    {
        var $id_archivo;
        var $nombre
        var $fecha_subida;
        var $descripcion;
        var $id_subcategoria;
        var $id_usuario;

        function __construct($id_archivo,$nombre,$fecha_subida,$descripcion,$id_subcategoria, $id_usuario)
        {
            $this->id_archivo = $id_archivo;
            $this->nombre = $nombre;
            $this->fecha_subida = $fecha_subida;
            $this->descripcion = $descripcion;
            $this->$id_subcategoria = $id_subcategoria;
            $this->id_usuario = $id_usuario;
        }
        /*
            Metodos setters
        */
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
        static function saveArchivo()
        {
            $added = false;
            Connection :: connect();
            try
            {
                $query = 'INSERT INTO archivo(fecha_subida, descripcion, nombre, id_subcategoria, id_usuario) VALUES('$this->fecha_subida', '$this->descripcion', '$this->nombre', '$this->id_subcategoria', '$this->id_usuario')';
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
    }
?>
