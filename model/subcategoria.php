<?php
class Subcategoria
{
    var $id_subcategoria;
    var $nombre;
    var $descripcion;
    var $id_categoria;
    var $url;
    // CONSTRUCT
    public function __construct(){}
    public function __construct($id_subcategoria, $nombre, $descripcion, $id_subcategoria, $url)
    {
        $this->id_subcategoria = $id_subcategoria;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_categoria = $id_categoria;
        $this->url = $url;
    }
    // GETTER AND SETTER METHODS
    function setIdSubcategoria($id_subcategoria)
    {
        $this->id_subcategoria = $id_subcategoria;
    }
    function getIdSubcategoria()
    {
        return $this->id_subcategoria;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    function getDescripcion()
    {
        return $this->descripcion;
    }
    function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
    function getIdCategoria()
    {
        return $this->id_categoria;
    }
    function setUrl($url)
    {
        $this->url = $url;
    }
    function getUrl()
    {
        return $this->url;
    }
    static function saveSubcategoria()
    {
        $added = false;
        Connection :: connect();
        try
        {
            $query = 'INSERT INTO sub_categoria(nombre, descripcion, id_categoria, url) VALUES('$this->nombre', '$this->descripcion', '$this->id_categoria', '$this->url')';
            $result = Connection :: getConnection()->query($query);
            $added = true;
        }catch(Exception $e)
        {
            $added = false;
            $this->add_error = '<div class="alert alert-dismissible alert-danger">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     ha ocurrido un error </div>';
        }
        Connection :: close();
        return $added;
    }
}
?>
