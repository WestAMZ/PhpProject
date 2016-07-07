<?php

    class LogAcceso
    {
        var $id_log_acceso;
        var $tiempo_ingreso;
        var $tiempo_salida;
        var $id_usuario;

        function __contruct($id_log_acceso, $tiempo_ingreso,$tiempo_salida,$id_usuario)
        {
            $this->id_log_acceso = $id_log_acceso;
            $this->tiempo_ingreso = $tiempo_ingreso;
            $this->tiempo_salida = $tiempo_salida;
            $this->id_usuario = $id_usuario;
        }

        /*
            metodos setters
        */
        function setId_Log_Acceso($id_log_acceso)
        {
            $this->id_log_acceso = $id_log_acceso;
        }
        function setTiempo_Ingreso($tiempo_ingreso)
        {
            $this->tiempo_ingreso = $tiempo_ingreso;
        }
        function setTiempo_Salida($tiempo_salida)
        {
            $this->tiempo_salida = $tiempo_salida;
        }
        function setId_Usuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
        }

        /*
        metodos getters
        */

        function getId_Log_Acceso()
        {
            return $this->id_log_acceso;
        }
        function getTiempo_Ingreso()
        {
            return $this->tiempo_ingreso;
        }
        function getTiempo_Salida()
        {
            return $this->tiempo_salida;
        }
        function getId_Usuario()
        {
            return $this->id_usuario;
        }
    }

?>
