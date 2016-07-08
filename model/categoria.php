<?php
class Categoria
{
    var $id_categoria;
    var $nombre;
    var $descripcion;
    var $url;
    // CONSTRUCT
    public function __construct(){}
  /*  function __construct($id_categoria, $nombre, $descripcion, $url)
    {
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->url = $url;
    } */
    // SETTER AND GETTER METHODS
    function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
    function getIdCategoria()
    {
        return $this->id_categoria;
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
    function setUrl($url)
    {
        $this->url = $url;
    }
    function getUrl()
    {
        return $this->url;
    }
    static function getCategorias()
    {
        Connection :: connect();
        $query = 'SELECT id_categoria, nombre, descripcion, url FROM categoria';
        $result = Connection :: getConnection()->query($query);
        $categorias = array();
        if($result->num_rows >0)
        {
            while($row = $result->fetch_assoc())
            {
                $categoria = new Categoria();
                $categoria->setIdCategoria($row['id_categoria']);
                $categoria->setNombre($row['nombre']);
                $categoria->setDescripcion($row['descripcion']);
                $categoria->setUrl($row['url']);
                array_push($categorias, $categoria);
            }
        }
        Connection :: close();
        return $categorias;
    }
    static function saveCategoria()
    {
        $added = false;
        Connection :: connect();

        $query = "INSERT INTO categoria(nombre, descripcion, url) VALUES('$this->nombre', '$this->descripcion', '$this->url')";
        if(mkdir(DOCS_DIR . $this->url , 0777 ))
        {
            if(Connection :: getConnection() -> query($query))
            {
                $added = true;
            }
            else
            {
                $added = false;
                $this->add_error = '<div class="alert alert-dismissible alert-danger">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                         ha ocurrido un error </div>';
                $added = false;
            }
        }
        Connection :: close();
        return $added;
    }
}
?>
