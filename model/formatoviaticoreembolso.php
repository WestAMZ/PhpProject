<?php
class Formato_viatico_reembolso
{
    var $id_formato_viatico_reembolso;
    var $fecha_salida;
    var $fecha_reingreso;
    var $ciudad;
    var $id_solicitud;

    function __contruct($id_formato_viatico_reembolso, $fecha_salida, $fecha_reingreso, $ciudad, $id_solicitud)
    {
        $this->id_formato_viatico_reembolso;
        $this->fecha_salida;
        $this->fecha_reingreso;
        $this->ciudad;
        $this->id_solicitud;
    }
    function setIdFormatoViaticoReembolso($id_formato_viatico_reembolso)
    {
        $this->id_formato_viatico_reembolso = $id_formato_viatico_reembolso;
    }
    function getIdFormatoViaticoReembolso()
    {
        return $this->id_formato_viatico_reembolso;
    }
    function setFechaSalida($fecha_salida)
    {
        $this->fecha_salida = $fecha_salida;
    }
    function getFechaSalida()
    {
        return $this->fecha_salida;
    }
    function setFechaReingreso($fecha_reingreso)
    {
        $this->fecha_reingreso = $fecha_reingreso;
    }
    function getFechaReingreso()
    {
        return $this->fecha_reingreso;
    }
    function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }
    function getCiudad()
    {
        return $this->ciudad;
    }
    function setIdSolicitud($id_solicitud)
    {
        $this->id_solicitud = $id_solicitud;
    }
}
?>
