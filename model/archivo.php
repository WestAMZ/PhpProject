<?php
    class Archivo
    {
        var $id_archivo;
        var $fecha_subida;
        var $descripcion;
        var $id_subcategoria;

        function __construct($id_archivo,$fecha_subida,$descripcion,$id_subcategoria)
        {
            $this->id_archivo = $id_archivo;
            $this->fecha_subida = $fecha_subida;
            $this->descripcion = $descripcion;
            $this->$id_subcategoria;
        }
        /*
            Metodos setters
        */
        function setIdArchivo($id_archivo)
        {
            $this->id_archivo = $id_archivo;
        }
        /*
            Metodos getters
        */
    }
?>
