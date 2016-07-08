<?php

    class Empleado
    {
        var $id_empleado;
        var $nombre1;
        var $nombre2;
        var $apellido1;
        var $apellido2;
        var $cedula;
        var $telefono;
        var $firma;
        var $id_puesto;
        var $id_sitio;
        var $id_jefe;
        var $inss;
        var $fecha_ingreso;
        var $fecha_retiro;
        var $estado;
        var $add_error;
        var $documentos;
        /*
        constructor por defecto
        */
        function __construct($id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado,$documentos)
        {
            //quité la fecha de retiro
            $this->id_empleado = $id_empleado;
            $this->nombre1 = $nombre1;
            $this->nombre2 = $nombre2;
            $this->apellido1 = $apellido1;
            $this->apellido2 = $apellido2;
            $this->cedula = $cedula;
            $this->telefono = $telefono;
            $this->firma = $firma;
            $this->id_puesto = $id_puesto;
            $this->id_sitio = $id_sitio;
            $this->id_jefe = $id_jefe;
            $this->inss = $inss;
            $this->fecha_ingreso = $fecha_ingreso;
           // $this->fecha_retiro = $fecha_retiro;
            $this->estado = $estado;
            $this->documentos = $documentos;
        }


        /*
         Metodos setters
        */
        function setDocumentos($documentos)
        {
            $this->documentos = $documentos;
        }
        function getDocumentos()
        {
            return $this->documentos;
        }
        function add_error()
		{
			return $this->add_error;
		}

        function setId_Empleado($id_empleado)
        {
            $this->id_empleado = $id_empleado;
        }
        function setNombre1($nombre1)
        {
            $this->nombre1 = $nombre1;
        }
        function setNombre2($nombre2)
        {
            $this->nombre2 = $nombre2;
        }
        function setApellido1($apellido1)
        {
            $this->apellido1 = $apellido1;
        }
        function setApellido2($apellido2)
        {
            $this->apellido2 = $apellido2;
        }
        function setCedula($cedula)
        {
            $this->cedula = $cedula;
        }
        function setTelefono($telefono)
        {
            $this->telefono = $telefono;
        }
        function setFirma($firma)
        {
            $this->firma = $firma;
        }
        function setId_Puesto($id_puesto)
        {
            $this->id_puesto = $id_puesto;
        }
        function setId_Sitio($id_sitio)
        {
            $this->id_sitio = $id_sitio;
        }
        function setId_Jefe($id_jefe)
        {
            $this->id_jefe = $id_jefe;
        }
        function setInss($inss)
        {
            $this->inss = $inss;
        }
        function setFecha_Ingreso($fecha_ingreso)
        {
            $this->fecha_ingreso = $fecha_ingreso;
        }
        function setFecha_Retiro($fecha_retiro)
        {
            $this->fecha_retiro = $fecha_retiro;
        }
        function setEstado($estado)
        {
            $this->estado = $estado;
        }

        /*
            Metodos getters
        */

        function getId_Empleado()
        {
            return $this->id_empleado;
        }
        function getNombre1()
        {
            return $this->nombre1;
        }
        function getNombre2()
        {
            return $this->nombre2;
        }
        function getApellido1()
        {
            return $this->apellido1;
        }
        function getApellido2()
        {
            return $this->apellido2;
        }
        function getCedula()
        {
            return $this->cedula;
        }
        function getTelefono()
        {
            return $this->telefono;
        }
        function getFirma()
        {
            return $this->firma;
        }
        function getId_Puesto()
        {
            return $this->id_puesto;
        }
        function getId_Sitio()
        {
            return $this->id_sitio;
        }
        function getId_Jefe()
        {
            return $this->id_jefe;
        }
        function getInss()
        {
            return $this->inss;
        }
        function getFecha_Ingreso()
        {
            return $this->fecha_ingreso;
        }
        function getFecha_Retiro()
        {
            return $this->fecha_retiro;
        }
        function getEstado()
        {
            return $this->estado;
        }

        static function getEmpleados()
        {
             Connection :: connect();
             $query = "SELECT `id_empleado`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `cedula`, `telefono`, `firma`, `id_puesto`, `id_sitio`, `id_jefe`, `inss`, `fecha_ingreso`, `estado` , `documentos` FROM `empleado` ";
             $result = Connection::getConnection()->query($query);
             $empleados = array();
             while( $row = $result ->fetch_assoc())
             {
                //$id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado
                 $empleado = new Empleado($row['id_empleado'],$row['nombre1'],$row['nombre2'],$row['apellido1'],$row['apellido2'],$row['cedula'],$row['telefono'],$row['firma'],$row['id_puesto'],$row['id_sitio'],$row['id_jefe'],$row['inss'],$row['fecha_ingreso'],$row['estado'],$row['documentos']);
                array_push($empleados,$empleado);
             }
            Connection ::close();
            return $empleados;
        }

        function saveEmpleado($correo,$role,$foto,$password)
        {
            $added = false;
            Connection :: connect();
            $returned = Connection :: getConnection() -> query("SELECT cedula FROM empleado WHERE cedula='$this->cedula'  LIMIT 1");


            if(!($returned->num_rows >0))
            {
                try
                {
                    $query = "INSERT INTO `empleado`(`id_empleado`,`nombre1`,`nombre2`,`apellido1`,`apellido2`,`cedula`,`telefono`,`firma`,`id_puesto`,`id_sitio`,`id_jefe`,`inss`,`fecha_ingreso`,`estado`,`documentos`) VALUES('$this->id_empleado','$this->nombre1','$this->nombre2','$this->apellido1','$this->apellido2','$this->cedula','$this->telefono','$this->firma','$this->id_puesto','$this->id_sitio','$this->id_jefe','$this->inss','$this->fecha_ingreso',1,'$this->documentos')";
                    $result = Connection :: getConnection() -> query($query);
                    $added = true;
                }catch(Exception $e)
                {
                    $added = false;

                    $this->add_error = '<div class="alert alert-dismissible alert-danger">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     Yha ocurrido un error </div>';
                }

                 if($added == true)
                    {
                        $query = "SELECT MAX(`id_empleado`) as id_empleado FROM `empleado`";
                        $result = Connection::getConnection()->query($query);
                        $row = $result ->fetch_assoc();
                        $id_empleado = $row['id_empleado'];
                        $password = Connection::codify($password);

                        $query2 = "INSERT INTO usuario(`correo`,`password`,`id_empleado`,`role`,`estado`,`foto`) VALUES('$correo','$password','$id_empleado','$role',1,'$foto')";
                        $result2 = Connection :: getConnection() -> query($query2);

                        $added = true;
                    }

            }
            else
            {
                $obj = $returned->fetch_assoc();
                if(strtolower($obj['cedula']) == strtolower($this->cedula))
                    {
                     $this->add_error = '<div class="alert alert-dismissible alert-danger">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     Ya existe un usuario registrado con este numero de cedula !! </div>';
                    }
            }
            return $added;
        }
        function getFullName()
        {
            $full_name = $this->getNombre1() . ' '. $this->getApellido1();
            return $full_name;
        }
        function getAllName()
        {
            $all_name = $this->getNombre1() . ' '.$this->getNombre2() . ' '. $this->getApellido1().' '.$this->getApellido2();
            return $all_name;
        }
        static function getEmpleadoById($id)
        {
            Connection::connect();
            $query = "SELECT `id_empleado`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `cedula`, `telefono`, `firma`, `id_puesto`, `id_sitio`, `id_jefe`, `inss`, `fecha_ingreso`, `estado`, `documentos` FROM `empleado` WHERE id_empleado = '$id' ";

            $result = Connection::getConnection()->query($query);
            $row = $result->fetch_assoc();
            $empleado =  new Empleado($row['id_empleado'],$row['nombre1'],$row['nombre2'],$row['apellido1'],
                $row['apellido2'],$row['cedula'],$row['telefono'],$row['firma'],$row['id_puesto'],
                $row['id_sitio'],$row['id_jefe'],$row['inss'],$row['fecha_ingreso'],$row['estado'],$row['documentos']);
            Connection::close();
            return $empleado;
        }
        static function searchInEmpleado($search)
        {
            Connection :: connect();
             $query = "SELECT `id_empleado`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `cedula`, `telefono`, `firma`, `id_puesto`, `id_sitio`, `id_jefe`, `inss`, `fecha_ingreso`, `estado`,`documentos` FROM empleado HAVING CONCAT(`nombre1`,' ', `nombre2`,' ', `apellido1`,' ',`apellido2`) LIKE  '%$search%' or `inss` LIKE '%$search%'  or `cedula` LIKE '%$search%'";
             $result = Connection::getConnection()->query($query);
             $empleados = array();
             while($row = $result ->fetch_assoc())
             {
                //$id_empleado,$nombre1,$nombre2,$apellido1,$apellido2,$cedula,$telefono,$firma,$id_puesto,$id_sitio,$id_jefe,$inss,$fecha_ingreso,$estado
                 $empleado = new Empleado($row['id_empleado'],$row['nombre1'],$row['nombre2'],$row['apellido1'],$row['apellido2'],$row['cedula'],$row['telefono'],$row['firma'],$row['id_puesto'],$row['id_sitio'],$row['id_jefe'],$row['inss'],$row['fecha_ingreso'],$row['estado'],$row['documentos']);
                array_push($empleados,$empleado);
             }
            Connection ::close();
            return $empleados;
        }


        function update($correo)
        {
            Connection :: connect();
            //activamos la modificación de llaves foraneas
            Connection::getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
            $query = " UPDATE
                      `empleado`
                    SET
                      `nombre1` = '$this->nombre1',
                      `nombre2` = '$this->nombre2',
                      `apellido1` = '$this->apellido1',
                      `apellido2` = '$this->apellido2',
                      `cedula` = '$this->cedula',
                      `telefono` = '$this->telefono',
                      `firma` = '$this->firma',
                      `id_puesto` = '$this->id_puesto',
                      `id_sitio` = '$this->id_sitio',
                      `id_jefe` = '$this->id_jefe',
                      `inss` = '$this->inss',
                      `fecha_ingreso` = '$this->fecha_ingreso',
                      `estado` = '$this->estado',
                      `documentos` = '$this->documentos'
                    WHERE
                      id_empleado = '$this->id_empleado' ";
            if(Connection::getConnection()->query($query))
            {
                echo('1');
            }
            else
            {
                echo(Connection::getConnection()->error);
            }
            //desactivamos  la modificación de llaves foraneas
            Connection::getConnection()->query('SET FOREIGN_KEY_CHECKS=1');
            Connection::getConnection()->query("UPDATE usuario SET correo = '$correo' WHERE id_empleado = '$this->id_empleado' ");
            Connection ::close();


        }

    }
?>
