<?php
    include( MODELS_DIR . 'insidencia.php');
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
	                         i.estado,terter
	                         i.fecha,
	                         i.titulo,
	                         i.descripcion,
	                         CONCAT(e.nombre1, ' ', e.apellido2) AS 'usuario'
                      FROM usuario u INNER JOIN insidencia i ON u.id_usuario = i.id_usuario
                      INNER JOIN empleado e on u.id_empleado = e.id_empleado
                      INNER JOIN sitio s ON e.id_sitio = s.id_sitio WHERE s.id_sitio = '$id' ORDER BY i.fecha DESC";

            $result = Connection::getConnection()->query($query);
            while($row = $result->fetch_assoc())
            {

?>

        <tr id="<?php echo($row['id_insidencia'])?>" class="insidencia">
            <td>
                <?php echo($row['id_insidencia'])?>
            </td>
            <td>
                <?php
                    if($row['estado'] == 1)
                    {
                        $img = 'locked.svg';
                    }
                    else
                    {
                        $img = 'locked-1.svg';
                    }
                 ?>
                 <img src="<?php IMG_DIR . $img ?>">
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
        </tr>
        <?php
            }
             Connection ::close();
    }
?>
