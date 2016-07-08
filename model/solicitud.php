<?php
class Solicitud
{
    var $id_solicitud;
    var $fecha_solicitud;
    var $observaciones;
    var $estado;
    var $id_empleado;
    var $fase;
    var $id_tipo_solicitud;
    var $generado_por;
    var $fecha_aprobacion;
    var $aprobado_por;

    public function __construct(){}
    function __contruct($id_solicitud, $fecha_solicitud, $observaciones, $estado, $id_empleado, $fase, $id_tipo_solicitud, $generado_por, $fecha_aprobacion, $aprobado_por)
    {
        $this->id_solicitud = $id_solicitud;
        $this->fecha_solicitud = $fecha_solicitud;
        $this->observaciones = $observaciones;
        $this->estado = $estado;
        $this->id_empleado = $id_empleado;
        $this->fase = $fase;
        $this->id_tipo_solicitud = $id_tipo_solicitud;
        $this->generado_por = $generado_por;
        $this->fecha_aprobacion = $fecha_aprobacion;
        $this->aprobador_por = $aprobado_por;
    }
    function setIdSolicitud($id_solicitud)
    {
        $this->id_solicitud = $id_solicitud;
    }
    function getIdSolicitud()
    {
        return $this->id_solicitud;
    }
    function setFechaSolicitud($fecha_solicitud)
    {
        $this->fecha_solicitud = $fecha_solicitud;
    }
    function getFechaSolicitud()
    {
        return $this->fecha_solicitud;
    }
    function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }
    function getObservaciones()
    {
        return $this->observaciones;
    }
    function setEstado($estado)
    {
        $this->estado = $estado;
    }
    function getEstado()
    {
        return $this->estado;
    }
    function setIdEmpleado($id_empleado)
    {
        $this->id_empleado = $id_empleado;
    }
    function getIdEmpleado()
    {
        return $this->id_empleado;
    }
    function setFase($fase)
    {
        $this->fase = $fase;
    }
    function getFase()
    {
        return $this->fase;
    }
    function setIdTipoSolicitud($id_tipo_solicitud)
    {
        $this->id_tipo_solicitud = $id_tipo_solicitud;
    }
    function getIdTipoSolicitud()
    {
        return $this->id_tipo_solicitud;
    }
    function setGeneradoPor($generado_por)
    {
        $this->generado_por = $generado_por;
    }
    function getGeneradoPor()
    {
        return $this->generado_por;
    }
    function setAprobadoPor($aprobado_por)
    {
        $this->aprovador_por = $aprobado_por;
    }
    function getAprobadoPor()
    {
        return $this->aprobado_por;
    }
    function setFechaAprobacion($fecha_aprobacion)
    {
        $this->fecha_aprobacion = $fecha_aprobacion;
    }
    function getFechaAprobacion()
    {
        return $this->fecha_aprobacion;
    }
    function saveSolicitud()
    {
        try
        {
        $estado = true;
        $added = false;
        Connection :: connect();
        Connection::getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $query = "INSERT INTO solicitud(fecha_solicitud, observacion, estado, id_empleado, fase, id_tipo_solicitud, generado_por, fecha_aprovacion, aprobado_por) VALUES(CURRENT_DATE, '$this->observaciones' ,'$this->estado', '$this->id_empleado', '1' ,'$this->id_tipo_solicitud','$this->generado_por',CURRENT_DATE,'$this->aprobado_por')";
        $result = Connection :: getConnection()->query($query);
        echo($result = Connection :: getConnection()->error);
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
}
?>
