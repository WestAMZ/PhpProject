<?php
include(MODELS_DIR .'categoria.php');
class Subcategoria
{
    var $id_subcategoria;
    var $nombre;
    var $img;
    var $id_categoria;
    var $url;
    var $estado;
    var $vista;
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
    function setImg($img)
    {
        $this->img = $img;
    }
    function getImg()
    {
        $img = "";
        if($this->img == null or $this->img == "")
        {
            $img = "folder-2.svg";
        }
        else
        {
            $img = $this->img;
        }
        return $img;
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
    function setVista($vista)
    {
        $this->vista= $vista;
    }
    function getVista()
    {
        $vista="";
        if($this->vista != "")
        {
            $vista = "view=" . $this->vista;
        }
        else
        {
            $vista = "view=archivo&id=".$this->id_subcategoria;
        }
        return $vista;
    }
    function add_error()
    {
        return $this->add_error;
    }
    function saveSubcategoria()
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

            $query = "INSERT INTO sub_categoria(nombre, img, id_categoria, url, estado) VALUES('$this->nombre', '$this->img', '$this->id_categoria', '$this->url', '1')";
            if(mkdir(DOCS_DIR . $categoria_url . '/' . $this->url , 0777 ))
            {
                if(Connection :: getConnection() -> query($query))
                {
                    $added = true;
                }
                else
                {
                    $added = false;
                    $this->add_error = Connection :: getConnection() ->error;
                        /*'<div class="alert alert-dismissible alert-danger">
                             <button type="button" class="close" data-dismiss="alert">&times;</button>
                             ha ocurrido un error </div>';*/
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
    static function getSubcategorias($url)
    {
        $categoria = Categoria::getCategoriaByUrl($url);
        $idcategoria = $categoria->getIdCategoria();
        Connection :: connect();
        $query = "SELECT id_subcategoria, nombre, img, id_categoria, url FROM sub_categoria WHERE estado = TRUE and id_categoria = '$idcategoria'";
        $result = Connection :: getConnection()->query($query);
        $subcategorias = array();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $subcategoria = new Subcategoria();
                $subcategoria->setIdSubcategoria($row['id_subcategoria']);
                $subcategoria->setNombre($row['nombre']);
                $subcategoria->setImg($row['img']);
                $subcategoria->setIdCategoria($row['id_categoria']);
                $subcategoria->setUrl($row['url']);
                array_push($subcategorias, $subcategoria);
            }


        }
        Connection :: close();
        return $subcategorias;
    }
    static function getAllSubcategorias($id_categoria)
    {
        Connection :: connect();
        $query = "SELECT id_subcategoria, nombre, img, id_categoria, estado, url FROM sub_categoria where id_categoria ='$id_categoria'";
        $result = Connection :: getConnection()->query($query);
        $subcategorias = array();
        while($row = $result->fetch_assoc())
        {
            $subcategoria = new Subcategoria();
            $subcategoria->setIdSubcategoria($row['id_subcategoria']);
            $subcategoria->setNombre($row['nombre']);
            $subcategoria->setImg($row['img']);
            $subcategoria->setIdCategoria($row['id_categoria']);
            $subcategoria->setEstado($row['estado']);
            $subcategoria->setUrl($row['url']);

            array_push($subcategorias, $subcategoria);
        }
        Connection :: close();
        return $subcategorias;
    }
    static function SearchSubCategoria($search,$id_categoria)
    {
        Connection :: connect();
        $query = "SELECT id_subcategoria,estado, nombre, img, url, id_categoria FROM sub_categoria WHERE id_categoria = '$id_categoria' and nombre LIKE '%$search%' ";
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
                $subcategoria->setImg($row['img']);
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
            $subcategoria->setImg($row['img']);
            $subcategoria->setIdCategoria($row['id_categoria']);
            $subcategoria->setUrl($row['url']);
            $subcategoria->setEstado($row['estado']);
            array_push($subcategorias, $subcategoria);
        }
        Connection :: close();
        return $subcategorias;
    }
    static function getFullUrlById($id)
    {
        Connection::connect();
        $full_url = "";
        $query = "SELECT CONCAT(c.url ,'/',s.url) as full_url FROM  categoria c INNER JOIN sub_categoria s ON c.id_categoria = s.id_categoria WHERE  s.id_subcategoria= '$id'";
        if($result = Connection::getConnection()->query($query))
        {
            if($result->num_rows >0)
            {
                $row = $result->fetch_assoc();
                $full_url =$row['full_url'];
            }
        }
        else
        {
            echo(Connection::getConnection()->error);
        }
        Connection::close();
        return $full_url;
    }
}
?>
