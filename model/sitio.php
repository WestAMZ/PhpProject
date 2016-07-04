<?php
    /*
     Sitios
    */
  class Sitio
  {
      var $idSitio;
      var $nombre;
      var $pais;
      var $ciudad;
      var $direccion;
      var $telefono;
      var $latitud;
      var $longitud;
      var $estado;

    // constructor
    function __construct($idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado)
    {
        $this->idSitio = $idSitio;
        $this->nombre = $nombre;
        $this->pais = $pais;
        $this->ciudad = $ciudad;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->latitud = 0;
        $this->longitud = 0;
        $this->estado = $estado;
    }
 // Setter and Getter Methods
    function setIdSitio($idSitio)
    {
        $this->idSitio = $idSitio;
    }
    function getIdSitio()
    {
        return $this->idSitio;
    }
    function setName($nombre)
    {
        $this->nombre = $nombre;
    }
    function getName()
    {
        return $this->nombre;
    }
    function setCountry($pais)
    {
        $this->pais = $pais;
    }
    function getCountry()
    {
        return $this->pais;
    }
    function setCity($ciudad)
    {
        $this->ciudad = $ciudad;
    }
    function getCity()
    {
        return $this->ciudad;
    }
    function setAddress($direccion)
    {
        $this->direccion = $direccion;
    }
    function getAddress()
    {
        return $this->direccion;
    }
    function setTelefono($phone)
    {
        $this->telefono = $phone;
    }
    function getPhone()
    {
        return $this->telefono;
    }
    function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }
    function getLatitud()
    {
        return $this->latitud;
    }
    function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }
    function getLongitud()
    {
        return $this->longitud;
    }
    function setStatus($estado)
    {
        $this->estado = $estado;
    }
    function getStatus()
    {
        return $this->estado ;
    }
    function saveSitio()
    {
        $added = false;
        Connection :: connect();
        $query = "SELECT `nombre`, `pais`, `ciudad` `estado` FROM `sitio` WHERE nombre = '$this->nombre' AND pais != '$this->pais' AND ciudad != '$this->ciudad' LIMIT 1";
        $returned = Connection :: getConnection() -> query($query);
        if(!($returned->num_rows >0))
        {
            $query = "INSERT INTO `sitio`(`nombre`,`pais`,`ciudad`,`direccion`,`latitud`,`longitud`,`telefono`,`estado`) VALUES('$this->nombre','$this->pais','$this->ciudad','$this->direccion','$this->latitud','$this->longitud','$this->telefono',true)";
            $result = Connection :: getConnection() -> query($query);
            $added = true;
        }
        else
        {
            $obj = $returned->fetch_assoc();
              if(strtolower($obj['nombre']) == strtolower($this->nombre) and strtolower($obj['pais']) == strtolower($this->pais) and strtolower($obj['ciudad']) == strtolower($this->ciudad))
              {
                  $this->add_error = '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Ya existe un sitio con ese nombre en la misma ciudad y pais </div>';
              }
        }
        Connection :: close();
        return $added;
    }
    static function getSitios()
    {
        Connection :: connect();
        $query = "SELECT `id_sitio`, `nombre`, `pais`, `ciudad`, `direccion`, `latitud`, `longitud`, `telefono`, `estado` FROM `sitio`";
        $result = Connection::getConnection()->query($query);
        $sitios = array();
        while( $row = $result ->fetch_assoc())
        {
            //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
            $sitio = new Sitio( $row['id_sitio'] ,$row['nombre'] , $row['pais'] ,$row['ciudad'] ,$row['direccion'] , $row['telefono'] ,$row['latitud'] , $row['longitud']  , $row['estado']);
            array_push($sitios,$sitio);
        }
        Connection ::close();
        return $sitios;
    }

    function updateSitio()
    {
        Connection :: connect();

        $query = "UPDATE sitio set `nombre` = '$this->nombre', `pais` = '$this->pais', `ciudad` = '$this->ciudad', `direccion` = '$this->direccion', `latitud` = '$this->latitud', `longitud` = '$this->longitud', `telefono` = '$this->telefono', `estado` = '$this->estado' where `id_sitio` = '$this->idSitio'";
        $result = Connection::getConnection()->query($query);
        Connection :: close();
    }
    static function getSitioById($id)
    {
        Connection :: connect();
        $query = "SELECT `id_sitio`, `nombre`, `pais`, `ciudad`, `direccion`, `latitud`, `longitud`, `telefono`, `estado` FROM `sitio` WHERE id_sitio = '$id' ";
        $result = Connection::getConnection()->query($query);

        $row = $result ->fetch_assoc();

        //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
        $sitio = new Sitio( $row['id_sitio'] ,$row['nombre'] , $row['pais'] ,
        $row['ciudad'],$row['direccion'] , $row['telefono'] ,$row['latitud'] , $row['longitud'] ,
        $row['estado']);


        Connection ::close();
        return $sitio;
    }
    function cambiarEstado($id,$nuevo_estado)
    {
        Connection::connect();
        $query=" UPDATE `sitio` SET `estado`= $nuevo_estado' WHERE id_sitio = '$id'";
        Connection::geConnection()->query($query);
        Connection::close();
    }
    static function SearchinSitios($search)
    {
        Connection :: connect();
        $query = "SELECT `id_sitio`, `nombre`, `pais`, `ciudad`, `direccion`, `latitud`, `longitud`, `telefono`, `estado` FROM `sitio` WHERE `nombre` LIKE '%$search%' OR `pais` LIKE '%$search%' OR `ciudad` LIKE '%$search%' ";
        $result = Connection::getConnection()->query($query);
        $sitios = array();
        while( $row = $result ->fetch_assoc())
        {
            //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
            $sitio = new Sitio( $row['id_sitio'] ,$row['nombre'] , $row['pais'] ,$row['ciudad'] ,$row['direccion'] , $row['telefono'] ,$row['latitud'] , $row['longitud']  , $row['estado']);
            array_push($sitios,$sitio);
        }
        Connection ::close();
        return $sitios;
    }
}
?>
