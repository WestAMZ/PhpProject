<?php

    class Puesto
    {
        var $id_puesto;
        var $nombre;
        var $descripcion;
        var $add_error;

        /*
            COnstructor por defecto
        */

        function __construct($id_puesto,$nombre,$descripcion)
        {
            $this->id_puesto = $id_puesto;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
        }

        /*
            setters de la clase
        */

        function setId_Puesto($id_puesto)
        {
            $this->id_puesto = $id_puesto;
        }
        function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        /*
            getters de la clase
        */

        function getId_Puesto()
        {
            return $this->id_puesto;
        }
        function getNombre()
        {
            return $this->nombre;
        }
        function getDescripcion()
        {
            return $this->descripcion;
        }
        public static function getPuesto()
        {
            Connection :: connect();
            $query = 'SELECT `id_puesto`,`nombre`,`descripcion` FROM `puesto`';
            $result = Connection::getConnection()->query($query);
            $puestos = array();
            while( $row = $result ->fetch_assoc())
            {
                $puesto = new Puesto($row['id_puesto'],$row['nombre'],$row['descripcion']);
                array_push($puestos,$puesto);
            }
            Connection ::close();
            return $puestos;
        }
        function savePuesto()
        {
          $added = false;
          Connection :: connect();

            try
            {
                $query = "INSERT INTO puesto(nombre,descripcion) VALUES('$this->nombre', '$this->descripcion')";
                $result = Connection :: getConnection() -> query($query);
                $added = true;

            }catch(Exception $ex)
            {
                 $this->add_error = '<div class="alert alert-dismissible alert-danger">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     Yha ocurrido un error </div>';
            }
            Connection :: close();
            return added;
        }
    }

?>
