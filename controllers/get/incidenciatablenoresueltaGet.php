<?php
    include_once( MODELS_DIR . 'insidencia.php');
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
    $insidencias = insidencia::Searchininsidencias($_GET['search']);
    foreach ($insidencias as &$insidencia)
    {
?>
    <tr id="<?php echo($insidencia->getIdinsidencia())?>" class="insidencia">
        <td>
            <?php echo($insidencia->getIdInsidencia())?>
        </td>
        <td>
            <?php echo($insidencia->getEstado())?>
        </td>
        <td>
            <?php echo($insidencia->getFecha())?>
        </td>
        <td>
            <?php echo($insidencia->getTitulo())?>
        </td>
        <td>
            <?php echo($insidencia->getDescripcion())?>
        </td>
        <td>
            <?php echo($insidencia->getId_Usuario())?>
        </td>
    </tr>
    <?php
    }
}
else
{
            $id = $_GET['id'];
            Connection :: connect();
            $query = "SELECT i.id_insidencia,
	                         i.estado,
	                         i.fecha,
	                         i.titulo,
	                         i.descripcion,
	                         CONCAT(e.nombre1, ' ', e.apellido2) AS 'usuario',
                             i.adjunto
                      FROM usuario u INNER JOIN insidencia i ON u.id_usuario = i.id_usuario
                      INNER JOIN empleado e on u.id_empleado = e.id_empleado
                      INNER JOIN sitio s ON e.id_sitio = s.id_sitio WHERE s.id_sitio = '$id'and i.estado = false ORDER BY i.id_insidencia DESC ";

            $result = Connection::getConnection()->query($query);
            while($row = $result->fetch_assoc())
            {

?>

        <tr id="<?php echo($row['id_insidencia'])?>" class="seguimiento2">
            <td>
                <?php echo($row['id_insidencia'])?>
            </td>
            <td>
                <?php
                    if($row['estado'] == 1)
                    {
                    ?>
                    <i class="fa fa-lock" style="font-size:30px;color:red"></i>
                    <?php
                    }
                    else
                    {
                    ?>
                        <i class="fa fa-unlock-alt" style="font-size:30px;color:green"></i>
                        <?php
                    }
                 ?>
            </td>
            <td>
                <?php echo($row['fecha'])?>
            </td>
            <td>
                <?php echo($row['titulo'])?>
            </td>
            <td>
                <?php echo($row['descripcion'])?>
            </td>
            <td>
                <?php echo($row['usuario'])?>
            </td>
            <td>
                <?php
                    if($row['adjunto'] != null)
                    {
                 ?>
                    <a href="<?php echo(INSIDENCIAS_DIR . $row['adjunto'])?>"> <i class="fa fa-paperclip" style="font-size:20px;color:blue"></i>
                        <?php echo($row['adjunto']) ?>
                    </a>
                    <?php
                    }
                ?>
            </td>
        </tr>
        <?php
            }
             Connection ::close();
    }
?>
