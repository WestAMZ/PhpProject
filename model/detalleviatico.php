<?php
class Detalle_viatico
{
    var $id_detalle_viatico;
    var $fecha;
    var $numero_factura;
    var $concepto;
    var $monto;
    var $total;
    var $id_formato_viatico_reembolso;
    // contruct
    function __contruct($id_detalle_viatico, $fecha, $numero_factura, $concepto, $monto, $total, $id_formato_viatico_reembolso)
    {
        $this->id_detalle_viatico = $id_detalle_viatico;
        $this->fecha = fecha;
        $this->numero_factura = $numero_factura;
        $this->concepto = $concepto;
        $this->monto = $monto;
        $this->total = $total;
        $this->id_formato_viatico_reembolso = $id_formato_viatico_reembolso;
    }
    //Setter and Getter Methods
    function setIdDetalleViaticoReembolso($id_detalle_viatico_reembolso)
    {
        $this->id_detalle_viatico_reembolso = $id_detalle_viatico_reembolso;
    }
    function getIdDetalleViaticoReembolso()
    {
        return $this->id_detalle_viatico_reembolso;
    }
    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function getFecha()
    {
        return $this->fecha;
    }
    function setNumeroFactura($numero_factura)
    {
        $this->numero_factura = $numero_factura;
    }
    function getNumeroFactura()
    {
        return $this->numero_factura;
    }
    function setConcepto($concepto)
    {
        $this->concepto = $concepto;
    }
    function getConcepto()
    {
        return $this->concepto;
    }
    function setMonto($monto)
    {
        $this->monto = $monto;
    }
    function getMonto()
    {
        return $this->monto;
    }
    function setTotal($total)
    {
        $this->total = $total;
    }
    function getTotal()
    {
        return $this->total;
    }
    function setIdFormatoViaticoReembolso($id_formato_viatico_reembolso)
    {
        $this->id_formato_viatico_reembolso = $id_formato_viatico_reembolso;
    }
    function getIdFormatoViaticoReembolso()
    {
        return $this->id_formato_viatico_reembolso;
    }
}
?>
