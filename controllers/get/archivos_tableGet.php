<?php
    include_once( MODELS_DIR . 'archivo.php');
    include_once( MODELS_DIR . 'usuario.php');
    $archivos = null;
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $archivos = Archivo::SearchArchivos($_GET['search'],$_GET['id']);
    }
    else
    {
        $archivos = Archivo::getAllArchivos($_GET['id']);
    }
    //echo(sizeof($archivos));
    foreach ($archivos as &$archivo)
    {
        $id = $archivo->getIdArchivo();
        $estado = $archivo->getEstado();
        $id_usuario = $archivo->getIdUsuario();
        $nombre_usuario = Usuario::getNameUser($id_usuario);
    ?>

    <tr class="categoria">
        <td><?php echo($archivo->getIdArchivo())?></td>
        <td><?php echo($archivo->getNombre())?></td>
        <td><?php echo($archivo->getDescripcion())?></td>
        <td><?php echo($archivo->getFechaSubida())?></td>
        <td><?php echo($nombre_usuario)?></td>
        <td><a href="<?php echo($archivo->getUrl())?>"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
</a></td>



        <td>
                <?php
                    if($archivo->getEstado()==1)
                    {

                        echo('<a class="btn cambiar-estado green" id="'. $id .'" estado="1">Desabilitar</a>');

                    }
                    else
                    {

                      echo('<a class="btn cambiar-estado red" id="'. $id .'" estado="0">Habilitar</a>');


                    }
                ?>
        </td>
    </tr>

<?php
    }

?>
