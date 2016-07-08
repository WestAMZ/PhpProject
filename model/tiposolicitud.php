<?php

    class TipoSolicitud
    {
        var $id_tipo_solicitud;
        var $nombre;
        var $descripcion;
        var $estado;

        function __construct($id_tipo_solicitud,$nombre,$descripcion,$estado)
        {
            $this->id_tipo_solicitud = $id_tipo_solicitud;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->estado = $estado;
        }

        /*
            Metodos Setters
        */
        function setId_Tipo_Solicitud($id_tipo_solicitud)
        {
            $this->id_tipo_solicitud = $id_tipo_solicitud;
        }
        function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
        function setEstado($estado)
        {
            $this->estado = $estado;
        }

        /*
            Metodos Getters
        */
        function getId_Tipo_Solicitud()
        {
            return $this->id_tipo_solicitud;
        }
        function getNombre()
        {
            return $this->nombre;
        }
        function getDescripcion()
        {
            return $this->descripccion;
        }
        function getEstado()
        {
            return $this->estado;
        }
        static function getTipoSolicitud()
        {
            Connection :: connect();
            $query = 'SELECT idTipo_Solicitud, nombre, descripcion, estado FROM tipo_solicitud';
            $result = Connection :: getConnection()->query($query);
            $tipos_solicitudes = array();
            while($row = $result ->fetch_assoc())
            {
                $tipo_solicitud = new TipoSolicitud($row['idTipo_Solicitud'], $row['nombre'], $row['descripcion'], $row['estado']);
                array_push($tipos_solicitudes, $tipo_solicitud);
            }
            Connection :: close();
            return $tipos_solicitudes;
        }
    }

?>
