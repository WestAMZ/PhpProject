<?php
class Formato_vacaciones_licencia_medica
{
    var $id_formato_vacaciones_licencia_medica;
    var $numero_dias;
    var $periodo;
    var $inicio;
    var $termina;
    var $regresa;
    var $id_solicitud;
    // Construct
    function __construct($id_formato_vacaciones_licencia_medica, $numero_dias, $periodo, $inicio, $termina, $regresa, $id_solicitud)
    {
        $this->id_formato_vacaciones_licencia_medica = $id_formato_vacaciones_licencia_medica;
        $this->numero_dias = $numero_dias;
        $this->periodo = $periodo;
        $this->inicio = $inicio;
        $this->termina = $termina;
        $this->regresa = $regresa;
        $this->id_solicitud = $id_solicitud;
    }
    // Setter and Getters Methods
    function setIdFormatoVacacionesLicenciaMedica($id_formato_vacaciones_licencia_medica)
    {
        $this->id_formato_vacaciones_licencia_medica = $id_formato_vacaciones_licencia_medica;
    }
    function getIdFormatoVacacionesLicenciaMedica()
    {
        return $this->id_formato_vacaciones_licencia_medica;
    }
    function setNumeroDias($numero_dias)
    {
        $this->numero_dias = $numero_dias;
    }
    function getNumeroDias()
    {
        return $this->numero_dias;
    }
    function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }
    function getPeriodo()
    {
        return $this->peiodo;
    }
    function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }
    function getInicio()
    {
        return $this->inicio;
    }
    function setTermina($termina)
    {
        $this->termina = $termina;
    }
    function getTermina()
    {
        return $this->termina;
    }
    function setRegresa($regresa)
    {
        $this->regresa = $regresa;
    }
    function getRegresa()
    {
        return $this->regresa;
    }
    function setIdSolicitud($id_solicitud)
    {
        $this->id_solicitud = $id_solicitud;
    }
    function getIdSolicitud()
    {
        return $this->id_solicitud;
    }
}
?>
