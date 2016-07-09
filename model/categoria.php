<?php
class Categoria
{
    var $id_categoria;
    var $nombre;
    var $descripcion;
    var $url;
    var $estado;
    var $add_error;

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
    function setEstado($estado)
    {
        $this->estado = $estado;
    }
    function getEstado()
    {
        return $this->estado;
    }
    function add_error()
    {
        return $this->add_error;
    }

    static function getCategorias()
    {
        Connection :: connect();
        $query = 'SELECT id_categoria,estado, nombre, descripcion, url FROM categoria where estado = true';
        $result = Connection :: getConnection()->query($query);
        $categorias = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $categoria = new Categoria();
                $categoria->setEstado($row['estado']);
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
    static function getAllCategorias()
    {
        Connection :: connect();
        $query = 'SELECT id_categoria,estado, nombre, descripcion, url FROM categoria';
        $result = Connection :: getConnection()->query($query);
        $categorias = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $categoria = new Categoria();
                $categoria->setEstado($row['estado']);
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
    function saveCategoria()
    {
        $added = false;
        Connection :: connect();
        $returned = Connection :: getConnection()->query("SELECT * FROM categoria WHERE nombre ='$this->nombre'");
        if($returned->num_rows == 0)
        {
            $query = "INSERT INTO categoria(nombre, descripcion, url,estado) VALUES('$this->nombre', '$this->descripcion', '$this->url','1')";
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

    static function SearchCategoria($search)
    {
        Connection :: connect();
        $query = "SELECT id_categoria,estado, nombre, descripcion, url FROM categoria WHERE nombre LIKE '%$search%' ";
        $result = Connection :: getConnection()->query($query);
        $categorias = array();
        if($result->num_rows >0)
        {
            while($row = $result->fetch_assoc())
            {
                $categoria = new Categoria();
                $categoria->setEstado($row['estado']);
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
<<<<<<< HEAD
    static function getCategoriaById($id)
    {
        Connection :: connect();
        $query = "SELECT id_categoria,estado, nombre, descripcion, url FROM categoria where id_categoria= '$id'";
        $result = Connection::getConnection()->query($query);

        $row = $result ->fetch_assoc();
        $categoria = new Categoria();
        $categoria->setIdCategoria($row['id_categoria']);
        $categoria->setNombre($row['nombre']);
        $categoria->setDescripcion($row['descripcion']);
        $categoria->setUrl($row['url']);
        $categoria->setEstado($row['estado']);
        Connection ::close();
        return $categoria;
    }
    function updateCategoria()
    {
        Connection :: connect();
        $query = "UPDATE categoria set `nombre` = '$this->nombre',`descripcion` = '$this->descripcion' WHERE `id_categoria` = '$this->id_categoria'";
        $result = Connection::getConnection()->query($query);
        Connection :: close();
=======
    static function cambiarEstado($id , $estado)
    {
        $flag = false;
        Connection::connect();
        $query = "UPDATE categoria SET estado = '$estado' WHERE id_categoria = '$id' ";

        if(Connection::getConnection()->query($query))
        {
            $flag =true;
        }
        Connection::close();
        return $flag;
>>>>>>> origin/master
    }
}
?>
