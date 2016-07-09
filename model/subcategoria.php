<?php
class Subcategoria
{
    var $id_subcategoria;
    var $nombre;
    var $descripcion;
    var $id_categoria;
    var $url;
    var $estado;
    var $add_error;
    // CONSTRUCT
    public function __construct(){}
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
    function setEstado($estado)
    {
        $this->estado = $estado;
    }
    function getEstado()
    {
        return $this->estado;
    }
    static function saveSubcategoria()
    {
        $added = false;
        Connection :: connect();
        $returned = Connection :: getConnection()->query("SELECT * FROM sub_categoria WHERE nombre ='$this->nombre'");
        if($returned->num_rows == 0)
        {
            $second_query = "SELECT url FROM categoria WHERE id_categoria = '$this->id_categoria'";
            $result = Connection :: getConnection()->query($second_query);
            $row = $result->fetch_assoc();
            $categoria_url = $row['url'];

            $query = "INSERT INTO sub_categoria(nombre, descripcion, id_categoria, url, estado) VALUES('$this->nombre', '$this->descripcion', '$this->id_categoria', '$this->url', '1')";

            if(mkdir(DOCS_DIR . $categoria_url . '/' . $this->url , 0777 ))
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
                }
            }
        }
        else
        {
            $added=false;
            $this->add_error = '<div class="alert alert-dismissible alert-danger">
                             <button type="button" class="close" data-dismiss="alert">&times;</button>
                             Ya existe una categoria con ese nombre </div>';
        }

        Connection :: close();
        return $added;


    }
    static function getSubcategorias()
    {
        Connection :: connect();
        $query = 'SELECT id_subcategoria, nombre, descripcion, id_categoria, url FROM sub_categoria WHERE stado = TRUE';
        $result = Connection :: getConnection()->query($query);
        $subcategorias = array();
        while($row = $result->fetch_assoc())
        {
            $subcategoria = new Subcategoria();
            $subcategoria->setIdSubcategoria($row['id_subcategoria']);
            $subcategoria->setNombre($row['nombre']);
            $subcategoria->setDescripcion($row['descripcion']);
            $subcategoria->setIdCategoria($row['id_categoria']);
            $subcategoria->setUrl($row['url']);
            array_push($subcategorias, $subcategoria);
        }
        Connection :: close();
        return subcategorias;
    }
    static function getAllSubcategorias()
    {
        Connection :: connect();
        $query = 'SELECT id_subcategoria, nombre, descripcion, id_categoria, url FROM sub_categoria';
        $result = Connection :: getConnection()->query($query);
        $subcategorias = array();
        while($row = $result->fetch_assoc())
        {
            $subcategoria = new Subcategoria();
            $subcategoria->setIdSubcategoria($row['id_subcategoria']);
            $subcategoria->setNombre($row['nombre']);
            $subcategoria->setDescripcion($row['descripcion']);
            $subcategoria->setIdCategoria($row['id_categoria']);
            $subcategoria->setUrl($row['url']);
            array_push($subcategorias, $subcategoria);
        }
        Connection :: close();
        return subcategorias;
    }
    static function SearchSubCategoria($search)
    {
        Connection :: connect();
        $query = "SELECT id_subcategoria,estado, nombre, descripcion, url, id_categoria FROM sub_categoria WHERE nombre LIKE '%$search%' ";
        $result = Connection :: getConnection()->query($query);
        $subcategorias = array();
        if($result->num_rows >0)
        {
            while($row = $result->fetch_assoc())
            {
                $subcategoria = new Categoria();
                $subcategoria->setEstado($row['estado']);
                $subcategoria->setIdCategoria($row['id_subcategoria']);
                $subcategoria->setNombre($row['nombre']);
                $subcategoria->setDescripcion($row['descripcion']);
                $subcategoria->setUrl($row['url']);
                $subcategoria->setIdCategoria($row['id_categoria']);
                array_push($categorias, $categoria);
            }
        }
        Connection :: close();
        return $categorias;
    }
    static function getSubcategoriaById($id_subcategoria)
    {
        Connection :: connect();
        $query = "SELECT * FROM sub_categoria WHERE id_subcategoria = '$id_subcategoria'";
        $result = Connection :: getConnection()->query($query);
        $subcategorias = array();
        while($row = $result->fetch_assoc())
        {
            $subcategoria = new Subcategoria();
            $subcategoria->setIdSubcategoria($row['id_subcategoria']);
            $subcategoria->setNombre($row['nombre']);
            $subcategoria->setDescripcion($row['descripcion']);
            $subcategoria->setIdCategoria($row['id_categoria']);
            $subcategoria->setUrl($row['url']);
            $subcategoria->setEstado($row['estado']);
            array_push($subcategorias, $subcategoria);
        }
        Connection :: close();
        return $subcategorias;
    }
}
?>
