<?php

    class Insidencia
    {
        var $id_insidencia;
        var $fecha;
        var $descripcion;
        var $nivel;
        var $estado;
        var $id_usuario;
        var $adjunto;
        var $titulo;

        function __construct($id_insidencia,$fecha,$descripcion,$nivel,$estado,$id_usuario,$adjunto, $titulo)
        {
            $this->id_insidencia = $id_insidencia;
            $this->fecha = $fecha;
            $this->descripcion = $descripcion;
            $this->nivel = $nivel;
            $this->estado = $estado;
            $this->id_usuario = $id_usuario;
            $this->adjunto = $adjunto;
            $this->titulo = $titulo;
        }

        /*
            MEtodos setters
        */
        function setId_Insidencia($id_insidencia)
        {
            $this->id_insidencia = $id_insidencia;
        }
        function setFecha($fecha)
        {
            $this->fecha = $fecha;
        }
        function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
        function setNivel($nivel)
        {
            $this->nivel = $nivel;
        }
        function setEstado($estado)
        {
            $this->estado = $estado;
        }
        function setId_Usuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
        }
        function setAdjunto($adjunto)
        {
            $this->adjunto = $adjunto;
        }
        function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }
        /*
            Metodos getters
        */
        function getTitulo()
        {
            return $this->titulo;
        }
        function getId_Insidencia()
        {
            return $this->id_insidencia;
        }
        function getFecha()
        {
            return $this->fecha;
        }
        function getDescripcion()
        {
            return $this->descripcion;
        }
        function getNivel()
        {
            return $this->nivel;
        }
        function getEstado()
        {
            return $this->estado;
        }
        function getId_Usuario()
        {
            return $this->id_usuario;
        }
        function getAdjunto()
        {
            return $this->adjunto;
        }

        //$id_insidencia,$fecha,$descripcion,$nivel,$estado,$id_usuario,$adjunto

        function saveInsidencia()
        {
            $added = false;
            try
            {
                Connection :: connect();
                $query = "INSERT INTO `insidencia`(`fecha`,`descripcion`,`nivel`,`estado`,`id_usuario`,`adjunto`) VALUES(CURRENT_DATE,'$this->descripcion','$this->nivel','$this->estado','$this->id_usuario','$this->adjunto')";
                $result = Connection :: getConnection() -> query($query);
                $added = true;


            }catch(Exception $e)
            {
                $this->add_error = '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    ha ocurrido un error :/ </div>';
            }

            Connection :: close();
            return $added;
        }
        static function getInsidencias($id)
        {
            Connection :: connect();
            $query = "SELECT i.id_insidencia,
	                         i.estado,
	                         i.fecha,
	                         i.titulo,
	                         i.descripcion,
	                         CONCAT(e.nombre1, ' ', e.apellido2) AS 'Usuario'
                      FROM usuario u INNER JOIN insidencia i ON u.id_usuario = i.id_usuario
                      INNER JOIN empleado e on u.id_empleado = e.id_empleado
                      INNER JOIN sitio s ON e.id_sitio = s.id_sitio WHERE s.id_sitio = '$id' ORDER BY i.fecha ASC";

            $result = Connection::getConnection()->query($query);
            $row = $result->fetch_assoc();

            Connection ::close();
            return $row;
        }
        static function uploadfile($filename)
        {
            $target_file = FILE_DIR . basename($filename["name"]);
            echo ( $target_file);
            $uploadOk = false;

                if (move_uploaded_file($_FILES["$filename"]["tmp_name"], $target_file))
                {
                    echo "The file ". basename( $_FILES["$filename"]["name"]). " has been uploaded.";
                    $uploadOk = true;
                }
                else
                {
                    echo "Sorry, there was an error uploading your file.";
                    $uploadOk = false;
                }



            return $uploadOk;
        }

        function cambiarEstado($id,$estado)
        {
            Connection::connect();
            $query = "UPDATE `insidencia` SET `estado`= '$estado' WHERE id_insidencia = '$id'";
            Connection::getConnection()->query($query);
            echo(Connection::getConnection()->affected_rows );
            Connection::close();
        }
    }

?>
