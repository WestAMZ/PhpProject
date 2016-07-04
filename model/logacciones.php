<?php

    class LogAcciones
    {
        var $id_log_acciones;
        var $fecha;
        var $accion;
        var $empleado_id_empleado;

        function __contruct($id_log_acciones,$fecha,$accion,$empleado_id_empleado)
        {
            $this->id_log_acciones = $id_log_acciones;
            $this->fecha = $fecha;
            $this->accion = $accion;
            $this->empleado_id_empleado = $empleado_id_empleado;
        }

        /*
            Metodos Setters
        */
        function setId_Log_Acciones($id_log_acciones)
        {
            $this->id_log_acciones = $id_log_acciones;
        }
        function setFecha($fecha)
        {
            $this->fecha = $fecha;
        }
        function setAccion($accion)
        {
            $this->accion = $accion;
        }
        function setEmpleado_Id_Empleado($empleado_id_empleado)
        {
            $this->empleado_id_empleado = $empleado_id_empleado;
        }

        /*
            Metodos GEtters
        */
        function getId_Log_Acciones()
        {
            return $this->id_log_acciones;
        }
        function getFecha()
        {
            return $this->fecha;
        }
        function getAccion()
        {
            return $this->accion;
        }
        function getEmpleado_Id_Empleado()
        {
            return $this->empleado_id_empleado;
        }
    }

?>
